<?php

namespace Tests\Feature;

use App\Http\Livewire\SetStatus;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class AdminSetStatusTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function show_page_contains_set_status_livewire_component_when_user_is_admin()
	{
		$user = User::factory()->create([
			'email' => 'vakhtang.chitauri@gmail.com',
		]);

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusOpen = Status::factory()->create(['name' => 'Open']);

		$idea = Idea::factory()->create([
			'user_id'     => $user->id,
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
			'title'       => 'My First Idea',
			'description' => 'My first description',
		]);

		$this->actingAs($user)
			->get(route('idea.show', $idea))
			->assertSeeLivewire('set-status');
	}

	/** @test */
	public function show_page_not_contains_set_status_livewire_component_when_user_is_not_admin()
	{
		$user = User::factory()->create([
			'email' => 'notAdmin.chitauri@gmail.com',
		]);

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusOpen = Status::factory()->create(['name' => 'Open']);

		$idea = Idea::factory()->create([
			'user_id'     => $user->id,
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
			'title'       => 'My First Idea',
			'description' => 'My first description',
		]);

		$this->actingAs($user)
			->get(route('idea.show', $idea))
			->assertDontSeeLivewire('set-status');
	}

	/** @test */
	public function initial_status_is_set_correctly()
	{
		$user = User::factory()->create([
			'email' => 'vakhtang.chitauri@gmail.com',
		]);

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusConsidering = Status::factory()->create(['name' => 'Considering']);

		$idea = Idea::factory()->create([
			'user_id'     => $user->id,
			'category_id' => $categoryOne->id,
			'status_id'   => $statusConsidering->id,
			'title'       => 'My First Idea',
			'description' => 'My first description',
		]);

		Livewire::actingAs($user)
			->test(SetStatus::class, [
				'idea' => $idea,
			])
			->assertSet('status', $statusConsidering->id);
	}
}
