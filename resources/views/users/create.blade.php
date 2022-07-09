@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> create user</h3>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="first_name">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="last_name">
                        <input type="text" name="contact" value="{{ old('contact') }}" placeholder="contact">
                        <select name="user_type_id">
                            <option selected disable>Select Role</option>
                            @foreach($userTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->role }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="username">
                        <input type="password" name="password" placeholder="password">
                        <input type="password" name="password_confirmation" placeholder="password_confirmation">

                        <button type="submit">Submit</button>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection