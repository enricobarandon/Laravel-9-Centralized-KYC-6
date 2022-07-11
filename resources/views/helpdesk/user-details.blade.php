@extends('layouts.app')

@section('content')
@php
$id_type = [
    1 => "Government Service Insurance System (GSIS) Card",
    2 => "Unified Multi-Purpose Identification (UMID) Card",
    3 => "Land Transportation Office (LTO) Driver's License",
    4 => "Professional Regulatory Commission (PRC) ID",
    5 => "Philippine Identification (PhilID)",
    6 => "Commission on Elections (COMELEC) Voter's ID",
    7 => "Senior Citizen ID",
    8 => "Philippine Postal ID (issued November 2016 onwards)",
    9 => "Latest Passport",
    10 => "National ID/PhilSys ID"
];
@endphp
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Player Details</h3>
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

                    <!-- {{ $userDetails }} -->
                       
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col col-12">
                            <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white profile-div">
                                        <img src="/img/icons/avatar.png" alt="Avatar" class="img-fluid my-4 img-avatar" />
                                        <h5>{{ strtoupper($user->first_name . ' ' . $user->middle_name  . ' ' . $user->last_name) }}</h5>
                                        <p>{{ $id_type[$userDetails->valid_id_type] }}</p>
                                        
                                        <img src="/img/id_picture/{{ $userDetails->id_picture }}" alt="Avatar" class="img-responsive my-2 id-img img-thumbnail" />
                                        <img src="/img/id_picture_selfie/{{ $userDetails->selfie_with_id }}" alt="Avatar" class="img-responsive my-5 id-img img-thumbnail" />
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body p-4">

                                            <h6><i class="fa fa-info-circle"></i> PLAYER INFORMATION</h6>

                                            <hr class="mt-0 mb-2">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Contact Number</h6>
                                                    <p class="text-muted">{{ $user->username }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Status</h6>
                                                    <p class="text-muted">
                                                        <strong class="{{ $user->status }}">{{ strtoupper($user->status) }}</strong>
                                                        <!-- <a class="update-status pull-right"><i class="fa fa-edit"></i></a> -->
                                                    </p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Date of Birth</h6>
                                                    <p class="text-muted">{{ date("M. d, Y",strtotime($userDetails->date_of_birth)) }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Place of Birth</h6>
                                                    <p class="text-muted">{{ $userDetails->place_of_birth }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Present Address</h6>
                                                    <p class="text-muted">
                                                        @php
                                                        $presentAddress = '';
                                                            if($userDetails->present_address){
                                                                $address = json_decode($userDetails->present_address,true);

                                                                $presentAddress = $address['house_number'] . " " . $address['street'] . " " . $address['barangay'] . " " . $address['city'] . " " . $address['zipcode'] . " " . $address['province'];
                                                            }else{
                                                                $presentAddress = '--';  
                                                            }
                                                        @endphp
                                                        {{ $presentAddress }}
                                                    </p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Permanent Address</h6>
                                                    <p class="text-muted">
                                                        @php
                                                        $permanentAddress = '';
                                                            if($userDetails->permanent_address){
                                                                $address = json_decode($userDetails->permanent_address,true);

                                                                $permanentAddress = $address['house_number'] . " " . $address['street'] . " " . $address['barangay'] . " " . $address['city'] . " " . $address['zipcode'] . " " . $address['province'];
                                                            }else{
                                                                $permanentAddress = '--';  
                                                            }
                                                        @endphp
                                                        {{ $permanentAddress }}
                                                    </p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Nationality</h6>
                                                    <p class="text-muted">{{ $userDetails->nationality }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Country</h6>
                                                    <p class="text-muted">{{ $userDetails->country }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Source of Income</h6>
                                                    <p class="text-muted">{{ $userDetails->source_of_income }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Occupation</h6>
                                                    <p class="text-muted">{{ $userDetails->occupation }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Contact</h6>
                                                    <p class="text-muted">{{ $user->contact }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Facebook</h6>
                                                    <p class="text-muted">{{ $userDetails->facebook }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="pt-1">
                                                <form class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <h6>Snapshot 1</h6>
                                                        <input type="file" class="form-control file-css" placeholder="Snapshot 1">
                                                        <img src="/img/not-available.gif" alt="No Picture Available" class="img-responsive my-2 snapshot-img img-thumbnail" />
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <h6>Snapshot 2</h6>
                                                        <input type="file" class="form-control file-css" placeholder="Snapshot 1">
                                                        <img src="/img/not-available.gif" alt="No Picture Available" class="img-responsive my-2 snapshot-img img-thumbnail" />
                                                    </div>
                                                    
                                                    <div class="col-md-12 mb-1 text-center">
                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                    </div>
                                                </form>
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