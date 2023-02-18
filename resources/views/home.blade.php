@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">{{ __('Dashboard') }}
            @if($userInfo->user_type_id == 5)
                @if($userInfo->status == 'disapproved' || $userInfo->site_status == 'returned')
                <a href='{{ url("/player/$userInfo->id") }}' class="btn btn-normal float-right"><i class="fas fa-cog"></i> Update Details</a>
                @endif
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
                <!-- for Player role -->
                <div class="row">
                    @if(Auth::user()->status == 'pending')
                        @if(Auth::user()->site_status == 'returned')
                            <div class="col-md-12 text-center">
                                <div class="card card-outline card-warning mb-2">
                                    <div class="card-header">
                                        <h4><i class="fa fa-info-circle"></i> Your account has been returned to 'for review' status</h4>
                                    </div>

                                    <div class="card-body">
                                        <h5>Please comply with the rules.</h5>
                                        <h5><strong><i class="fa fa-exclamation-triangle"></i> {{ isset($userDetails->remarks) ? $userDetails->remarks : '' }}</strong></h5>
                                    </div>
                                </div>
                            </div>
                        @else
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
                        @endif

                    @elseif(Auth::user()->status == 'disapproved')
                    <div class="col-md-12 text-center qrcode-div">
                        <div class="card card-outline card-danger mb-2">
                            <div class="card-header">
                                <h4><i class="fa fa-info-circle"></i> Your account has been rejected.</h4>
                            </div>

                            <div class="card-body">
                                <h5>Please comply with the rules.</h5>
                                <h5><strong><i class="fa fa-exclamation-triangle"></i> {{ isset($userDetails->remarks) ? $userDetails->remarks : '' }}</strong></h5>
                            </div>
                        </div>
                    </div>
                    @elseif(Auth::user()->status == 'review')
                        @if(Auth::user()->site_status == 'returned')
                        <div class="col-md-12 text-center">
                            <div class="card card-outline card-warning mb-2">
                                <div class="card-header">
                                    <h4><i class="fa fa-info-circle"></i> Your account has been returned to 'for review' status</h4>
                                </div>

                                <div class="card-body">
                                    <h5>Please comply with the rules.</h5>
                                    <h5><strong><i class="fa fa-exclamation-triangle"></i> {{ isset($userDetails->remarks) ? $userDetails->remarks : '' }}</strong></h5>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-12 text-center">
                            <div class="card card-outline card-info mb-2">
                                <div class="card-header">
                                    <h4><i class="fa fa-info-circle"></i> Your account registration is still under review.</h4>
                                </div>

                                <div class="card-body">
                                    <p><strong>Please ask OCBS/Arena Supervisor for assistance!</strong></p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif

                    @include('partials.profile')

                    @if(Auth::user()->status == 'verified')
                    {{-- <div class="col-md-4 text-center" style="height: 100%;">
                        <div class="qrcode-div" id="qrcode-div" style="background: #ffffff; height: 100%; padding: 10px;">
                            <img src="/img/pitmasters-live.png" class="img-responsive">
                                <!-- {!! $img !!} -->
                            <img src="data:image/png;base64,{{ $img }}" alt="barcode" style="width: 100%" />
                            <h5>{{ $userInfo->first_name . ' ' . $userInfo->last_name  }}</h5>
                        </div>
                        <a class="btn btn-primary mt-3" id="downloadQR"><i class="fa fa-download"></i> Download</a>
                    </div>
                    @section('script')
                    <script src="{{ asset('js/html2canvas.js') }}"></script>
                    <script>
                    $(document).ready(function(){
                        var element = $("#qrcode-div"); // global variable
                        var getCanvas; // global variable

                        html2canvas(element, {
                        onrendered: function (canvas) {
                            getCanvas = canvas;
                            }
                        });

                        $("#downloadQR").on('click', function () {

                            var imgageData = getCanvas.toDataURL("image/png");
                            // Now browser starts downloading it instead of just showing it
                            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                            $("#downloadQR").attr("download", "my_profile_qrcode.png").attr("href", newData);
                        });

                    });

                    </script>
                    @endsection --}}
                    @endif
                </div>
                @elseif(Auth::user()->user_type_id == 4)
                <!-- for Supervisor role -->
                You are logged in!
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5 text-center" style="height: 100%;">
                        <div class="input-group input-group-md">
                            <input type="text" class="form-control" id="textUrl" value="{{ $svUrl }}" readonly>
                            <span class="input-group-append">
                                <button type="button" onclick="cupyUrl()" class="btn btn-info btn-flat">Copy</button>
                            </span>
                        </div>
                        <div class="site-qr"style="background: #ffffff; height: 100%; padding: 10px;">
                            <h4>Registration QR Code</h4>
                            <img src="data:image/png;base64,{{ $url }}" alt="barcode" />
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                @section('script')
                <script>
                function cupyUrl() {
                    var copyText = document.getElementById("textUrl");

                    copyText.select();
                    copyText.setSelectionRange(0, 99999);

                    navigator.clipboard.writeText(copyText.value);

                    swal({
                        title: "Copy Link",
                        text: "Success copy registration link",
                        icon: "success",
                        timer: 1500,
                    });
                }
                </script>
                @endsection

                @else
                <!-- for Admin,tech and heldesk role -->
                    @include('partials.cards')

                @endif

            </div>

        </div>
    </div>


</div>

@endsection
