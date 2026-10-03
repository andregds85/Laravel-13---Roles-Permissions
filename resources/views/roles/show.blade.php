@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Role: {{ $role->name }}</h2>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $role->id }}</dd>

                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $role->name }}</dd>

                <dt class="col-sm-3">Guard</dt>
                <dd class="col-sm-9">{{ $role->guard_name }}</dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $role->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At</dt>
                <dd class="col-sm-9">{{ $role->updated_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Permissions</dt>
                <dd class="col-sm-9">
                    @foreach($role->permissions as $permission)
                        <span class="badge bg-secondary me-1">{{ $permission->name }}</span>
                    @endforeach
                </dd>
            </dl>
        </div>
    </div>
</div>
@endsection