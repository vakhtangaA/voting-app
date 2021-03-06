<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamManagementTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function shows_mark_idea_as_spam_livewire_component_when_user_has_authorization()
	{
		$user = User::factory()->create();
		$idea = Idea::factory()->create([]);

		$this->actingAs($user)
			->get(route('idea.show', $idea))
			->assertSeeLivewire('mark-idea-as-spam');
	}

	/** @test */
	public function does_not_show_mark_idea_as_spam_livewire_component_when_user_does_not_have_authorization()
	{
		$user = User::factory()->create();
		$idea = Idea::factory()->create([]);

		$this->get(route('idea.show', $idea))
			 ->assertDontSeeLivewire('mark-idea-as-spam');
	}
}
