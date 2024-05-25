<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Models\Content\PostCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= auth()->user();
        // dd($user->hasRole('operator'));
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
    public function store(PostCategoryRequest $request)
    { 
        $inputs = $request->all();

        if (!File::isDirectory(public_path('images'.DIRECTORY_SEPARATOR.'post-categories'))) {

            File::makeDirectory(public_path('images'.DIRECTORY_SEPARATOR.'post-categories'),0755,true);
        }

        if ($request->hasFile('image')) {
            
            $manager = new ImageManager(new Driver()); 
            $img = $manager->read($request->file('image'));
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            if($request->size == 'small'){
                $img->resize(160,120);
            }
            if($request->size == 'medium'){
                $img->resize(320,240);
            }
            if($request->size == 'large'){
                $img->resize(800,600);
            }
            $img->save(public_path('images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR.$imageName));
            $imagePath = 'images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR.$imageName;
            $inputs['image'] = $imagePath;

        }
            PostCategory::create($inputs);
            return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی مورد نظر با موفقیت ثبت شد');
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
        $inputs = $request->all();

        if($request->hasFile('image')){

            File::delete(public_path($postCategory->image));
            $manager = new ImageManager(new Driver()); 
            $img = $manager->read($request->file('image'));
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            if($request->size == 'small'){
                $img->resize(160,120);
            }
            if($request->size == 'medium'){
                $img->resize(320,240);
            }
            if($request->size == 'large'){
                $img->resize(800,600);
            }
            $img->save(public_path('images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR.$imageName));
            $imagePath = 'images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR.$imageName;
            $inputs['image'] = $imagePath;

        }
        else{

            $request['image']= $postCategory->image;
            $manager = new ImageManager(new Driver()); 
            $img = $manager->read($request->image); 
            $format = Str::of($request->image)->after('.');
            $imageName = uniqid() . '.' . $format;

            if($request->size){
            
                File::delete(public_path($postCategory->image));   

            if($request->size == 'small'){
                $img->resize(160,120);
            }
            if($request->size == 'medium'){
                $img->resize(320,240);
            }
            if($request->size == 'large'){
                $img->resize(800,600);
            }
        }
            $img->save(public_path('images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR.$imageName));
            $imagePath = 'images'.DIRECTORY_SEPARATOR.'post-categories'.DIRECTORY_SEPARATOR.$imageName;
            $inputs['image'] = $imagePath;

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
