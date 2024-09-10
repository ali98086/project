<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Copan;
use App\Models\Market\Product;
use App\Models\User\User;
use Illuminate\Http\Request;

class DiscountController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function copan()
    {
        $copans= Copan::all();
        return view('admin.market.discount.copan', compact('copans'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function copanCreate()
    {
        $users= User::all();
        return view('admin.market.discount.copan-create', compact('users'));
    }



    public function copanDiscountStore(CopanRequest $request)
    {
        $inputs= $request->all();
        $realTimeStampStartDate= substr($request->start_date, 0, 10);
        $realTimeStampEndDate= substr($request->end_date, 0, 10);
        $inputs['start_date']= date('Y-m-d H:i:s', $realTimeStampStartDate);
        $inputs['end_date']= date('Y-m-d H:i:s', $realTimeStampEndDate);

        if($inputs['type'] == 0){

            $inputs['user_id']= null;

        }

        Copan::create($inputs);
        return redirect()->route('admin.market.discount.copanDiscount')->with('swal-success','کوپن تخفیف جدید با موفقیت ایجاد شد');

    }



    public function copanDiscountEdit(Copan $copan)
    {

        $users= User::all();
        return view('admin.market.discount.copan-edit', compact('users','copan'));

    }



    public function copanDiscountUpdate(CopanRequest $request , Copan $copan)
    {
        $inputs= $request->all();
        $realTimeStampStartDate= substr($request->start_date, 0, 10);
        $realTimeStampEndDate= substr($request->end_date, 0, 10);
        $inputs['start_date']= date('Y-m-d H:i:s', $realTimeStampStartDate);
        $inputs['end_date']= date('Y-m-d H:i:s', $realTimeStampEndDate);

        if($inputs['type'] == 0){

            $inputs['user_id']= null;
            
        }

        $copan->update($inputs);
        return redirect()->route('admin.market.discount.copanDiscount')->with('swal-success','کوپن تخفیف مورد نظر با موفقیت ویرایش شد');

    }




    public function copanDiscountDestroy(Copan $copan)
    {
        $copan->delete();
        return redirect()->route('admin.market.discount.copanDiscount')->with('swal-success','کوپن تخفیف مورد نظر با موفقیت حذف شد');
    }





    public function commonDiscount()
    {
        $commonDiscounts= CommonDiscount::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.common', compact('commonDiscounts'));
    }




    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-create');
    }




    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs= $request->all();
        $realTimeStampStartDate= substr($request->start_date, 0, 10);
        $realTimeStampEndDate= substr($request->end_date, 0, 10);
        $inputs['start_date']= date('Y-m-d H:i:s', $realTimeStampStartDate);
        $inputs['end_date']= date('Y-m-d H:i:s', $realTimeStampEndDate);

        CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی جدید با موفقیت ایجاد شد');
    }




    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common-edit' , compact('commonDiscount'));
    }




    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs= $request->all();
        $realTimeStampStartDate= substr($request->start_date, 0, 10);
        $realTimeStampEndDate= substr($request->end_date, 0, 10);
        $inputs['start_date']= date('Y-m-d H:i:s', $realTimeStampStartDate);
        $inputs['end_date']= date('Y-m-d H:i:s', $realTimeStampEndDate);

        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی مورد نظر با موفقیت ویرایش شد');
    }




    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی مورد نظر با موفقیت حذف شد');
    }
    



  
    public function amazingSale()
    {
        $amazingSales= AmazingSale::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.amazing', compact('amazingSales'));
    }




    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-create', compact('products'));
    }




    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs= $request->all();
        $realTimeStampStartDate= substr($request->start_date, 0, 10);
        $realTimeStampEndDate= substr($request->end_date, 0, 10);
        $inputs['start_date']= date('Y-m-d H:i:s', $realTimeStampStartDate);
        $inputs['end_date']= date('Y-m-d H:i:s', $realTimeStampEndDate);

        AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success','فروش شگفت انگیز کالا با موفقیت ایجاد شد');
    }




    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs= $request->all();
        $realTimeStampStartDate= substr($request->start_date, 0, 10);
        $realTimeStampEndDate= substr($request->end_date, 0, 10);
        $inputs['start_date']= date('Y-m-d H:i:s', $realTimeStampStartDate);
        $inputs['end_date']= date('Y-m-d H:i:s', $realTimeStampEndDate);

        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success','فروش شگفت انگیز کالا با موفقیت ویرایش شد');
    }




    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-edit', compact('products', 'amazingSale'));
    }




    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale.destroy')->with('swal-success','فروش شگفت انگیز کالا با موفقیت حذف شد');
    }
}
