@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8">
    <h3>{{ $employee->exists ? 'Edit' : 'Create' }} Employee</h3>
    <form method="POST" action="{{ $employee->exists ? route('employees.update', $employee) : route('employees.store') }}">
      @csrf
      @if($employee->exists) @method('PUT') @endif

      <div class="mb-3">
        <label>First name</label>
        <input class="form-control" name="first_name" value="{{ old('first_name', $employee->first_name) }}">
      </div>
      <div class="mb-3">
        <label>Last name</label>
        <input class="form-control" name="last_name" value="{{ old('last_name', $employee->last_name) }}">
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input id="email-field" class="form-control" name="email" value="{{ old('email', $employee->email) }}">
        <div id="email-feedback" class="form-text text-danger" style="display:none;"></div>
      </div>

      <div class="mb-3">
        <label>Department</label>
        <select name="department_id" class="form-select">
          <option value="">-- Select --</option>
          @foreach($departments as $d)
            <option value="{{ $d->id }}" {{ old('department_id', $employee->department_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Skills (select existing)</label>
        <select name="skills[]" multiple class="form-select">
          @foreach($skills as $s)
            <option value="{{ $s->id }}" {{ in_array($s->id, old('skills', $employee->skills->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>{{ $s->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Or add new skills</label>
        <div id="new-skills-wrap">
          <!-- dynamic inputs here -->
        </div>
        <button id="add-skill" class="btn btn-sm btn-secondary" type="button">Add new skill</button>
      </div>

      <div class="mb-3">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

@endsection
