<x-layouts.admin-layout>
  <h5>Inventory</h5>

  <div class="row justify-content-end grid gap-0 column-gap-1">
      <div class='p-2 g-col-6'>
          <a href="/suppliers" class="btn btn-primary mb-3">View Supplier</a>
      </div>
      <div class='p-2 g-col-6'>
          <a href="/inventory/create" class="btn btn-primary mb-3"><i class="fa-regular fa-plus"></i> Add new Inventory</a>
      </div>

      <div class='p-2 g-col-6'>
          <form action="/inventory" method="get" class="d-flex mb-3">
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
                  Inventory List
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Product Name</th>
                                  <th>Stock</th>
                                  <th>Unit</th>
                                  <th>Price/Unit</th>
                                  <th>Supplier</th>
                                  <th>Last Restock</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($inventories as $inventory)
                                  <tr>
                                      <td>{{ $inventory->name }}</td>
                                      <td>{{ $inventory->stock }}</td>
                                      <td>{{ $inventory->unit }}</td>
                                      <td>{{ $inventory->formatted_price }}</td>
                                      <td>{{ $inventory->supplier->name }}</td>
                                      <td>{{ $inventory->created_at->format('d F Y') }}</td>
                                      <td>
                                          <a href="/inventory/{{ $inventory->id }}" class="btn btn-primary"><i class="bi bi-eye"></i> Detail</a>
                                          <!-- Order button triggers a modal -->
                                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#OrderModal-{{ $inventory->id }}"><i class="bi bi-pencil-square"></i> Order</button>
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
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-primary">Order</button>
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

  <div class="modal fade" ></div>
</x-layouts.admin-layout>

<!-- Include Bootstrap CSS and JavaScript -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
