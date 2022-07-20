@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Players Attendance</h3>
                    <a href='{{ url("/groups") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back</a>
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
                        <form class="form-horizontal mb-3" method="get">
                            <div class="form-group row">

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Name / Username" value="">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="date" id="date" placeholder="Date" value="{{ $date != '' ? date('M d, Y',strtotime($date)) : '' }}">
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Submit</button>
                                    <a href='{{ url("/groups/report/$id") }}' class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                        <h5><i class="fas fa-info-circle"></i> Player Attendance for {{ $filterDate }}</h5>
                        <h6>{{ $groupCode->name }}</h6>
                    </div>

                    <table class="table table-bordered table-striped global-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Group Code</th>
                                <th>SV Incharge</th>
                                <th>Attendance Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $playersCount = ($trackingLogs->currentpage()-1)* $trackingLogs->perpage() + 1;
                            @endphp
                            @foreach($trackingLogs as $value)
                            <tr>
                                <td>{{ $playersCount++ }}</td>
                                <td>{{ $value->first_name . ' ' . $value->middle_name . ' ' . $value->last_name }}</td>
                                <td>{{ $value->username }}</td>
                                <td>{{ $value->group_code }}</td>
                                <td>{{ $processedBy[$value->approved_by] }}</td>
                                <td>{{ date("M d, Y h:i:s a",strtotime($value->created_at)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>     

                    <div class="col">
                        <div class="float-right">
                            {{ $trackingLogs->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
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