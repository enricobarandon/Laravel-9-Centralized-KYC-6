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

                    
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info-circle"></i> Groups Statistics for {{ $currentDate }}</h5>
                            </div>

                            <div class="box-body table-responsive table-striped global-table">
                                <table class="table table-hover">
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
                                        <!-- <tr>
                                            <td>219</td>
                                            <td>Alexander Pierce</td>
                                            <td>11-7-2014</td>
                                            <td><span class="label label-warning">Pending</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>657</td>
                                            <td>Bob Doe</td>
                                            <td>11-7-2014</td>
                                            <td><span class="label label-primary">Approved</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>175</td>
                                            <td>Mike Doe</td>
                                            <td>11-7-2014</td>
                                            <td><span class="label label-danger">Denied</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        



    </div>
</div>
@endsection