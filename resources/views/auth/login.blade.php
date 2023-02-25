
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WPC</title>


    <!-- Styles -->

    <link href="{{ asset('css/min/backend.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body class="body-content">
    <div class="content img-bg">
      <div class="container-fluid">
            <main class="py-4">
                <div class="container login-container">
                    <div class="row justify-content-center">
                        <!-- <div class="col-md-6 text-center justify-content-center align-items-center">
                            <img src="dist/img/wpc-logo.jpg" alt="logo" class="header-mobile__logo-img logo-img  mb-2">
                        </div> -->
                        <div class="col-md-6">
                            <div class="card card-login">
                                <div class="card-header card__header">
                                    <h4>LOGIN TO YOUR ACCOUNT</h4>
                                </div>

                                <div class="card-body card__content">
                                    <!-- <form method="POST" action="{{ route('login') }}">
                                        <div class="form-group">
                                            <label for="username" >Username</label>
                                                <input id="username" type="text" placeholder="Enter your username" class="form-control" name="username" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                                <input id="password" type="password" placeholder="Enter your password" class="form-control" name="password" required>
                                        </div>

                                        <div class="form-group form-group--sm">
                                            <div >
                                                <button type="submit" id="btnSignin" class="btn btn-primary btn-lg btn-block">
                                                    SIGN IN TO YOUR ACCOUNT
                                                </button>

                                            </div>
                                        </div>
                                    </form> -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- <div class="row mb-3">
                                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                                            <div class="col-md-6">
                                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="username" >Username</label>
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- <div class="row mb-3">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Login') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div> -->
                                        <div class="form-group form-group--sm">
                                            <div >
                                                <button type="submit" id="btnSignin" class="btn btn-primary btn-lg btn-block">
                                                    SIGN IN TO YOUR ACCOUNT
                                                </button>

                                            </div>
                                        </div>
                                    </form>


                                    <div class="form-group form-group--sm">
                                        <div class="text-center">
                                            <a href="/forgot-password" class="t-white ">
                                                Forgot password?
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group form-group--sm">
                                        <div>
                                            <a href="/register" class="btn btn-secondary btn-lg btn-block btn-class">
                                                Create Account
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</body>

</html>
