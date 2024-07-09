<x-layouts.admin-layout>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Edit Supplier
        </div>
        <div class="card-body">
          <form action="{{ route('suppliers.update', ['id' => $supplier->id]) }}" method="post">
            @csrf
            @method('PUT') <!-- Use PUT method for update -->

            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" id="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $supplier->name) }}" placeholder="Enter name" required autofocus>
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email', $supplier->email) }}" placeholder="Enter email" required>
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="text" name="phone" id="phone"
                     class="form-control @error('phone') is-invalid @enderror"
                     value="{{ old('phone', $supplier->phone) }}" placeholder="Enter phone number" required>
              @error('phone')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea name="address" id="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Enter address" required>{{ old('address', $supplier->address) }}</textarea>
              @error('address')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-layouts.admin-layout>
