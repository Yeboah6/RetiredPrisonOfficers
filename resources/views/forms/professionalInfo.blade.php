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
                                <label for="region">Branch / Region <span>*</span></label>
                                <select name="region" id="region" class="form-control"  style="background-color: #fff;">
                                    <option selected> -- Choose Branch / Region -- </option>
                                    @foreach ($region as $regionItem)
                                        <option value="{{ $regionItem->region }}">{{ $regionItem->region }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('region'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">District <span>*</span></label>
                                <select name="district" id="district" class="form-control"  style="background-color: #fff;">
                                    <option selected> -- Choose District -- </option>
                                </select>
                                <span class="text-danger">@error('district'){{ $message }} @enderror</span>
                            </div>
                        </div>
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