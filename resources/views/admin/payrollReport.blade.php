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
    <h1>Payroll Report</h1>
    <h3>Generated on : {{ $date }}</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date Paid</th>
                <th>Month</th>
                <th>Employee ID</th>
                <th>Name</th>
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
                <td>{{ $payroll->employee_id }}</td>
                <td>{{ $payroll->employee->fullname }}</td>
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