@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Supervisor Page</h3>
                    <a href='{{ url("/supervisor") }}' class="btn btn-normal float-right">Refresh</a>
                    <a href='{{ url("/groups/report/$group->id") }}' class="btn btn-normal float-right mr-3"><i class="fa fa-eye"></i> View Reports</a>
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

                    <div>
                        <div class="col-md-6 m-auto">
                            <input type="hidden" id="userId">
                            <input type="text" class="form-control" name="qrcode" id="qrcode" placeholder="QR CODE" autofocus>
                        </div>   
                        
                        <div id="approval" class="text-center">
                            <button id="btnApprove" class="btn btn-success" data-id="" data-uuid=""><i class="fa fa-check"></i> Approve</button>
                        </div>                     
                        
                        <div class="row-element">
                            <div class="qrscanner img-thumbnail mb-3 text-center" id="scanner">
                            </div>
                        </div>
                        <!-- <div id="playerInfo">
                            <span id="append"></span>
                        </div> -->


                        <div class="row justify-content-center align-items-center h-100 css-hide" id="playerInfo">
                            <div class="col col-12">
                                <div class="card mb-3" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="col-md-4 gradient-custom text-center text-white profile-div">
                                            <img src="/img/icons/avatar.png" alt="Avatar" class="img-fluid my-4 img-avatar-player" id="profilePic" />
                                            <h5 id="pFullName"></h5>
                                            <p id="pUsername"></p>
                                            <p id="pContact"></p>
                                            <p id="pAddress"></p>
                                            <!-- <i class="far fa-edit mb-5"></i> -->
                                        </div>

                                        <div class="col-md-8">
                                            <div class="card-body p-4">

                                                <h6>Information</h6>

                                                <hr class="mt-0 mb-4">

                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Date of Birth</h6>
                                                        <p class="text-muted" id="pDateBirth"></p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Place of Birth</h6>
                                                        <p class="text-muted" id="pPlaceBirth"></p>
                                                    </div>
                                                </div>

                                                <hr class="mt-0 mb-4">

                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Source of Income</h6>
                                                        <p class="text-muted" id="pIncome"></p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Occupation</h6>
                                                        <p class="text-muted" id="pOccupation"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript" src="{{ asset('/js/lib/jsqrscanner/jsqrscanner.nocache.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/backend/supervisor.js') }}"></script>
@endsection