<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{


    public function product(Product $product){

        $relatedProducts = Product::orderBy('id','desc')->get();
        return view('customer.market.product', compact('product' , 'relatedProducts'));

    }

    public function addComment(Request $request, Product $product){

        $request->validate(['body' => 'required|max:1000']);

        $inputs= $request->all();

        $inputs['author_id']= Auth::user()->id;
        $inputs['body']= str_replace(PHP_EOL, '<br>' , $request->body);
        $inputs['commentable_id']= $product->id;
        $inputs['commentable_type']= Product::class;
        $inputs['status']= 1;

        Comment::create($inputs);
        return redirect()->route('customer.market.product' , $product->id)->with('swal-success','.نظر شما با موفقیت ارسال شده و پس از تایید مدیر سایت قابل مشاهده می باشد');

    }


    public function addToFavorite(Product $product){

        if(Auth::check()){

            $product->users()->toggle([Auth::user()->id]);

            if($product->users->contains(Auth::user()->id)){

                return response()->json(['status'=> 1]);

            }
            else{

                return response()->json(['status'=> 2]);

            }

        }
        else{

            return response()->json(['status'=> 3]);

        }


    }


}
