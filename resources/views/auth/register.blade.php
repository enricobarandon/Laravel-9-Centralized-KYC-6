
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WPC</title>


    <!-- Styles -->

    <link href="{{ asset('css/min/backend.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.css')}}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body class="body-content">
    <div class="content">
      <div class="container-fluid">
            <main class="py-4">
                <div class="container login-container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-login">
                                <div class="card-header card__header">
                                    <h4>Register</h4>
                                </div>

                                <div class="card-body card__content">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('register') }}" id="formRegister" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="group_code" value="{{ isset($_GET['code']) ? $_GET['code'] : '' }}">
                                    <div class="form-group row">
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
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="first_name" >First Name</label>
                                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" >

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="middle_name" >Middle Name</label>
                                            <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" >

                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="last_name" >Last Name</label>
                                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" >

                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="contact" >Contact</label>
                                            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" >

                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date_of_birth" >Date of Birth</label>
                                            <input id="date_of_birth" type="text" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" >

                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="place_of_birth" >Place of Birth</label>
                                            <input id="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" value="{{ old('place_of_birth') }}" required autocomplete="place_of_birth" >

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
                                            <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality') }}" required autocomplete="nationality">

                                            @error('nationality')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="country" >Country</label>
                                            <!-- <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country"> -->
                                            <select id="country" name="country" class="form-control selectCSS @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required>
                                                <option selected value="Philippines">Philippines</option>
                                                @foreach ($countries as $key => $value)
                                                <option value="{{$value}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label>Present Address</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="house_number" >House Number</label>
                                            <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number') }}" required autocomplete="house_number">

                                            @error('house_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="street" >Street</label>
                                            <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street">

                                            @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="zipcode" >Zipcode</label>
                                            <input id="zipcode" type="number" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode">

                                            @error('zipcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="form-group row">

                                        <div class="col-md-4">
                                            <label for="region">Region</label>
                                            <select id="region" class="form-control selectCSS @error('region') is-invalid @enderror" name="region" value="{{ old('region') }}" required>
                                                <option disabled selected value="">-- Select Region --</option>

                                            </select>

                                            @error('region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="province" >Province</label>
                                            <select id="province" name="province" class="form-control selectCSS @error('province') is-invalid @enderror"  value="{{ old('province') }}" required>
                                                <option disabled selected value="">-- Select Province --</option>
                                            </select>

                                            @error('province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="city">City / Municipality</label>
                                            <select id="city" class="form-control selectCSS @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required>
                                                <option disabled selected value="">-- Select City --</option>

                                            </select>

                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="barangay" >Barangay</label>
                                            <!-- <input id="barangay" type="text" class="form-control @error('barangay') is-invalid @enderror" name="barangay" value="{{ old('barangay') }}" required autocomplete="barangay"> -->
                                            <select id="barangay" class="form-control selectCSS @error('barangay') is-invalid @enderror" name="barangay" value="{{ old('barangay') }}" required>
                                                <option disabled selected value="">-- Select Barangay --</option>

                                            </select>

                                            @error('barangay')
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
                                            <input class="form-check-input" type="checkbox" value="check" name="sameAddress" id="sameAddress">
                                            <label class="form-check-label" for="sameAddress">
                                                    SAME AS PRESENT ADDRESS
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="p_house_number" >House Number</label>
                                            <input id="p_house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="p_house_number" value="{{ old('p_house_number') }}" required autocomplete="p_house_number">

                                            @error('p_house_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="p_street" >Street</label>
                                            <input id="p_street" type="text" class="form-control @error('p_street') is-invalid @enderror" name="p_street" value="{{ old('p_street') }}" required autocomplete="p_street">

                                            @error('p_street')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="col-md-4">
                                            <label for="p_zipcode" >Zipcode</label>
                                            <input id="p_zipcode" type="number" class="form-control @error('p_zipcode') is-invalid @enderror" name="p_zipcode" value="{{ old('p_zipcode') }}" required autocomplete="p_zipcode">

                                            @error('p_zipcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-4">
                                            <label for="p_region">Region</label>
                                            <select id="p_region" class="form-control selectCSS @error('p_region') is-invalid @enderror" name="p_region" value="{{ old('p_region') }}" required>
                                                <option disabled selected value="">-- Select Region --</option>

                                            </select>

                                            @error('p_region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="p_province" >Province</label>
                                            <select id="p_province" name="p_province" class="form-control selectCSS @error('p_province') is-invalid @enderror" value="{{ old('p_province') }}" required>
                                                <option disabled selected value="">-- Select Province --</option>
                                                <!-- @foreach ($provinces as $province)
                                                <option value="{{$province->name}}" {{ old('p_province') == $province->name ? 'selected' : '' }}>{{$province->name}}</option>
                                                @endforeach -->
                                            </select>

                                            @error('p_province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="p_city">City / Municipality</label>
                                            <select id="p_city" class="form-control selectCSS @error('p_city') is-invalid @enderror" name="p_city" value="{{ old('p_city') }}" required>
                                                <option disabled selected value="">-- Select City --</option>

                                            </select>

                                            @error('p_city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="p_barangay" >Barangay</label>
                                            <!-- <input id="barangay" type="text" class="form-control @error('barangay') is-invalid @enderror" name="barangay" value="{{ old('barangay') }}" required autocomplete="barangay"> -->
                                            <select id="p_barangay" class="form-control selectCSS @error('p_barangay') is-invalid @enderror" name="p_barangay" value="{{ old('p_barangay') }}" required>
                                                <option disabled selected value="">-- Select Barangay --</option>

                                            </select>

                                            @error('p_barangay')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="occupation" >Occupation</label>
                                            <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{ old('occupation') }}" required autocomplete="occupation">

                                            @error('occupation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="select_source_of_income" >Source of Income</label>
                                            <select id="select_source_of_income" name="select_source_of_income" type="text" class="form-control @error('select_source_of_income') is-invalid @enderror selectCSS" name="select_source_of_income" value="{{ old('select_source_of_income') }}" required autocomplete="select_source_of_income">
                                                <option selected disabled> Select source of income</option>
                                                <option value="salary" {{ old('select_source_of_income') == 'salary' ? 'selected' : '' }}>Salary</option>
                                                <option value="business" {{ old('select_source_of_income') == 'business' ? 'selected' : '' }}>Business</option>
                                                <option value="others" {{ old('select_source_of_income') == 'others' ? 'selected' : '' }}>Others</option>
                                            </select>
                                            @error('select_source_of_income')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 div-others-income">
                                            <label for="source_of_income" class="income-label">Specify Source of Income</label>
                                            <input id="source_of_income" type="text" class="form-control" name="source_of_income" value="{{ old('source_of_income') }}" required autocomplete="source_of_income">
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
                                            <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') }}" required autocomplete="facebook">

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
                                                <option value="{{$value}}" {{ old('video_app') == $value ? 'selected' : '' }}>{{$value}}</option>
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
                                                <option value="{{$key}}" {{ old('valid_id_type') == $key ? 'selected' : '' }}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('valid_id_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="id_picture" >ID Picture</label>
                                            <input class="form-control fileCSS" type="file" name="id_picture" id="id_picture" accept="capture" required>
                                            @error('id_picture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <img src="/img/picture_of_id.png" id="image-previewer-id" class="img-fluid img-responsive">
                                        </div>


                                        <div class="col-md-6">
                                            <label for="selfie_with_id" >Selfie with ID</label>
                                            <input class="form-control fileCSS" type="file" name="selfie_with_id" id="selfie_with_id" accept="capture" required>
                                            @error('selfie_with_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <img src="/img/holding_id.png" id="image-previewer-selfie" class="img-fluid img-responsive">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="form-group form-check">
                                            <input class="form-check-input" type="checkbox" name="agree_terms_privacy" id="agree_terms_privacy" value="1" required="">
                                            <label class="form-check-label" for="agree_terms_privacy">I Agree with the <a href="/terms" target="_blank">terms and conditions</a> , <a href="/policy" target="_blank">privacy policy</a> </label>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group form-check">
                                            <input class="form-check-input" type="checkbox" name="over_age" id="over_age" value="1" required="">
                                            <label class="form-check-label" for="over_age">I am 21 years/above 21 years old</label>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="form-group form-group--sm">
                                        <div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-class">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>


                                <div class="form-group form-group--sm">
                                    <div>
                                        <a href="/login" class="btn btn-secondary btn-lg btn-block btn-class">
                                            Back To login Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
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
            $('#p_house_number').val($('#house_number').val()).attr('readonly', true);
            $('#p_street').val($('#street').val()).attr('readonly', true);
            $('#p_zipcode').val($('#zipcode').val()).attr('readonly', true);
            $('#p_region').val($('#region').val());
            // $('#p_province').val($('#province').val());
            // $('#p_barangay').val($('#barangay').val()).attr('readonly', true);
            // $('#p_city').val($('#city').val()).attr('readonly', true);
            $('#p_province').append('<option selected value="'+ $('#province').val() +'">'+ $('#province').val() +'</option>');
            $('#p_city').append('<option selected value="'+ $('#city').val() +'">'+ $('#city').val() +'</option>');
            $('#p_barangay').append('<option selected value="'+ $('#barangay').val() +'">'+ $('#barangay').val() +'</option>');
        }else{
            $('#p_house_number').val("").attr('readonly', false);
            $('#p_street').val("").attr('readonly', false);
            $('#p_barangay').val("").attr('readonly', false);
            $('#p_city').val("").attr('readonly', false);
            $('#p_zipcode').val("").attr('readonly', false);
            $('#p_province').val("").attr("disabled", false);
        }
    });
    if($('#sameAddress').is(":checked")){
        $('#p_house_number').attr('readonly', true);
        $('#p_street').attr('readonly', true);
        $('#p_barangay').attr('readonly', true);
        $('#p_city').attr('readonly', true);
        $('#p_zipcode').attr('readonly', true);
        $('#p_province').val($('#province').val());
    }else{
        $('#p_house_number').attr('readonly', false);
        $('#p_street').attr('readonly', false);
        $('#p_barangay').attr('readonly', false);
        $('#p_city').attr('readonly', false);
        $('#p_zipcode').attr('readonly', false);
        $('#p_province').attr("disabled", false);
    }
    $('#select_source_of_income').on('change', function() {
            $('.div-others-income').show();
            $('#source_of_income').val("");
        if(this.value == 'others'){
            $('.income-label').text('Specify source of income');
        }else if(this.value == 'salary'){
            $('.income-label').text('Provide Company Name');
        }else{
            $('.income-label').text('Provide Business Name');
        }
    });

    if($('#select_source_of_income').val()){
        if($('#select_source_of_income').val() == 'others'){
            $('.income-label').text('Provide Business Name');
        }else if($('#select_source_of_income').val() == 'salary'){
            $('.income-label').text('Provide Company Name');
        }else{
            $('.income-label').text('Specify source of income');
        }
    }

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

    var PHL = '';
    var REGION, P_REGION  = '';
    var PROVINCE, P_PROVINCE = '';
    var CITY, P_CITY = '';
    $.getJSON('/ph_address.json', function(data) {
        console.log(data);
        PHL = data;
        $("#region, #p_region").html('<option disabled selected value="">-- Select Region --</option>');
        $.each(data, function(key, value) {
            $("#region, #p_region").append('<option value="' + key + '">' + value.region_name + '</option>');
        }); // close each()
    }); // close getJSON()

    $('#region').change(() => {
        let region = $('#region').find(':selected').val();
        REGION = region;
        // alert(region);
        console.log(PHL[region].province_list);
        $("#province, #city").html('');
        $("#province").html('<option disabled selected value="">-- Select Province --</option>');
        $("#city").html('<option disabled selected value="">-- Select City --</option>');
        $.each(PHL[region].province_list, function(key, value) {
            $("#province").append('<option value="' + key + '">' + key + '</option>');
        });
    });

    $('#province').change(() => {
        let province = $('#province').find(':selected').val();
        PROVINCE = province;
        let cities = PHL[REGION].province_list[province].municipality_list;
        console.log(cities);
        $("#city").html('');
        $("#city").html('<option disabled selected value="">-- Select City --</option>');
        $.each(cities, function(key, value) {
            $("#city").append('<option value="' + key + '">' + key + '</option>');
        });
    });

    $('#city').change(() => {
        let city = $('#city').find(':selected').val();
        let brgy = PHL[REGION].province_list[PROVINCE].municipality_list[city].barangay_list;
        CITY = city;
        console.log('brgy');
        console.log(brgy);
        $("#barangay").html('');
        $("#barangay").html('<option disabled selected value="">-- Select Barangay --</option>');
        $.each(brgy, function(key, value) {
            $("#barangay").append('<option value="' + value + '">' + value + '</option>');
        });
    });



    $('#p_region').change(() => {
        let region = $('#p_region').find(':selected').val();
        P_REGION = region;
        $("#p_province, #p_city").html('');
        $("#p_province").html('<option disabled selected value="">-- Select Province --</option>');
        $("#p_city").html('<option disabled selected value="">-- Select City --</option>');
        $.each(PHL[region].province_list, function(key, value) {
            $("#p_province").append('<option value="' + key + '">' + key + '</option>');
        });
    });

    $('#p_province').change(() => {
        let province = $('#p_province').find(':selected').val();
        P_PROVINCE = province;
        let cities = PHL[P_REGION].province_list[province].municipality_list;
        $("#p_city").html('');
        $("#p_city").html('<option disabled selected value="">-- Select City --</option>');
        $.each(cities, function(key, value) {
            $("#p_city").append('<option value="' + key + '">' + key + '</option>');
        });
    });


    $('#p_city').change(() => {
        let city = $('#p_city').find(':selected').val();
        let brgy = PHL[P_REGION].province_list[P_PROVINCE].municipality_list[city].barangay_list;
        P_CITY = city;
        $("#p_barangay").html('');
        $("#p_barangay").html('<option disabled selected value="">-- Select Barangay --</option>');
        $.each(brgy, function(key, value) {
            $("#p_barangay").append('<option value="' + value + '">' + value + '</option>');
        });
    });

});
</script>
</html>

