<x-layouts.admin-layout>
    @section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection

    <h5>Payroll</h5>

    <div class="row justify-content-end">
        <button id="overtimeCreateBtn" type="button" class="btn btn-primary" data-toggle="modal"
            data-target="#payroll-modal">
            <i class="fa-regular fa-plus"></i> Generate
        </button>
        <!-- Overtime modal -->
        <div class="modal fade" id="payroll-modal" tabindex="-1" aria-labelledby="overtimeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add overtime</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="payrollForm" class="mx-auto">
                                    @csrf
                                    <div class="form-group">
                                        <label for="emplyee-select">Employee</label>
                                        <select name="employeeId" id="employee-select"
                                            class="employeeSelect form-control w-full">
                                            <option selected value="" disabled>Select employee...</option>
                                            @foreach ($employees as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="overtime-date">Month</label>
                                        <select name="month" class="form-control">
                                            <option selected value="" disabled>Select month...</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salary</label>
                                        <input id="salary" type="text" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="overtime-total">Overtime</label>
                                        <input id="overtime-total" type="text" class="form-control" disabled>
                                        <div class="table-responsive my-4">
                                            {{-- Overtime table --}}
                                            <table class="table table-bordered" id="overtimeTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>per Hour</th>
                                                        <th>Hour</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dayoff-total">Dayoff</label>
                                        <input id="dayoff-total" type="text" class="form-control" disabled>
                                        <div class="table-responsive my-4">
                                            {{-- Overtime table --}}
                                            <table class="table table-bordered" id="dayoffTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pay-total">Total</label>
                                        <input id="pay-total" type="text" class="form-control" disabled>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow my-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="payrollTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Salary</th>
                            <th>Overtime</th>
                            <th>Cut</th>
                            <th>Total</th>
                            <th>Month</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Salary</th>
                            <th>Overtime</th>
                            <th>Cut</th>
                            <th>Total</th>
                            <th>Month</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                        <tr>
                            <td>{{ $payroll->employee->fullname }}</td>
                            <td>{{ $payroll->salary }}</td>
                            <td>{{ $payroll->overtime }}</td>
                            <td>{{ $payroll->cut }}</td>
                            <td>{{ $payroll->total }}</td>
                            <td>{{ $payroll->month }}</td>
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

                var employees = @json($employees); // encode your collection as a JSON string without HTML entities

                // Payroll form month input handler
                $('#payrollForm select[name=month]').change(function() {
                    var month = $(this).val();
                    var data = {
                        employee: $('#payrollForm input[name=employeeId]').val(),
                        month: month
                    }

                    $.ajax({
                        type: 'GET',
                        url: "{{ route('payroll.get') }}",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: data,
                        dataType: 'json',
                        success: function(data) {
                            $('#overtime-total').val('Rp ' + data.overtimeTotal.toLocaleString('id-ID'));
                            $('#dayoff-total').val('Rp ' + data.dayoffTotal.toLocaleString('id-ID'));

                            // Calculate total pay
                            var totalPay = data.salary + data.overtimeTotal - data.dayoffTotal;
                            $('#pay-total').val('Rp ' + totalPay.toLocaleString('id-ID'));
                        },
                        error: function(data) {
                            // Remove previous error
                            $('.error-message').remove();
    
                            // Create error message
                            var errors = data.responseJSON.errors;
                            var element = '<div class="error-message alert alert-danger" role="alert">'
                            for (const err in errors) {
                                element += '<li>' + errors[err] + '</li>'
                            }
                            element += '</div>';
    
                            // Add error message before form
                            $('#overtimeForm').prepend(element);
                        }
                    })
                });

                // Handle overtime form autofill
                $('#payrollForm input[name=employeeId]').change(function() {
                    var month = $('#payrollForm select[name=month]').val();
                    var data = {
                        employee: $(this).val(),
                        month: month
                    }

                    $.ajax({
                        type: 'GET',
                        url: "{{ route('payroll.get') }}",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: data,
                        dataType: 'json',
                        success: function(data) {
                            $('#overtime-total').val('Rp ' + data.overtimeTotal.toLocaleString('id-ID'));
                            $('#dayoff-total').val('Rp ' + data.dayoffTotal.toLocaleString('id-ID'));
                            $('#salary').val('Rp ' + data.salary.toLocaleString('id-ID'));

                            // Calculate total pay
                            var totalPay = data.salary + data.overtimeTotal - data.dayoffTotal;
                            $('#pay-total').val('Rp ' + totalPay.toLocaleString('id-ID'));
                        },
                        error: function(data) {
                            // Remove previous error
                            $('.error-message').remove();
    
                            // Create error message
                            var errors = data.responseJSON.errors;
                            var element = '<div class="error-message alert alert-danger" role="alert">'
                            for (const err in errors) {
                                element += '<li>' + errors[err] + '</li>'
                            }
                            element += '</div>';
    
                            // Add error message before form
                            $('#overtimeForm').prepend(element);
                        }
                    })
                })

                // Overtime form submit handler
                $('#payrollForm').submit(function(e) {
                    e.preventDefault();
                    var data = new FormData(this);
                    var url = "{{ route('payroll.post') }}";

                    $.ajax({
                        type: 'POST',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: data,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire({
                                title: "Success!",
                                text: data.msg,
                                icon: "success",
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(data) {
                            console.log(data);
                            // Remove previous error
                            $('.error-message').remove();
    
                            // Create error message
                            var errors = data.responseJSON.errors;
                            var element = '<div class="error-message alert alert-danger" role="alert">'
                            for (const err in errors) {
                                element += '<li>' + errors[err] + '</li>'
                            }
                            element += '</div>';
    
                            // Add error message before form
                            $('#payrollForm').prepend(element);
                        }
                    })
                });

                // Delete button handler
                $('.delete-btn').click(function() {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            // Post request
                            var data = new FormData();
    
                            data.set('_method', 'DELETE');
                            data.set('id', $(this).data('id'));

                            // URL based on delete button data-mdeol
                            var url = '';
                            if ($(this).data('model') === 'overtime') {
                                url = "{{ route('overtime.delete') }}";
                            } else {
                                url = "{{ route('dayoff.delete') }}"
                            }
    
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: data,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function() {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(data) {
                                    // Remove previous error
                                    $('.error-message').remove();
    
                                    // Create error message
                                    var errors = data.responseJSON.errors;
                                    var element = '<div class="error-message alert alert-danger" role="alert">'
                                    for (const err in errors) {
                                        element += '<li>' + errors[err] + '</li>'
                                    }
                                    element += '</div>';
    
                                    // Add error message before form
                                    $('#overtimeForm').prepend(element);
                                }
                            })
                        }
                    });
                });
            })
    </script>
    @endsection
</x-layouts.admin-layout>