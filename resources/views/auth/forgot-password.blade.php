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
                                    <h4>SEND RESET PASSWORD LINK</h4>
                                </div>

                                <div class="card-body card__content">

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="form-group form-group--sm">
                                            <label for="email">Please enter your email</label>
                                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group form-group--sm">
                                            <button type="submit" id="btnResetPassword" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
                                        </div>
                                        <div class="form-group form-group--sm">
                                            <div>
                                                <a href="/login" class="btn btn-secondary btn-lg btn-block btn-class">
                                                    Back To login Page
                                                </a>
                                            </div>
                                        </div>
                                    </form>

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
