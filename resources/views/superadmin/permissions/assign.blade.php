@extends('components.layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Assign Permissions to {{ $role->name }}</h1>
    
    <!-- Permission Assignment Form -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permission Assignment Form</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.storePermissions', $role->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="permissions">Permissions</label><br>
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
