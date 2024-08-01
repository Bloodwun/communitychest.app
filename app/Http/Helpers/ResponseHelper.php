<?php

// Constants
use App\Constants\Message;
use App\Constants\ResponseCode;


/**
 * Return default object.
 *
 * @return object
 */
function invalidTokenResponse()
{
	return [
            'data' => [
                'code'      => ResponseCode::FAIL,
                'message'   => Message::INVALID_TOKEN,
                'serverMaintenance' => env("SERVER_MAINTENANCE"),
            ],
            'status' => false
        ];
}


/**
 * Return default object.
 *
 * @return object
 */
function defaultErrorResponse()
{
	return [
            'data' => [
                'code' => ResponseCode::FAIL,
                'message' => Message::SOMETHING_WENT_WRONG,
                'serverMaintenance' => env("SERVER_MAINTENANCE"),
            ],
            'status' => false
        ];
}

/**
 * Make json object.
 *
 * @param  integer $code
 * @param  string $message
 * @param  boolean $status
 * @param  string $errors (optional)
 * @param  object $data
 * @return array
 */
function makeResponse($code,$message,$status,$errors=null,$data=null)
{
	return [
            'data' => [
                'code' => $code,
                'message' => $message,
                'result' => $data,
                'errors' => $errors,
                'serverMaintenance' => env("SERVER_MAINTENANCE"),
            ],
           'status' => $status
        ];
}