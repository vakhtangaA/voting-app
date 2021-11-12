<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteIndexPageTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function index_page_contains_idea_index_livewire_component()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create(['name' => 'Category 1']);

		$statusOpen = Status::factory()->create(['name'=> 'Open', 'classes' => 'bg-gray-200']);

		$idea = Idea::factory()->create([
			'user_id'     => $user->id,
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
			'title'       => 'My First Idea',
			'description' => 'Description for my first idea',
		]);

		$this->get(route('idea.index'))
			 ->assertSeeLivewire('idea-index');
	}
}
