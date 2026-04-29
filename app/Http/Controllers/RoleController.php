<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->latest()->get();

        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:50|unique:roles,name|regex:/^[a-z_]+$/',
            'display_name' => 'required|string|max:100',
            'description'  => 'nullable|string|max:255',
        ], [
            'name.regex' => 'Role name must be lowercase letters and underscores only (e.g. finance, hr_manager).',
        ]);

        Role::create($request->only('name', 'display_name', 'description'));

        return redirect()->route('roles.index')->with('success', 'Role "' . $request->display_name . '" created successfully.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'         => ['required', 'string', 'max:50', 'regex:/^[a-z_]+$/', Rule::unique('roles')->ignore($role->id)],
            'display_name' => 'required|string|max:100',
            'description'  => 'nullable|string|max:255',
        ], [
            'name.regex' => 'Role name must be lowercase letters and underscores only.',
        ]);

        $role->update($request->only('name', 'display_name', 'description'));

        return redirect()->route('roles.index')->with('success', 'Role "' . $role->display_name . '" updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')
                ->with('error', 'Cannot delete "' . $role->display_name . '" — ' . $role->users()->count() . ' user(s) are still assigned to this role.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
