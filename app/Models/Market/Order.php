<?php

namespace App\Models\Market;

use App\Models\Address;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function address(){

        return $this->belongsTo(Address::class);

    }

    public function payment(){

        return $this->belongsTo(Payment::class);

    }

    public function delivery(){

        return $this->belongsTo(Delivery::class);

    }

    public function copan(){

        return $this->belongsTo(Copan::class);

    }

    public function commonDiscount(){

        return $this->belongsTo(CommonDiscount::class);

    }

    public function orderItems(){

        return $this->hasMany(OrderItem::class);

    }

}
