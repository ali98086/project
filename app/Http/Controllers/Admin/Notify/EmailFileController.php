<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Email $email)
    {
        return view('admin.notify.email-files.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Email $email)
    {
        return view('admin.notify.email-files.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs= $request->all();


        if($request->hasFile('file')){

            if($request->placeSave == 'public'){
                
                $fileService->checkExistsDirectory(public_path('files'.DIRECTORY_SEPARATOR.'notify'.DIRECTORY_SEPARATOR.'email-notify'.DIRECTORY_SEPARATOR));
                $fileService->setPathFile('files'.DIRECTORY_SEPARATOR.'notify'.DIRECTORY_SEPARATOR.'email-notify'.DIRECTORY_SEPARATOR);
                $fileService->setNameFile($request->file('file'));
                $resultUpload= $fileService->saveFileToPublic($request->file('file'));
                $fullFilePath= $fileService->fullPath();

            
            if(!$resultUpload){

                return redirect()->route('admin.notify.email-file.index' , $email->id)->with('swal-error','خطا در آپلود فایل!');

            }
        }
        
        else{

            $fileService->setNameFile($request->file('file'));
            $resultUpload= $fileService->saveFileToStorage($request->file('file'));
            $fullFilePath= $fileService->fullPath('storage');

            if(!$resultUpload){

                return redirect()->route('admin.notify.email-file.index' , $email->id)->with('swal-error','خطا در آپلود فایل!');

            }

        }
    }
    
        $inputs['public_mail_id']= $email->id;
        $inputs['file_path']= $fullFilePath;
        $inputs['file_size']= $fileService->getSizeFile($fullFilePath, $request->placeSave);
        $inputs['file_type']= $fileService->getFormatFile($request->file('file'));

        EmailFile::create($inputs);

        return redirect()->route('admin.notify.email-file.index' , $email->id)->with('swal-success','فایل مورد نظر با موفقیت اضافه شد');

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
    public function edit(EmailFile $file)
    {
        return view('admin.notify.email-files.edit' , compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailFileRequest $request, EmailFile $file)
    {
        $inputs= $request->all();

        if($request->hasFile('file')){

            File::delete(public_path($file->file_path));
            $filePath = 'files'.DIRECTORY_SEPARATOR.'notify'.DIRECTORY_SEPARATOR.'email-notify'.DIRECTORY_SEPARATOR;
            $fileName = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move($filePath, $fileName);
            $fullFilePath= $filePath.$fileName;
            $inputs['file_path']= $fullFilePath;
            $inputs['file_size']= File::size($fullFilePath);
            $inputs['file_type']= $request->file('file')->getClientOriginalExtension();

        }

        $file->update($inputs);

        return redirect()->route('admin.notify.email-file.index' , $file->email->id)->with('swal-success','فایل مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailFile $file)
    {
        $file->delete();
        return redirect()->route('admin.notify.email-file.index' , $file->email->id)->with('swal-success','فایل مورد نظر با موفقیت حذف شد');
    }

    public function status(EmailFile $file){

        $file->status= $file->status == 0 ? 1 : 0 ;
        $result= $file->save();

        if($result){
            if($file->status == 0){

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
