<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= auth()->user();

        if($user->can('view-category')){

            $postCategories = PostCategory::orderBy('created_at', 'desc')->paginate(15);
            return view('admin.content.category.index', compact('postCategories'));

        }
        else{

            abort(403);

        }

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.category.create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryRequest $request, ImageService $imageService )
    { 
        $inputs = $request->all();

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR);
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $imageService->setNameImage($request->file('image'));
            $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $inputs['image'] = $fullImagePath;

            if(!$resultUpload){

                return redirect()->route('admin.market.category.index')->with('swal-error','خطا در آپلود تصویر!');

            }
    }
            PostCategory::create($inputs);
            return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی مورد نظر با موفقیت ثبت شد');
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory)
    {

        return view('admin.content.category.edit', compact('postCategory'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryRequest $request, ImageService $imageService , PostCategory $postCategory)
    {        
        $inputs = $request->all();

        if($request->hasFile('image')){

            $imageService->setPathImage('images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR);
            $imageService->setNameImage($request->file('image'));
            $imageService->checkExistsDirectory(public_path($imageService->getPathImage()));
            $resultUpload= $imageService->saveImageToPublic($request->file('image'), $request->size);
            $fullImagePath= $imageService->fullPath();
            $imageService->deleteImage($postCategory->image);
            $inputs['image'] = $fullImagePath;


            if(!$resultUpload){

                return redirect()->route('admin.market.category.index')->with('swal-error','خطا در آپلود تصویر!');

            }
        }

        $inputs['slug']= null;
        $postCategory->update($inputs);

        return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی با موفقیت ویرایش شد');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }



    public function status(PostCategory $postCategory)
    {

        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        //update status column in table database by save method
        $result = $postCategory->save();

        if ($result) {
            if ($postCategory->status == 0) {
                //after save status if status equal 0 , checked equal false and send json response to ajax java script for handle
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                //after save status if status equal 1 , checked equal true and send json response to ajax java script for handle
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {

            return response()->json(['status' => false]);
        }
    }
}
