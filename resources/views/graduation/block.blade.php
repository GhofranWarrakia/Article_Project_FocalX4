@extends('layouts.master')

@section('title', ' حظر المستخدمين' )

@section('content')
   <br><br> <h1 style="color: orange;" > حظر المستخدمين</h1>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table">
       <br><br> <thead>
            <tr>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>الاجراء المتبع</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(in_array($user->id, $blockedUsers))
                            <form action="{{ route('block.unblock') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="blocked_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger"  style="background-color: black;">إزالة الحظر</button>
                            </form>
                        @else
                            <form action="{{ route('block.block') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="blocked_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary"  style="background-color: orange;">حظر المستخدم</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection