@extends('layouts.app')

@section('content')

@include('includes.sidenav')
	
@include('includes.header')
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <br>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- visitors  start -->
            <div class="col-sm-3">
                <div class="card bg-c-green text-white widget-visitor-card" style="background-color:#4680FF;">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ $registered }}</h2>
                        <h6 class="text-white">Submitted</h6>
                        <i class="feather icon-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-c-yellow text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ $pending }}</h2>
                        <h6 class="text-white">Pending</h6>
                        <i class="feather icon-user-minus"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-c-green text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ $approve }}</h2>
                        <h6 class="text-white">Approved</h6>
                        <i class="feather icon-user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-c-red text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ $regions }}</h2>
                        <h6 class="text-white">Registered</h6>
                        <i class="feather icon-map-pin"></i>
                    </div>
                </div>
            </div>
            <!-- progressbar static data end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    

@endsection
