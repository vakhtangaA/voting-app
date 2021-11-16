<?php

namespace Tests\Unit\Jobs;

use App\Jobs\NotifyAllVoters;
use App\Mail\IdeaStatusUpdateMailable;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\Vote;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class NotifyAllVotersTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function it_sends_an_email_to_all_voters()
	{
		$user = User::factory()->create([
			'email' => 'vakhtang.chitauri@gmail.com',
		]);

		$userB = User::factory()->create([
			'email' => 'vakhtangaa.chitauri@gmail.com',
		]);

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);

		$statusConsidering = Status::factory()->create(['name' => 'Considering']);

		$idea = Idea::factory()->create([
			'user_id'     => $user->id,
			'category_id' => $categoryOne->id,
			'status_id'   => $statusConsidering->id,
			'title'       => 'My First Idea',
			'description' => 'My first description',
		]);

		Vote::create([
			'idea_id' => $idea->id,
			'user_id' => $user->id,
		]);

		Vote::create([
			'idea_id' => $idea->id,
			'user_id' => $userB->id,
		]);

		Mail::fake();

		NotifyAllVoters::dispatch($idea);

		Mail::assertQueued(IdeaStatusUpdateMailable::class, function ($mail) {
			return $mail->hasTo('vakhtang.chitauri@gmail.com');
		});

		Mail::assertQueued(IdeaStatusUpdateMailable::class, function ($mail) {
			return $mail->hasTo('vakhtangaa.chitauri@gmail.com');
		});
	}
}
