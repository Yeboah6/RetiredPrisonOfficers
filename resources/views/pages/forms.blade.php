@extends('layouts.app')

@section('content')

@include('includes.sidenav')
	
@include('includes.header')

<style>

.form-title {
        background-color: #461d1dcc;
        color: white;
        padding: 10px;
        border-radius: 4px;
        margin: 20px 0;
        text-align: center;
    }

 fieldset {
        border: 1px solid #867e7e;
        padding: 20px;
        border-radius: 4px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    input[type="text"],
    input[type="date"], 
    input[type="email"],
    input[type="file"],
    input[type='month'],
    textarea,
    select {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
    }
    
    input[type="radio"] {
        margin-right: 5px;
    }
    
    label span {
        color: #d93025;
    }

    .fieldset {
        border: 1px solid #ffffff;
        /* background-color: #005687; */
        width: 240px;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
        color: #000000;
        font-weight: bold
    }

    .fieldset-containter {
        position: absolute;
        left: 50px;
        top: 130px;
        /* left: 50px; */
        /* padding: 10px; */
        /* margin: 10px; */

    }

</style>

{{-- <div class="container"> --}}

    <div class="pcoded-main-container">
        <div class="pcoded-content">
  
    <div class="row" style="margin-top: -110px;">
        <div class="col-md-6 offset-md-3">
            <h2 class="form-title">Registration Form</h2>

            <form action="{{url('/forms')}}" method="POST">
                @if (Session::has('success'))
				    	<div class="alert alert-success">{{ Session::get('success') }}</div>
				    @endif
				    @if (Session::has('fail'))
				    	<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				    @endif

                @csrf

                <fieldset id="personal">
                    <input type="text" name="reg_id" hidden>
                    <div class="form-group">
                        <label for="first-name">Full Name <span>*</span></label>
                            <input type="text" name="full_name" placeholder="Enter Full Name"  required>
                        <span class="text-danger">@error('full_name'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="middle-name">Gov't Pension No: <span>*</span></label>
                                <input type="text" name="govt_pension_no" placeholder="Enter Gov't Pension No">
                                <span class="text-danger">@error('govt_pension_no'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last-name">Prison SVC. No: <span>*</span></label>
                                <input type="text" name="prison_svc_no" required placeholder="Enter Prison SVC. No">
                                <span class="text-danger">@error('prison_svc_no'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Residential Address <span>*</span></label>
                        <input type="text" name="residential_address" required placeholder="Enter Residential Address">
                        <span class="text-danger">@error('residential_address'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="nationality">Postal Address <span>*</span></label>
                        <input type="text" name="postal_address" required placeholder="Enter Postal Address">
                        <span class="text-danger">@error('postal_address'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Telephone <span>*</span></label>
                        <input type="text" name="telephone" required placeholder="Enter Telephone">
                        <span class="text-danger">@error('telephone'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Ghana Card No <span>*</span></label>
                        <input type="text" name="ghana_card_no" required placeholder="Enter Ghana Card No">
                        <span class="text-danger">@error('ghana_card_no'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sex <span>*</span></label>
                                <select name="sex">
                                    <option selected> -- Choose Sex -- </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="text-danger">@error('sex'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Present Age <span>*</span></label>
                                <input type="text" name="present_age" placeholder="Enter Present Age">
                                <span class="text-danger">@error('present_age'){{ $message }} @enderror</span>
                            </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <label for="full-name">Date of Enlistment <span>*</span></label>
                        <input type="date" name="date_of_enlistment" required placeholder="Enter Date of Enlistment">
                        <span class="text-danger">@error('date_of_enlistment'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Date of Retirement <span>*</span></label>
                        <input type="date" name="date_of_retirement" required placeholder="Enter Date of Retirement">
                        <span class="text-danger">@error('date_of_retirement'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Rank Of Retirement <span>*</span></label>
                        <input type="text" name="rank_of_retirement" required placeholder="Enter Rank Of Retirement">
                        <span class="text-danger">@error('rank_of_retirement'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Station Retired <span>*</span></label>
                        <input type="text" name="station_retired" required placeholder="Enter Station Retired">
                        <span class="text-danger">@error('station_retired'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Where To Attend Meeting <span>*</span></label>
                        <input type="text" name="where_to_attend_meeting" required placeholder="Enter Where To Attend Meeting">
                        <span class="text-danger">@error('where_to_attend_meeting'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Hometown <span>*</span></label>
                        <input type="text" name="hometown" required placeholder="Enter HomeTown">
                        <span class="text-danger">@error('hometown'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Present Place Of Residence <span>*</span></label>
                        <input type="text" name="present_place_of_residence" required placeholder="Enter Present Place Of Residence">
                        <span class="text-danger">@error('present_place_of_residence'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Present Occupation (If any) <span></span></label>
                        <input type="text" name="present_occupation" required placeholder="Enter Present Occupation (If any)">
                        <span class="text-danger">@error('present_occupation'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Marital Status <span>*</span></label>
                        <input type="text" name="marital_status" required placeholder="Enter Marital Status">
                        <span class="text-danger">@error('marital_status'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Next Of Kin <span>*</span></label>
                        <input type="text" name="next_of_kin" required placeholder="Enter Next Of Kin">
                        <span class="text-danger">@error('next_of_kin'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Member Signature <span>*</span></label>
                        <input type="text" name="member_signature" required placeholder="Enter Member Signature">
                        <span class="text-danger">@error('member_signature'){{ $message }} @enderror</span>
                    </div>
                </fieldset>

                <div class="card-footer text-right">
                    <button type="submit" style="background-color: #a52a2acc;color: #fff" class="btn">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
{{-- </div> --}}

@endsection