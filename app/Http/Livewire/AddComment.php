<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class AddComment extends Component
{
	public Idea $idea;

	public $comment;

	protected $rules = [
		'comment' => 'required|min:4',
	];

	public function addComment()
	{
		if (auth()->guest())
		{
			abort(Response::HTTP_FORBIDDEN);
		}

		$this->validate();

		Comment::create([
			'user_id' => auth()->id(),
			'idea_id' => $this->idea->id,
			'body'    => $this->comment,
		]);

		$this->reset('comment');

		$this->emit('commentWasAdded', 'Comment was posted!');
	}

	public function render()
	{
		return view('livewire.add-comment');
	}
}
