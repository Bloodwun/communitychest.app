<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DB;
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

	public function edit($id)
	{
		// Find the user by ID
		$user = User::findOrFail($id);
	
		// Pass the user data to the edit view
		return view('owner.admin.edit', compact('user'));
	}

    public function update(Request $request, $id) {
        // Find the user by ID
        $user = User::findOrFail($id);
    
        // Validate the fields
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $id,
            'role_id' => 'required|exists:admin_roles,id', // Ensure role exists
            'zip_code' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'referral_code' => 'nullable|string|max:255',
            'email_verified_at' => 'nullable|date',
            'password' => 'nullable|string|min:8|confirmed', // Password confirmation
            'remember_token' => 'nullable|string|max:100',
            'parent_user_id' => 'nullable|exists:users,id', // Parent user validation (optional)
        ]);
    
        // If password is provided, hash it before updating
        if ($request->has('password') && $request->password) {
            $validated['password'] = bcrypt($request->password);
        }
    
        // Update the user with the validated data
        $user->update($validated);
    
        // Redirect back to the user list with a success message
        return redirect()->route('owner.user.list')->with('success', 'User updated successfully.');
    }
	public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete(); // Delete the user
		return redirect()->back()->with('success','Deleted successfuly');
    }

	public function all_admin(Request $request)
	{
		$role_id = 2;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}
	
		return view('owner.users.index',compact('all_users','role_id'));
	}
	public function all_cummiunitystaff(Request $request)
	{
		$role_id = 3;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}
		return view('owner.users.index',compact('all_users','role_id'));
	}
	public function all_business(Request $request)
	{
		$role_id = 4;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}
		return view('owner.users.index',compact('all_users','role_id'));
	}
	public function all_business_staff(Request $request)
	{
		$role_id = 5;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}
		return view('owner.users.index',compact('all_users','role_id'));
	}
	public function all_property_manager(Request $request)
	{
		$role_id = 6;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}

		return view('owner.users.index',compact('all_users','role_id'));
	}
	public function all_property_staff(Request $request)
	{
		$role_id = 7;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}
		return view('owner.users.index',compact('all_users','role_id'));
	}
	public function all_resident(Request $request)
	{
		$role_id = 8;
		if(Auth::user()->role_id == 1){
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->get();
		}else{
			$all_users = User::where('id', '!=', Auth::id() )->where('role_id',$role_id)->where('parent_user_id' , Auth::id())->get();
		}
		return view('owner.users.index',compact('all_users','role_id'));
	}





	public function user_create()
    {
		
		if(Auth::user()->role_id == 1){
			$roles = DB::table('admin_roles')->get(); // Fetch all roles from the 'admin_roles' table
		}elseif(Auth::user()->role_id == 2){
			$roles = DB::table('admin_roles')->where('id',3)->get(); // Fetch all roles from the 'admin_roles' table
		}elseif(Auth::user()->role_id == 4){
			$roles = DB::table('admin_roles')->where('id',5)->get(); // Fetch all roles from the 'admin_roles' table
		}elseif(Auth::user()->role_id == 6){
			$roles = DB::table('admin_roles')
			->whereIn('id', [7, 8])
			->get();
		}
		
        return view('owner.users.create',compact('roles'));
    }

	public function store(Request $request)
	{
		// Manually validate the incoming request data
		$errors = [];
	
		if (empty($request->first_name) || !is_string($request->first_name) || strlen($request->first_name) > 255) {
			$errors[] = 'First name is required and must be a string with a maximum of 255 characters.';
		}
	
		if (empty($request->last_name) || !is_string($request->last_name) || strlen($request->last_name) > 255) {
			$errors[] = 'Last name is required and must be a string with a maximum of 255 characters.';
		}
	
		if (!empty($request->middle_name) && (!is_string($request->middle_name) || strlen($request->middle_name) > 255)) {
			$errors[] = 'Middle name must be a string with a maximum of 255 characters.';
		}
	
		if (empty($request->email) || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'A valid email address is required.';
		} elseif (User::where('email', $request->email)->exists()) {
			$errors[] = 'The email address is already in use.';
		}
	
		if (empty($request->user_name) || strlen($request->user_name) > 255) {
			$errors[] = 'User name is required and must be a maximum of 255 characters.';
		} elseif (User::where('user_name', $request->user_name)->exists()) {
			$errors[] = 'The user name is already in use.';
		}
	
		if (empty($request->password) || strlen($request->password) < 6 || $request->password !== $request->password_confirmation) {
			$errors[] = 'Password must be at least 6 characters long and match the confirmation.';
		}
	
		if (!empty($request->phone_number) && strlen($request->phone_number) > 15) {
			$errors[] = 'Phone number must be a maximum of 15 characters.';
		}
	
		if (!empty($request->city) && strlen($request->city) > 255) {
			$errors[] = 'City must be a maximum of 255 characters.';
		}
	
		if (!empty($request->state) && strlen($request->state) > 255) {
			$errors[] = 'State must be a maximum of 255 characters.';
		}
	
		if (!empty($request->address) && strlen($request->address) > 255) {
			$errors[] = 'Address must be a maximum of 255 characters.';
		}
	
		if (!empty($request->zip_code) && strlen($request->zip_code) > 10) {
			$errors[] = 'ZIP code must be a maximum of 10 characters.';
		}
	
		if (!empty($request->referral_code) && strlen($request->referral_code) > 50) {
			$errors[] = 'Referral code must be a maximum of 50 characters.';
		}
	
		// Check if role_id is valid
		$role = DB::table('admin_roles')->find($request->role_id);
	
		if (!$role) {
			$errors[] = 'Invalid role selected.';
		}
	
		// Check for validation errors
		if (!empty($errors)) {
			return redirect()->back()->withErrors($errors)->withInput();
		}
	
		try {
			// Attempt to create the new user
			$user = User::create([
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'middle_name' => $request->middle_name ?? null,
				'email' => $request->email,
				'user_name' => $request->user_name,
				'password' => bcrypt($request->password),
				'phone_number' => $request->phone_number ?? null,
				'city' => $request->city ?? null,
				'state' => $request->state ?? null,
				'address' => $request->address ?? null,
				'zip_code' => $request->zip_code ?? null,
				'referral_code' => $request->referral_code ?? null,
				'role' => $role->slug ?? null,
				'role_id' => $request->role_id,
				'parent_user_id' => Auth::id(),
			]);
	
			// If successful, redirect with a success message
			return redirect()->back()->with('success', 'User created successfully.');
		} catch (\Exception $e) {
			// Log the error for debugging
			\Log::error('User creation failed: ' . $e->getMessage());
	
			// Redirect back with an error message
			return redirect()->back()->with('error', 'Failed to create user. Please try again.');
		}
	}
	
	


}
