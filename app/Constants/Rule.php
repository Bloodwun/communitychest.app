<?php

namespace App\Constants;

class Rule
{
	// Rules According to API's
	private static $rules = [
		'ADD_TICKET' => [
			'user_id'         => 'required',
			'ticket_url'	  => 'required',
		],
		'UPDATE_PROFILE' => [
			'id'         => 'required',
			'user_note'	  => 'required',
			'user_status'	  => 'required',
		],
		'UPDATE_USER' => [
			'community_id' => 'required',
			'steam_ID64'   => 'required',
			'discord_username'   => 'required',

		]

	];

	public static function get($api)
	{
		return self::$rules[$api];
	}
}
