<x-layouts.admin-layout>
      <h5>Inventory</h5>
  
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      Inventory List
                  </div>
                  <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Product Name</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($inventories as $inventory)
                              <tr>
                                  <td>{{ $inventory->product_name }}</td>
                                  <td>{{ $inventory->quantity }}</td>
                                  <td>{{ $inventory->price }}</td>
                                  <td>
                                      <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-primary">Edit</a>
                                      <a href="{{ route('inventory.destroy', $inventory->id) }}" class="btn btn-danger">Delete</a>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
</x-layouts.admin-layout>