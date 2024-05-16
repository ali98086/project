<?php

namespace App\Models\Market;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashPayment extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded= ['id'];

    public function payments(){

        return $this->morphMany(Payment::class, 'paymentable');

    }

}
