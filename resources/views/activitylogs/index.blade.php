@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Activity Logs</h3>
                </div>

                <div class="card-body">
                    <table id="tblLogs" class="table table-bordered global-table table-hover position-relative">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 205px !important;">Date</th>
                                <th>Module</th>
                                <th>User</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = ($activityLogs->currentpage()-1)* $activityLogs->perpage() + 1;
                        @endphp
                            @if(!$activityLogs->isEmpty())
                            
                                @foreach($activityLogs as $index => $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date("M d, Y h:i:s a",strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->type }}</td>
                                        
                                        <td>
                                            {{ $value->username. ' - ' . $value->role  }}
                                        </td>
                                        <td>
                                            @php

                                                $decoded_data = json_decode($value->assets,true);
                                                
                                                if(json_last_error() === JSON_ERROR_NONE){

                                                    $description = '';

                                                    foreach($decoded_data as $key => $data){

                                                        if (is_array($data)) {

                                                        } else {
                                                            $description .= "<li>" .$key . " : " .  $data . "</li>";
                                                        }



                                                    }
                                                }else{
                                                    $description = "<li>".$value->assets."</li>";
                                                }

                                            @endphp
                                            {!! $description !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan='5'>No Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="col">
                        <div class="float-right">
                            {{ $activityLogs->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
