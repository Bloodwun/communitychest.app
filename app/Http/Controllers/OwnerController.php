<?php

namespace App\Http\Controllers;
use App\Models\Community;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
   
	public function root()
	{
		if (!Auth::check()) {
			return view('user.login');
		}
		session()->flash('success', 'Login Successfully.');
		return view('owner.dashboard');
	}
	public function register(Request $request)
	{
		return view('owner.register');
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
		return \Redirect::route('owner.user.list')->with('message', 'success!!!');
	}
public function users(Request $request)
{
    if ($request->ajax()) {
        $parent_user_id = (Auth::user() != null) ? Auth::user()->id : -1;

        // Fetch users with specific parent_user_id and necessary columns
        $users = User::where('parent_user_id', $parent_user_id)
            ->select(['id', 'first_name', 'email', 'city', 'state', 'address', 'zip_code', 'created_at']);

        return DataTables::eloquent($users)
            ->addColumn('actions', function ($user) {
                $editUrl = route('owner.user.edit', $user->id); // Assuming a named route for editing
                $deleteUrl = route('owner.user.destroy', $user->id); // Assuming a named route for deletion
                $csrfToken = csrf_token();

                return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['actions']) // Ensure the HTML is rendered as-is
            ->toJson();
    }

    return view('owner.users.index');
}

    public function alluser(Request $request)
	{

		$all_user = User::all();
		return view('owner.users.index',compact('all_user'));
	}

    public function store(Request $request) {
        // Validate and store the new user
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            // Add other fields as needed
        ]);
    
        User::create($validated); // Create user
        return redirect()->route('owner.user.list')->with('success', 'User created successfully.');
    }
    
    public function edit($id) {
        $user = User::findOrFail($id); // Fetch the user
        $roles = DB::table('admin_roles')->get(); // Fetch all roles from the 'admin_roles' table

        
        return view('owner.users.edit', compact('user','roles')); // Return a view for editing
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
        return response()->json(['message' => 'User deleted successfully.']);
    }
    
}
