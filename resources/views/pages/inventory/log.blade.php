<x-layouts.admin-layout>
  @section('css')
      <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
      <link href="{{ asset('vendor/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap 5 -->
  @endsection

  @if(session()->has('success'))
      <div class="alert alert-success col-lg-12" role="alert">
          {{ session('success') }}
      </div>
  @endif

  <div class="d-flex justify-content-between mb-3">
    <a href="/inventory" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back</a>
  </div>
  
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  Order Log
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="inventory-table">
                          <thead>
                              <tr>
                                  <th>Product Name</th>
                                  <th>Quantity</th>
                                  <th>Price/Unit</th>
                                  <th>Total Price</th>
                                  <th>Supplier</th>
                                  <th>Order Date</th>
                                  <th>Operator Name</th> 
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($logs as $log)
                                  <tr>
                                    <td>{{ $log->ingredient->name }}</td>
                                    <td>{{ $log->quantity . " " . $log->ingredient->unit}}</td>
                                    <td>{{ $log->getPriceFormat($log->price) }}</td>
                                    <td>{{ $log->getPriceFormat($log->total_price) }}</td>
                                    <td>{{ $log->ingredient->supplier->name }}</td>
                                    <td>{{ $log->created_at->format('d F Y') . " at " .  $log->created_at->format(' H:i') }}</td>
                                    <td>{{ $log->employee->fullname }}</td>
                                  </tr>
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
              $('.combobox').combobox();
          });
      </script>
  @endsection
</x-layouts.admin-layout>
