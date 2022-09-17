@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-info-circle"></i> Player Information</h3>
                <a href='{{ url("/") }}' class="btn btn-normal float-right"><i class="fas fa-backward"></i> Back to dashboard</a>
            </div>
            
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="/updatePlayer" class="form-mg" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hdnStatus" value="{{ $playerInfo->status }}">
                    <input type="hidden" name="hdnId" value="{{ $playerInfo->id }}">
                    <!-- <div class="form-group row">
                        <div class="col-md-4">
                            <label for="username" >Username</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="password" >Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <img class="view-password1" src="{{ asset('img/icons/eye.png') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="password_confirmation" >Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <img class="view-password2" src="{{ asset('img/icons/eye.png') }}">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="first_name" >First Name</label>
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ isset($playerInfo->first_name) ? $playerInfo->first_name : '' }}" required autocomplete="first_name" >

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name" >Middle Name</label>
                            <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ isset($playerInfo->middle_name) ? $playerInfo->middle_name : '' }}" required autocomplete="middle_name" >

                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="last_name" >Last Name</label>
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ isset($playerInfo->middle_name) ? $playerInfo->last_name : '' }}" required autocomplete="last_name" >

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- <div class="col-md-4">
                            <label for="contact" >Contact</label>
                            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" >

                            @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> -->
                        <div class="col-md-4">
                            <label for="date_of_birth" >Date of Birth</label>
                            <input id="date_of_birth" type="text" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ isset($playerDetails->date_of_birth) ? date('M. d, Y',strtotime($playerDetails->date_of_birth)) : '' }}" required autocomplete="date_of_birth" >

                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="place_of_birth" >Place of Birth</label>
                            <input id="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" value="{{ isset($playerDetails->place_of_birth) ? $playerDetails->place_of_birth : '' }}" required autocomplete="place_of_birth" >

                            @error('place_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nationality" >Nationality</label>
                            <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ isset($playerDetails->nationality) ? $playerDetails->nationality : '' }}" required autocomplete="nationality">

                            @error('nationality')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="country" >Country</label>
                            <!-- <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country"> -->
                            <select id="country" name="country" class="form-control selectCSS @error('country') is-invalid @enderror" name="country" required>
                                @foreach ($countries as $key => $value)
                                <option value="{{$value}}" {{ $value  == $playerDetails->country ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                            </select>
                            
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Present Address</label>
                        </div>
                    </div>
                    @php
                        $house_number = '';
                        $street = '';
                        $barangay = '';
                        $city = '';
                        $zipcode = '';
                        $province = '';
                        if(isset($playerDetails->present_address)){
                            $address = json_decode($playerDetails->present_address,true);

                            $house_number = isset($address['house_number']) ? $address['house_number'] : '';
                            $street = isset($address['street']) ? $address['street'] : '';
                            $barangay = isset($address['barangay']) ? $address['barangay'] : '';
                            $city = isset($address['city']) ? $address['city'] : '';
                            $zipcode = isset($address['zipcode']) ? $address['zipcode'] : '';
                            $province = isset($address['province']) ? $address['province'] : '';
                            $region = isset($address['region']) ? $address['region'] : '';
                        }
                    @endphp
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="house_number" >House Number</label>
                            <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ $house_number }}" required autocomplete="house_number">

                            @error('house_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="street" >Street</label>
                            <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $street }}" required autocomplete="street">

                            @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="barangay" >Barangay</label>
                            <input id="barangay" type="text" class="form-control @error('barangay') is-invalid @enderror" name="barangay" value="{{ $barangay }}" required autocomplete="barangay">

                            @error('barangay')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="city" >City</label>
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $city }}" required autocomplete="city">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="zipcode" >Zipcode</label>
                            <input id="zipcode" type="number" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ $zipcode }}" required autocomplete="zipcode">

                            @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="province" >Province</label>
                            <input id="province" type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ $province }}" required autocomplete="province">
                            <!-- <select id="province" name="province" class="form-control selectCSS @error('province') is-invalid @enderror" name="province" value="{{ old('province') }}" required>
                                <option disabled selected value="">-- Select Province --</option>
                                @foreach ($provinces as $value)
                                <option value="{{$value->name}}" {{ $value->name == $province ? 'selected' : '' }}>{{$value->name}}</option>
                                @endforeach
                            </select> -->

                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="zipcode" >Region</label>
                            <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" value="{{ $region }}" required autocomplete="region">

                            @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Permanent Address</label>
                        </div>

                        <div class="col-sm-12">
                            <input class="form-check-input" type="checkbox" value="" id="sameAddress">
                            <label class="form-check-label" for="sameAddress">
                                    SAME AS PRESENT ADDRESS
                            </label>
                        </div>
                    </div>

                    @php
                        $p_house_number = '';
                        $p_street = '';
                        $p_barangay = '';
                        $p_city = '';
                        $p_zipcode = '';
                        $p_province = '';
                        if(isset($playerDetails->permanent_address)){
                            $p_address = json_decode($playerDetails->permanent_address,true);

                            $p_house_number = isset($p_address['house_number']) ? $p_address['house_number'] : '';
                            $p_street = isset($p_address['street']) ? $p_address['street'] : '';
                            $p_barangay = isset($p_address['barangay']) ? $p_address['barangay'] : '';
                            $p_city = isset($p_address['city']) ? $p_address['city'] : '';
                            $p_zipcode = isset($p_address['zipcode']) ? $p_address['zipcode'] : '';
                            $p_province = isset($p_address['province']) ? $p_address['province'] : '';
                            $p_region = isset($p_address['region']) ? $p_address['region'] : '';
                        }
                    @endphp
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="p_house_number" >House Number</label>
                            <input id="p_house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="p_house_number" value="{{ $p_house_number }}" required autocomplete="p_house_number">

                            @error('p_house_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="p_street" >Street</label>
                            <input id="p_street" type="text" class="form-control @error('p_street') is-invalid @enderror" name="p_street" value="{{ $p_street }}" required autocomplete="p_street">

                            @error('p_street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="p_barangay" >Barangay</label>
                            <input id="p_barangay" type="text" class="form-control @error('p_barangay') is-invalid @enderror" name="p_barangay" value="{{ $p_barangay }}" required autocomplete="p_barangay">

                            @error('p_barangay')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="p_city" >City</label>
                            <input id="p_city" type="text" class="form-control @error('p_city') is-invalid @enderror" name="p_city" value="{{ $p_city }}" required autocomplete="p_city">

                            @error('p_city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="p_zipcode" >Zipcode</label>
                            <input id="p_zipcode" type="number" class="form-control @error('p_zipcode') is-invalid @enderror" name="p_zipcode" value="{{ $p_zipcode }}" required autocomplete="p_zipcode">

                            @error('p_zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="p_province" >Province</label>
                            <input id="p_province" type="text" class="form-control @error('p_province') is-invalid @enderror" name="p_province" value="{{ $p_province }}" required autocomplete="p_province">
                            <!-- <select id="p_province" name="p_province" class="form-control selectCSS @error('p_province') is-invalid @enderror" name="p_province" value="{{ old('p_province') }}" required>
                                <option disabled selected value="">-- Select Province --</option>
                                @foreach ($provinces as $value)
                                <option value="{{$value->name}}" {{ $value->name == $p_province ? 'selected' : '' }}>{{$value->name}}</option>
                                @endforeach
                            </select> -->

                            @error('p_province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="zipcode" >Region</label>
                            <input id="p_region" type="text" class="form-control @error('p_region') is-invalid @enderror" name="p_region" value="{{ $p_region }}" required autocomplete="region">

                            @error('p_region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="occupation" >Occupation</label>
                            <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{ isset($playerDetails->occupation) ? $playerDetails->occupation : '' }}" required autocomplete="occupation">

                            @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @php
                        $select_source_of_income = '';
                        $source_of_income = '';
                        if(isset($playerDetails->source_of_income)){
                            $income = json_decode($playerDetails->source_of_income,true);
                            if(json_last_error() === JSON_ERROR_NONE){
                                $select_source_of_income = $income['select_source_of_income'];
                                $source_of_income = $income['source_of_income'];
                            }else{
                                $select_source_of_income = $playerDetails->source_of_income;
                                $source_of_income = $playerDetails->source_of_income;
                            }
                        }
                        @endphp
                        <div class="col-md-4">
                            <label for="select_source_of_income" >Source of Income</label>
                            <select id="select_source_of_income" type="text" class="form-control @error('select_source_of_income') is-invalid @enderror selectCSS" name="select_source_of_income" value="{{ old('select_source_of_income') }}" required>
                                <option value="others" selected>Others</option>
                                <option value="salary" {{ $select_source_of_income == 'salary' ? 'selected' : '' }}>Salary</option>
                                <option value="business" {{ $select_source_of_income == 'business' ? 'selected' : '' }}>Business</option>
                            </select>
                            @error('select_source_of_income')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 div-others-income">
                            <label for="source_of_income" class="income-label">Specify Source of Income</label>
                            <input id="source_of_income" type="text" class="form-control" name="source_of_income" value="{{ isset($source_of_income) ? $source_of_income : '' }}" required autocomplete="source_of_income">
                        </div>
                            @error('source_of_income')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="facebook" >Facebook</label>
                            <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ isset($playerDetails->facebook) ? $playerDetails->facebook : '' }}" required autocomplete="facebook">

                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="video_app">Prefer Video Interview App</label>
                            <select class="form-control selectCSS" name="video_app" id="video_app" required>
                                <option disabled selected value="">-- Select Video App --</option>
                                @foreach ($video_apps as $key => $value)
                                <option value="{{$value}}" {{ $value == $playerDetails->video_app ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('video_app')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="valid_id_type">Valid ID Type</label>
                            <select class="form-control selectCSS" name="valid_id_type" id="valid_id_type" required>
                                <option disabled selected value="">-- Select Valid ID --</option>
                                @foreach ($valid_ids as $key => $value)
                                <option value="{{$key}}" {{ $key == $playerDetails->valid_id_type ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="id_picture" >ID Picture</label>
                            <input class="form-control fileCSS" type="file" name="id_picture" id="id_picture" accept="capture">
                            @error('id_picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if(isset($playerDetails->id_picture))
                            <img src="/img/id_picture/{{ $playerDetails->id_picture }}" id="image-previewer-id" class="img-fluid img-responsive">
                            @else
                            <img src="/img/picture_of_id.png" id="image-previewer-id" class="img-fluid img-responsive">
                            @endif
                        </div>

                        
                        <div class="col-md-6">
                            <label for="selfie_with_id" >Selfie with ID</label>
                            <input class="form-control fileCSS" type="file" name="selfie_with_id" id="selfie_with_id" accept="capture">
                            @error('selfie_with_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if(isset($playerDetails->id_picture))
                            <img src="/img/id_picture_selfie/{{ $playerDetails->selfie_with_id }}" id="image-previewer-selfie" class="img-fluid img-responsive">
                            @else
                            <img src="/img/holding_id.png" id="image-previewer-selfie" class="img-fluid img-responsive">
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group form-group--sm">
                        <div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-class">
                                Submit Update
                            </button>
                        </div>
                    </div>
                </form>
                

            </div>

        </div>
    </div>


</div>

@endsection

@section('script')
<script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('js/imoViewer-min.js') }}"></script>
<script>
$("document").ready(function(){
    $('.view-password1').hover(function () {
        $('#password').attr('type', 'text'); 
    }, function () {
        $('#password').attr('type', 'password'); 
    });
    $('.view-password2').hover(function () {
        $('#password_confirmation').attr('type', 'text'); 
    }, function () {
        $('#password_confirmation').attr('type', 'password'); 
    });
    $('#sameAddress').change(function() {
        if(this.checked) {
            $('#p_house_number').val($('#house_number').val());
            $('#p_street').val($('#street').val());
            $('#p_barangay').val($('#barangay').val());
            $('#p_city').val($('#city').val());
            $('#p_zipcode').val($('#zipcode').val());
            $('#p_province').val($('#province').val());
        }else{
            $('#p_house_number').val("");
            $('#p_street').val("");
            $('#p_barangay').val("");
            $('#pCp_cityity').val("");
            $('#p_zipcode').val("");
            $('#p_province').val("");
        }
    });
    $('#select_source_of_income').on('change', function() {
        $('.div-others-income').show();
        if(this.value == 'others'){
            $('.income-label').text('Specify source of income');
        }else if(this.value == 'salary'){
            $('.income-label').text('Provide Company Name');
        }else{
            $('.income-label').text('Provide Business Name');
        }
    });
    
    $("#date_of_birth").datetimepicker({
        timepicker: false,
        format: 'M d, Y',
        maxDate: 0
    });
    
    $('#id_picture').imoViewer({
      'preview' : '#image-previewer-id',
    })

    $('#selfie_with_id').imoViewer({
      'preview' : '#image-previewer-selfie',
    })
});
</script>
@endsection