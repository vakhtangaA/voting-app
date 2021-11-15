<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class SearchFilterTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function searching_works_when_more_than_3_characters()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create(['name' => 'Category 1']);
		$categoryTwo = Category::factory()->create(['name' => 'Category 2']);

		$statusOpen = Status::factory()->create(['name' => 'Open']);

		$ideaOne = Idea::factory()->create([
			'user_id'           => $user->id,
			'category_id'       => $categoryOne->id,
			'status_id'         => $statusOpen->id,
			'title'             => 'My First Idea',
			'description'       => 'Description for my first idea',
		]);

		$ideaTwo = Idea::factory()->create([
			'user_id'           => $user->id,
			'category_id'       => $categoryOne->id,
			'status_id'         => $statusOpen->id,
			'title'             => 'My Second Idea',
			'description'       => 'Description for my first idea',
		]);

		$ideaThree = Idea::factory()->create([
			'user_id'           => $user->id,
			'category_id'       => $categoryOne->id,
			'status_id'         => $statusOpen->id,
			'title'             => 'My Third Idea',
			'description'       => 'Description for my first idea',
		]);

		Livewire::test(IdeasIndex::class)
			->set('search', 'Second')
			->assertViewHas('ideas', function ($ideas) {
				return $ideas->count() === 1
					&& $ideas->first()->title === 'My Second Idea';
			});
	}

	/** @test */
	public function does_not_perform_search_if_less_than_3_characters()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create(['name' => 'Category 1']);
		$categoryTwo = Category::factory()->create(['name' => 'Category 2']);

		$statusOpen = Status::factory()->create(['name' => 'Open']);

		$ideaOne = Idea::factory()->create([
			'user_id'           => $user->id,
			'category_id'       => $categoryOne->id,
			'status_id'         => $statusOpen->id,
			'title'             => 'My First Idea',
			'description'       => 'Description for my first idea',
		]);

		$ideaTwo = Idea::factory()->create([
			'user_id'           => $user->id,
			'category_id'       => $categoryOne->id,
			'status_id'         => $statusOpen->id,
			'title'             => 'My Second Idea',
			'description'       => 'Description for my first idea',
		]);

		$ideaThree = Idea::factory()->create([
			'user_id'           => $user->id,
			'category_id'       => $categoryOne->id,
			'status_id'         => $statusOpen->id,
			'title'             => 'My Third Idea',
			'description'       => 'Description for my first idea',
		]);

		Livewire::test(IdeasIndex::class)
			->set('search', 'qw')
			->assertViewHas('ideas', function ($ideas) {
				return $ideas->count() === 3;
			});
	}
}
