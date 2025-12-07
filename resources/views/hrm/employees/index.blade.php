@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Employees</h3>
  <div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Employee</a>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4">
    <select id="filter-department" class="form-select">
      <option value="">-- All Departments --</option>
      @foreach($departments as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
      @endforeach
    </select>
  </div>
</div>

<table class="table" id="employees-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Department</th>
      <th>Skills</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($employees as $employee)
    <tr>
      <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
      <td>{{ $employee->email }}</td>
      <td>{{ $employee->department->name ?? '' }}</td>
      <td>{{ $employee->skills->pluck('name')->join(', ') }}</td>
      <td>
        <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">Show</a>
        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('employees.destroy', $employee) }}" style="display:inline">@csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $employees->links() }}

@endsection
