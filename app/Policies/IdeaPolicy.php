<?php

namespace App\Policies;

use App\Models\User;
use App\Models\idea;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdeaPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user)
	{
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\idea $idea
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, idea $idea)
	{
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function create(User $user)
	{
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\idea $idea
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, idea $idea)
	{
		return $user->id === (int) $idea->user_id
			&& now()->subHour() <= $idea->created_at;
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\idea $idea
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, idea $idea)
	{
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\idea $idea
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function restore(User $user, idea $idea)
	{
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\idea $idea
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function forceDelete(User $user, idea $idea)
	{
	}
}
