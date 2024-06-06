<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'comment',
        'user_id',
        'article_id',
    ];

    public function commenter()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function article_comment()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

}
