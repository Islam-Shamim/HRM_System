@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Departments</h3>
  <a href="{{ route('departments.create') }}" class="btn btn-primary">Create Department</a>
</div>

<table class="table">
  <thead><tr><th>Name</th></tr></thead>
  <tbody>
    @foreach($departments as $d)
      <tr><td>{{ $d->name }}</td></tr>
    @endforeach
  </tbody>
</table>

@endsection
