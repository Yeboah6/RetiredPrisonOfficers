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
                                        @foreach ($regions as $region)
                                                <option value="{{$region -> region}}">{{$region -> region}}</option>
                                            @endforeach
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
                            {{-- <li class="nav-item dropdown">
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
                            </li> --}}
                            <li class="nav-item dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="year">
                                            <option selected>Year of Retirement</option>
                                            @foreach ($getYear as $year) {
                                                <option value="{{$year -> date_of_retirement}}">{{$year -> date_of_retirement}}</option>
                                                }
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('year'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="age">
                                            <option selected>Choose Age Range</option>
                                            <option value="60">60 - 70</option>
                                            <option value="70">70 - 80</option>
                                            <option value="80">80 - 90</option>
                                            <option value="90">90 - 100 </option>
                                        </select>
                                        <span class="text-danger">@error('age'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="stat">
                                            <option selected>Status</option>
                                            <option value="Deceased">Deceased</option>
                                            <option value="Alive">Alive</option>
                                        </select>
                                        <span class="text-danger">@error('stat'){{ $message }} @enderror</span>
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
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success" style="text-align: center;">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger" style="text-align: center;">{{ Session::get('fail') }}</div>
                            @endif
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-12 invoice-btn-group text-right">
                                <button type="button" style="background-color: #a52a2acc;color: #fff" class="btn btn-print-invoice m-b-10">Print</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>REG ID</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Status</th>
                                        <th>Gov't Pension No</th>
                                        <th>Gender</th>
                                        <th>Prison SVC No</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach ($query as $officer)
                                        <tr>
                                        <td>{{ $officer -> reg_id}}</td>
                                        <td>{{ $officer -> full_name}}</td>
                                        <td>{{ $officer -> telephone}}</td>
                                        <td>{{ $officer -> stat}}</td>
                                        <td>{{ $officer -> govt_pension_no}}</td>
                                        <td>{{ $officer -> sex}}</td>
                                        <td>{{ $officer -> prison_svc_no}}</td>
                                        <td>
                                            <a href="{{ url ('/view/'.$officer -> id)}}" class="btn btn-warning btn-sm">View</a>
                                            <a href="{{ url ('/edit-personal-info/'.$officer -> id)}}" class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ url ('/approve/'.$officer -> id)}}" class="btn btn-success btn-sm">Approve</a>
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
        function printData() {
            // Select the content to print
            var divToPrint = document.getElementById("report-table");
            var clonedTable = divToPrint.cloneNode(true);
    
            // Remove the "Options" column from the cloned table
            var headers = clonedTable.querySelectorAll("thead tr th");
            var rows = clonedTable.querySelectorAll("tbody tr");
    
            headers[headers.length - 1].remove(); // Remove the last header (Options)
    
            rows.forEach(row => {
                row.querySelectorAll("td")[headers.length - 1].remove(); // Remove the last cell in each row
            });
    
            // Open a new window for the print preview
            var newWin = window.open("");
    
            // Add print-specific styles
            var styles = `
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }
                    h5 {
                        font-size: 1.2rem;
                        margin: 5px 0;
                        text-align: center;
                    }
                    .btn, .breadcrumb, .page-header, .page-block {
                        display: none; /* Hide buttons and breadcrumbs */
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                    @media print {
                        .btn, .breadcrumb, .page-header, .page-block {
                            display: none;
                        }
                    }
                </style>
            `;
    
            // Write the content and styles to the new window
            newWin.document.write(`
                <html>
                <head>
                    <title>Report Details</title>
                    ${styles}
                </head>
                <body>
                    ${clonedTable.outerHTML}
                </body>
                </html>
            `);
    
            // Ensure all resources are loaded before printing
            newWin.document.close();
            newWin.onload = function() {
                newWin.print();
                newWin.close();
            };
        }
    
        // Event listener for the print button
        document.querySelector('.btn-print-invoice').addEventListener('click', printData);
    </script>
    
    
    
    <script>
        // DataTable start
        $('#report-table').DataTable();
        // DataTable end
    </script>

    <script>
        document.getElementById('generateReport').addEventListener('click', function () {
            window.location.href = "{{ route('quarterly.report') }}";
        });
    </script>

@endsection
