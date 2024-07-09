@extends('components.layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Roles List</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Roles Management</h6>
        </div>
        <div class="card-body">
            <!-- Add New Role -->
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="role_name">Role Name</label>
                    <input type="text" class="form-control" id="role_name" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <!-- Roles List -->
            <h2 class="mt-4">Roles List</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- User-Role Assignment -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Assign Roles to Users</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.storeRole') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_email">User Email</label>
                    <input type="email" class="form-control" id="user_email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label>
                    <select multiple class="form-control" id="roles" name="roles[]">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Roles</button>
            </form>

            <!-- User-Role List -->
            <h2 class="mt-4">User-Role List</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-info">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($user->roles as $role)
                                    <form action="{{ route('roles.removeUserRole', ['user' => $user->id, 'role' => $role->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove {{ $role->name }}</button>
                                    </form>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
