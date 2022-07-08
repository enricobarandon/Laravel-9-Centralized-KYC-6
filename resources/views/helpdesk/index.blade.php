@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Help Desk Page</h3>
                    <a href='#' class="btn btn-primary float-right"><i class="fas fa-plus"></i> Create Player</a>
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
                                <th>Player Name</th>
                                <th>Username</th>
                                <th>User Role</th>
                                <th>Created At</th>
                                <th>Is Active</th>
                                <th>Account Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $playersCount = 0;
                            @endphp
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ ++$playersCount }}</td>
                                    <td>{{ $player->first_name . ' ' . $player->last_name }}</td>
                                    <td>{{ $player->username }}</td>
                                    <td>{{ $player->role }}</td>
                                    <td>{{ date("M d, Y h:i:s a",strtotime($player->created_at)) }}</td>
                                    <td>{{ $player->is_active ? 'Active' : 'Deactivated' }}</td>
                                    <td>{{ $player->status }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href='{{ url("/helpdesk/user/$player->id") }}'>View Details</a>
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