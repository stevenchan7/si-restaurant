<x-layouts.admin-layout>

    <div class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Create New Ingredient
            </div>

            <div class="card-body">
                <form action="{{ "/inventory" }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" required autofocus value="{{ old('name') }}" placeholder="Enter name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <input name="unit" id="unit"
                                class="form-control @error('unit') is-invalid @enderror" required value = "{{ old('unit') }}"
                                placeholder="Enter unit"></input>
                            @error('unit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price per Unit</label>
                            <input type="text" name="price" id="price"
                                class="form-control @error('price') is-invalid @enderror" required value="{{ old('price') }}"
                                placeholder="Enter price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="minimum_stock" class="form-label">Minimum Stock</label>
                            <input type="text" name="minimum_stock" id="minimum_stock"
                                class="form-control @error('Minimum Stock') is-invalid @enderror" required value = "{{ old('minimum_stock') }}"
                                placeholder="Enter Minimum Stock">
                            @error('minimum_stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="supplier" class="form-label">Supplier</label>
                                <select class="form-select" name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                        @if(old('supplier_id') == $supplier->id)
                                            <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                                        @else
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @error('supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="d-flex mb-3">
                        <div class="me-auto p-2">
                            <button type="submit" class="btn btn-primary mb-2">Add Ingredient</button>
                        </div>

                        <div class="p-2">
                        <a href="{{ "/inventory" }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
                        
</x-layouts.admin-layout>
