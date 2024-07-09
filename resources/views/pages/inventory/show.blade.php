<x-layouts.admin-layout>
  <div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between mb-3">
                <a href="/inventory" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back</a>
                <div>
                    <a href="/inventory/{{ $ingredient->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="/inventory/{{ $ingredient->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2>{{ $ingredient->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h5><span class="badge text-dark">Stock</span></h5>
                        </div>
                        <div class="col-sm-8">
                            <h5>{{ $ingredient->stock . " " . $ingredient->unit }}</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h5><span class="badge text-dark">Price per Unit</span></h5>
                        </div>
                        <div class="col-sm-8">
                            <h5>{{ $ingredient->formatted_price }}</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h5><span class="badge text-dark">Minimum Stock</span></h5>
                        </div>
                        <div class="col-sm-8">
                            <h5>{{ $ingredient->minimum_stock }}</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h5><span class="badge text-dark">Last Stock</span></h5>
                        </div>
                        <div class="col-sm-8">
                            <h5>{{ $ingredient->created_at }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
              <h3>Supplier</h3>
              <div class="card">
                <div class="card-body">
                  @if($ingredient->supplier)
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h5><span class="badge">Name</span></h5>
                        </div>
                        <div class="col-sm-8">
                            <h5>{{ $ingredient->supplier->name }}</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4">
                          <h5><span class="badge">Address</span></h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>{{ $ingredient->supplier->address }}</h5>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-4">
                        <h5><span class="badge">Phone</span></h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>{{ $ingredient->supplier->phone }}</h5>
                      </div>
                    </div>
                  @else
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <h5>No Supplier Information Available</h5>
                        </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin-layout>