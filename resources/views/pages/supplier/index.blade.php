<x-layouts.admin-layout>
  <h5>Supplier</h5>

  <div class="row justify-content-end grid gap-0 column-gap-1">
    <div class='p-2 g-col-6'>
      <a href="/suppliers/create" class="btn btn-primary mb-3"> <i class="fa-regular fa-plus"> </i> Add new supplier</a>
    </div>
    
    <div class='p-2 g-col-6'>
      <form action="/suppliers" method="get" class="d-flex mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
      </form>
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
</x-layouts.admin-layout>

@section('script')
  <!-- Include DataTables scripts -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('css')
  <!-- Include DataTables CSS -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
