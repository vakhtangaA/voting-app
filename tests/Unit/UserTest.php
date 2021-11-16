<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function can_check_if_user_is_an_admin()
	{
		$userA = User::factory()->create([
			'name'  => 'vakho',
			'email' => 'vakhtang.chitauri@gmail.com',
		]);

		$userB = User::factory()->create([
			'name'  => 'vakho',
			'email' => 'admin@gmail.com',
		]);

		$this->assertTrue($userA->isAdmin());
		$this->assertFalse($userB->isAdmin());
	}
}
