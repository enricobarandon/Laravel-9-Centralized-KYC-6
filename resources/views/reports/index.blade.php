@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Reports</h3>
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

                    
                    @include('partials.cards')

                    
                    <div class="callout callout-info">
                        
                        <form class="form-horizontal mb-3" method="get">
                            <div class="form-group row">

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="group" id="group" placeholder="Group Code" value="{{ $groupCode }}">
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="date" id="date" placeholder="Date" value="{{ $date != '' ? date('M d, Y',strtotime($date)) : '' }}">
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href="{{ url('/reports') }}" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
                                </div>
                            </div>
                        </form>

                        <h5><i class="fas fa-info-circle"></i> Groups Statistics for {{ $filterDate }}</h5>

                    </div>

                    <table class="table table-hover table-striped global-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Type</th>
                                <th>Province</th>
                                <th>Registered Player</th>
                                <th>Player Logged In Today</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $groupCount = 0;
                            @endphp
                            @foreach($groupsStatistics as $group)
                                <tr>
                                    <td class="text-center">{{ ++$groupCount }}</td>
                                    <td>{{ $group->group->name }}</td>
                                    <td>{{ $group->group->group_type }}</td>
                                    <td>{{ $group->group->province->name }}</td>
                                    <td class="text-center"><span class="badge bg-green">{{ $group->total_player_registered }}</span></td>
                                    <td class="text-center"><span class="badge bg-blue">{{ $group->total_player_logged_in }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="col">
                        <div class="float-right">
                            {{ $groupsStatistics->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
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
$('document').ready(function() {
    $("#date").datetimepicker({
        timepicker: false,
        format: 'M d, Y',
        maxDate: 0
    });
});
</script>
@endsection