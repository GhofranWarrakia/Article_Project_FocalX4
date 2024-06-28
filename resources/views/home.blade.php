@extends('layouts.master')
@section('title')
موقع المقالات
@endsection
@section('css')
<style>
    .page-header {
        background-image: url('{{ asset('images/photo_2024-06-15_02-45-28.jpg') }}');
        background-size: 70%;
        background-position: center;
        background-color: #f0f0f0;
        padding: 20px;
        position: relative;
        height: 580px;
    }

    .text-overlay {
        position: absolute;
        top: 30%;
        right: 25%; 
        text-align: right; 
        color: #111;
        padding: 20px;
        max-width: 60%;
    }

    .text-overlay h2 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .text-overlay p {
        font-size: 18px;
        line-height: 1.6;
        color: #666;
    }
</style>
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-header">
    <div class="text-overlay">
        <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبًا بك في موقع المقالات 📚📝😊</h2>
        <p>استكشف مجموعتنا المتنوعة من المقالات الشيقة.</p>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')

@endsection
@section('js')

@endsection