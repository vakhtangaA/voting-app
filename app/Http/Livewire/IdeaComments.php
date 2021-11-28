<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
	use WithPagination;

	public Idea $idea;

	protected $listeners = ['commentWasAdded', 'commentWasDeleted', 'statusWasUpdated'];

	public function commentWasAdded()
	{
		$this->idea->refresh();
	}

	public function commentWasDeleted()
	{
		$this->idea->refresh();
		$this->gotoPage(1);
	}

	public function statusWasUpdated()
	{
		$this->idea->refresh();
		$this->goToPage($this->idea->comments()->paginate()->lastPage());
	}

	public function render()
	{
		return view('livewire.idea-comments', [
			'comments' => Comment::with(['user', 'status'])->where('idea_id', $this->idea->id)->paginate()->withQueryString(),
		]);
	}
}
