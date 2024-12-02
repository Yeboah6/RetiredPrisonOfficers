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

    <div class="pcoded-main-container">
        <div class="pcoded-content">
  
    <div class="row" style="margin-top: -110px;">
        <div class="col-md-6 offset-md-3">
            <h2 class="form-title">Registration Form</h2>

            <form action="{{url('/edit-others/'.$editOther -> id)}}" method="POST">
                @if (Session::has('success'))
				    	<div class="alert alert-success" style="text-align: center;">{{ Session::get('success') }}</div>
				    @endif
				    @if (Session::has('fail'))
				    	<div class="alert alert-danger" style="text-align: center;">{{ Session::get('fail') }}</div>
				    @endif

                @csrf

                <fieldset id="personal">
                    <input type="text" name="personal_id" hidden value="{{ $editOther -> personal_id}}">

                    <legend>Other Information</legend>

                    <div class="form-group">
                        <label for="full-name">Present Occupation (If any) <span></span></label>
                        <input type="text" name="present_occupation" placeholder="Enter Present Occupation (If any)" value="{{ $editOther -> present_occupation}}">
                        <span class="text-danger">@error('present_occupation'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Next Of Kin <span>*</span></label>
                        <input type="text" name="next_of_kin" required placeholder="Enter Next Of Kin" value="{{ $editOther -> next_of_kin}}">
                        <span class="text-danger">@error('next_of_kin'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Member Signature <span>*</span></label>
                        <input type="text" name="member_signature" required placeholder="Enter Full Name as Signature" value="{{ $editOther -> member_signature}}">
                        <span class="text-danger">@error('member_signature'){{ $message }} @enderror</span>
                    </div>
                </fieldset>

                <div class="card-footer text-right">
                    <a href="{{url ('/edit-professional-info/'.$editOther -> id) }}"><button type="button" class="btn" style="background-color: #a52a2acc;color: #fff">Back</button></a>
                    <button type="submit" style="background-color: #a52a2acc;color: #fff" class="btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

@endsection