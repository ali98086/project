<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= Product::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.product.index', compact('products'));
    }



    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories= ProductCategory::all();
        $brands= Brand::all();
        return view('admin.market.product.create', compact('productCategories','brands'));
    }



    
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {  
        $inputs= $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR);
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $imageService->setNameImage($request->file('image'));

        }
            $fullImagePath= $imageService->fullPath();
            $inputs['image'] = $fullImagePath;
            
        DB::transaction(function() use ($request , $inputs, $imageService){


            $product= Product::create($inputs);

            $metas= array_combine($request->meta_key, $request->meta_value);

            foreach($metas as $key=>$value){

                ProductMeta::create([
                    'meta_key'=>$key ,
                    'meta_value'=>$value,
                    'product_id'=>$product->id
                ]);

            }

            $imageService->saveImageToPublic($request->file('image'), $request->size);
        });

            return redirect()->route('admin.market.product.index')->with('swal-success','کالای مورد نظر با موفقیت ایجاد شد');

    }



    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productCategories= ProductCategory::all();
        $brands= Brand::all();
        return view('admin.market.product.edit', compact('product','productCategories','brands'));
    }



    
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, ImageService $imageService, Product $product)
    {

        $inputs= $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR);
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $imageService->setNameImage($request->file('image'));
            
            DB::transaction(function() use ($request , $inputs, $product, $imageService){

                $fullImagePath= $imageService->fullPath();
                $inputs['image'] = $fullImagePath;
                $product->update($inputs);

                $metas= array_combine($request->meta_key, $request->meta_value);

                foreach($metas as $key=>$value){
                    
                    ProductMeta::where('product_id', $product->id)->update([
                        'meta_key'=>$key ,
                        'meta_value'=>$value,
                        'product_id'=>$product->id
                    ]);

                }

                $imageService->saveImageToPublic($request->file('image'), $request->size);
            });
        }
        else{

            if($request->meta_key != null){

            DB::transaction(function() use ($request , $inputs, $product){

            $product->update($inputs);

            $meta_ids = array_keys($request->meta_key);
            $meta_keys = $request->meta_key;
            $meta_values = $request->meta_value;

            $metas= array_map(function($meta_ids, $meta_keys, $meta_values){

                return array_combine(

                    ['meta_id', 'meta_key', 'meta_value'],

                    [$meta_ids, $meta_keys, $meta_values]
                    
                    );

            } , $meta_ids, $meta_keys, $meta_values);

            // dd($metas);
            foreach($metas as $meta){
                
                ProductMeta::where('id', $meta['meta_id'])->update(
                    
                    [

                    'meta_key'=>$meta['meta_key'] ,
                    'meta_value'=>$meta['meta_value'],

                    ]);

            }

        });
    }
    }

        return redirect()->route('admin.market.product.index')->with('swal-success','کالای مورد نظر با موفقیت ویرایش شد');

    }



    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success','کالای مورد نظر با موفقیت حذف شد');
    }
}
