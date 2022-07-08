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

                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <input type="text" name="first-name" value="{{ old('first-name') }}">
                        <input type="text" name="last-name" value="{{ old('last-name') }}">
                        <select name="user-type-id">
                            <option selected disable>Select Role</option>
                            @foreach($userTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->role }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="username" value="{{ old('username') }}">
                        <input type="password" name="password">
                        <input type="password" name="confirm-password">

                        <button type="submit">Submit</button>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection