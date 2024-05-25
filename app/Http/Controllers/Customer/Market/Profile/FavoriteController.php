<?php

namespace App\Http\Controllers\Customer\Market\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(){

        return view('customer.profile.my-favorites');

    }

    public function removeToFavorites(Product $product){

        auth()->user()->products()->detach($product->id);
        return redirect()->route('customer.salesProcess.profile-favorites.index')->with('success','محصول با موفقیت از علاقمندی ها حذف شد.');

    }
}
