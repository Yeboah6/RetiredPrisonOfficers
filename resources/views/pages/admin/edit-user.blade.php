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
        margin-top: 100px;
        width: 900px;
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

    @media screen and (max-width: 1850px) {
        fieldset {
            margin-left: -150px;
            width: 900px;
        }
    }

</style>

    <div class="pcoded-main-container">
        <div class="pcoded-content">
  
    <div class="row" style="margin-top: -110px;">
        <div class="col-md-6 offset-md-3">

            <form action="{{url('super-admin/edit-users/'.$editUser -> id)}}" method="POST">

                @csrf

                <fieldset id="personal">

                    <legend>Edit User</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Name <span>*</span></label>
                                <input type="text" name="name" required placeholder="Enter User Name" value="{{ $editUser -> name}}">
                                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Email <span>*</span></label>
                                <input type="text" name="email" required placeholder="Enter User Email" value="{{ $editUser -> email}}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Current Password Status</label>
                                <div class="alert alert-info">
                                    <i class="fas fa-lock"></i> Password is encrypted and cannot be displayed
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="text" name="password" placeholder="Enter new password (optional)" value="">
                                <small class="text-muted">Leave blank to keep current password</small>
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Region <span>*</span></label>
                                <select name="region">
                                    <option> {{$editUser -> region}} </option>
                                    @foreach ($region as $region)
                                        <option value="{{$region -> region}}"> {{$region -> region}} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('region'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Role <span>*</span></label>
                                <select name="role">
                                    <option value="{{$editUser -> role}}"> {{$editUser -> role}} </option>
                                </select>
                                <span class="text-danger">@error('role'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="full-name">Status <span>*</span></label>
                            <select name="status">
                                <option value="{{$editUser -> status}}">{{$editUser -> status}}</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                        </div>
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

@endsection