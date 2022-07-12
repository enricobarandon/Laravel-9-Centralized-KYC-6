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
                
                @if(Auth::user()->user_type_id == 5)
                <div class="row">
                    @if(Auth::user()->status == 'pending')
                    <div class="col-md-12 text-center qrcode-div">
                        <h5><strong><i class="fa fa-info-circle"></i> Your account is not yet verified</strong></h5>
                        <h5>Please wait for your account to be verified!</h5>
                    </div>
                    @endif

                    @include('partials.profile')

                    @if(Auth::user()->status == 'verified')
                    <div class="col-md-5 text-center qrcode-div">
                        <h4>Profile QR Code</h4>
                            {!! $img !!}
                    </div>
                    @endif
                </div>
                @else
                
                    @include('partials.cards')

                @endif

            </div>

        </div>
    </div>


</div>

@endsection
