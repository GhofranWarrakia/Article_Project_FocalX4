@extends('layouts.master')
@section('title')
المستخدمين
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
@if(session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">قائمة المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
</div>

<!-- breadcrumb -->
@endsection
@section('content')
<h1></h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Post Form -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة مستخدم</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">الرقم التسلسلي</th>
                                <th class="border-bottom-0">الاسم</th>
                                <th class="border-bottom-0">الرقم الوطني</th>
                                <th class="border-bottom-0">الدولة</th>
                                <th class="border-bottom-0">الايميل</th>
                                <th class="border-bottom-0">حالة المستخدم</th>
                                <th class="border-bottom-0">نوع المستخدم </th>
                                <th class="border-bottom-0">الاجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($user as $users)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->national_number }}</td>
                                    <td>{{ $users->country }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->status }}</td>
                                    <td>
                                        @if(is_array($users->roles_name))
                                            {{ implode(', ', $users->roles_name) }}
                                        @else
                                            {{ $users->roles_name }}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-id="{{ $users->id }}" data-name="{{ $users->name }}"
                                           data-national_number="{{ $users->national_number }}" data-toggle="modal" href="#exampleModal2"
                                           data-country="{{ $users->country }}" data-email="{{ $users->email }}"
                                           data-password="{{ $users->password }}"
                                           title="تعديل"><i class="las la-pen"></i></a>
                                           
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-id="{{ $users->id }}" data-name="{{ $users->name }}" data-toggle="modal"
                                           href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">أضف مستخدم جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail">اسم المستخدم</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">الايميل</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">كلمة السر</label>
                                <input type="text" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">الرقم الوطني</label>
                                <input type="text" class="form-control" id="national_number" name="national_number" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">الدولة</label>
                                <input type="text" class="form-control" id="country" name="country" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">حالة المستخدم</label>
                                {{-- <input type="text" class="form-control" id="country" name="country" required> --}}
                                <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                                    <option value="مفعل">مفعل</option>
                                    <option value="غير مفعل">غير مفعل</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">صلاحية المستخدم</label>
                                {{-- <input type="text" class="form-control" id="country" name="country" required> --}}
                                {{-- {!! Form::select('roles_name[]', $roles,[], ['class' => 'form-control', 'multiple']) !!} --}}
                                {{-- {!! Form::select('roles_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!} --}}
                                {{-- <label for="exampleInputEmail">صلاحية المستخدم</label>
                                <select name="roles_name[]" class="form-control" multiple>
                                @foreach($roles as $roleId => $roleName)
                                <option value="{{ $roleId }}">{{ $roleName }}</option>
                                @endforeach
                                </select>
                                --}}
                                <select name="roles_name[]" class="form-control" multiple>
                                @foreach($roles as $roleId => $roleName)
                                    <option value="{{ $roleId }}" {{ in_array($roleId, old('roles_name', [])) ? 'selected' : '' }}>{{ $roleName }}</option>
                                @endforeach
                            </select>
                            {{-- @foreach($users->roles_name as $role)
                            {{ $role->name }}
                        @endforeach --}}
                        
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-primary" type="submit">تأكيد</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل المستخدم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.update', 'id') }}" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label">اسم المستخدم:</label>
                                <input class="form-control" name="name" id="name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">الرقم الوطني:</label>
                                <textarea class="form-control" id="national_number" name="national_number"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">الدولة:</label>
                                <textarea class="form-control" id="country" name="country"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">الايميل:</label>
                                <textarea class="form-control" id="email" name="email"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تأكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>

        <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('users.destroy', 'id') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="name" id="name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<!-- JavaScript to populate the modal with user data for editing -->
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var national_number = button.data('national_number');
        var country = button.data('country');
        var email = button.data('email');
        var password = button.data('password');
        
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #national_number').val(national_number);
        modal.find('.modal-body #country').val(country);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #password').val(password);
    });
</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })
</script>

@endsection
