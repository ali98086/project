<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FaqRequest;
use App\Models\Content\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs= FAQ::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.content.faq.index' , compact('faqs'));
    }



    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.faq.create');
    }



    
    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        $inputs= $request->all();
        FAQ::create($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success','سوال مورد نظر با موفقیت درج شد');
    }



    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }



    
    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, FAQ $faq)
    {
        $inputs= $request->all();
        $inputs['slug']= null;
        $faq->update($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success','ویرایش سوال با موفقیت انجام شد');
    }



    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('admin.content.faq.index')->with('swal-success','سوال مورد نظر با موفقیت حذف شد');
    }



    
    public function status(FAQ $faq){

        $faq->status= $faq->status == 0 ? 1 : 0 ;
        $result= $faq->save();

        if($result){
            if($faq->status == 0){

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
