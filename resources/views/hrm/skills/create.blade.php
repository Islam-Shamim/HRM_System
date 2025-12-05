@extends('layouts.app')

@section('content')
<div class="col-md-6">
  <h3>Create Skill</h3>
  <form method="POST" action="{{ route('skills.store') }}">@csrf
    <div class="mb-3"><label>Name</label><input class="form-control" name="name" value="{{ old('name') }}"></div>
    <div class="mb-3"><button class="btn btn-primary">Save</button></div>
  </form>
</div>
@endsection
