<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $roles = DB::table('admin_roles')->get(); // Fetch all roles
        return view('owner.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string',
        ]);

        DB::table('admin_roles')->insert([
            'name' => $request->name,
            'slug' => $request->slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('owner.all.role')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = DB::table('admin_roles')->where('id', $id)->first(); // Fetch role by ID
        return view('owner.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
        $role = DB::table('admin_roles')->where('id', $id)->first(); // Fetch role by ID
        return view('owner.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
           
        ]);

        DB::table('admin_roles')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'updated_at' => now(),
            ]);

        return redirect()->route('owner.all.role')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ensure the ID is provided
        if (!$id) {
            return redirect()->route('owner.all.role')->with('error', 'Role ID is missing.');
        }
    
        // Attempt to delete the role
        $deleted = DB::table('admin_roles')->where('id', $id)->delete();
    
        // Provide feedback based on the result
        if ($deleted) {
            return redirect()->route('owner.all.role')->with('success', 'Role deleted successfully.');
        } else {
            return redirect()->route('owner.all.role')->with('error', 'Role not found or unable to delete.');
        }
    }
    
}
