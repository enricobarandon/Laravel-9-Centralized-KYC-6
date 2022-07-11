@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="text-center">
                    @if(Auth::user()->user_type_id == 5)
                        @if(Auth::user()->status == 'verified')
                            {!! $img !!}
                        @else
                            <h5><strong><i class="fa fa-info-circle"></i> Your account is not yet verified</strong></h5>
                            <h5>Please wait for your account to be verified!</h5>
                        @endif
                    @else
                        {{ __('You are logged in!') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
