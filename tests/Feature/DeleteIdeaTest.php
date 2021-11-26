<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteIdeaTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function shows_delete_idea_livewire_component_when_user_has_authorization()
	{
		$user = User::factory()->create();
		$idea = Idea::factory()->create([
			'user_id' => $user->id,
		]);

		$this->actingAs($user)
			->get(route('idea.show', $idea))
			->assertSeeLivewire('delete-idea');
	}

	/** @test */
	public function does_not_show_delete_idea_livewire_component_when_user_does_not_have_authorization()
	{
		$user = User::factory()->create();
		$idea = Idea::factory()->create([]);

		$this->actingAs($user)
			->get(route('idea.show', $idea))
			->assertDontSeeLivewire('delete-idea');
	}

	/** @test */
	public function deleting_an_idea_does_not_show_on_menu_when_user_does_not_have_authorization()
	{
		$user = User::factory()->create();
		$idea = Idea::factory()->create([]);

		Livewire::actingAs($user)
			->test(IdeaShow::class, [
				'idea'       => $idea,
				'votesCount' => 4,
			])
			->assertDontSee('Delete Idea', true);
	}
}
