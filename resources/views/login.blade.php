<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login | TK Dharma Mulya</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="sistem informasi,tk dharma mulya" name="keywords">
  <meta content="Website sistem informasi TK Dharma Mulya" name="description">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="{{ asset('guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('guest/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('guest/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="{{ asset('guest/css/style.css') }}" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center"
  style="min-height: 100vh; background: linear-gradient(rgba(19, 53, 123, .6), rgba(19, 53, 123, .6)), url({{ asset('guest/img/login-hero.PNG') }}) !important; background-size: cover !important; background-position: center center; background-repeat: no-repeat !important; background-attachment: fixed !important;">
  <!-- Navbar & Hero Start -->

  <div class="card" style="max-width: 500px;">
    <div class="card-body p-5">
      <form method="POST" action="{{ route('auth_login') }}">
        @csrf
        <div class="row g-3">
          <div class="col-md-12">

            <a href="{{ route('beranda') }}" class="h4 d-flex align-items-center">
              <img width="65" src="{{ asset('guest/img/logo-tk.png') }}" alt="">
              TK Dharma Mulya
            </a>

            <p class="mt-4">Masukkan username dan password.</p>

            @if ($errors->has('username'))
              <p class="mt-3 text-danger"> {{ $errors->first('username') }}</p>
            @endif

            <div class="form-floating">
              <input value="{{ old('username') }}" name="username" type="text" class="form-control bg-white border-1"
                id="username" placeholder="Username">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-floating">
              <input name="password" type="password" class="form-control bg-white border-1" id="password"
                placeholder="*****">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex align-items-start">
              <button class="btn btn-primary text-white w-25 py-2" type="submit">Login</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>


  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('guest/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('guest/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('guest/lib/lightbox/js/lightbox.min.js') }}"></script>


  <!-- Template Javascript -->
  <script src="{{ asset('guest/js/main.js') }}"></script>
</body>

</html>
