@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> create user</h3>
                </div>

                <div class="card-body text-center">
                    <div class="col-md-4 m-auto">
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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="col-md-4 m-auto">
                            <div class="form-group ">
                                <input class="form-control" type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                            </div>

                            <div class="form-group ">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>

                            <div class="form-group ">
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                            </div>

                            <div class="form-group ">
                                <select class="form-control" name="user_type_id" required>
                                    <option selected disable value="">Select User Role</option>
                                    @foreach($userTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <select class="form-control" name="group_code" data-live-search="true" required>
                                    <option selected disable value="">Select Group Code</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->code }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group ">
                                <input type="text" class="form-control" name="contact" value="{{ old('contact') }}" placeholder="Contact Number">
                            </div>

                            <div class="form-group ">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                            </div>
                            
                            <div class="form-group ">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection