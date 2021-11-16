<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteIndexPageTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function index_page_contains_idea_index_livewire_component()
	{
		Idea::factory()->create();

		$this->get(route('idea.index'))
			 ->assertSeeLivewire('idea-index');
	}
}
