<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands= Brand::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request, ImageService $imageService)
    { 
        $inputs= $request->all();

        if($request->hasFile('logo')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'brands'.DIRECTORY_SEPARATOR);
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $imageService->setNameImage($request->file('logo'));
            $resultUpload= $imageService->saveImageToPublic($request->file('logo'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $inputs['logo'] = $fullImagePath;

            if(!$resultUpload){

                return redirect()->route('admin.market.brand.index')->with('swal-error','خطا در آپلود تصویر!');

            }
    }

        Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند مورد نظر با موفقیت ثبت شد');

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
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs= $request->all();

        if($request->hasFile('logo')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'market'.DIRECTORY_SEPARATOR.'brands'.DIRECTORY_SEPARATOR);
            $imageService->setNameImage($request->file('logo'));
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $resultUpload= $imageService->saveImageToPublic($request->file('logo'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $imageService->deleteImage($brand->logo);
            $inputs['logo'] = $fullImagePath;


            if(!$resultUpload){

                return redirect()->route('admin.market.brand.index')->with('swal-error','خطا در آپلود تصویر!');

            }
        }
        $inputs['slug']= null;
        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند مورد نظر با موفقیت حذف شد');
 
    }


    public function status(Brand $brand){

        $brand->status= $brand->status == 0 ? 1 : 0 ;
        $result= $brand->save();

        if($result){
            if($brand->status == 0){

                return response()->json(['status'=> true , 'checked'=> false]);

            }
            else{

                return response()->json(['status'=> true , 'checked'=>true]);

            }


        }
        else{

            return response()->json(['status'=> false]);

        }

    }
}
