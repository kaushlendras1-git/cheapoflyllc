<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('department')->orderBy('name')->paginate(10);
        return view('web.masters.roles.index', compact('roles'));
    }

    public function create()
    {
        $departments = Department::where('status', 1)->orderBy('name')->get();
        return view('web.masters.roles.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        Role::create($request->only(['name', 'department_id']));

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $departments = Department::where('status', 1)->orderBy('name')->get();
        return view('web.masters.roles.edit', compact('role', 'departments'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'status' => 'boolean',
        ]);

        $role->update($request->only(['name', 'department_id', 'status']));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}