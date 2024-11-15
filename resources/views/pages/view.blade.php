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
                            <h5 class="m-b-10">Invoice</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Invoice ] start -->
            <div class="container" id="printTable">
                <div>
                    <div class="card">
                        <div class="row invoice-contact">
                            <div class="col-md-8">
                                <div class="invoice-box row">
                                    <div class="col-sm-12">
                                        <table class="table table-responsive invoice-table table-borderless p-l-20">
                                            <tbody>
                                                {{-- <tr>
                                                    <td><a href="index.html" class="b-brand">
                                                            <img class="img-fluid" src="assets/images/logo-dark.png" alt="Able pro Logo">
                                                        </a>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td>RETIRED PRISON OFFICERS' ASSOCIATION OF GHANA </td>
                                                </tr>
                                                <tr>
                                                    <td>P.0. BOX CT. 10895, CANTONMENTS, ACCRA.</td>
                                                </tr>
                                                <tr>
                                                    <td><a class="text-secondary" href="repoaghana@gmail.com" target="_top">repoaghana@gmail.com</a></td>
                                                </tr>
                                                <tr>
                                                    <td>03 0393 3865</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="card-body">
                            <div class="row invoive-info">
                                <div class="col-md-4 col-xs-12 invoice-client-info">
                                    <h6>Client Information :</h6>
                                    <h6 class="m-0">{{ $viewOfficer -> full_name}}</h6>
                                    <p class="m-0 m-t-10">1065 Mandan Road, Columbia MO, Missouri. (123)-65202</p>
                                    <p class="m-0">(1234) - 567891</p>
                                    <p><a class="text-secondary" href="mailto:demo@gmail.com" target="_top">demo@gmail.com</a></p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6>Order Information :</h6>
                                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Date :</th>
                                                <td>November 14</td>
                                            </tr>
                                            <tr>
                                                <th>Status :</th>
                                                <td>
                                                    <span class="label label-warning">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Id :</th>
                                                <td>
                                                    #146859
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6 class="m-b-20">Invoice Number <span>#125863478945</span></h6>
                                    <h6 class="text-uppercase text-primary">Total Due :
                                        <span>$950.00</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table invoice-detail-table">
                                            <thead>
                                                <tr class="thead-default">
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6>Logo Design</h6>
                                                        <p class="m-0">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                                                    </td>
                                                    <td>6</td>
                                                    <td>$200.00</td>
                                                    <td>$1200.00</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>Logo Design</h6>
                                                        <p class="m-0">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                                                    </td>
                                                    <td>7</td>
                                                    <td>$100.00</td>
                                                    <td>$700.00</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6>Logo Design</h6>
                                                        <p class="m-0">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                                                    </td>
                                                    <td>5</td>
                                                    <td>$150.00</td>
                                                    <td>$750.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive invoice-table invoice-total">
                                        <tbody>
                                            <tr>
                                                <th>Sub Total :</th>
                                                <td>$4725.00</td>
                                            </tr>
                                            <tr>
                                                <th>Taxes (10%) :</th>
                                                <td>$57.00</td>
                                            </tr>
                                            <tr>
                                                <th>Discount (5%) :</th>
                                                <td>$45.00</td>
                                            </tr>
                                            <tr class="text-info">
                                                <td>
                                                    <hr />
                                                    <h5 class="text-primary m-r-10">Total :</h5>
                                                </td>
                                                <td>
                                                    <hr />
                                                    <h5 class="text-primary">$ 4827.00</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>Terms and Condition :</h6>
                                    <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-12 invoice-btn-group text-center">
                            <button type="button" class="btn waves-effect waves-light btn-primary btn-print-invoice m-b-10">Print</button>
                            <button type="button" class="btn waves-effect waves-light btn-secondary m-b-10 ">Cancel</button>
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