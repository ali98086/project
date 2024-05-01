<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Intervention\Gif\Decoder;

class HomeController extends Controller
{

    public function home(){
auth()->loginUsingId(7);
        $slideShowBanners = Banner::where('position', 0)->where('status', 1)->get();
        $topSlideShowBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleSlideShowBanners = Banner::where('position' , 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position' , 3)->where('status', 1)->first();

        $mostVisitedProducts = Product::latest()->take(10)->get();
        $productOffers = Product::latest()->take(10)->get();
        $brands = Brand::all();

        return view('customer.home', compact('slideShowBanners', 'topSlideShowBanners', 'middleSlideShowBanners', 'bottomBanner', 'mostVisitedProducts', 'productOffers', 'brands' ));

    }
}
