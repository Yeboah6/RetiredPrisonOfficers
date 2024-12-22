

    @extends('layouts.app')

    @section('content')
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	@include('includes.sidenav')
	<!-- [ navigation menu ] end -->
@include('includes.header')
	<!-- [ Header ] end -->


<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">HTML 5 Data DataTable</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Data Table</a></li>
                            <li class="breadcrumb-item"><a href="#!">HTML 5 Data Initialization</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- HTML5 Export Buttons table start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>HTML5 Export Buttons</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr>
                                        <td>Dai Rios</td>
                                        <td>Personnel Lead</td>
                                        <td>Edinburgh</td>
                                        <td>35</td>
                                        <td>2012/09/26</td>
                                        <td>$217,500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- HTML5 Export Buttons end -->
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/ripple.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>
	{{-- <script src="../assets/js/menu-setting.min.js"></script> --}}

<!-- datatable Js -->
{{-- <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/plugins/buttons.colVis.min.js"></script>
<script src="../assets/js/plugins/buttons.print.min.js"></script>
<script src="../assets/js/plugins/pdfmake.min.js"></script>
<script src="../assets/js/plugins/jszip.min.js"></script>
<script src="../assets/js/plugins/dataTables.buttons.min.js"></script>
<script src="../assets/js/plugins/buttons.html5.min.js"></script>
<script src="../assets/js/plugins/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/pages/data-export-custom.js"></script> --}}


@endsection
