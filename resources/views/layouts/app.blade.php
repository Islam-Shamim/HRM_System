<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRM System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">HRM</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        @auth
        <li class="nav-item"><a class="nav-link" href="{{ route('employees.index') }}">Employees</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('skills.index') }}">Skills</a></li>
        @endauth
      </ul>
      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
          <li class="nav-item"><span class="nav-link">{{ auth()->user()->name }}</span></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">@csrf
              <button class="btn btn-link nav-link" style="display:inline;padding:0;border:none;">Logout</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
  </nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
    @endif

    @yield('content')
</div>

<script src="{{ asset('js/hrm.js') }}"></script>
</body>
</html>
