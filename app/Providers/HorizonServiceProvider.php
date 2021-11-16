<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		// Horizon::routeSmsNotificationsTo('15556667777');
		// Horizon::routeMailNotificationsTo('example@example.com');
		// Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');

		Horizon::night();
	}

	/**
	 * Register the Horizon gate.
	 *
	 * This gate determines who can access Horizon in non-local environments.
	 *
	 * @return void
	 */
	protected function gate()
	{
		Gate::define('viewHorizon', function ($user) {
			return in_array($user->email, [
				'vakhtang.chitauri@gmail.com',
				'vakhtang1.chitauri@gmail.com',
				'vakhtang2.chitauri@gmail.com',
			]);
		});
	}
}
