<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class CommentNotifications extends Component
{
	const NOTIFICATION_THRESHOLD = 20;

	public $notifications;

	public $notificationCount;

	public $isLoading;

	protected $listeners = ['getNotifications'];

	public function mount()
	{
		$this->notifications = collect([]);
		$this->isLoading = true;
		$this->getNotificationCount();
	}

	public function getNotificationCount()
	{
		$this->notificationCount = auth()->user()->unreadNotifications()->count();

		if ($this->notificationCount > self::NOTIFICATION_THRESHOLD)
		{
			$this->notificationCount = self::NOTIFICATION_THRESHOLD . '+';
		}
	}

	public function getNotifications()
	{
		$this->notifications =
		auth()
		->user()
		->unreadNotifications()
		->latest()
		->take(self::NOTIFICATION_THRESHOLD)
		->get();

		$this->isLoading = false;
	}

	public function markAsRead($notificationId)
	{
		$notification = DatabaseNotification::findOrFail($notificationId);

		$notification->markAsRead();

		$comment = Comment::find($notification->data['comment_id']);

		if (!$comment)
		{
			session()->flash('success_message', 'This comment no longer exists!');

			return redirect()->route('idea.index');
		}

		return redirect()->route('idea.show', [
			'idea' => $notification->data['idea_slug'],
		]);
	}

	public function markAllAsRead()
	{
		auth()->user()->unreadNotifications->markAsRead();
		$this->getNotificationCount();
		$this->getNotifications();
	}

	public function render()
	{
		return view('livewire.comment-notifications');
	}
}
