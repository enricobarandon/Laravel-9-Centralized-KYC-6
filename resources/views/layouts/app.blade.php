<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link href="{{ asset('css/min/backend.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

</head>
<body class="hold-transition sidebar-mini skin-green layout-fixed">
    <div class="wrapper">
    @include('layouts.navbar')

        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- <div class="row"> -->
                        <main class="py-4">
                            @yield('content')
                        </main>
                    <!-- </div> -->
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

        <!-- Footer -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
            </div>
        </aside>

        </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/min/backend.min.js') }}"></script>
@yield('script')
</html>

