@extends('layouts.app')

@section('content')

@include('includes.header')

@include('includes.sidenav')

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Student</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">School</a></li>
                            <li class="breadcrumb-item"><a href="#!">Student</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- subscribe start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Student List </h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>REG ID</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Gov't Pension No</th>
                                        <th>Sex</th>
                                        <th>Prison SVC No</th>
                                        <th>Residential Address</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach ($officers as $officer)
                                        <tr>
                                        <td>{{ $officer -> reg_id}}</td>
                                        <td>{{ $officer -> full_name}}</td>
                                        <td>{{ $officer -> telephone}}</td>
                                        <td>{{ $officer -> govt_pension_no}}</td>
                                        <td>{{ $officer -> sex}}</td>
                                        <td>{{ $officer -> prison_svc_no}}</td>
                                        <td>{{ $officer -> residential_address}}</td>
                                        <td style="text-align: center"><span style="background-color: #008B9C;color:#fff;padding:5px;border-radius:50px;font-size:12px;text-align:center">{{ $officer -> status}}</span></td>
                                        <td>
                                            <a href="{{ url ('/view/'.$officer -> id)}}" class="btn btn-success btn-sm">View</a>
                                            <a href="{{ url ('/edit/'.$officer -> id)}}" class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ url ('/delete/'.$officer -> id)}}" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
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
        <!-- [ Main Content ] end -->
    </div>
</div>

<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>

<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>


@endsection
