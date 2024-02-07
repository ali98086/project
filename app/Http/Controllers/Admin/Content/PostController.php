<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postCategories= PostCategory::all();
        return view('admin.content.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $inputs= $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        if(!File::isDirectory(public_path('images'.DIRECTORY_SEPARATOR.'posts'))){

            File::makeDirectory(public_path('images'.DIRECTORY_SEPARATOR.'posts'),0755,true); 

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
            $img->save(public_path('images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$imageName));
            $imagePath = 'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$imageName;
            $inputs['image'] = $imagePath;

    }

        $inputs['author_id']= 1;

        Post::create($inputs);
        return redirect()->route('admin.content.post.index')->with('swal-success','پست مورد نظر با موفقیت ثبت شد');
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
    public function edit(Post $post)
    {
        $postCategories= PostCategory::all();
        return view('admin.content.post.edit', compact('post','postCategories'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $inputs = $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        if($request->hasFile('image')){


            unlink(public_path($post->image));
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
            $img->save(public_path('images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$imageName));
            $imagePath = 'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$imageName;
            $inputs['image'] = $imagePath;

        }
        else{

            $request['image']= $post->image;
            $manager = new ImageManager(new Driver()); 
            $img = $manager->read($request->image); 
            $format = Str::of($request->image)->after('.');
            $imageName = uniqid() . '.' . $format;

            if($request->size){
            
                unlink(public_path($post->image));    

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
            $img->save(public_path('images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$imageName));
            $imagePath = 'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$imageName;
            $inputs['image'] = $imagePath;

    }
    $inputs['slug']= null;
    $post->update($inputs);
    return redirect()->route('admin.content.post.index')->with('swal-success','پست با موفقیت ویرایش شد');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.content.post.index')->with('swal-success','پست مورد نظر با موفقیت حذف شد');
    }

    public function status(Post $post){

        $post->status= $post->status == 0 ? 1 : 0 ;
        $result= $post->save();

        if($result){
            if($post->status == 0){

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

    public function commentable(Post $post){

        $post->commentable= $post->commentable == 0 ? 1 : 0 ;
        $result= $post->save();

        if($result){
            if($post->commentable == 0){

                return response()->json(['commentable'=> true , 'checked'=> false]);

            }
            else{

                return response()->json(['commentable'=> true , 'checked'=>true]);

            }


        }
        else{

            return response()->json(['commentable'=> false]);

        }

    }

}
