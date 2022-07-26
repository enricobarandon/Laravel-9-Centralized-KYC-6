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

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="group_code" id="group_code" placeholder="Group Code" value="{{ $code }}">
                                </div>
                                
                                <div class="col-md-2">
                                    <select class="form-control" name="player_status" id="player_status">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" {{ $status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $status == '0' ? 'selected' : '' }}>Deactivated</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href="{{ url('/helpdesk') }}" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
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
                                <th>Processed By</th>
                                <th>Processed At</th>
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
                                    <td>{{ isset($player->processed_by) ? $processedBy[$player->processed_by] : '' }}</td>
                                    <td>{{ $player->processed_at ? date("M d, Y h:i:s a",strtotime($player->processed_at)) : '' }}</td>
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
                                            <a href='{{ url("/helpdesk/user/$player->id") }}' data-toggle="tooltip" data-placement="top" title="Review Details" class="mr-2"><i class="fa fa-eye"></i></a>
                                            <a href='{{ url("/users/update/$player->id/password") }}' data-toggle="tooltip" data-placement="top" title="Update Password"><i class="fa fa-cog"></i></a>
                                            @if(Auth::user()->user_type_id == 1)
                                                <a href='{{ url("/player/$player->id") }}' data-toggle="tooltip" data-placement="top" title="Update Information" class="ml-2"><i class="fa fa-edit"></i></a>
                                            @endif
                                        </form>
                                        <form action='{{ url("/users/is_black_listed/$player->id") }}' method="POST">
                                            @csrf
                                            <input type="hidden" name="black-list-remarks" class="black-list-remarks" value="">
                                            @if($player->is_black_listed)
                                                <button type="button" class="btn btn-xs btn-light users-black-list black-listed mr-2 btn-padding" data-toggle="tooltip" data-placement="top" title="Remove from Black List">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-xs btn-dark users-black-list not-black-listed mr-2 check-padding"  data-toggle="tooltip" data-placement="top" title="Add to Black List">
                                                    <i class="fas fa-check"></i>
                                                </button>
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
        });
        $('.users-black-list').on('click', function(){
            if($(this).hasClass('not-black-listed') == true){
                $text = 'add this user to black list?';
                swal({
                    title: "ADD TO BLACK LIST",
                    text: "Input Remarks",
                    icon: "info",
                    content: "input",
                    buttons: {
                        cancel: true,
                        confirm: true,
                    }
                }).then((result) => {
                    $('.black-list-remarks').val(result);
                    if(result != null){
                        if($('.black-list-remarks').val().length > 0){
                            $(this).closest('form').submit();
                        }else{
                            swal({icon: "error", text : 'Please Enter Remarks to proceed'});
                        }
                    }
                });

            }else{
                $text = 'remove this user from black list?';
                swal({
                    title: "BLACK LIST",
                    text: "Are you sure you want to " + $text,
                    input: 'text',
                    inputLabel: 'Your IP address',
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then((willUpdate) => {
                    if (willUpdate) {
                        $(this).closest('form').submit();
                    }
                });
            }

        })
    });
</script>
@endsection