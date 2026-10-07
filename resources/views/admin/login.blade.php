<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login - Laundry Service</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('css/st_login2.css') }}" />
  <link rel="icon" href="{{ asset('img/logo.png') }}">
</head>
<style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-position: center;
    background-image: linear-gradient(rgba(255, 255, 255, 0.858), rgba(255, 255, 255, 0.5)),
    url("{{ asset('img/BG_PODOMORO_LOGIN.png') }}");
}
</style>

<body>
  <br>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand">
      <img src="{{ asset('img/logoo.png') }}" alt="" width="200" height="200" class="d-inline-block align-text-center" />
    </a>
  </nav>
  <br>
  <div class="wrapper">
    <!-- Session Status -->
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <br>
      <h1>Admin Login</h1>

      <div class="input-box">
        <input
          type="text"
          name="email"
          placeholder="Username"
          value="{{ old('email') }}"
          required
          autofocus
        />
        <i class="bx bxs-user"></i>
      </div>

      <div class="input-box">
        <input
          type="password"
          name="password"
          placeholder="Password"
          required
        />
        <i class="bx bxs-lock-alt"></i>
      </div>

      <button type="submit" class="btn">Login</button>

      <div class="register-link">
        <p>Don't have an account? Contact the manager.</p>
        <p>2024 Laundry PodoMoro. All rights reserved.</p>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
