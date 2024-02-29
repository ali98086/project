<?php

namespace App\Models\Ticket;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAdmin extends Model
{
    use HasFactory;

    protected $fillable= ['user_id','status'];

    public function user(){

        return $this->belongsTo(User::class);

    }
}
