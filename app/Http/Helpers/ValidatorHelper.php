<?php

// Constants
use App\Constants\Rule;

// Validator
use Illuminate\Support\Facades\Validator;


/**
 * Return Rules Object.
 *
 * @param  string $api
 * @return object
 */
function getRule($api)
{
	return Rule::get($api);
}

/**
 * Validate Rules.
 *
 * @param  object $request
 * @param  string $apiRule
 * @return object
 */
function validateData($request, $apiRule, $customMessages=[])
{
	$rules = getRule($apiRule);
	$validator = Validator::make($request->all(), $rules, $customMessages);
	
	if ($validator->fails()) 
	{
		return [ 'status'=>true, 'errors'=>$validator->messages()];
	}
	return [ 'status'=>false ];
}
function validateDataRules($request, $rules, $customMessages=[])
{
	$validator = Validator::make($request->all(), $rules, $customMessages);
	
	if ($validator->fails()) 
	{
		return [ 'status'=>true, 'errors'=>$validator->messages()];
	}
	return [ 'status'=> false ];
}