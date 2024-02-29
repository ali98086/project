<?php

namespace App\Models\Ticket;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable= ['subject','description','status','seen','user_id','reference_id','parent_id','category_id','priority_id'];


    public function user(){

        return $this->belongsTo(User::class);

    }

    public function admin(){
        
       return $this->belongsTo(TicketAdmin::class, 'reference_id');

    }

    public function parent(){
        
        return $this->belongsTo(Ticket::class, 'parent_id')->with('parent');
 
     }

     public function children(){
        
        return $this->hasMany(Ticket::class, 'parent_id')->with('children');
 
     }

     public function category(){
        
        return $this->belongsTo(TicketCategory::class);
 
     }

     public function priority(){
        
        return $this->belongsTo(TicketPriority::class);
 
     }
}
