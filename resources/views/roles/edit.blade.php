@extends('layouts.master')

@section('title', 'Edit Role')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">تعديل الصلاحية</div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">اسم الصلاحية</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" >
                            </div>
                            <button type="submit" class="btn btn-primary">تثبيت التعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection