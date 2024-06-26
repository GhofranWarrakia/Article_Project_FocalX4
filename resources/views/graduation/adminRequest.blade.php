<!DOCTYPE html>
<html>
<head>
    <title>طلبات الترقية</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: rgb(23, 18, 10);
            color: white;
        }
    </style>
</head>
<body>
    <h1>قائمة طلبات المستخدمين للترقية</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>اسم المستخدم</th>
                <th>ايميل المستخدم</th>
                <th>سبب الترقية</th>
                <th>حالة الطلب</th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->user_id }}</td>
                <td>{{ $request->name }}</td>
                <td>{{ $request->email }}</td>
                <td>{{ $request->reason }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <form action="{{ route('role.request.handle', $request->id) }}" method="POST">
                        @csrf
                        <button type="submit" name="action" value="approve"  style="background-color: rgb(255, 183, 0); color: white; border: 2px solid rgb(22, 26, 21); padding: 12px 24px;">تأكيد الترقية</button>
                        <button type="submit" name="action" value="deny" style="background-color: black; color: white;border: 2px solid black; padding: 12px 24px;">رفض الترقية</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>