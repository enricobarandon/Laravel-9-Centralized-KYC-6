@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Black/White List Management</h3>
                    <a href='{{ url("/blacklist/add") }}' class="btn btn-sm btn-normal float-right"><i class="fas fa-plus"></i> Add Information</a>
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
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="name" value="{{ $keyword }}">
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="type" id="type">
                                        <option selected disabled>-- Select Type --</option>
                                        <option value="blacklisted" {{ $type == 'blacklisted' ? 'selected' : '' }}>BLACKLISTED</option>
                                        <option value="whitelisted" {{ $type == 'whitelisted' ? 'selected' : '' }}>WHITELISTED</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href="{{ url('/blacklist') }}" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered table-striped global-table text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                @if(in_array(Auth::user()->user_type_id, [1,2,3]))
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $playersCount = 0;
                            @endphp
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ ++$playersCount }}</td>
                                    <td>{{ $player->type }}</td>
                                    <td>{{ $player->bad_first_name . ' ' . $player->last_name }}</td>
                                    <td>{{ $player->bad_middle_name }}</td>
                                    <td>{{ $player->bad_last_name }}</td>
                                    <td>{{ date('M d, Y', strtotime($player->bad_date_of_birth)) }}</td>
                                    @if(in_array(Auth::user()->user_type_id, [1,2,3]))
                                    <td>
                                        <a href='{{ url("/blacklist/edit/$player->id") }}' data-toggle="tooltip" data-placement="top" title="Update Information">
                                            <i class="far fa-edit"></i>
                                        </a>
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
    });
</script>
@endsection