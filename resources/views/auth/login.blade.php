@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3>Login</h3>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label>Email</label>
        <input class="form-control" name="email" value="{{ old('email') }}">
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input class="form-control" type="password" name="password">
      </div>
      <div class="mb-3">
        <button class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
</div>
@endsection
