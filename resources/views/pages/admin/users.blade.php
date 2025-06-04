@extends('layouts.app')

@section('content')

@include('includes.header')

@include('includes.sidenav')

<style>

.link-bttn {
    background-color: #a52a2acc;
    color: #fff;
    width:70px;
    margin-left:1550px;
}

@media screen and (max-width: 1850px) {
    .link-bttn { 
        margin-left:930px;
    }
}

</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">User</a></li>
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
                        <h5>User </h5>
                        <a class="btn link-bttn" href="/super-admin/add-users">Add</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- <div class="col-sm-6">
                            </div> --}}
                            @if (Session::has('success'))
                                <div class="alert alert-success" style="text-align: center;">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger" style="text-align: center;">{{ Session::get('fail') }}</div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        {{-- <th>User</th> --}}
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Region</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach ($users as $user)
                                        <tr>
                                        <td>{{ $user -> id}}</td>
                                        <td>{{ $user -> email}}</td>
                                        @if ($user -> role == 'super_admin')
                                            <td>Super Admin</td>
                                        @else
                                            <td>Admin</td>
                                        @endif
                                        <td>{{ $user -> region}}</td>
                                        @if ($user -> status == 'active')
                                            <td style="text-align:center;"><span class="badge bg-success" >{{ $user -> status}}</span></td>
                                        @else
                                            <td style="text-align:center;"><span class="badge bg-danger" >{{ $user -> status}}</span></td>
                                        @endif
                                        
                                        <td>
                                            {{-- <a href="{{ url ('/edit-region/'.$region -> id)}}" class="btn btn-info btn-sm">Edit</a> --}}
                                            {{-- <a href="{{ url ('/delete-region/'.$region -> id)}}" class="btn btn-danger btn-sm">Delete</a> --}}
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

<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>

<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>


@endsection
