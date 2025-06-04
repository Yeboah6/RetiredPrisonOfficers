
<!DOCTYPE html>
<html>
<head>
    <title>{{ $reportTitle }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="container" style="text-align: center;margin-top: 20px;margin-bottom: 50px;">
        <h5>RETIRED PRISON OFFICERS' ASSOCIATION OF GHANA </h5>
        <h5>P.O. BOX CT. 10895, CANTONMENTS, ACCRA. </h5>
        <h5><a class="text-secondary" href="repoaghana@gmail.com" style="text-decoration:none;">repoaghana@gmail.com</a> 03 0393 3865</h5>
    </div>
    <h2 style="text-align: center;">{{ $reportTitle }}</h2>
    <div class="table-responsive">
        <table id="report-table" class="table table-bordered table-striped mb-0" style="margin-left:-5px;">
            <thead>
                <tr>
                    <th>REG ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Gov't Pension No</th>
                    <th>Gender</th>
                    <th>Prison SVC No</th>
                    <th>Residential Address</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction -> reg_id}}</td>
                        <td>{{ $transaction -> full_name}}</td>
                        <td>{{ $transaction -> telephone}}</td>
                        <td>{{ $transaction -> govt_pension_no}}</td>
                        <td>{{ $transaction -> sex}}</td>
                        <td>{{ $transaction -> prison_svc_no}}</td>
                        <td>{{ $transaction -> residential_address}}</td>
                        <td>{{ $transaction->formatted_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
