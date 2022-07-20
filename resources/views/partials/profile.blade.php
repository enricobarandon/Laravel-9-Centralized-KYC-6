<div class="{{ in_array($userInfo->status, ['pending','disapproved']) ? 'col-md-12' : 'col-md-8' }}">
    <div class="card card-widget widget-user shadow-lg">

        <div class="widget-user-header text-white" style="background: url('/dist/img/bg2.jpg') center center;">
            <h3 class="widget-user-username text-right">{{ strtoupper($userInfo->first_name .' '. $userInfo->last_name) }}</h3>
            <h5 class="widget-user-desc text-right">{{ strtoupper($userInfo->status) }} ACCOUNT</h5>
        </div>
        <div class="widget-user-image">
            
            <img class="img-circle" src="/img/id_picture_selfie/{{ $userDetails->selfie_with_id }}" alt="User Avatar">

        </div>
        <div class="card-footer">
            <div class="row">

                <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userInfo->contact) ? $userInfo->contact : '--' }}</h5>
                        <span class="description-text text-muted">Contact</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="description-block">
                        <h5 class="description-header">{{ $userInfo->username }}</h5>
                        <span class="description-text text-muted">Username</span>
                    </div>
                </div>

            </div>

            <hr>
            
            <div class="row">

                <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userDetails->place_of_birth) ? $userDetails->place_of_birth : '--' }}</h5>
                        <span class="description-text text-muted">Place of Birth</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userDetails->date_of_birth) ? date("M. d, Y",strtotime($userDetails->date_of_birth)) : '--' }}</h5>
                        <span class="description-text text-muted">Date of Birth</span>
                    </div>
                </div>

            </div>

            <hr>
            
            <div class="row">

                <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <h5 class="description-header">
                        @php
                        $presentAddress = '';
                            if(isset($userDetails->present_address)){
                                $address = json_decode($userDetails->present_address,true);

                                $presentAddress = $address['house_number'] . " " . $address['street'] . " " . $address['barangay'] . " " . $address['city'] . " " . $address['province'] . " " . $address['zipcode'];
                            }else{
                                $presentAddress = '--';  
                            }
                        @endphp
                        {{ $presentAddress }}
                        </h5>
                        <span class="description-text text-muted">Present Address</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="description-block">
                        <h5 class="description-header">
                        @php
                        $permanentAddress = '';
                            if(isset($userDetails->permanent_address)){
                                $address = json_decode($userDetails->permanent_address,true);

                                $permanentAddress = $address['house_number'] . " " . $address['street'] . " " . $address['barangay'] . " " . $address['city'] . " " . $address['province'] . " " . $address['zipcode'];
                            }else{
                                $permanentAddress = '--';  
                            }
                        @endphp
                        {{ $permanentAddress }}
                        </h5>
                        <span class="description-text text-muted">Permanent Address</span>
                    </div>
                </div>

            </div>
            
            <hr>
            
            <div class="row">

                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userDetails->nationality) ? $userDetails->nationality : '--' }}</h5>
                        <span class="description-text text-muted">Nationality</span>
                    </div>
                </div>

                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userDetails->country) ? $userDetails->country : '--' }}</h5>
                        <span class="description-text text-muted">Country</span>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userDetails->occupation) ? $userDetails->occupation : '--' }}</h5>
                        <span class="description-text text-muted">Occupation</span>
                    </div>
                </div>

            </div>

            <hr>
            
            <div class="row">

                <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <h5 class="description-header">
                            @php
                            $source_income = '';
                                if(isset($userDetails->source_of_income)){
                                    $income = json_decode($userDetails->source_of_income,true);
                                    if(json_last_error() === JSON_ERROR_NONE){
                                        $source_income = $income['select_source_of_income'] . ": " . $income['source_of_income'];
                                    }else{
                                        $source_income = $userDetails->source_of_income;
                                    }
                                }else{
                                    $source_income = '--';  
                                }
                            @endphp
                            {{ $source_income }}</h5>
                        <span class="description-text text-muted">Source of Income</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($userDetails->facebook) ? $userDetails->facebook : '--' }}</h5>
                        <span class="description-text text-muted">Facebook</span>
                    </div>
                </div>

            </div>

            <hr>

        </div>
    </div>
</div>