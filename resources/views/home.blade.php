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

                        @if($userDetails->interview_link)
                            <div class="alert alert-info">
                                <h4>You have received an interview link! Please take the interview to finish the registration.</h4>
                                <p>{{ $userDetails->interview_description }}</p>
                                @if(isset($userDetails->interview_date_time))
                                    <p><strong>Date & Time: {{ date('M d, Y h:i A', strtotime($userDetails->interview_date_time)) }}</strong></p>
                                @endif
                                <a href="{{ $userDetails->interview_link }}" class="btn btn-primary btn-sm">CLICK ME TO JOIN THE MEETING!</a>
                            </div>
                        @endif

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
