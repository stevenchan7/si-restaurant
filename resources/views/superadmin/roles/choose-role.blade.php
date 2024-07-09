@extends('components.layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Choose Roles for {{ $user->name }}</h1>
    
    <!-- Role Form -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Role Selection Form</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.storeRole', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="roles">Roles</label><br>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role{{ $role->id }}">{{ $role->name }}</label>
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
