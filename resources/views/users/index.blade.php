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
                                    <td>{{ ++$usersCount }}</td>
                                    <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $userTypes[$user->user_type_id] }}</td>
                                    <td>{{ date("M d, Y h:i:s a",strtotime($user->created_at)) }}</td>
                                    <td>{{ $user->is_active ? 'Active' : 'Deactivated' }}</td>
                                    <td>
                                        <form action='{{ url("/users/is_active/$user->id") }}' method="POST">
                                            @csrf
                                                @if($user->is_active)
                                                    <button type="button" class="btn btn-danger users-status deactivate">
                                                        <i class="fas fa-times"></i> Deactivate
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-success users-status activate">
                                                        <i class="fas fa-plus"></i> Activate
                                                    </button>
                                                @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>     

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