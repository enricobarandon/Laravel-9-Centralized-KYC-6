@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> API Data Page</h3>
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

                    Get DATA from API

                    @if(Auth::user()->username == 'kikoadmin')

                        <form class="form-inline" method="post" action="{{ route('api.getGroups') }}">
                            @csrf
                            <p>Initial Groups transfer</p>
                            <button type="submit" class="btn btn-primary mb-2" id="btnSyncUsers">Confirm</button>
                        </form>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection