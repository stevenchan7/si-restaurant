<x-layouts.admin-layout>
    @section('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap 5 -->
    @endsection

    <h5>Inventory</h5>

    <div class="d-flex justify-content-end mb-3">
        <div class="md-3 mb-3">
            <div class="card-body text-center">
                <a href="/orderLog" class="btn btn-secondary w-100">Log Order</a>
            </div>
        </div>
        <div class="ml-3 mb-3">
            <div class="card-body text-center">
                <a href="/suppliers" class="btn btn-primary w-100">View Supplier</a>
            </div>
        </div>
        <div class="ml-3 mb-3">
            <div class="card-body text-center">
                <a href="/inventory/create" class="btn btn-primary w-100">
                    <i class="fa-regular fa-plus me-2"></i>Add new Inventory
                </a>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Inventory List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="inventory-table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Stock</th>
                                    {{-- <th>Unit</th> --}}
                                    <th>Price/Unit</th>
                                    <th>Minimum Stock</th>
                                    <th>Supplier</th>
                                    <th>Last Restock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->name }}</td>
                                        <td>{{ $inventory->stock . " " . $inventory->unit }}</td>
                                        {{-- <td>{{ $inventory->unit }}</td> --}}
                                        <td>{{ $inventory->formatted_price }}</td>
                                        <td>{{ $inventory->minimum_stock . " " . $inventory->unit }}</td>
                                        <td>{{ $inventory->supplier->name }}</td>
                                        <td>{{ $inventory->created_at->format('d F Y') }}</td>
                                        <td>
                                            <a href="/inventory/{{ $inventory->id }}" class="btn btn-primary"><i class="bi bi-eye"></i> Detail</a>
                                            <!-- Order button triggers a modal -->
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#OrderModal-{{ $inventory->id }}"><i class="bi bi-pencil-square"></i> Order</button>
                                        </td>
                                    </tr>

                                    <!-- Modal for each inventory item -->
                                    <div class="modal fade" id="OrderModal-{{ $inventory->id }}" tabindex="-1" aria-labelledby="OrderModalLabel-{{ $inventory->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="OrderModalLabel-{{ $inventory->id }}">Order Inventory</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form for ordering an inventory item -->
                                                    <form action="/inventory/{{ $inventory->id }}/order" method="post">
                                                        @csrf
                                                        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                                        <div class="form-group">
                                                            <label for="quantity-{{ $inventory->id }}" class="form-label">Quantity</label>
                                                            <input type="number" name="quantity" id="quantity-{{ $inventory->id }}" class="form-control" required>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="employee" class="form-label">Select Operator</label>
                                                            <select name="employee" id="employee-{{ $inventory->id }}" class="form-select" required>
                                                                @foreach($employees as $employee)
                                                                    <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer mt-3">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Order</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/datatables-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap 5 -->

        {{-- Combo box --}}
        <script src="{{ asset('vendor/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#inventory-table').DataTable();

                // Initialize the combobox each time a modal is shown
                $('.modal').on('shown.bs.modal', function () {
                    $(this).find('.combobox').combobox();
                });
            });
        </script>
    @endsection
</x-layouts.admin-layout>
