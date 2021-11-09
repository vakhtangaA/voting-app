<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function ideas()
	{
		return $this->hasMany(Idea::class);
	}

	public function votes()
	{
		return $this->belongsToMany(Idea::class, 'votes');
	}

	public function getAvatar()
	{
		$firstCharacter = $this->email[0];

		if (is_numeric($firstCharacter))
		{
			$intergerToUse = ord(strtolower($firstCharacter)) - 21;
		}
		else
		{
			$intergerToUse = ord(strtolower($firstCharacter)) - 96;
		}

		return 'https://en.gravatar.com/avatar/'
		 . md5($this->email)
		 . '?s=200'
		 . '&d=mp'
		 . 'https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
		 . $intergerToUse
		 . '.png';
	}
}
