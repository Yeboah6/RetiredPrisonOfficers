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
                                    <div class="col-sm-12">
                                        <table class="table table-responsive invoice-table table-borderless p-l-20">
                                            <tbody>
                                                <tr>
                                                    <td>RETIRED PRISON OFFICERS' ASSOCIATION OF GHANA </td>
                                                </tr>
                                                <tr>
                                                    <td>P.O. BOX CT. 10895, CANTONMENTS, ACCRA.</td>
                                                </tr>
                                                <tr>
                                                    <td><a class="text-secondary" href="repoaghana@gmail.com">repoaghana@gmail.com</a></td>
                                                </tr>
                                                <tr>
                                                    <td>03 0393 3865</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <button type="button" class="btn waves-effect waves-light btn-primary btn-print-invoice m-b-10">Print</button>
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

<script>
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
</script>


@endsection