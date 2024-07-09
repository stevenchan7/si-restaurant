@extends('components.layouts.admin-layout')

@section('content')
<div class="container">
    <h2>Edit Permissions for {{ $role->name }}</h2>

    <form action="{{ route('roles.updatePermissions', $role->id) }}" method="POST">
        @csrf

        @foreach($permissions as $permission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                <label class="form-check-label">
                    {{ $permission->name }}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
