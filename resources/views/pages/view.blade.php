@extends('layouts.app')

@section('content')

@include('includes.header')

@include('includes.sidenav')

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"></a></li><br><br>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row" style=" ">
            <!-- [ Invoice ] start -->
            <div class="container" id="printTable">
                <div>
                    <div class="card container">
                        <div class="row invoice-contact" style=" font-size: 1rem;">
                            <div class="col-md-8">
                                <div class="invoice-box row">
                                    <div class="col-sm-12 printStyles" style="text-align:center;">
                                        <h5>RETIRED PRISON OFFICERS' ASSOCIATION OF GHANA </h5>
                                        <h5>P.O. BOX CT. 10895, CANTONMENTS, ACCRA. </h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex;">
                            <h5><a class="text-secondary" href="repoaghana@gmail.com">repoaghana@gmail.com</a> </h5>
                            <h5 style="margin-left: 10px">03 0393 3865 </h5>
                        </div>
                        <h3 style="text-align:center">{{ $viewOfficer -> reg_id }}</h3>
                        <div class="card-body">
                            <div class="row invoive-info">
                                <div class="col-md-4 col-xs-12 invoice-client-info">
                                    <label for="" style="font-weight: bold; font-size:1rem">Name: </label>
                                    <p class="m-0" style="font-size: 1rem;"> {{ $viewOfficer -> full_name}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Residential Address: </label>
                                    <p class="m-0 m-t-10" style="font-size: 1rem;">{{ $viewOfficer -> residential_address}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Postal Address: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> postal_address}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Telephone: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> telephone}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Ghana Card No.: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> ghana_card_no}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Sex: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> sex}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Present Age: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> present_age}}</p>
                                </div>

                                <div class="col-md-4 col-xs-12 invoice-client-info">
                                    <label for="" style="font-weight: bold; font-size:1rem">Gov't Pension No.: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> govt_pension_no}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Prison SVC No.: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> prison_svc_no}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Date of Enlistment: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> date_of_enlistment}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Date of Retirement: </label>
                                    <p class="m-0 m-t-10" style="font-size: 1rem;">{{ $viewOfficer -> date_of_retirement}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Rank of Retirement: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> rank_of_retirement}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Station Retired: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> station_retired}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Where to Attend Meeting: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> where_to_attend_meeting}}</p>
                                </div>

                                <div class="col-md-4 col-xs-12 invoice-client-info">
                                    <label for="" style="font-weight: bold; font-size:1rem">Hometown: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> hometown}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Present Place of Residence: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> present_place_of_residence}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Present Occupation: </label>
                                    <p class="m-0 m-t-10" style="font-size: 1rem;">{{ $viewOfficer -> present_occupation}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Marital Status: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> marital_status}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Next Of Kin: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> next_of_kin}}</p>
                                    <br>
                                    <label for="" style="font-weight: bold; font-size:1rem">Member Signature: </label>
                                    <p class="m-0" style="font-size: 1rem;">{{ $viewOfficer -> member_signature}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-12 invoice-btn-group text-center">
                            <button type="button" style="background-color: #a52a2acc;color: #fff" class="btn btn-print-invoice m-b-10">Print</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Invoice ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ Main Content ] end -->

<script src="../assets/js/vendor-all.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/ripple.js"></script>
<script src="../assets/js/pcoded.min.js"></script>

{{-- <script>
    function printData() {
        var divToPrint = document.getElementById("printTable");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    $('.btn-print-invoice').on('click', function() {
        printData();
    })
</script> --}}


<script>
    function printData() {
        // Select the content to print
        var divToPrint = document.getElementById("printTable");

        // Open a new window for the print preview
        var newWin = window.open("");

        // Add print-specific styles
        var styles = `
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                .invoice-contact {
                    width: 100%;
                    margin-bottom: 0;
                    position: static;
                    left: 300px;
                }
                .text-secondary {
                    font-size: 1.5rem
                    position: static;
                    left: 550px;
                }
                .invoive-info{
                    width: 100%;
                    margin-bottom: 20px;
                }
                h5 {
                    font-size: 1.2rem;
                    margin: 5px 0;
                    text-align: center;
                }
                .invoice-client-info label {
                    font-weight: bold;
                }
                p {
                    font-size: 1rem;
                    margin: 5px 0;
                }
                .btn, .breadcrumb, .page-header, .page-block {
                    display: none; /* Hide buttons and breadcrumbs */
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
                <title>Officer Details</title>
                ${styles}
            </head>
            <body>
                ${divToPrint.outerHTML}
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



@endsection