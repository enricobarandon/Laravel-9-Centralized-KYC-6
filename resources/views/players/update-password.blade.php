@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Update Password</h3>
                    <a href='{{ url("home") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="/submitPassword">
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end" minlength="8">New Password</label>

                            <div class="col-md-6">
                                <input id="cpassword" type="password" class="form-control" minlength="8" name="cpassword" required autofocus>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="ccpassword" type="password" class="form-control" name="ccpassword" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
