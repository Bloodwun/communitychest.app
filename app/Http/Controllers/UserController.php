<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function root()
	{
		if (!Auth::check())
		{
			return view('user.login');
		}
		session()->flash('success', 'Login Successfully.');
		return view('user.dashboard');
	}
	public function contactsProfile()
	{
		return view('user.contacts-profile');
	}
	public function Approve($id)
	{
		$community = Community::where('id', $id)->first();
		if (!$community)
			return \Redirect::back()->with('error', "Data not found!");
		$community->status = 1;
		$community->save();

		// change the user status 

		$user = User::where('id', $community->discord_id)->first();
		$user->user_status = 2;
		$user->member_since = \Carbon\Carbon::now();
		$user->save();
		return \Redirect::back()->with('Success', "Approved Successfully!");
	}
	public function Reject($id)
	{
		$community = Community::where('id', $id)->first();
		if (!$community)
			return \Redirect::back()->with('error', "Data not found!");
		$community->status = 2;
		$community->save();

		return \Redirect::back()->with('Success', "Reject Successfully!");
	}
}
