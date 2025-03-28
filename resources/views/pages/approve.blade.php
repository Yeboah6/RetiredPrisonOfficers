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
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 4px;
    }
 legend {
        font-size: 18px;
        color: white;
        background-color: #51B3E4;
        padding: 5px 10px;
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

            <div class="card-footer text-left">
                <button onclick="history.back()" style="background-color: #a52a2a;color: #fff" class="btn">Back</button>
            </div>

            @foreach ($approveOfficer as $approveOfficer)

            <form action="{{url('/approve/'.$approveOfficer -> id)}}" method="POST">
                @if (Session::has('success'))
				    	<div class="alert alert-success">{{ Session::get('success') }}</div>
				    @endif
				    @if (Session::has('fail'))
				    	<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				    @endif

                @csrf

                <fieldset id="personal">
                    <input type="text" name="reg_id" hidden value="{{ $approveOfficer -> reg_id}}">

<label style="text-align:center;color:red;">Personal Information</label>
<hr>

                    <div class="form-group">
                        <label for="first-name">Full Name <span>*</span></label>
                            <input type="text" name="full_name" placeholder="Enter Full Name" value="{{ $approveOfficer -> full_name}}">
                        <span class="text-danger">@error('full_name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="first-name">Upload Picture @if(!$approveOfficer->image)<span>*</span>@endif</label>
                        <input type="file" 
                               name="image" 
                               @if(!$approveOfficer->image) required @endif 
                               @if($approveOfficer->image) value="{{ 'uploads/Officer-images/' . $approveOfficer->image }}" @endif>
                        <br><br>
                        @if($approveOfficer && $approveOfficer->image)
                            <!-- Show the preview of the uploaded image -->
                            <img src="{{ asset('uploads/Officer-images/' . $approveOfficer->image) }}" 
                                 style="width:30%; border-radius: 80px;" 
                                 alt="Officer Image">
                            <p class="text-muted small">Current image will be kept if no new image is uploaded</p>
                        @endif
                        <span class="text-danger">@error('image'){{ $message }}@enderror</span>
                    </div>
                    {{-- <div class="form-group">
                        <label for="first-name">Upload Picture <span>*</span></label>
                            <input type="file" name="image" required value="{{'uploads/Officer-images/' . $approveOfficer -> image}}">
                            <br><br>
                        @if($approveOfficer && $approveOfficer -> image)
                            <!-- Show the preview of the uploaded image -->
                            <img src="{{ asset('uploads/Officer-images/' . $approveOfficer -> image) }}" style="width:30%;border-radius: 80px;"  alt="Officer Image">
                        @endif
                        <span class="text-danger">@error('image'){{ $message }} @enderror</span>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="middle-name">Gov't Pension No: <span>*</span></label>
                                <input type="text" name="govt_pension_no" placeholder="Enter Gov't Pension No" value="{{ $approveOfficer -> govt_pension_no}}">
                                <span class="text-danger">@error('govt_pension_no'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last-name">Prison SVC. No: <span>*</span></label>
                                <input type="text" name="prison_svc_no" required placeholder="Enter Prison SVC. No" value="{{ $approveOfficer -> prison_svc_no}}">
                                <span class="text-danger">@error('prison_svc_no'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Residential Address <span>*</span></label>
                        <input type="text" name="residential_address" required placeholder="Enter Residential Address" value="{{ $approveOfficer -> residential_address}}">
                        <span class="text-danger">@error('residential_address'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Postal Address <span>*</span></label>
                                <input type="text" name="postal_address" required placeholder="Enter Postal Address" value="{{ $approveOfficer -> postal_address}}">
                                <span class="text-danger">@error('postal_address'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Marital Status  <span>*</span></label>
                                <select name="marital_status">
                                    <option selected> {{ $approveOfficer -> marital_status}} </option>
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
                                <input type="text" name="telephone" required placeholder="Enter Telephone" value="{{ $approveOfficer -> telephone}}">
                                <span class="text-danger">@error('telephone'){{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Email <span>*</span></label>
                                <input type="text" name="email" required placeholder="Enter Email" value="{{ $approveOfficer -> email}}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Ghana Card No <span>*</span></label>
                        <input type="text" name="ghana_card_no" required placeholder="Enter Ghana Card No" value="{{ $approveOfficer -> ghana_card_no}}">
                        <span class="text-danger">@error('ghana_card_no'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sex <span>*</span></label>
                                <select name="sex">
                                    <option selected> {{ $approveOfficer -> sex}} </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="text-danger">@error('sex'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Present Age <span>*</span></label>
                                <input type="text" name="present_age" placeholder="Enter Present Age" value="{{ $approveOfficer -> present_age}}">
                                <span class="text-danger">@error('present_age'){{ $message }} @enderror</span>
                            </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <label for="full-name">Present Place Of Residence <span>*</span></label>
                        <input type="text" name="present_place_of_residence" required placeholder="Enter Present Place Of Residence" value="{{ $approveOfficer -> present_place_of_residence}}">
                        <span class="text-danger">@error('present_place_of_residence'){{ $message }} @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Hometown <span>*</span></label>
                                <input type="text" name="hometown" required placeholder="Enter HomeTown" value="{{ $approveOfficer -> hometown}}">
                                <span class="text-danger">@error('hometown'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <span>*</span></label>
                                <select name="stat">
                                    <option selected> {{ $approveOfficer -> stat}} </option>
                                    <option value="Alive">Alive</option>
                                    <option value="Dead">Dead</option>
                                </select>
                                <span class="text-danger">@error('stat'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

<br>
<hr>
<label style="text-align:center;color:red;">Professional Information</label>
<hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Date of Enlistment <span>*</span></label>
                                <input type="date" name="date_of_enlistment" required placeholder="Enter Date of Enlistment" value="{{ $approveOfficer -> date_of_enlistment}}">
                                <span class="text-danger">@error('date_of_enlistment'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Date of Retirement <span>*</span></label>
                                <input type="date" name="date_of_retirement" required placeholder="Enter Date of Retirement" value="{{ $approveOfficer -> date_of_retirement}}">
                                <span class="text-danger">@error('date_of_retirement'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Rank Of Retirement <span>*</span></label>
                        <input type="text" name="rank_of_retirement" required placeholder="Enter Rank Of Retirement" value="{{ $approveOfficer -> rank_of_retirement}}">
                        <span class="text-danger">@error('rank_of_retirement'){{ $message }} @enderror</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region">Region <span>*</span></label>
                                <select name="region" id="region" class="form-control"  style="background-color: #fff;">
                                    <option selected> {{ $approveOfficer -> region }} </option>
                                    @foreach ($region as $regionItem)
                                        <option value="{{ $regionItem -> region }}">{{ $regionItem -> region }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('region'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">District <span>*</span></label>
                                <select name="district" id="district" class="form-control"  style="background-color: #fff;">
                                    <option selected> {{ $approveOfficer -> district }} </option>
                                </select>
                                <span class="text-danger">@error('district'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Station Retired <span>*</span></label>
                        <input type="text" name="station_retired" required placeholder="Enter Station Retired" value="{{ $approveOfficer -> station_retired}}">
                        <span class="text-danger">@error('station_retired'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Where To Attend Meeting <span>*</span></label>
                        <input type="text" name="where_to_attend_meeting" required placeholder="Enter Where To Attend Meeting" value="{{ $approveOfficer -> where_to_attend_meeting}}">
                        <span class="text-danger">@error('where_to_attend_meeting'){{ $message }} @enderror</span>
                    </div>

<br>
<hr>
<label style="text-align:center;color:red;">Other Information</label>
<hr>
                    <div class="form-group">
                        <label for="full-name">Present Occupation (If any) <span></span></label>
                        <input type="text" name="present_occupation" placeholder="Enter Present Occupation (If any)" value="{{ $approveOfficer -> present_occupation}}">
                        <span class="text-danger">@error('present_occupation'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Next Of Kin <span>*</span></label>
                        <input type="text" name="next_of_kin" required placeholder="Enter Next Of Kin" value="{{ $approveOfficer -> next_of_kin}}">
                        <span class="text-danger">@error('next_of_kin'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Member Signature <span>*</span></label>
                        <input type="text" name="member_signature" required placeholder="Enter Member Signature" value="{{ $approveOfficer -> member_signature}}">
                        <span class="text-danger">@error('member_signature'){{ $message }} @enderror</span>
                    </div>
                    
<br>
<hr>
<label style="text-align:center;color:red;">Official Use</label>
<hr>

                    <input type="text" name="official_id" hidden value="{{ $approveOfficer -> personal_id}}">
                    <div class="form-group">
                        <label for="first-name">Secretary <span>*</span></label>
                            <input type="text" name="secretary" placeholder="Enter Secretary Name"  required value="{{ $approveOfficer -> secretary}}">
                        <span class="text-danger">@error('secretary'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="first-name">Chairman <span>*</span></label>
                            <input type="text" name="chairman" placeholder="Enter Chairman Name"  required value="{{ $approveOfficer -> chairman}}">
                        <span class="text-danger">@error('chairman'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="first-name">Treasury <span>*</span></label>
                            <input type="text" name="treasury" placeholder="Enter Treasury Name"  required value="{{ $approveOfficer -> treasury}}">
                        <span class="text-danger">@error('treasury'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="first-name">REPOAG NO. <span>*</span></label>
                            <input type="text" name="repoag_no" placeholder="Enter REPOAG NO."  required value="{{ $approveOfficer -> repoag_no}}">
                        <span class="text-danger">@error('repoag_no'){{ $message }} @enderror</span>
                    </div>
<br>
<hr>
                    <div class="form-group">
                        <label>Status <span>*</span></label>
                        <select name="status">
                            <option selected> {{ $approveOfficer -> status}} </option>
                            <option value="Submitted">Submitted</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                        </select>
                        <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                    </div>
                </fieldset>
                @endforeach

                <div class="card-footer text-right">
                    <button type="submit" style="background-color: #a52a2acc;color: #fff" class="btn">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<!-- AJAX Script to Fetch Districts Dynamically -->
<div id="loading" style="display: none;">Loading districts...</div>
<div id="error" class="text-danger" style="display: none;"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#region').change(function() {
            var region = $(this).val();
            $('#loading').show();
            $('#error').hide();
            if (region) {
                $.ajax({
                    url: '{{ url("/get-districts") }}/' + region,
                    type: 'GET',
                    success: function(data) {
                        $('#district').empty();
                        $('#district').append('<option selected> -- Choose District -- </option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + value.district + '">' + value.district + '</option>');
                        });
                        $('#loading').hide();
                    },
                    error: function() {
                        $('#loading').hide();
                        $('#error').text('Failed to load districts. Please try again.').show();
                    }
                });
            } else {
                $('#district').empty().append('<option selected> -- Choose District -- </option>');
                $('#loading').hide();
            }
        });
    });
</script>


@endsection