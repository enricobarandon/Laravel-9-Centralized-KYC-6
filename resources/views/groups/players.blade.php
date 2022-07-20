@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Groups</h3>
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

                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" value="">
                                </div>
                                
                                <div class="col-md-2">
                                    <select class="form-control" name="status" id="status">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="verified" selected disabled>Verified</option>
                                        <option value="pending" selected disabled>Pending</option>
                                        <option value="disapproved" selected disabled>Disapproved</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href="{{ url('/groups') }}" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered table-striped global-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Group Code</th>
                                <th>Status</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $playersCount = ($players->currentpage()-1)* $players->perpage() + 1;
                            @endphp
                            @foreach($players as $player)
                            <tr>
                                <td>{{ $playersCount++ }}</td>
                                <td>{{ $player->first_name . ' ' . $player->middle_name . ' ' . $player->last_name }}</td>
                                <td>{{ $player->username }}</td>
                                <td>{{ $player->group_code }}</td>
                                <td>{{ $player->status }}</td>
                                <td>{{ $player->contact }}</td>
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