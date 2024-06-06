<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
    ];

    public function favorite_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function favorite_article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

}
