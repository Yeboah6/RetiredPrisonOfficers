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
                            <li class="breadcrumb-item"><a href="#!">User Logs</a></li>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history me-2"></i>User Login Logs
                    </h5>
                    <div class="card-tools">
                        <span class="badge bg-info">Total: {{ $logs->total() }} records</span>
                    </div>
                </div>
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
                        @if($logs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="25%">Name</th>
                                        <th width="25%">Email</th>
                                        <th width="15%">Role</th>
                                        <th width="20%">Login Time</th>
                                        <th width="15%">IP Address</th>
                                        <th width="20%">Browser/Device</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $index => $log)
                                        <tr>
                                            <td>{{ $logs->firstItem() + $index }}</td>
                                            <td>
                                                <strong>{{ $log->name }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $log->email }}</strong>
                                            </td>
                                            <td>
                                                @if($log->role == 'super_admin')
                                                    <span class="badge bg-danger">Super Admin</span>
                                                @elseif($log->role == 'admin')
                                                    <span class="badge bg-warning">Admin</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($log->role) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold">{{ date('M d, Y', strtotime($log->login_time)) }}</span>
                                                    <small class="text-muted">{{ date('h:i A', strtotime($log->login_time)) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <code class="bg-light text-dark p-1 rounded">{{ $log->ip_address }}</code>
                                            </td>
                                            <td>
                                                <div class="user-agent-info">
                                                    @php
                                                        $userAgent = $log->user_agent;
                                                        $browser = 'Unknown';
                                                        $platform = 'Unknown';
                                                        
                                                        // Simple browser detection
                                                        if (strpos($userAgent, 'Chrome') !== false) {
                                                            $browser = 'Chrome';
                                                        } elseif (strpos($userAgent, 'Firefox') !== false) {
                                                            $browser = 'Firefox';
                                                        } elseif (strpos($userAgent, 'Safari') !== false) {
                                                            $browser = 'Safari';
                                                        } elseif (strpos($userAgent, 'Edge') !== false) {
                                                            $browser = 'Edge';
                                                        }
                                                        
                                                        // Simple platform detection
                                                        if (strpos($userAgent, 'Windows') !== false) {
                                                            $platform = 'Windows';
                                                        } elseif (strpos($userAgent, 'Mac') !== false) {
                                                            $platform = 'macOS';
                                                        } elseif (strpos($userAgent, 'Linux') !== false) {
                                                            $platform = 'Linux';
                                                        } elseif (strpos($userAgent, 'Android') !== false) {
                                                            $platform = 'Android';
                                                        } elseif (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
                                                            $platform = 'iOS';
                                                        }
                                                    @endphp
                                                    
                                                    <div class="mb-1">
                                                        <i class="fas fa-globe me-1"></i>
                                                        <strong>{{ $browser }}</strong>
                                                    </div>
                                                    <div class="text-muted small">
                                                        <i class="fas fa-desktop me-1"></i>
                                                        {{ $platform }}
                                                    </div>
                                                    <button class="btn btn-link btn-sm p-0 text-decoration-none mt-1" 
                                                            type="button" 
                                                            data-bs-toggle="collapse" 
                                                            data-bs-target="#agent-{{ $loop->index }}"
                                                            title="View full user agent">
                                                        <small><i class="fas fa-eye me-1"></i>Details</small>
                                                    </button>
                                                    <div class="collapse mt-2" id="agent-{{ $loop->index }}">
                                                        <div class="alert alert-light p-2 mb-0">
                                                            <small class="text-muted">{{ $log->user_agent }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Login Logs Found</h5>
                            <p class="text-muted">There are no user login records to display at this time.</p>
                        </div>
                    @endif
                    </div>
                    @if($logs->count() > 0)
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="text-muted mb-2 mb-md-0">
                                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} results
                            </div>
                            <div>
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                @endif
                </div>
            </div>
            <!-- subscribe end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<!-- [ Main Content ] end -->

@push('styles')
<style>
    .user-agent-info {
        max-width: 200px;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .badge {
        font-size: 0.75em;
        font-weight: 500;
    }
    
    code {
        font-size: 0.85em;
        font-weight: 500;
    }
    
    .btn-link {
        font-size: 0.75em;
        color: #6c757d !important;
        text-decoration: none !important;
    }
    
    .btn-link:hover {
        color: #495057 !important;
    }
    
    .alert-light {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    
    .table-dark th {
        border-color: #454d55;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .user-agent-info {
            max-width: 150px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Optional: Auto-refresh every 30 seconds
        setInterval(function() {
            location.reload();
        }, 3000);
        
        console.log('User logs page loaded - {{ $logs->total() }} total records');
    });
</script>
@endpush

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
