<?php



namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.color.index', compact('product'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.color.create', compact('product'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([

            'color_name'=>'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'color_code'=>'required|max:120',
            'price_increase'=>'required|numeric'

        ]);

        $inputs= $request->all();
        $inputs['product_id']= $product->id;
        ProductColor::create($inputs);

        return redirect()->route('admin.market.product.color.index', $product->id)->with('swal-success','رنگ مورد نظر با موفقیت ایجاد شد');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductColor $productColor)
    {
        $productColor->delete();
        return redirect()->route('admin.market.product.color.index', $product->id)->with('swal-success','رنگ مورد نظر با موفقیت حذف شد');
    }
}
