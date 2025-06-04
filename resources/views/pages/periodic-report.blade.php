@extends('layouts.app')

@section('content')
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	@include('includes.sidenav')
	@include('includes.header')	

    <style>
        input[type='number'],
        select {
        width: calc(100% - 0);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

     .btn-invoice {
        background-color: #a52a2acc;
        color: #fff; 
        margin-left: 1000px;
     }

    @media screen and (max-width: 1850px) {
        .btn-invoice {
            margin-top: -50px;
            margin-left: 900px;
        }
    }

    </style>
	
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Periodic Report</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Invoice-left ] end -->
            <!-- [ Invoice-right ] start -->
            <div class="col-lg-12 filter-bar invoice-list">
                
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row text-center">
                            <form id="reportForm">
                            <ul class="nav">
                                <li class="nav-item dropdown">
                                    <div class="col-md-6">
                                        <label>Year:</label>
                                        <input type="number" name="year" value="{{ date('Y') }}" required>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <div class="col-md-6">
                                        <label>Quarter:</label>
                                        <select name="quarter">
                                            <option value="">Full Year</option>
                                            <option value="1">Q1 (Jan-Mar)</option>
                                            <option value="2">Q2 (Apr-Jun)</option>
                                            <option value="3">Q3 (Jul-Sep)</option>
                                            <option value="4">Q4 (Oct-Dec)</option>
                                        </select>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <div class="col-md-6">
                                        <label>Status:</label>
                                        <select name="stat">
                                            <option selected value="all">All</option>
                                            <option value="Deceased">Deceased</option>
                                            <option value="Alive">Alive</option>
                                            <!-- Add other districts dynamically -->
                                        </select>
                                    </div>
                                </li>
                                <button type="submit" class="btn btn-invoice m-b-10">Generate Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Invoice-right ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>

    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>

    <script>
        document.getElementById('reportForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const queryString = new URLSearchParams(formData).toString();
            window.location.href = "/generate-quarterly-report?" + queryString;
        });
    </script>

@endsection
