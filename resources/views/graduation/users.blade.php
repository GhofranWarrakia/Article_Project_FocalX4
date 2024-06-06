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
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">قائمة المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    {{-- <div class="row row-sm"> --}}
                        <!--div-->
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة مستخدم</a>
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
                                                    <th class="border-bottom-0">كلمة المرور</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr>        
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

                                            <form action="{{route('users.store')}}" method="post">
                                                {{csrf_field()}}



                                            <div class="form-group">
                                                <label for="exampleTnputEmail">اسم المستخدم</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                        </div>

                                            <div class="form-group">
                                                <label for="exampleTnputEmail">الايميل</label>
                                                <input type="text" class="form-control" id="email" name="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleTnputEmail">كلمة السر</label>
                                            <input type="text" class="form-control" id="password" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleTnputEmail">الرقم الوطني</label>
                                        <input type="text" class="form-control" id="national_number" name="national_number" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTnputEmail">الدولة</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                            </div>


                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" type="submit">تأكيد</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->



                        </div>
                        <!--/div-->
                        </div>
                    </div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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
@endsection