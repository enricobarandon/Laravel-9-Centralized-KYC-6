@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Help Desk Page</h3>
                    <!-- <a href='#' class="btn btn-normal float-right"><i class="fas fa-plus"></i> Create Player</a> -->
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
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Name / Username" value="{{ $keyword }}">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="group_code" id="group_code" placeholder="Group Code" value="{{ $code }}">
                                </div>
                                
                                <div class="col-md-2">
                                    <select class="form-control" name="player_status" id="player_status">
                                        <option value="" selected disabled>Player Status</option>
                                        <option value="1" {{ $status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $status == '0' ? 'selected' : '' }}>Deactivated</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <select class="form-control" name="account_status" id="player_status">
                                        <option value="" selected disabled>Account Status</option>
                                        <option value="pending" {{ $account_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="disapproved" {{ $account_status == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href="{{ url('/helpdesk/for-approval') }}" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered table-striped global-table text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Player Name</th>
                                <th>Username</th>
                                <th>User Role</th>
                                <th>Group Code</th>
                                <th>Created At</th>
                                <th>Is Active</th>
                                <th>Account Status</th>
                                @if(in_array(Auth::user()->user_type_id, [1,3]))
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $playersCount = ($players->currentpage()-1)* $players->perpage() + 1;
                            @endphp
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ $playersCount++ }}</td>
                                    <td>{{ $player->first_name . ' ' . $player->last_name }}</td>
                                    <td>{{ $player->username }}</td>
                                    <td>{{ $player->role }}</td>
                                    <td>{{ $player->group_code }}</td>
                                    <td>{{ date("M d, Y h:i:s a",strtotime($player->created_at)) }}</td>
                                    <td>
                                        <strong class="{{ $player->is_active ? 'active' : 'deactivated' }}">
                                            {{ $player->is_active ? 'Active' : 'Deactivated' }}
                                        </strong>
                                    </td>
                                    <td><strong class="{{ $player->status }}">{{ strtoupper($player->status) }}</td>
                                    @if(in_array(Auth::user()->user_type_id, [1,3]))
                                    <td>
                                        <form action='{{ url("/users/is_active/$player->id") }}' method="POST">
                                            @csrf
                                            @if($player->is_active)
                                                <button type="button" class="btn btn-xs btn-danger users-status deactivate mr-2 btn-padding" data-toggle="tooltip" data-placement="top" title="Deactivate">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-xs btn-success users-status activate mr-2 check-padding"  data-toggle="tooltip" data-placement="top" title="Activate">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                            <a href='{{ url("/helpdesk/user/$player->id") }}' data-toggle="tooltip" data-placement="top" class="mr-2" title="Review Details"><i class="fa fa-eye"></i></a>
                                            <a href='{{ url("/users/update/$player->id/password") }}' data-toggle="tooltip" data-placement="top" title="Update Password"><i class="fa fa-cog"></i></a>
                                            @if(Auth::user()->user_type_id == 1)
                                            <a href='{{ url("/player/$player->id") }}' data-toggle="tooltip" data-placement="top" title="Update Information" class="ml-2"><i class="fa fa-folder-open"></i></a>
                                            @endif
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>     

                    <div class="col">
                        <div class="float-right">
                            {{ $players->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
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
        $('[data-toggle="tooltip"]').tooltip(); 
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