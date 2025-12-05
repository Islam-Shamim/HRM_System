<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Skill;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        $departments = Department::orderBy('name')->get();
        $employees = Employee::with(['department','skills'])->latest()->paginate(15);
        return view('hrm.employees.index', compact('employees', 'departments'));
    }

    // AJAX filter
    public function filter(Request $request)
    {
        $dept = $request->query('department_id');
        $query = Employee::with(['department','skills']);
        if ($dept) $query->where('department_id', $dept);
        $employees = $query->get();

        return response()->json($employees);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->query('email');
        $id = $request->query('id');
        $query = Employee::where('email', $email);
        if ($id) $query->where('id', '!=', $id);
        $exists = $query->exists();
        return response()->json(['unique' => !$exists]);
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();
        return view('hrm.employees.create_edit', ['employee' => new Employee(), 'departments' => $departments, 'skills' => $skills]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
            'skills' => 'nullable|array',
            'skills.*' => 'integer|exists:skills,id',
            'new_skills' => 'nullable|array',
            'new_skills.*' => 'string',
        ]);

        $employee = Employee::create($data);

        $skillIds = $data['skills'] ?? [];
        if (!empty($data['new_skills'])) {
            foreach ($data['new_skills'] as $ns) {
                $s = Skill::firstOrCreate(['name' => $ns]);
                $skillIds[] = $s->id;
            }
        }

        $employee->skills()->sync($skillIds);

        return redirect()->route('employees.index')->with('success', 'Employee created');
    }

    public function show(Employee $employee)
    {
        $employee->load(['department','skills']);
        return view('hrm.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();
        return view('hrm.employees.create_edit', compact('employee','departments','skills'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'department_id' => 'required|exists:departments,id',
            'skills' => 'nullable|array',
            'skills.*' => 'integer|exists:skills,id',
            'new_skills' => 'nullable|array',
            'new_skills.*' => 'string',
        ]);

        $employee->update($data);

        $skillIds = $data['skills'] ?? [];
        if (!empty($data['new_skills'])) {
            foreach ($data['new_skills'] as $ns) {
                $s = Skill::firstOrCreate(['name' => $ns]);
                $skillIds[] = $s->id;
            }
        }

        $employee->skills()->sync($skillIds);

        return redirect()->route('employees.index')->with('success', 'Employee updated');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted');
    }
}
