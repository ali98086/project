<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Page;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;
use Intervention\Gif\Decoder;

class HomeController extends Controller
{

    public function home(){
 
        $slideShowBanners = Banner::where('position', 0)->where('status', 1)->get();
        $topSlideShowBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleSlideShowBanners = Banner::where('position' , 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position' , 3)->where('status', 1)->first();

        $mostVisitedProducts = Product::orderBy('view','desc')->take(10)->get();
        $productOffers = Product::orderBy('sold_number', 'desc')->take(10)->get();
        $brands = Brand::all();

        return view('customer.home', compact('slideShowBanners', 'topSlideShowBanners', 'middleSlideShowBanners', 'bottomBanner', 'mostVisitedProducts', 'productOffers', 'brands' ));

    }


    public function products(Request $request, ProductCategory $category = null){

        //show Products of each Category

        if($category){

            $productModel = $category->products();

        }
        else{

            $productModel = new Product();

        }


        //brands
        $brands= Brand::all();

        //categories
        $categories= ProductCategory::whereNull('parent_id')->get();


        //check sort type
        if($request->sort){

            if($request->sort == 1){

                $column="created_at";
                $direction= "desc";
    
            }
            if($request->sort == 2){
    
                $column="price";
                $direction= "desc";
                
            }
            if($request->sort == 3){
    
                $column="price";
                $direction= "asc";
                
            }
            if($request->sort == 4){
    
                $column="view";
                $direction= "desc";
                
            }
            if($request->sort == 5){
    
                $column="sold_number";
                $direction= "desc";
                
            }
        }
        else{

            $column="created_at";
            $direction= "asc";
            
        }

        //search
        if($request->search){

            $query= $productModel->where('name','LIKE','%'.$request->search.'%')->orderBy($column , $direction);

        }
        else{

            $query= $productModel->orderBy($column , $direction);

        }

        //filer price min and max price
        $products= $request->min_price && $request->max_price ? $query->whereBetween('price' , [$request->min_price , $request->max_price]) : 

            $query->when($request->min_price, function($query) use ($request){

                $query->where('price','>=',$request->min_price)->get();

            })->when($request->max_price, function($query) use ($request){

                $query->where('price','<=',$request->max_price)->get();

            })->when(!($request->min_price && $request->max_price), function($query){

                $query->get();

            });

            //show products by this brands
            $products= $products->when($request->brands, function() use ($request , $products){

                $products->whereIn('brand_id', $request->brands);

            });

            $products= $products->paginate(3);
            $products->appends($request->query());

        return view('customer.market.products', compact('products','brands','categories','category'));

    }


    public function page(Page $page){

        return view('customer.page.page', compact('page'));

    }
}
