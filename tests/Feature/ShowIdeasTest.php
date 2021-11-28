<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function single_idea_shows_correctly_on_the_main_page()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusOpen = Status::factory()->create(['name' => 'Open']);
		$statusConsidering = Status::factory()->create(['name' => 'Considering']);

		$ideaOne = Idea::factory()->create([
			'user_id'     => $user->id,
			'title'       => 'My First Idea',
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
			'description' => 'My first description',
		]);

		$ideaTwo = Idea::factory()->create([
			'user_id'     => $user->id,
			'title'       => 'My First Idea',
			'category_id' => $categoryTwo->id,
			'status_id'   => $statusConsidering->id,
			'description' => 'My first description',
		]);

		$response = $this->get(route('idea.index'));

		$response->assertSuccessful();
		$response->assertSee($ideaOne->title);
		$response->assertSee($ideaOne->description);
		$response->assertSee($categoryOne->name);

		$response->assertSee($ideaTwo->title);
		$response->assertSee($ideaTwo->description);
		$response->assertSee($categoryTwo->name);
	}

	/** @test */
	public function same_idea_title_different_slugs()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusOpen = Status::factory()->create(['name' => 'Open']);
		$statusConsidering = Status::factory()->create(['name' => 'Considering']);

		$ideaOne = Idea::factory()->create([
			'user_id'     => $user->id,
			'title'       => 'My First Idea',
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
		]);
		$ideaTwo = Idea::factory()->create([
			'user_id'     => $user->id,
			'title'       => 'My First Idea',
			'category_id' => $categoryTwo->id,
			'status_id'   => $statusConsidering->id,
		]);

		$response = $this->get(route('idea.show', $ideaOne));

		$response->assertSuccessful();
		$this->assertTrue(request()->path() === 'ideas/my-first-idea');

		$response = $this->get(route('idea.show', $ideaTwo));

		$response->assertSuccessful();
		$this->assertTrue(request()->path() === 'ideas/my-first-idea-2');
	}

	/** @test */
	public function in_app_button_works_when_index_page_visited_first()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusOpen = Status::factory()->create(['name' => 'Open']);
		$statusConsidering = Status::factory()->create(['name' => 'Considering']);

		$ideaOne = Idea::factory()->create([
			'user_id'     => $user->id,
			'title'       => 'My First Idea',
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
			'description' => 'My first description',
		]);

		$response = $this->get('/?category=Category%202&status=Considering');
		$response = $this->get(route('idea.show', $ideaOne));

		$this->assertStringContainsString('/?category=Category%202&status=Considering', $response['backUrl']);
	}

	/** @test */
	public function in_app_button_works_when_show_page_visited()
	{
		$user = User::factory()->create();

		$categoryOne = Category::factory()->create([
			'name' => 'Category 1',
		]);
		$categoryTwo = Category::factory()->create([
			'name' => 'Category 2',
		]);

		$statusOpen = Status::factory()->create(['name' => 'Open']);
		$statusConsidering = Status::factory()->create(['name' => 'Considering']);

		$ideaOne = Idea::factory()->create([
			'user_id'     => $user->id,
			'title'       => 'My First Idea',
			'category_id' => $categoryOne->id,
			'status_id'   => $statusOpen->id,
			'description' => 'My first description',
		]);

		$response = $this->get(route('idea.show', $ideaOne));

		$this->assertEquals(route('idea.index'), $response['backUrl']);
	}
}
