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
        select {
        width: calc(100% - 0);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
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
                            <li class="breadcrumb-item"><a href="#!">Report</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#!">Invoice List</a></li> --}}
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
                <form action="{{ url('report')}}" method="GET">

                    @csrf
                    <nav class="navbar m-b-30 p-10">
                        <ul class="nav">
                            <li class="nav-item f-text active">
                                <a class="nav-link text-secondary" href="#!">Filter: <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="region">
                                        <option selected>Choose Branch / Region</option>
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
                            </li>
                            <li class="nav-item dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="rank">
                                            <option selected>Choose Rank</option>
                                            @foreach ($rankName as $rank)
                                                <option value="{{$rank -> rank_of_retirement}}">{{$rank -> rank_of_retirement}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('branch'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="gender">
                                            <option selected>Choose Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <span class="text-danger">@error('branch'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="service_id">
                                            <option selected>Choose Service id</option>
                                            @foreach ($serviceId as $id)
                                                <option value="{{$id -> prison_svc_no}}">{{$id -> prison_svc_no}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('branch'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="nav-item nav-grid f-view">
                            <button class="btn" type="submit" style="background-color: #a52a2acc;color: #fff">
                                Filter
                            </button>
                        </div>
                    </nav>
                </form>
                <div class="row">
                    <!-- subscribe start -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Officers List </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="report-table" class="table table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>REG ID</th>
                                                <th>Name</th>
                                                <th>Number</th>
                                                <th>Email</th>
                                                <th>Gov't Pension No</th>
                                                <th>Sex</th>
                                                <th>Prison SVC No</th>
                                                <th>Residential Address</th>
                                                <th>Status</th>
                                                {{-- <th>Options</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($query as $query)
                                                <tr>
                                                    <td>{{ $query -> id}}</td>
                                                    <td>{{ $query -> full_name}}</td>
                                                    <td>{{ $query -> telephone}}</td>
                                                    <td>{{ $query -> email}}</td>
                                                    <td>{{ $query -> govt_pension_no}}</td>
                                                    <td>{{ $query -> sex}}</td>
                                                    <td>{{ $query -> prison_svc_no}}</td>
                                                    <td>{{ $query -> residential_address}}</td>
                                                    @if ($query -> status == "Submitted")
                                                        <td style="text-align: center"><span style="background-color: #008B9C;color:#fff;padding:8px;border-radius:50px;font-size:12px;text-align:center">{{ $query -> status}}</span></td>
                                                    @elseif ($query -> status == "Pending")
                                                        <td style="text-align: center"><span style="background-color: #fcf04e;color:#000;padding:8px;border-radius:50px;font-size:12px;text-align:center">{{ $query -> status}}</span></td>
                                                    @elseif ($query -> status == "Approved")
                                                    <td style="text-align: center"><span style="background-color: #45c739;color:#fff;padding:8px;border-radius:50px;font-size:12px;text-align:center">{{ $query -> status}}</span></td>
                                                    @endif
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- subscribe end -->
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
    {{-- <script src="../assets/js/plugins/bootstrap.min.js"></script> --}}
    <script src="../assets/js/ripple.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

    <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../assets/js/plugins/dataTables.bootstrap4.min.js"></script>

<!-- invoice-list js -->
{{-- <script src="../assets/js/pages/invoice-list.js"></script> --}}

<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>

@endsection
