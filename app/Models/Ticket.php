<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use App\Models\Comment;
use App\Events\TicketStatusChangeEvent;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory,Sortable,Notifiable;
    protected $guard='tickets';

    protected $fillable=[
        'ticket_name',
        'user_id',
        'status',
        'priority',
        'ticket_message'
    ];

    public $sortable = ['id','user_id', 'ticket_name', 'status','priority','ticket_message', 'created_at', 'updated_at'];

    // public static function search($query, $s)
    // {
    //     return $query->where('ticket_name', 'like', '%'.$s.'%')
    //         ->orwhere('ticket_message', 'like', '%'.$s.'%')
    //         ->orwhere('status', 'like', '%'.$s.'%')
    //         ->orwhere('priority', 'like', '%'.$s.'%')->orwhere('id', '=', '%'.$s.'%');
    // }



    // public $searchable = ['id', 'ticket_name', 'status','priority','ticket_message'];

    // public static function searchable()
    // {
    //     return ['id', 'ticket_name', 'status','priority','ticket_message'];
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class,'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    // public static function boot()
    // {
    //     parent::boot();
    //     static::updated(function ($ticket) {
    //         if ($ticket->status == 'active'|| $ticket->status=="reject") {
    //             event(new TicketStatusChangeEvent($ticket));
    //         }
    //     });
    // }

}
