<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRM System</title>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom overrides -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <span class="brand-logo me-2" aria-hidden="true"></span>
      <span class="fw-semibold">HRM</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
<footer class="border-top mt-5 py-4 bg-white">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
    <div class="text-muted small">&copy; {{ date('Y') }} HRM System</div>
    <div class="mt-2 mt-md-0">
      <a href="#" class="text-decoration-none me-3 small text-muted">About</a>
      <a href="#" class="text-decoration-none me-3 small text-muted">Contact</a>
      <a href="#" class="text-decoration-none small text-muted">Privacy</a>
    </div>
  </div>
</footer>

<script src="{{ asset('js/hrm.js') }}"></script>
</body>
</html>
