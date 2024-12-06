<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;

class StaffController extends Controller
{
	public function root()
	{
		if (!Auth::check()) {
			return view('user.login');
		}
		session()->flash('success', 'Login Successfully.');
		return view('staff.dashboard');
	}
	public function register(Request $request)
	{
		return view('staff.register');
	}
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'city' => ['required', 'string', 'max:255'],
			'state' => ['required', 'string', 'max:255'],
			'zip_code' => ['required', 'string', 'max:255'],
			// 'referral_code' => ['required', 'string', 'max:255'],
			'address' => ['required', 'string', 'max:255'],
			'phone_number' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'user_name' => ['required', 'string', 'string', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data)
	{
		$user =  User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'middle_name' => $data['middle_name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'role_id' => $data['role_id'],
			'user_name' => $data['user_name'],
			'city' => $data['city'],
			'state' => $data['state'],
			'zip_code' => $data['zip_code'],
			'phone_number' => $data['phone_number'],
			'address' => $data['address'],
			'referral_code' => $data['referral_code'] ?? null,
			'parent_user_id' => (Auth::user() != null) ? Auth::user()->id : null

		]);
		session()->flash('success', 'Registeration Successfully.');

		return $user;
	}
	public function submitRegister(Request $request)
	{
		// Validate the request data
		$this->validator($request->all())->validate();

		// Create the user
		$user = $this->create($request->all());

		// Redirect or handle response
		return \Redirect::route('staff.user.list')->with('message', 'success!!!');
	}
	public function users(Request $request)
	{

		if ($request->ajax()) {
			$parent_user_id = (Auth::user() != null)? Auth::user()->id : -1;
			$users = User::where('parent_user_id',$parent_user_id)->select(['id', 'first_name', 'email','city','state','address','zip_code','created_at']); // Select only necessary columns
			return DataTables::eloquent($users)
				// ->addColumn('actions', function ($user) {
				//     // Add custom column data if needed
				//     return '<button class="btn btn-sm btn-info">View</button>';
				// })
				// ->rawColumns(['actions'])
				->toJson();
		}
		return view('staff.users.index');
	}
}
