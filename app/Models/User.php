<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Article;
use App\Models\RoleRequest;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_number',
        'country',
        'roles_name',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
        
    ];


    public function articles()
{
    return $this->hasMany(Article::class);
}

public function blockedUsers()
    {
        return $this->hasMany(Block::class, 'blocker_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Article::class, 'favorites');
    }
    public function roleRequests()
    {
        return $this->hasMany(RoleRequest::class);
    }

    protected $guarded = [];

    public function roles_name()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_name');
    }


    public function scopeWriters($query)
    {
        return $query->where('roles', 'author');
    
}
}