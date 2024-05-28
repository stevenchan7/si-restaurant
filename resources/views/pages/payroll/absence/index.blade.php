<x-layouts.admin-layout>
    @section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection

    <h5>Absence</h5>

    <div class="row justify-content-end">
        <button id="overtimeCreateBtn" type="button" class="btn btn-primary" data-toggle="modal"
            data-target="#overtime-modal">
            <i class="fa-regular fa-clock"></i>
            Overtime
        </button>
        <!-- Overtime modal -->
        <div class="modal fade" id="overtime-modal" tabindex="-1" aria-labelledby="overtimeModal" aria-hidden="true">
            <div class="modal-dialog">
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
                                <form id="overtimeForm" class="mx-auto">
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
                                        <label for="overtime-date">Date</label>
                                        <input id="overtime-date" type="date" name="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="overtime-pay">Pay / hour</label>
                                        <input id="overtime-pay" type="text" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="overtime-hours">Total hours</label>
                                        <input id="overtime-hours" type="number" name="overtimeHour"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="overtime-total">Total pay</label>
                                        <input id="overtime-total" type="text" class="form-control" disabled>
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
        <button id="dayoffCreateBtn" type="button" class="btn btn-primary ml-2" data-toggle="modal"
            data-target="#dayoff-modal">
            <i class="fa-regular fa-moon"></i>
            Dayoff
        </button>
        <!-- Dayoff modal -->
        <div class="modal fade" id="dayoff-modal" tabindex="-1" aria-labelledby="dayoffModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add dayoff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="dayoffForm" class="mx-auto">
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
                                        <label for="overtime-date">Date</label>
                                        <input id="overtime-date" type="date" name="date" class="form-control">
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

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button id="showOvertimeBtn" class="btn btn-link active">Overtime</button>
        </li>
        <li class="nav-item">
            <button id="showDayoffBtn" class="btn btn-link">Dayoff</button>
        </li>
    </ul>

    {{-- Table start --}}
    <div id="table-container">
        <div class="card shadow my-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table</h6>
            </div>
            <div class="card-body">
                <div id="overtime-table-responsive" class="table-responsive">
                    {{-- Overtime table --}}
                    <table class="table table-bordered" id="overtimeTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>per Hour</th>
                                <th>Hour</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>per Hour</th>
                                <th>Hour</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($overtimes as $overtime)
                            <tr>
                                <td>{{ $overtime->employee->fullname }}</td>
                                {{-- <td>Rp{{ number_format($salary->salary, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($salary->overtime, 0, ',', '.') }}</td> --}}
                                <td>{{ $overtime->pay_per_hour }}</td>
                                <td>{{ $overtime->total_hour }}</td>
                                <td>{{ $overtime->total_pay }}</td>
                                <td>{{ $overtime->date }}</td>
                                <td>
                                    <div class="row">
                                        {{-- <div class="col">
                                            <button class="btn btn-primary edit-btn" data-toggle="modal"
                                                data-service="edit" data-target="#createSalaryModal"
                                                data-salary="{{ $salary }}">Edit</button>
                                        </div> --}}
                                        <div class="col">
                                            <button class="btn btn-danger delete-btn" data-model="overtime"
                                                data-id="{{ $overtime->id }}">Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="dayoff-table-responsive" class="table-responsive" style="display:none">
                    {{-- Dayoff table --}}
                    <table class="table table-bordered" id="dayoffTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Paid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Paid</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dayoffs as $dayoff)
                            <td>{{ $dayoff->employee->fullname }}</td>
                            <td>{{ $dayoff->date }}</td>
                            <td>{{ $dayoff->paid }}</td>
                            <td>
                                <div class="row">
                                    {{-- <div class="col">
                                        <button class="btn btn-primary edit-btn" data-toggle="modal" data-service="edit"
                                            data-target="#createSalaryModal" data-salary="{{ $salary }}">Edit</button>
                                    </div> --}}
                                    <div class="col">
                                        <button class="btn btn-danger delete-btn" data-model="dayoff"
                                            data-id="{{ $dayoff->id }}">Delete</button>
                                    </div>
                                </div>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Table end --}}

    @section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    {{-- Combo box --}}
    <script src="{{ asset('vendor/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
    <script type="text/javascript">
        $('document').ready(function() {
                $('.employeeSelect').combobox();

                $('#overtimeTable').DataTable({
                    columnDefs: [
                        {
                            // Set salary and overtime column type to number and format number
                            type: "num",
                            targets: [1, 3],
                            render: $.fn.dataTable.render.number(".", ",", 0, "Rp "),
                        },
                    ],
                });

                $('#dayoffTable').DataTable();

                var employees = @json($employees); // encode your collection as a JSON string without HTML entities
                var salaries = @json($salaries);

                // Handle overtime form autofill
                $('#overtimeForm input[name=employeeId]').change(function() {
                    var selectedEmpId = $(this).val();

                    // Filter salaries
                    var salary = salaries.filter((sal) => {
                        return sal.employee_id == selectedEmpId;
                    });
                    $('#overtimeForm #overtime-pay').attr('data-amount', salary[0].overtime);
                    $('#overtimeForm #overtime-pay').val("Rp " + salary[0].overtime.toLocaleString('id-ID'));

                    // Recalculate total when overtime pay changed
                    overtimeHourInput = $('#overtimeForm input[name=overtimeHour]');
                    if (overtimeHourInput.val()) {
                        var total = overtimeHourInput.val() * salary[0].overtime;
                        $('#overtimeForm #overtime-total').val("Rp " + total.toLocaleString('id-ID'));
                    }

                    // Undisabled input
                    if (overtimeHourInput.attr('disabled')) {
                        overtimeHourInput.removeAttr('disabled');
                    }
                })

                // overtime hours handler
                $('#overtimeForm input[name=overtimeHour]').change(function() {
                    var amount = $('#overtimeForm #overtime-pay').data('amount');
                    var total = $(this).val() * amount;
                    $('#overtimeForm #overtime-total').val("Rp " + total.toLocaleString('id-ID'));
                })

                // Overtime form submit handler
                $('#overtimeForm').submit(function(e) {
                    e.preventDefault();
                    var data = new FormData(this);
                    var url = "{{ route('overtime.post') }}";

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

                // Dayoff form submit handler
                $('#dayoffForm').submit(function(e) {
                    e.preventDefault();
                    var data = new FormData(this);
                    var url = "{{ route('dayoff.post') }}";
                    console.log(url);

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
                            // Remove previous error
                            console.log(data);
                            $('.error-message').remove();
                            
                            // Create error message
                            var errors = data.responseJSON.errors;
                            var element = '<div class="error-message alert alert-danger" role="alert">'
                            for (const err in errors) {
                                element += '<li>' + errors[err] + '</li>'
                            }
                            element += '</div>';
    
                            // Add error message before form
                            $('#dayoffForm').prepend(element);
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
                
                // Show dayoff table toggle
                $('#showDayoffBtn').click(function() {
                    $('#overtime-table-responsive').hide();
                    $('#dayoff-table-responsive').show();
                });

                // Show overtime table toggle
                $('#showOvertimeBtn').click(function() {
                    $('#overtime-table-responsive').show();
                    $('#dayoff-table-responsive').hide();
                });
            })
    </script>
    @endsection
</x-layouts.admin-layout>