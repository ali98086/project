<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryAttributes= CategoryAttribute::all();
        return view('admin.market.property.index', compact('categoryAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ProductCategories= ProductCategory::all();
        return view('admin.market.property.create', compact('ProductCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryAttributeRequest $request)
    {
        $inputs= $request->all();
        CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success','فرم مورد نظر با موفقیت ایجاد شد');
    }

    public function edit(CategoryAttribute $categoryAttribute)
    {
        $ProductCategories= ProductCategory::all();
        return view('admin.market.property.edit', compact('categoryAttribute','ProductCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryAttributeRequest $request, CategoryAttribute $categoryAttribute)
    {
        $inputs= $request->all();
        $categoryAttribute->update($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success','فرم مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $categoryAttribute)
    {
        $categoryAttribute->delete();
        return redirect()->route('admin.market.property.index')->with('swal-success','فرم مورد نظر با موفقیت حذف شد');
    }
}
