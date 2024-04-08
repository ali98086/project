<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;
use App\Http\Services\File\FileService;
use App\Http\Services\Image\ImageService;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.category.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.category.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request, ImageService $imageService)
    {
        $inputs= $request->all();

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'product_categories'.DIRECTORY_SEPARATOR);
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $imageService->setNameImage($request->file('image'));
            $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $inputs['image'] = $fullImagePath;

            if(!$resultUpload){

                return redirect()->route('admin.market.category.index')->with('swal-error','خطا در آپلود تصویر!');

            }
    }

            ProductCategory::create($inputs);
            return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی مورد نظر با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productcategory)
    {

        $productCategories = ProductCategory::all()->except($productcategory->id);
        return view('admin.market.category.edit', compact('productcategory' , 'productCategories'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productcategory, ImageService $imageService)
    {
        $inputs= $request->all();

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'product_categories'.DIRECTORY_SEPARATOR);
            $imageService->setNameImage($request->file('image'));
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $imageService->deleteImage($productcategory->image);
            $inputs['image'] = $fullImagePath;


            if(!$resultUpload){

                return redirect()->route('admin.market.category.index')->with('swal-error','خطا در آپلود تصویر!');

            }
        }
        $inputs['slug']= null;
        $productcategory->update($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productcategory)
    {
        $productcategory->delete();
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی مورد نظر با موفقیت حذف شد');

    }
}
