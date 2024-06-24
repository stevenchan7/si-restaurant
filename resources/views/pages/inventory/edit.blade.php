<x-layouts.admin-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Inventory
                </div>
                <div class="card-body">
                    <form action="/inventory/{{ $inventory->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group
                        ">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" required autofocus value="{{ $inventory->name }}" placeholder="Enter name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group
                        ">
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input name="unit" id="unit"
                                    class="form-control @error('unit') is-invalid @enderror" required value="{{ $inventory->unit }}"
                                    placeholder="Enter unit"></input>
                                @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group
                        ">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price per Unit</label>
                                <input type="text" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror" required value="{{ $inventory->price }}"
                                    placeholder="Enter price">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group
                        ">
                            <div class="mb-3">
                                <label for="minimum_stock" class="form-label
                                ">Minimum Stock</label>
                                <input type="text" name="minimum_stock" id="minimum_stock"
                                    class="form-control @error('Minimum Stock') is-invalid @enderror" required value="{{ $inventory->minimum_stock }}"
                                    placeholder="Enter Minimum Stock">
                                @error('minimum_stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group
                        ">
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Supplier</label>
                                <select class="form-select" name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $inventory->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin-layout>