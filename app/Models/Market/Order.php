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

    protected $guarded= ['id'];

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


    public function paymentStatus(){

        $paymentSts= $this->payment_status;
        $status = '';

        if(auth()->check()){

            if($paymentSts == 0){

                $status = 'پرداخت نشده';

            }
            if($paymentSts == 1){

                $status = 'پرداخت شده';

            }
            if($paymentSts == 2){

                $status = 'لغو شده';

            }
            if($paymentSts == 3){

                $status = 'برگشت داده شده';

            }

            return $status;

        }

    }

}
