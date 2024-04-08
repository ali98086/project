<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    
    public function index(CategoryAttribute $categoryAttribute){

        
        return view('admin.market.property.property-value.index', compact('categoryAttribute'));

    }

    public function create(CategoryAttribute $categoryAttribute){

        return view('admin.market.property.property-value.create', compact('categoryAttribute'));
        
    }

    public function store(CategoryValueRequest $request, CategoryAttribute $categoryAttribute){

        $inputs= $request->all();
        $inputs['category_attribute_id']= $categoryAttribute->id ;
        $inputs['value']= json_encode(['value' => $request->value , 'price_increase'=> $request->price_increase]);

        CategoryValue::create($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)->with('swal-success','مقدار فرم مورد نظر با موفقیت درج شد');

    }

    public function edit(CategoryAttribute $categoryAttribute , CategoryValue $value){

        return view('admin.market.property.property-value.edit', compact('categoryAttribute','value'));
        
    }

    public function update(CategoryValueRequest $request, CategoryAttribute $categoryAttribute , CategoryValue $value){

        $inputs= $request->all();
        $inputs['value']= json_encode(['value'=> $request->value, 'price_increase'=> $request->price_increase]);
        $value->update($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)->with('swal-success','مقدار فرم مورد نظر با موفقیت ویرایش شد');
        
    }

    public function destroy(CategoryAttribute $categoryAttribute , CategoryValue $value){

        $value->delete();
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)->with('swal-success','مقدار فرم مورد نظر با موفقیت حذف شد');
    }
}
