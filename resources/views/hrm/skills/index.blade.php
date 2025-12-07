@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Skills</h3>
  <a href="{{ route('skills.create') }}" class="btn btn-primary">Create Skill</a>
</div>

<table class="table">
  <thead><tr><th>Name</th></tr></thead>
  <tbody>
    @foreach($skills as $s)
      <tr><td>{{ $s->name }}</td></tr>
    @endforeach
  </tbody>
</table>

@endsection
