@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Update Users Account</h3>
                    @if($usersInfo->user_type_id == 5)
                        @if($usersInfo->status == 'verified')
                        <a href='{{ url("helpdesk") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back</a>
                        @else
                            @if(isset($usersInfo->review_by))
                            <a href='{{ url("helpdesk/for-approval") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back</a>
                            @else
                            <a href='{{ url("helpdesk/for-review") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back</a>
                            @endif
                        @endif
                    @else
                    <a href='{{ url("users") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back</a>
                    @endif
                </div>

                <div class="card-body">
                    @if($operation == 'info')
                    <form method="POST" action="/submitUser">
                    {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $usersInfo->id }}">
                        <input type="hidden" name="operation" value="{{ $operation }}">
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
                            <label class="col-md-2 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $usersInfo->username }}" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-2 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $usersInfo->first_name }}" required autocomplete="first_name" autofocus>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="last_name" class="col-md-2 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $usersInfo->last_name }}" required autocomplete="last_name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact" class="col-md-2 col-form-label text-md-end">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $usersInfo->contact }}" required autocomplete="contact">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_type_id" class="col-md-2 col-form-label text-md-end">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                <select id="user_type_id" class="form-control @error('user_type_id') is-invalid @enderror" name="user_type_id" required>
                                    <option selected disabled value="0">-- Select User Role--</option>
                                    @foreach($userTypes as $userType)
                                        <option value="{{ $userType->id }}" {{ $userType->id == $usersInfo->user_type_id ? 'selected' : '' }}>{{ $userType->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="group_code" class="col-md-2 col-form-label text-md-end">{{ __('Group') }}</label>

                            <div class="col-md-6">
                                <select id="group_code" class="form-control @error('group_code') is-invalid @enderror" name="group_code" required>
                                    <option selected disabled value="0">-- Select Group--</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->code }}" {{ $group->code == $usersInfo->group_code ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    @elseif($operation == 'password')
                    <form method="POST" action="/submitUser">
                    {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $usersInfo->id }}">
                        <input type="hidden" name="operation" value="{{ $operation }}">
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
                            <label class="col-md-2 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $usersInfo->username }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $usersInfo->first_name }}" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $usersInfo->last_name }}" readonly>
                            </div>
                        </div>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
