@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4>{{ $employee->first_name }} {{ $employee->last_name }}</h4>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Department:</strong> {{ $employee->department->name ?? '-' }}</p>
    <p><strong>Skills:</strong> {{ $employee->skills->pluck('name')->join(', ') }}</p>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>

@endsection
