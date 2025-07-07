<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'VW Komputer') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('vendor/sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf

                                        {{-- Email --}}
                                        <div class="form-group">
                                            <input id="email" type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autofocus
                                                placeholder="Masukkan Alamat Email...">
                                            @error('email')
                                                <span class="invalid-feedback pl-3" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="form-group">
                                            <input id="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" required placeholder="Kata Sandi">
                                            @error('password')
                                                <span class="invalid-feedback pl-3" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Remember Me --}}
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" id="remember"
                                                    class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">
                                                    Ingat Saya
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Submit --}}
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>

                                        {{-- Optional: Forgot Password --}}
                                        @if (Route::has('password.request'))
                                            <div class="text-center mt-3">
                                                <a class="small" href="{{ route('password.request') }}">
                                                    Lupa Kata Sandi?
                                                </a>
                                            </div>
                                        @endif
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('vendor/sbadmin2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
