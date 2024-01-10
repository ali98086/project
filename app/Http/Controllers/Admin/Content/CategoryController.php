<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postCategories= PostCategory::orderBy('created_at','desc')->paginate(15);
        return view('admin.content.category.index', compact('postCategories'));
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
    public function store(PostCategoryRequest $request)
    {
        $inputs= $request->all();
        $inputs['slug']= str_replace('','-',$inputs['name']).'-'.Str::random(5);
        $inputs['image']='image';
        PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی مورد نظر با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {
        //
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
    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $inputs= $request->all();
        $inputs['image']= 'image';
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی با موفقیت حذف شد');
    }

    public function status(PostCategory $postCategory){

        $postCategory->status= $postCategory->status == 0 ? 1 : 0;
        //update status column in table database by save method
        $result= $postCategory->save();

        if($result){
            if($postCategory->status == 0){
                //after save status if status equal 0 , checked equal false and send json response to ajax java script for handle
                return response()->json(['status'=> true , 'checked'=> false]);
            }
            else{
                //after save status if status equal 1 , checked equal true and send json response to ajax java script for handle
                return response()->json(['status'=> true , 'checked'=> true]);
            }
        }
        else{

            return response()->json(['status'=> false]);

        }

    }
}
