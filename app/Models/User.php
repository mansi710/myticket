<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Comment;
use App\Models\Ticket

;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        
        'name',
        'email',
        'password',
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
    ];


    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class,'user_id');
    }


    public function get_notifications()
    {
        return $this->hasMany(User::class);
    }
    // public static function boot()
    // {
    //     parent::boot();
    //      static::updated(function ($users) {
    //     if ($users->ticket->status == 'active') {
    //         event(new TicketStatusChangeEvent($user));
    //     }
    // });
    // }
}
