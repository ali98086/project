<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Market\Product;
use App\Models\Rating;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{


    public function product(Product $product)
    {

        $relatedProducts = Product::where('category_id' , $product->category_id)->get()->except($product->id);
        return view('customer.market.product', compact('product', 'relatedProducts'));
    }

    public function addComment(CommentRequest $request, Product $product)
    {

        // $request->validate(['body' => 'required|max:1000']);

        $inputs = $request->all();

        $inputs['author_id'] = Auth::user()->id;
        $inputs['body'] = str_replace(PHP_EOL, '<br>', $request->body);
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        $inputs['status'] = 1;

        Comment::create($inputs);
        return redirect()->route('customer.market.product', $product->id)->with('swal-success', '.نظر شما با موفقیت ارسال شده و پس از تایید مدیر سایت قابل مشاهده می باشد');
    }


    public function addToFavorite(Product $product)
    {

        if (Auth::check()) {

            $product->users()->toggle([Auth::user()->id]);

            if ($product->users->contains(Auth::user()->id)) {

                return response()->json(['status' => 1]);
            } else {

                return response()->json(['status' => 2]);
            }
        } else {

            return response()->json(['status' => 3]);
        }
    }


    public function addRate(Request $request, Product $product)
    {

        if (Auth::check()) {

            $rated = Rating::where('model_id', Auth::user()->id)->where('rateable_type', Product::class)->where('rateable_id', $product->id)->first();

            if($rated){

                return back()->with('alert-message-info', 'شما قبلا به این محصول امتیاز داده اید.');

            }
            elseif (auth()->user()->isBuyProductUser($product)) {

                auth()->user()->rate($product, $request->rating);
                return back()->with('alert-message-success', 'امتیاز شما با موفقیت ثبت شد.');
            }
            else{

                return back()->with('alert-message-error', 'شما مجاز به امتیازدهی این محصول نمی باشید.');

            }
        }
    }
}
