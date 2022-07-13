@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Users Page</h3>
                    <a href='{{ url("/users/create") }}' class="btn btn-normal float-right"><i class="fas fa-plus"></i> Create User</a>
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

                    <div class="callout callout-info">
                        <form class="form-horizontal" method="get">
                            <div class="form-group row">

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="keyword" value="{{ $keyword }}">
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="userType" id="userType">
                                        <option value="" selected disabled>Select All Type</option>
                                        @foreach($displayRole as $type)
                                        <option value="{{ $type->id }}" {{ $userType == $type->id ? 'selected' : '' }}>{{ $type->role }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <select class="form-control" name="userStatus" id="userStatus">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" {{ $userStatus == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $userStatus == '0' ? 'selected' : '' }}>Deactivated</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href="{{ url('/users') }}" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped global-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>User Role</th>
                                <th>Created At</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $usersCount = 0;
                            @endphp
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ ++$usersCount }}</td>
                                    <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $userTypes[$user->user_type_id] }}</td>
                                    <td>{{ date("M d, Y h:i:s a",strtotime($user->created_at)) }}</td>
                                    <td class="text-center">
                                        <strong class="{{ $user->is_active ? 'active' : 'deactivated' }}">
                                            {{ $user->is_active ? 'Active' : 'Deactivated' }}
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        <form action='{{ url("/users/is_active/$user->id") }}' method="POST">
                                            @csrf
                                                @if($user->is_active)
                                                    <button type="button" class="btn btn-sm btn-danger users-status deactivate">
                                                        <i class="fas fa-times"></i> Deactivate
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success users-status activate">
                                                        <i class="fas fa-plus"></i> Activate
                                                    </button>
                                                @endif
                                        </form>
                                        
                                        <a href='{{ url("users/update/$user->id/info") }}' name="updateUser" class="btn btn-sm btn-primary"><i class="fas fa-cog"></i> Edit</a>
                                        <a href='{{ url("users/update/$user->id/password") }}' name="updateUser" class="btn btn-sm btn-info"><i class="fas fa-cog"></i> Change Password</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>     
                    
                    <div class="col">
                        <div class="float-right">
                            {{ $users->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("document").ready(function(){
        $('.users-status').on('click', function(){
            if($(this).hasClass('activate') == true){
                $text = 'activate';
            }else{
                $text = 'deactivate';
            }
            swal({
                title: $text.toUpperCase() + " USER",
                text: "Are you sure you want to " + $text + " this user?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((willUpdate) => {
                if (willUpdate) {
                    $(this).closest('form').submit();
                }
            });
        })
    });
</script>
@endsection