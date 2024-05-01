<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\Guarantee;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    

    public function index(Product $product){

        $guarantees = Guarantee::all();
        return view('admin.market.product.guarantee.index' , compact('product', 'guarantees'));

    }


    public function create(Product $product){

        return view('admin.market.product.guarantee.create', compact('product'));

    }


    public function store(Product $product, Request $request){

        $validate= $request->validate([

            'name' => 'required',
            'price_increase' => 'required|numeric',

        ]);

        $inputs= $request->all();
        $inputs['product_id'] = $product->id;

        Guarantee::create($inputs);
        return redirect()->route('admin.market.product.guarantee.index' , $product->id)->with('swal-success','گارانتی مورد نظر با موفقیت ایجاد شد');


    }


    public function destroy(Product $product , Guarantee $guarantee){

        $guarantee->delete();
        return redirect()->route('admin.market.product.guarantee.index', $product->id)->with('swal-success','گارانتی کالای مورد نظر با موفقیت حذف شد');

    }

}
