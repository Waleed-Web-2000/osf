<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function index(){
    	$items = Cart::instance('cart')->content();
        $product = Product::first();
        $products = Product::get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $search_categories = Category::limit(5)->get();
    	return view('cart', compact('items', 'product', 'search_categories', 'products', 'categories', 'items', 'footer_pro'));
    }
    public function add_to_cart(Request $request){
    	Cart::instance('cart')->add($request->id, $request->title, $request->quantity, $request->price)->associate('App\Models\Product');
    	toastr()->timeOut(10000)->closeButton()->addSuccess('Cart Addedd Succesfully');
    	return redirect()->back();
    }
    public function increase_cart_quantity($rowId) {
    	$product = Cart::instance('cart')->get($rowId);
    	$qty = $product->qty + 1;
    	Cart::instance('cart')->update($rowId,$qty);
    	return redirect()->back();
    }
    public function decrease_cart_quantity($rowId) {
    	$product = Cart::instance('cart')->get($rowId);
    	$qty = $product->qty - 1;
    	Cart::instance('cart')->update($rowId,$qty);
    	return redirect()->back();
    }
    public function  remove_item($rowId){
    	Cart::instance('cart')->remove($rowId);
    	return redirect()->back();
    }

    public function empty_cart(){
    	Cart::instance('cart')->destroy();
    	return redirect()->back();
    }

    public function checkout() {
        $address = Address::first();
        $items = Cart::instance('cart')->content();
        $products = Product::get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $search_categories = Category::limit(5)->get();
        return view('checkout', compact('address','items', 'search_categories', 'products', 'categories', 'items', 'footer_pro'));
    }


    public function place_an_order(Request $request) {    
    $this->setAmountforCheckout(); 
        $order = new Order();
        $order->mode = $request->mode;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->order_number ='ORD-'.strtoupper(Str::random(10));
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->status = "pending";
        $order->city = $request->city;
        $order->buy_now = 'no';
        $order->save();
 
    foreach(Cart::instance('cart')->content() as $item) {
        $orderitem = new OrderItem();
        $orderitem->product_id = $item->id;
        $orderitem->product_name = $item->name;
        $orderitem->price = $item->price;
        $orderitem->quantity = $item->qty;
        $orderitem->order_id = $order->id;
        $orderitem->save();
    }

    if ($request->mode == "card") {
        
    }
    elseif ($request->mode == "cod") {
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->mode = $request->mode;
        $transaction->status = "pending";
        $transaction->save();
    }
    if ($request->mode == "paypal") {
        
    }
    Cart::instance('cart')->destroy();
    session()->forget('checkout');
    session()->put('order_id',$order->id);
    return redirect()->route('cart.order.confirm');
    }

    public function place_order(Request $request) {    
        $this->setAmountforCheckout();
    if ($request->mode == "card") {
        
    }
    elseif ($request->mode == "cod") {
        $order = new Order();

        $order->mode = $request->mode;
        $order->subtotal = $request->price;
        $order->order_number ='ORD-'.strtoupper(Str::random(10));
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->product_id = $request->id;
        $order->product_img = $request->product_img;
        $order->product_name = $request->title;
        $order->price = $request->price;
        $order->quantity = $request->qty;
        $order->address = $request->address;
        $order->status = "pending";
        $order->city = $request->city;
        $order->buy_now = $request->buy_now;
        $order->save();
    }
    if ($request->mode == "paypal") {
        
    }
    Cart::instance('cart')->destroy();
    session()->forget('checkout');
    return redirect()->route('cart.order.confirm');
    }


    public function setAmountforCheckout(){
        if (!Cart::instance('cart')->count() > 0) {
            session()->forget('checkout');
            return;
        }
        else {
            session()->put('checkout',[
                'subtotal' => Cart::instance('cart')->subtotal(),
            ]);
        }
    }

    public function order_confirmation(){
        $items = Cart::instance('cart')->content();
        $products = Product::get();
        $footer_pro = Product::limit(3)->get();
        $categories = Category::get();
        $search_categories = Category::limit(5)->get();
        $order = Order::orderBy('created_at', 'DESC')->first();
        return view('order-confirm', compact('items', 'search_categories', 'products', 'categories', 'items', 'footer_pro', 'order'));
    }
}
