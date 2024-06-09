<x-layouts.admin-layout>
  <h5>Inventory</h5>
  
  <div class="row justify-content-end">
    <a href="/inventory/create" class="btn btn-primary mb-3"><i class="fa-regular fa-plus"></i> Add new Inventory</a>

    <form action="/inventory" method="get" class="d-flex mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
      <button class="btn btn-primary"><i class="bi bi-search"></i></button>
    </form>
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
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th></th>
                      <th>Price</th>
                      <th>Supplier</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($inventories as $inventory)
                <tr>
                  <td>{{ $inventory->name }}</td>
                  <td>{{ $inventory->stock }}</td>
                  <td>{{ $inventory->satuan }}</td>
                  <td>{{ $inventory->price }}</td>
                  <td>{{ $inventory->supplier }}</td>
                  <td>
                    <a href="/inventory/{{ $inventories->id }}" class="btn btn-primary"><i class="bi bi-eye"></i> Detail</span></a>
                    <a href="/inventory/{{ $inventories->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</span></a>
                    <form action="/inventory/{{ $inventories->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0" onclick="return confirm('Are you sure')"><i class="bi bi-trash3"></i> Delete</button>
                    </form>
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
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection