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

    legend {
        font-size: 18px;
        color: white;
        background-color: #a52a2acc;
        padding: 5px 10px;
        border-radius: 4px;
        text-align: center;
    } 
    
    label span {
        color: #d93025;
    }

    .fieldset {
        border: 1px solid #ffffff;
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
    }

</style>

    <div class="pcoded-main-container">
        <div class="pcoded-content">
  
    <div class="row" style="margin-top: -110px;">
        <div class="col-md-6 offset-md-3">
            <h2 class="form-title">Registration Form</h2>

            <form action="{{url('/edit-personal-info/'.$editPersonalInfo -> id)}}" method="POST" enctype="multipart/form-data">
                @if (Session::has('success'))
				    	<div class="alert alert-success" style="text-align: center;">{{ Session::get('success') }}</div>
				    @endif
				    @if (Session::has('fail'))
				    	<div class="alert alert-danger" style="text-align: center;">{{ Session::get('fail') }}</div>
				    @endif

                @csrf

                <fieldset id="personal">
                    <input type="text" name="reg_id" hidden>

                    <legend>Personal Information</legend>

                    <div class="form-group">
                        <label for="first-name">Full Name <span>*</span></label>
                            <input type="text" name="full_name" placeholder="Enter Full Name"  required value="{{ $editPersonalInfo -> full_name}}">
                        <span class="text-danger">@error('full_name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="first-name">Upload Picture 
                            @if(!$editPersonalInfo || !$editPersonalInfo->image) 
                                <span>*</span> 
                            @endif
                        </label>
                        <input type="file" name="image" @if(!$editPersonalInfo || !$editPersonalInfo->image) required @endif>
                        <br><br>
                    
                        @if($editPersonalInfo && $editPersonalInfo->image)
                            <!-- Show the preview of the uploaded image -->
                            <img src="{{ asset('uploads/Officer-images/' . $editPersonalInfo->image) }}" 
                                 style="width:30%;border-radius: 80px;"  
                                 alt="Officer Image">
                        @endif
                    
                        <span class="text-danger">@error('image'){{ $message }} @enderror</span>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="middle-name">Gov't Pension No: <span>*</span></label>
                                <input type="text" name="govt_pension_no" placeholder="Enter Gov't Pension No" value="{{ $editPersonalInfo -> govt_pension_no}}">
                                <span class="text-danger">@error('govt_pension_no'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last-name">Prison SVC. No: <span>*</span></label>
                                <input type="text" name="prison_svc_no" required placeholder="Enter Prison SVC. No" value="{{ $editPersonalInfo -> prison_svc_no}}">
                                <span class="text-danger">@error('prison_svc_no'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Residential Address <span>*</span></label>
                        <input type="text" name="residential_address" required placeholder="Enter Residential Address" value="{{ $editPersonalInfo -> residential_address}}">
                        <span class="text-danger">@error('residential_address'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Postal Address <span>*</span></label>
                                <input type="text" name="postal_address" required placeholder="Enter Postal Address" value="{{ $editPersonalInfo -> postal_address}}">
                                <span class="text-danger">@error('postal_address'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Marital Status  <span>*</span></label>
                                <select name="marital_status">
                                    <option selected> {{ $editPersonalInfo -> marital_status}} </option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                                <span class="text-danger">@error('marital_status'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="full-name">Telephone <span>*</span></label>
                            <input type="text" name="telephone" required placeholder="Enter Telephone" value="{{ $editPersonalInfo -> telephone}}">
                            <span class="text-danger">@error('telephone'){{ $message }} @enderror</span>
                        </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Email <span>*</span></label>
                                <input type="text" name="email" required placeholder="Enter Email" value="{{ $editPersonalInfo -> email}}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Ghana Card No <span>*</span></label>
                        <input type="text" name="ghana_card_no" required placeholder="Enter Ghana Card No" value="{{ $editPersonalInfo -> ghana_card_no}}">
                        <span class="text-danger">@error('ghana_card_no'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sex <span>*</span></label>
                                <select name="sex">
                                    <option selected>{{ $editPersonalInfo -> sex }} </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="text-danger">@error('sex'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Present Age <span>*</span></label>
                                <input type="text" name="present_age" placeholder="Enter Present Age" value="{{ $editPersonalInfo -> present_age}}">
                                <span class="text-danger">@error('present_age'){{ $message }} @enderror</span>
                            </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <label for="full-name">Present Place Of Residence <span>*</span></label>
                        <input type="text" name="present_place_of_residence" required placeholder="Enter Present Place Of Residence" value="{{ $editPersonalInfo -> present_place_of_residence}}">
                        <span class="text-danger">@error('present_place_of_residence'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Hometown <span>*</span></label>
                                <input type="text" name="hometown" required placeholder="Enter HomeTown" value="{{ $editPersonalInfo -> hometown}}">
                                <span class="text-danger">@error('hometown'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <span>*</span></label>
                                <select name="stat">
                                    <option selected> {{ $editPersonalInfo -> stat}} </option>
                                    <option value="Alive">Alive</option>
                                    <option value="Deceased">Deceased</option>
                                </select>
                                <span class="text-danger">@error('stat'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    
                </fieldset>
                <div class="card-footer text-right">
                    <button type="submit" style="background-color: #a52a2acc;color: #fff" class="btn">Save</button>
                    <a href="{{url ('/edit-professional-info/'.$editPersonalInfo -> id) }}"><button type="button" class="btn" style="background-color: #a52a2acc;color: #fff">Next</button></a>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

@endsection