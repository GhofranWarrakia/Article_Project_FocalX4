<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'email', 'reason', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
