<!DOCTYPE html>
<html>

<head>
    <title>Order Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>{{ $employee->fullname }}'s Payroll Details</h1>
    <h3>Generated on : {{ $date }}</h3>

    <h4>Employee Data :</h4>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Start Date</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->start_working_date }}</td>
                <td>{{ $employee->fullname }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->telephone_number }}</td>
                <td>{{ $employee->email }}</td>
            </tr>
        </tbody>
    </table>

    <h4>Payroll Detail Report:</h4>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date Paid</th>
                <th>Month</th>
                <th>Salary</th>
                <th>Overtime</th>
                <th>Cut</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr>
                <td>{{ $payroll->id }}</td>
                <td>{{ $payroll->updated_at }}</td>
                <td>{{ $payroll->month }}</td>
                <td>Rp. {{ number_format($payroll->salary, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($payroll->overtime, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($payroll->cut, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($payroll->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>