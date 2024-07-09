@extends('components.layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Permission</h1>
    <p class="mb-4">Update the details of the permission.</p>
    
    <!-- Permission Form -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Permission Form</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="permissionName">Permission Name</label>
                            <input type="text" class="form-control" id="permissionName" name="name" value="{{ $permission->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
