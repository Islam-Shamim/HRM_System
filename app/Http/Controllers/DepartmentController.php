<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('name')->get();
        return view('hrm.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('hrm.departments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:departments,name',
        ]);

        Department::create($data);
        return redirect()->route('departments.index')->with('success', 'Department created');
    }
}
