@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">{{ __('Dashboard') }}
            @if($userInfo->user_type_id == 5 and in_array($userInfo->status, ['pending','disapproved']))
                <a href='{{ url("/player/$userInfo->id") }}' class="btn btn-normal float-right"><i class="fas fa-cog"></i> Update Details</a>
            @endif
            </div>
            
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
                        <div class="card card-outline card-info mb-2">
                            <div class="card-header">
                                <h4><i class="fa fa-info-circle"></i> You have received an interview link! Please take the interview to finish the registration.</h4>
                            </div>

                            <div class="card-body">
                            <p>{{ $userDetails->interview_description }}</p>
                                @if(isset($userDetails->interview_date_time))
                                    <p><strong>Date & Time: {{ date('M d, Y h:i A', strtotime($userDetails->interview_date_time)) }}</strong></p>
                                @endif
                                <a href="{{ $userDetails->interview_link }}" target="_blank" class="btn btn-primary btn-sm">CLICK ME TO JOIN THE MEETING!</a>
                            </div>

                        </div>
                        @endif

                    </div>
                    @elseif(Auth::user()->status == 'disapproved')
                    <div class="col-md-12 text-center qrcode-div">
                        <div class="card card-outline card-danger mb-2">
                            <div class="card-header">
                                <h4><i class="fa fa-info-circle"></i> Your account has been rejected.</h4>
                            </div>

                            <div class="card-body">
                            <p><strong>Remarks: {{ isset($userDetails->remarks) ? $userDetails->remarks : '' }}</strong></p>
                            </div>

                        </div>
                    </div>
                    @endif

                    @include('partials.profile')

                    @if(Auth::user()->status == 'verified')
                    <div class="col-md-4 text-center qrcode-div">
                        <h4>Profile QR Code</h4>
                            <!-- {!! $img !!} -->
                            <img src="data:image/png;base64,{{ $img }}" alt="barcode" style="width: 100%" />
                            <a class="btn btn-primary mt-3" href="data:image/png;base64,{{ $img }}" download><i class="fa fa-download"></i> Download</a>
                    </div>
                    @endif
                </div>
                @elseif(Auth::user()->user_type_id == 4)
                
                You are logged in!

                @else

                    @include('partials.cards')

                @endif

            </div>

        </div>
    </div>


</div>

@endsection
