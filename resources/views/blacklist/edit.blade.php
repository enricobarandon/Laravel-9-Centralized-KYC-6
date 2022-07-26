@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">

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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action='{{ url("blacklist/update/$player->id") }}'>
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label text-md-end">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <!-- <input type="text" class="form-control" value="{{ $player->type }}" readonly> -->
                                <select class="form-control" name="type">
                                    <option selected disabled>-- Select Type --</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}"
                                            {{ $player->type == $type ? 'selected' : '' }}
                                        >
                                            {{ strtoupper($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-2 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $player->bad_first_name }}" required autocomplete="first_name" autofocus>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="middle_name" class="col-md-2 col-form-label text-md-end">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $player->bad_middle_name }}" required autocomplete="last_name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-2 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $player->bad_last_name }}" required autocomplete="contact">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date_of_birth" class="col-md-2 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="text" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ date('Y-m-d', strtotime($player->bad_date_of_birth)) }}" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
