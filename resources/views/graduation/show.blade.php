@extends('layouts.master')
@section('content')

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="article-details">
            <img src="{{ asset('images/' . $article->photo) }}" alt="صورة المقالة" style="max-width: 100px; float: right; margin-left: 10px;">
            <h2>
                {{ $article->title }}
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
                                onmouseout="this.innerHTML=' اضافة للمفضلة'">
                            <i class="far fa-heart"></i>  غير المفضلة
                        </button>
                    </form>
                @endif
            </h2>
            <p>{{ $article->body }}</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="comments-section">
            <h3>التعليقات</h3>
            @foreach($comments as $comment)
                <div class="comment mb-3" id="comment-{{ $comment->id }}">
                    <p>{{ $comment->comment }}</p>
                    <small>بواسطة {{ $comment->user->name }} في {{ $comment->created_at }}</small>
                    
                    @if(auth()->check() && auth()->user()->id == $comment->user_id)
                        <button class="btn btn-primary" onclick="editComment({{ $comment->id }})">تعديل</button>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    @endif
                </div>
            @endforeach

            @auth
            <form action="{{ route('comment.store', $article->id) }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="form-group">
                    <label for="comment">إضافة تعليق</label>
                    <textarea class="form-control" id="body" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">إرسال</button>
            </form>
            @endauth
        </div>
    </div>
</div>

<script>
    function editComment(commentId) {
        let commentElement = document.getElementById(`comment-${commentId}`);
        let commentText = commentElement.querySelector('p').innerText;
        let csrfToken = '{{ csrf_token() }}';
        let userId = '{{ auth()->check() ? auth()->user()->id : null }}';
        let commentUserId = commentElement.querySelector('small').innerText.includes('بواسطة {{ auth()->check() ? auth()->user()->name : null }}') ? userId : null;

        if (userId === commentUserId) {
            commentElement.innerHTML =  `
                <form action="/comments/${commentId}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <textarea name="comment" class="form-control small-textarea" required>${commentText}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">تحديث التعليق</button>
                </form>
            ` ;
        }
    }
</script>

@endsection
