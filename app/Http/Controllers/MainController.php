<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Logo;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use DB;
use Hash;

class MainController extends Controller
{
    public function index() {
        $searchTerm = request()->get('s');
        $items = Cart::instance('cart')->content();
        $products = Product::get();
        $feature_product = Product::inRandomOrder()->get();
        $productss = Product::limit(8)->get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $feture_category = Category::inRandomOrder()->get();
        $three_category = Category::limit(2)->get();
        $three_product = Product::inRandomOrder()->limit(3)->get();
        $four_products = Product::inRandomOrder()->limit(4)->get();
        $one_category = Category::inRandomOrder()->first();
        $bottom_category = Category::inRandomOrder()->limit(5)->first();
        $categoriess = Category::limit(3)->get();
        $search_categories = Category::limit(5)->get();
        return view('/index', compact('products', 'three_category', 'feature_product' , 'feture_category' ,'three_product', 'four_products' ,'one_category', 'categoriess', 'productss' ,'categories', 'items', 'bottom_category' ,'footer_pro', 'search_categories'));
    }

    public function shop() {
        $items = Cart::instance('cart')->content();
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(5);
        $footer_pro = Product::limit(3)->get();
        $categories = Category::with('productss')->get();
        $search_categories = Category::limit(5)->get();
        return view('/shop', compact('items', 'search_categories', 'products', 'categories', 'items', 'footer_pro'));
    }

    public function about() {
        $items = Cart::instance('cart')->content();
        $products = Product::get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $search_categories = Category::limit(5)->get();
    	return view('/about', compact('items', 'search_categories', 'products', 'categories', 'items', 'footer_pro'));
    }

    public function contact() {
        $items = Cart::instance('cart')->content();
        $products = Product::get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $search_categories = Category::limit(5)->get();
    	return view('/contact', compact('items','search_categories', 'products', 'categories', 'items', 'footer_pro'));
    }

    public function product_detail($slug){
        $items = Cart::instance('cart')->content();
        $products = Product::with('category')->get();
        $rel_product = Product::get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $search_categories = Category::limit(5)->get();
        $product_detail= Product::getProductBySlug($slug);
        return view('/product_detail', compact('product_detail','items', 'rel_product' ,'search_categories', 'products', 'categories', 'items', 'footer_pro'));
    }

    public function product_category($slug){
        $category = category::where('slug', $slug)->first();
        $productss = Product::where('category_id', $category->id)->paginate(10);
        $items = Cart::instance('cart')->content();
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(5);
        $footer_pro = Product::limit(3)->get();
        $categories = Category::with('productss')->get();
        $search_categories = Category::limit(5)->get();
        return view('/shop_list', compact('items', 'search_categories', 'products', 'categories', 'category','items', 'productss' , 'footer_pro'));
    }

}
