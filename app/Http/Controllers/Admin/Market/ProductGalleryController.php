<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create', compact('product'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $request->validate([
            'image'=>'required|image|mimes:png,jpg,jpeg,gif'
        ]);

        $inputs= $request->all();

        if($request->hasFile('image')){

        $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'product_galleries'.DIRECTORY_SEPARATOR);
        $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
        $imageService->setNameImage($request->file('image'));
        $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
        $fullImagePath= $imageService->fullPath();
        $inputs['image'] = $fullImagePath;

        if(!$resultUpload){

            return redirect()->route('admin.market.product.gallery.index', $product->id)->with('swal-error','خطا در آپلود تصویر!');

        }
    }

        $inputs['product_id']= $product->id;
        ProductGallery::create($inputs);

        return redirect()->route('admin.market.product.gallery.index', $product->id)->with('swal-success','عکس مورد نظر با موفقیت ایجاد شد');

    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product,ProductGallery $productGallery)
    {
        $productGallery->delete();
        return redirect()->route('admin.market.product.gallery.index', $product->id)->with('swal-success','عکس مورد نظر با موفقیت حذف شد');

    }
}
