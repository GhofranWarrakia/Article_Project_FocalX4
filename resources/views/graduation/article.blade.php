@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
    <style>
        .article-body {
            max-width: 300px; /* تعديل العرض حسب الحاجة */
            height: 4.5em; /* تقريبا 3 أسطر */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            white-space: normal;
        }
        .article-body:hover {
            overflow-y: auto; /* تمكين التمرير */
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المقالات </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if(session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i>&nbsp; اضافة مقالة
                        </button>
                       
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">عنوان المقالة</th>
                                    <th class="border-bottom-0">نوع المقالة</th>
                                    <th class="border-bottom-0">الكاتب</th>
                                    <th class="border-bottom-0">المحتوى</th>
                                    <th class="border-bottom-0">الصورة المرفقة</th>
                                    <th class="border-bottom-0">الخيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0 ?>
                            @foreach($articles as $article)
                            <?php $i++ ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$article->title}}</td>
                                    <td>{{ $article->category->name ?? 'غير محدد' }}</td>
                                    <td>{{ $article->user->name ?? 'غير محدد' }}</td>
                                    <td class="article-body">{{$article->body}}</td>
                                    <td><img src="{{ asset('images/' . $article->photo) }}" alt="صورة المقالة" style="max-width: 100px;"></td>
                                    <td>
                                            <button class="btn btn-outline-success btn-sm"
                                                data-title="{{ $article->title }}" data-pro_id="{{ $article->id }}"
                                                data-category_id="{{ $article->category->id ?? '' }}"
                                                data-user_id="{{ $article->user->id ?? '' }}"
                                                data-body="{{$article->body }}"
                                                data-photo="{{$article->photo }}"
                                                data-toggle="modal"
                                                data-target="#edit_article">تعديل</button>

                                            <button class="btn btn-outline-danger btn-sm " data-pro_id="{{ $article->id }}"
                                                data-title="{{ $article->title }}" data-toggle="modal"
                                                data-target="#modaldemo9">حذف</button>
                                        </td>
                                </tr>
                               @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for adding article -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة مقالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">عنوان المقالة</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">نوع المقالة</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled>-- حدد النوع --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id">الكاتب</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="" selected disabled>-- حدد الكاتب --</option>
                                    @foreach ($authors as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">نص المقالة</label>
                                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">ارفاق صورة</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">تاكيد</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for adding category
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">اضافة تصنيف جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">اسم التصنيف</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

        <!-- Modal for editing article -->
        <div class="modal fade" id="edit_article" tabindex="-1" role="dialog" aria-labelledby="editArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArticleModalLabel">تعديل المقالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('article.update','test') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="modal-body">
                            <input type="hidden" name="pro_id" id="pro_id">
                            <div class="form-group">
                                <label for="title">عنوان المقالة</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">نوع المقالة</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id">الكاتب</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach ($authors as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">نص المقالة</label>
                                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">تغيير الصورة</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">تاكيد</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for deleting article -->
        <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المقالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('article.destroy','test') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <input class="form-control" name="title" id="title" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        </div>
                    </form>
                </div>
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

<script>
    $('#edit_article').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var title = button.data('title')
        var pro_id = button.data('pro_id')
        var category_id = button.data('category_id')
        var user_id = button.data('user_id')
        var body = button.data('body')
        var photo = button.data('photo')
        var modal = $(this)
        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #pro_id').val(pro_id);
        modal.find('.modal-body #category_id').val(category_id);
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #body').val(body);
        modal.find('.modal-body #photo').val(photo);
    })
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var pro_id = button.data('pro_id')
        var title = button.data('title')
        var modal = $(this)
        modal.find('.modal-body #pro_id').val(pro_id);
        modal.find('.modal-body #title').val(title);
    })
</script>

@endsection
