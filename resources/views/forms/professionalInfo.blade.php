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

    legend {
        font-size: 18px;
        color: white;
        background-color: #a52a2acc;
        padding: 5px 10px;
        border-radius: 4px;
        text-align: center;
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

            <form action="{{url('/professional-info')}}" method="POST">
                @if (Session::has('success'))
				    	<div class="alert alert-success" style="text-align: center;">{{ Session::get('success') }}</div>
				    @endif
				    @if (Session::has('fail'))
				    	<div class="alert alert-danger" style="text-align: center;">{{ Session::get('fail') }}</div>
				    @endif

                @csrf

                <fieldset id="personal">
                    <input type="text" name="personal_id" hidden value = "{{ $personal_id }}">

                    <legend>Professional Information</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Date of Enlistment <span>*</span></label>
                                <input type="date" name="date_of_enlistment" required placeholder="Enter Date of Enlistment" min="1990-06-02" max="2001-06-08">
                                <span class="text-danger">@error('date_of_enlistment'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Date of Retirement <span>*</span></label>
                                <input type="date" name="date_of_retirement" required placeholder="Enter Date of Retirement">
                                <span class="text-danger">@error('date_of_retirement'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Rank Of Retirement <span>*</span></label>
                        <input type="text" name="rank_of_retirement" required placeholder="Enter Rank Of Retirement">
                        <span class="text-danger">@error('rank_of_retirement'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Station Retired <span>*</span></label>
                                <input type="text" name="station_retired" required placeholder="Enter Station Retired">
                                <span class="text-danger">@error('station_retired'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Branch / Region <span>*</span></label>
                                <select name="branch">
                                    <option selected> -- Choose Branch / Region -- </option>
                                    <option value="Upper West">Upper West</option>
                                        <option value="Savannah">Savannah</option>
                                        <option value="Bono East">Bono East</option>
                                        <option value="Bono">Bono</option>
                                        <option value="Ahafo">Ahafo</option>
                                        <option value="Kumasi">Ashanti</option>
                                        <option value="Western">Western</option>
                                        <option value="Western North">Western North</option>
                                        <option value="Upper East">Upper East</option>
                                        <option value="North East">North East</option>
                                        <option value="Northern">Northern</option>
                                        <option value="Oti">Oti</option>
                                        <option value="Volta">Volta</option>
                                        <option value="Eastern">Eastern</option>
                                        <option value="Accra">Greater Accra</option>
                                        <option value="Central">Central</option>
                                </select>
                                <span class="text-danger">@error('branch'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Where To Attend Meeting <span>*</span></label>
                        <input type="text" name="where_to_attend_meeting" required placeholder="Enter Where To Attend Meeting">
                        <span class="text-danger">@error('where_to_attend_meeting'){{ $message }} @enderror</span>
                    </div>
                </fieldset>
                <div class="card-footer text-right">
                    <a href="/personal-info"><button type="button" class="btn" style="background-color: #a52a2acc;color: #fff">Back</button></a>
                    <button type="submit" style="background-color: #a52a2acc;color: #fff" class="btn">Save</button>
                    <a href="/others"><button type="button" class="btn" style="background-color: #a52a2acc;color: #fff">Next</button></a>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
{{-- </div> --}}

@endsection