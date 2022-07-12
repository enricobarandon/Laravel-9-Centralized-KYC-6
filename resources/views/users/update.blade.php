@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href='{{ url("users") }}' class="btn btn-primary"><< Back to Users page</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Users Account') }}</div>

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
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $usersInfo->first_name }}" required autocomplete="first_name" autofocus>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $usersInfo->last_name }}" required autocomplete="last_name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $usersInfo->contact }}" required autocomplete="contact">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_type_id" class="col-md-4 col-form-label text-md-end">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                <select id="user_type_id" class="form-control @error('user_type_id') is-invalid @enderror" name="user_type_id">
                                    <option selected disabled value="0">-- Select User Role--</option>
                                    @foreach($userTypes as $userType)
                                        <option value="{{ $userType->id }}" {{ $userType->id == $usersInfo->user_type_id ? 'selected' : '' }}>{{ $userType->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="user_type_id" class="col-md-4 col-form-label text-md-end">{{ __('Group') }}</label>

                            <div class="col-md-6">
                                <select id="user_type_id" class="form-control @error('user_type_id') is-invalid @enderror" name="user_type_id">
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
                            <label for="name" class="col-md-4 col-form-label text-md-end" minlength="8">New Password</label>

                            <div class="col-md-6">
                                <input id="cpassword" type="password" class="form-control" minlength="8" name="cpassword" required autofocus>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="ccpassword" type="password" class="form-control" name="ccpassword" required>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
