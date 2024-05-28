<x-layouts.admin-layout>
    @section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet">
    @endsection

    <h5>Salary</h5>

    <div class="row justify-content-end">
        <button id="salary-create-btn" type="button" class="btn btn-primary" data-toggle="modal"
            data-target="#createSalaryModal">
            <i class="fa-regular fa-plus"></i>
            Add
        </button>
        <!-- Modal -->
        <div class="modal fade" id="createSalaryModal" tabindex="-1" aria-labelledby="salaryModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="salaryForm" class="mx-auto" data-service="create">
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
                                        <input type="text" id="employee-name" disabled class="form-control w-full"
                                            style="display: none">
                                    </div>
                                    <div class="form-group">
                                        <label for="salary-input">Input salary</label>
                                        <input id="salary-input" type="number" name="salary" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="overtime-input">Input overtime</label>
                                        <input id="overtime-input" type="number" name="overtime" class="form-control">
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

    {{-- Table here --}}
    <div class="card shadow my-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Salary</th>
                            <th>Overtime pay</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Salary</th>
                            <th>Overtime/hour </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($salaries as $salary)
                        <tr>
                            <td>{{ $salary->employee->fullname }}</td>
                            <td>{{ $salary->salary }}</td>
                            <td>{{ $salary->overtime }}</td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary edit-btn" data-toggle="modal" data-service="edit"
                                            data-target="#createSalaryModal" data-salary="{{ $salary }}">Edit</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-danger delete-btn"
                                            data-id="{{ $salary->id }}">Delete</button>
                                    </div>
                                </div>
                            </td>
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
            $('.employeeSelect').combobox();

            // create button handler
            $('#salary-create-btn').click(function() {
                $('.combobox-container').show();
                $('#salaryForm #employee-name').hide();
                
                $('#salaryForm .combobox-container input[name=employeeId]').val('');
                // $('#salaryForm .combobox-container .employeeSelect').val(salary.employee.fullname);
                $('#salaryForm input[name=salary]').val('');
                $('#salaryForm input[name=overtime]').val('');
            });

            // Modal show handler
            $('.modal').on('show.bs.modal', function(e) {
                // Button yang memunculkan modal
                var btn = $(e.relatedTarget);

                // Attach attr to form
                console.log(btn.data('service'));
                if (btn.data('service') === 'edit') {
                    var form = $('#salaryForm');
                    form.attr('data-service', btn.data('service'));
                    form.attr('data-id', btn.data('salary').id);
                }
            })

            // Edit button handler
            $('.edit-btn').click(function() {
                var salary = $(this).data('salary');

                $('.combobox-container').hide();

                var empNameInput = $('#salaryForm #employee-name');
                empNameInput.show();
                empNameInput.val(salary.employee.fullname);
                
                $('#salaryForm .combobox-container input[name=employeeId]').val(salary.employee_id);
                // $('#salaryForm .combobox-container .employeeSelect').val(salary.employee.fullname);
                $('#salaryForm input[name=salary]').val(salary.salary);
                $('#salaryForm input[name=overtime]').val(salary.overtime);
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

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('salary.delete') }}",
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
                                $('#salaryForm').prepend(element);
                            }
                        })
                    }
                });
            })

            // Form submit handler
            $('#salaryForm').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                var url = "{{ route('salary.post') }}";

                if ($(this).data('service') === 'edit') {
                    url = "{{ route('salary.update') }}";
                    data.set('id', $(this).data('id'));
                    data.set('_method', 'PUT')
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    dataType: 'json', // Expected incoming data type 
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
                        $('#salaryForm').prepend(element);
                    }
                });
            })
        })
    </script>
    @endsection
</x-layouts.admin-layout>