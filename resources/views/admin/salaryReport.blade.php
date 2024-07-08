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
    <h1>Salary Report</h1>
    <h3>Generated on : {{ $date }}</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Updated</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>Salary</th>
                <th>Overtime</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->id }}</td>
                <td>{{ $salary->updated_at }}</td>
                <td>{{ $salary->employee_id }}</td>
                <td>{{ $salary->employee->fullname }}</td>
                <td>{{ $salary->employee->start_working_date }}</td>
                <td>Rp. {{ number_format($salary->salary, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($salary->overtime, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>