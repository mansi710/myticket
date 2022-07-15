<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Comment extends Model
{
    use HasFactory,Notifiable,Sortable;
    protected $table='comments';

    protected $fillable=[
        'ticket_id',
        'user_id',
        'comment_name',
        'getTicket'
        
    ];

    public $sortable = ['id', 'ticket_id', 'user_id','comment_name'];

    public function getTicket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

  
}
