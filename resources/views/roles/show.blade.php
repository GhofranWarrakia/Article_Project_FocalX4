@extends('layouts.master')

@section('title', 'View Role')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">View Role</div>
                    <div class="card-body">
                        <p><strong>Role Name:</strong> {{ $role->name }}</p>
                        <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection