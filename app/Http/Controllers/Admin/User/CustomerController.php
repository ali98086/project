<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CustomerRequest;
use App\Http\Services\File\FileService;
use App\Models\User\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users= User::where('user_type', 0)->orderBy('id','desc')->get();
        return view('admin.user.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request, FileService $fileService)
    {
        $inputs= $request->all();

        if($request->hasFile('profile_photo_path')){

            $fileService->checkExistsDirectory(public_path('images'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.'profile-photos'.DIRECTORY_SEPARATOR));
            $fileService->setPathFile('images'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.'profile-photos'.DIRECTORY_SEPARATOR);
            $fileService->setNameFile($request->file('profile_photo_path'));
            $resultUpload= $fileService->saveFileToPublic($request->file('profile_photo_path'));
            $fullFilePath= $fileService->fullPath();
            $inputs['profile_photo_path'] = $fullFilePath;

            if(!$resultUpload){

                return redirect()->route('admin.user.customer.index')->with('swal-error','خطا در آپلود تصویر!');

            }
    }

        $inputs['user_type'] = 0 ;
        $inputs['password']= Hash::make($request->password);
        User::create($inputs);

        $details= ['message' => 'یک کاربر جدید ثبت نام کرد'];
        $adminUser= User::find(1);
        $adminUser->notify(new NewUserRegistered($details));
        
        return redirect()->route('admin.user.customer.index')->with('swal-success','کاربر مشتری جدید با موفقیت ثبت شد');
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
    public function edit(User $user)
    {
        return view('admin.user.customer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, User $user, FileService $fileService)
    {
        $inputs= $request->all();

        if($request->hasFile('profile_photo_path')){


            $fileService->deleteFile($user['profile_photo_path']);
            $fileService->setPathFile('images'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.'profile-photos'.DIRECTORY_SEPARATOR);
            $fileService->setNameFile($request->file('profile_photo_path'));
            $resultUpload= $fileService->saveFileToPublic($request->file('profile_photo_path'));
            $fullFilePath= $fileService->fullPath();
            $inputs['profile_photo_path'] = $fullFilePath;

            if(!$resultUpload){

                return redirect()->route('admin.user.customer.index')->with('swal-error','خطا در آپلود تصویر!');

            }
    }

        $user->update($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success','کاربر مشتری مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user , FileService $fileService)
    {
        $delete= $user->forceDelete();
        
        if($delete){

            $fileService->deleteFile($user->profile_photo_path);

        }

        return redirect()->route('admin.user.customer.index')->with('swal-success','کاربر مشتری مورد نظر با موفقیت حذف شد');
    }


    public function activation(User $user){

        $user->activation= $user->activation == 0 ? 1 : 0 ;
        $result= $user->save();

        if($result){
            if($user->activation == 0){

                return response()->json(['activation'=> true , 'checked'=> false]);

            }
            else{

                return response()->json(['activation'=> true , 'checked'=>true]);

            }


        }
        else{

            return response()->json(['activation'=> false]);

        }

    }

    public function status(User $user){

        $user->status= $user->status == 0 ? 1 : 0 ;
        $result= $user->save();

        if($result){
            if($user->status == 0){

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
