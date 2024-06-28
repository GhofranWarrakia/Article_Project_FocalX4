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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                <h4 class="content-title mb-0 my-auto">قائمة المقالات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                        <!-- Category Filter -->
                        <form method="GET" action="{{ route('article.index2') }}">
    <div class="form-group">
        <label for="category_id">البحث عن مقالة حسب النوع:</label>
        <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()">
            <option value="" {{ $selectedCategory = '' ? 'selected' : '' }}>-- جميع المقالات --</option>
            <option value="favorites" {{ $selectedCategory = 'favorites' ? 'selected' : '' }}>المقالات المفضلة</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $selectedCategory = $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</form>
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
        <td><a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></td>
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

    <a href="{{ route('article.show', $article->id) }}" class="btn btn-outline-primary btn-sm">فتح المقالة</a>

    @if(Auth::user()->favorites->contains($article->id))
    <form action="{{ route('article.unfavorite', $article->id) }}" method="post" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-outline-warning btn-sm" id="favoriteBtn{{$article->id}}" 
                onmouseover="this.innerHTML='ازالة'" 
                onmouseout="this.innerHTML=' مفضلة'">
            <i class="fas fa-heart-broken"></i> مفضلة
        </button>
    </form>
@else
    <form action="{{ route('article.favorite', $article->id) }}" method="post" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-outline-info btn-sm" id="favoriteBtn{{$article->id}}" 
                onmouseover="this.innerHTML='اضف للمفضلة'" 
                onmouseout="this.innerHTML='  اضافة للمفضلة'">
            <i class="far fa-heart"></i>  غير المفضلة
        </button>
    </form>
@endif

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
                    <form action="{{ route('article.storeWithId' ,'$id') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                        <div class="form-group">
                        <label for="title">عنوان المقالة</label>
                     <input type="text" class="form-control" id="title" name="title" required>
                        </div>
        <div class="form-group">
            <label for="user_id">الكاتب</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">نوع المقالة</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">المحتوى</label>
            <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="photo">الصورة المرفقة</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
</form>

                </div>
            </div>
        </div>

        <!-- Modal for editing article -->
        <div class="modal fade" id="edit_article" tabindex="-1" role="dialog" aria-labelledby="editArticleLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArticleLabel">تعديل المقالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('article.update', 'test') }}" method="post" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">عنوان المقالة</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <input type="hidden" class="form-control" id="pro_id" name="pro_id">
                            </div>
                            <div class="form-group">
                                <label for="edit_user_id">الكاتب</label>
                                <select class="form-control" id="edit_user_id" name="user_id" required>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_id">نوع المقالة</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">المحتوى</label>
                                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">الصورة المرفقة</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                <img id="edit_photo_preview" src="#" alt="معاينة الصورة" style="max-width: 100px; display: none;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Modal for deleting article -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المقالة</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('article.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <input class="form-control" name="title" id="title" type="text" readonly>
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
    <!-- row closed -->
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
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

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
            modal.find('.modal-body #title').val(title)
            modal.find('.modal-body #pro_id').val(pro_id)
            modal.find('.modal-body #category_id').val(category_id)
            modal.find('.modal-body #edit_user_id').val(user_id)
            modal.find('.modal-body #body').val(body)
            modal.find('.modal-body #edit_photo_preview').attr('src', '{{ asset('images') }}/' + photo).show()
        })

        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var title = button.data('title')
            var modal = $(this)
            modal.find('.modal-body #pro_id').val(pro_id)
            modal.find('.modal-body #title').val(title)
        })
    </script>
@endsection
