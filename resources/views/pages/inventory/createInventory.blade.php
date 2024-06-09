<x-layouts.admin-layout>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create Inventory
                </div>
                <div class="card-body">
                    <form action="/inventory" method="post">
                        @csrf
                        <div class="form-group

                        @error('name')
                            has-error
                        @enderror
                        ">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <span class="help-block
                                text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" name="satuan" id="satuan" class="form-control" value="{{ old('satuan') }}">
                        </div>
                        @error('satuan')
                            has-error
                        @enderror

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                        </div>

                        <div class="form-group
                        @error('supplier')
                            has-error

                        
</x-layouts.admin-layout>
