<x-layouts.admin-layout>
  @section('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap 5 -->
  @endsection

  <h5>Supplier</h5>

  <div class="row align-items-center">
    <div class="col-lg-2 p-2">
      <a href="/inventory" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>
  
    <div class="col-lg-10 p-2 text-lg-end">
      <div class="row justify-content-end align-items-center gap-0">
        <div class="col-lg-auto p-2">
          <a href="/suppliers/create" class="btn btn-primary mb-3">
            <i class="far fa-plus"></i> Add new supplier
          </a>
        </div>
  
        <div class="col-lg-6 p-2">
          <form action="/suppliers" method="get" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
          </form>
        </div>
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
            Supplier List
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($suppliers as $supplier)
                  <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                      <a href="/suppliers/{{ $supplier->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                      <!-- Optionally, you can include delete functionality -->
                      {{-- <form action="/suppliers/{{ $supplier->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i> Delete</button>
                      </form> --}}
                    </td>
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
  @endsection
</x-layouts.admin-layout>


