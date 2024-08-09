<?php

namespace App\Constants;

class Message
{
	// General Constants
	const PERMISSION_DENIED = 'You don\'t have access to this operation.';
	const INVALID_TOKEN = 'This token is invalid! The user could not be found.';
	const SOMETHING_WENT_WRONG = 'Something went wrong. please try again later!';
	const INVALID_INPUT_VALUES = 'Invalid input values.';
	const TOKEN_EXPIRED = 'The token has expired.';
	const TOKEN_NOT_FOUND = 'The token could not be found.';
	const REQUEST_SUCCESSFUL = 'Request successful.';
	const INVALID_ID = 'Invalid id.';
	const DATA_UPDATED_SUCCESSFULLY = "The data was successfully updated.";
	const NOT_ADMIN = 'This operation is only available to administrators.';
};