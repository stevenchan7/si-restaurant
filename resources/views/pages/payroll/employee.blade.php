<x-layouts.admin-layout>
    @section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h5>Employee Payroll Details</h5>
        <div class="row justify-content-end">
            <a href="/admin/generate-payroll-details-report/{{ $employee->id }}" class="btn btn-info"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Payroll Report</a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow my-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Employee ID : {{ $employee->id }}</h4>
            <h4 class="m-0 font-weight-bold text-primary">Name : {{ $employee->fullname }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="payrollTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Salary</th>
                            <th>Overtime</th>
                            <th>Cut</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Salary</th>
                            <th>Overtime</th>
                            <th>Cut</th>
                            <th>Total</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                        <tr>
                            <td>{{ $payroll->month }}</td>
                            <td>{{ $payroll->salary }}</td>
                            <td>{{ $payroll->overtime }}</td>
                            <td>{{ $payroll->cut }}</td>
                            <td>{{ $payroll->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    {{-- Combo box --}}
    <script src="{{ asset('vendor/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
    <script type="text/javascript">
        $('document').ready(function() {    
                $('#payrollTable').DataTable({
                    columnDefs: [
                        {
                            // Set salary and overtime column type to number and format number
                            type: "num",
                            targets: [1,2,3,4],
                            render: $.fn.dataTable.render.number(".", ",", 0, "Rp "),
                        },
                    ],
                });

                $('.employeeSelect').combobox();

            })
    </script>
    @endsection
</x-layouts.admin-layout>