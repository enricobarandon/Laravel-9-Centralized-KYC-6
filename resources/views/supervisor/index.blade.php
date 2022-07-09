@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Supervisor Page</h3>
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

                    supervisor

                    <div>
                        <input type="text" name="qrcode" id="qrcode" placeholder="QR CODE">
                        
                        
                        <div class="row-element">
                            <div class="qrscanner" id="scanner">
                            </div>
                        </div>
                        <!-- <div class="row-element">
                            <div class="form-field form-field-memo">
                            <div class="form-field-caption-panel">
                                <div class="gwt-Label form-field-caption">
                                Scanned text
                                </div>
                            </div>
                            <div class="FlexPanel form-field-input-panel">
                                <textarea id="scannedTextMemo" class="textInput form-memo form-field-input textInput-readonly" rows="3">
                                </textarea>
                            </div>
                            </div>
                            <div class="form-field form-field-memo">
                            <div class="form-field-caption-panel">
                                <div class="gwt-Label form-field-caption">
                                Scanned text history
                                </div>
                            </div>
                            </div>
                        </div> -->

                        <div id="playerInfo">
                            
                        </div>



                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript" src="{{ asset('/js/lib/jsqrscanner/jsqrscanner.nocache.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/backend/supervisor.js') }}"></script>
@endsection