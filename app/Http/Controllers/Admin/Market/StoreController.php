<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreRequest;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.store.index', compact('products'));
    }



    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.store.create', compact('product'));
    }



    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Product $product)
    {
        $product->marketable_number= $product->marketable_number + $request->marketable_number;
        $product->save();
        Log::info('مشخصات تحویل گیرنده - مشخصات تحویل دهنده - توضیحات - تعداد اضافه شده', ['reciver' => $request->reciver , 'delivier' => $request->delivier , 'description' => $request->description, 'added' => $request->marketable_number]);

        return redirect()->route('admin.market.store.index')->with('swal-success','افزایش موجودی کالا با موفقیت انجام شد');
    }



    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.market.store.edit', compact('product'));
    }



    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'marketable_number'=>'required|numeric' ,
            'frozen_number'=>'required|numeric' ,
            'sold_number'=>'required|numeric' ,
        ]);

        $inputs= $request->all();
        $product->update($inputs);

        return redirect()->route('admin.market.store.index')->with('swal-success','اصلاح موجودی کالا با موفقیت انجام شد');
    }


}
