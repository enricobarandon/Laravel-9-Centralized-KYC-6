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
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" value="{{ $keyword }}">
                                </div>
                                
                                <div class="col-md-2">
                                    <select class="form-control" name="status" id="status">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" {{ $status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $status == '0' ? 'selected' : '' }}>Deactivated</option>
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
                                <th>Group Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Province</th>
                                <th>site</th>
                                <th>Is Active</th>
                                <!-- <th>Players</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $groupsCount = ($groups->currentpage()-1)* $groups->perpage() + 1;
                            @endphp
                            @foreach($groups as $group)
                                <tr>
                                    <td class="text-center">{{ $groupsCount++ }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->code }}</td>
                                    <td>{{ $group->group_type }}</td>
                                    <td>{{ $group->province }}</td>
                                    <td>{{ $group->site }}</td>
                                    <td class="text-center">
                                        <strong class="{{ $group->is_active ? 'active' : 'deactivated' }}">
                                            {{ $group->is_active ? 'Active' : 'Deactivated' }}
                                        </strong>
                                    </td>
                                    <!-- <td class="text-center">
                                        <a href='{{ url("/groups/$group->id") }}' data-toggle="tooltip" data-placement="top" title="Vew Players"><i class="fa fa-eye"></i></a>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>     

                    <div class="col">
                        <div class="float-right">
                            {{ $groups->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection