<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\BannerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{


    public function index(){

        $banners= Banner::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.content.banner.index', compact('banners'));

    }



    public function create(){

        $positions = Banner::$positions;
        return view('admin.content.banner.create' , compact('positions'));

    }



    public function store(BannerRequest $request, ImageService $imageService){

        $inputs = $request->all();

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.'banners'.DIRECTORY_SEPARATOR);
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $imageService->setNameImage($request->file('image'));
            $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $inputs['image'] = $fullImagePath;

            if(!$resultUpload){

                return redirect()->route('admin.content.banner.index')->with('swal-error','خطا در آپلود تصویر!');

            }
    }

        Banner::create($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success','بنر مورد نظر با موفقیت ایجاد شد');


    }



    public function edit(Banner $banner){

        $positions= Banner::$positions;
        return view('admin.content.banner.edit' , compact('banner', 'positions'));

    }




    public function update(Banner $banner, BannerRequest $request, ImageService $imageService){

        $inputs= $request->all();

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.'banners'.DIRECTORY_SEPARATOR);
            $imageService->setNameImage($request->file('image'));
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $imageService->deleteImage($banner->image);
            $inputs['image'] = $fullImagePath;


            if(!$resultUpload){

                return redirect()->route('admin.market.brand.index')->with('swal-error','خطا در آپلود تصویر!');

            }
        }

        $banner->update($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success','بنر مورد نظر با موفقیت ویرایش شد');


    }



    public function status(Banner $banner){

        $banner->status = $banner->status == 0 ? 1 : 0;
        $result = $banner->save();

        if ($result) {
            if ($banner->status == 0) {

                return response()->json(['status' => true, 'checked' => false]);
            } else {

                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {

            return response()->json(['status' => false]);
        }

    }



    public function destroy(Banner $banner){

        $banner->delete();
        return redirect()->route('admin.content.banner.index')->with('swal-success','بنر مورد نظر با موفقیت حذف شد');

    }
}
