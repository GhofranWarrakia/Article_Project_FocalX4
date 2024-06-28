@extends('layouts.master')

@section('title', 'طلب الترقية')

@section('content')
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .alert {
            padding: 10px;
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            margin-bottom: 15px; /* Some space below the alert */
            border-radius: 5px; /* Rounded corners */
            font-family: Arial, sans-serif; /* Font style */
        }

        .alert-danger {
            background-color: #f44336; /* Red background */
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; /* Optional: Set a background color */
        }

        .form-container {
            width: 100%; /* Adjust the width as needed */
            max-width: 900px; /* Optional: Limit the maximum width of the form */
            padding: 110px;
            background-color: #ffffff; /* Optional: Set a background color */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add a box shadow */
            text-align: right; /* Right align text in form */
        }

        textarea {
            width: 100%;
            height: 150px; /* Adjust the height as needed */
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical; /* Allow vertical resizing of the textarea */
        }

        button[type="submit"] {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <br><br>
    <div class="form-container">
        <h2 style="text-align: center; color: orange;">فورم طلب الترقية</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('role.request') }}" method="POST">
            @csrf
            <div>
                <label for="reason">الرجاء ادخال سبب طلب الترقية مرفقا اسماء الكتب والمقالات التي قد قمت سابقا بكتابتها</label><br><br>
                <textarea name="reason" id="reason" required></textarea>
            </div><br>
            <button type="submit">إرسال الطلب</button>
        </form>
    </div>
</body>
</html>
@endsection
