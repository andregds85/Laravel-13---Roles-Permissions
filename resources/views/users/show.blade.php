@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User: {{ $user->name }}</h2>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $user->id }}</dd>

                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Email Verified At</dt>
                <dd class="col-sm-9">{{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Not verified' }}</dd>

                <dt class="col-sm-3">Roles</dt>
                <dd class="col-sm-9">
                    @foreach($user->roles as $role)
                        <span class="badge bg-info text-dark me-1">{{ $role->name }}</span>
                    @endforeach
                </dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $user->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At</dt>
                <dd class="col-sm-9">{{ $user->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection