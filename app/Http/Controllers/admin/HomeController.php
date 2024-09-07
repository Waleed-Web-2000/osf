<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use Auth;
use Carbon\carbon;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Setting;
use App\Models\OrderItem;
use File;

class HomeController extends Controller
{
     public function setting(){
        $data=Setting::first();
        return view('admin.setting')->with('data',$data); 
    } 

    public function update($id, Request $request){
        // return $request->all();
        $data=Setting::first();
        $settings = Setting::findorFail($id);
        $currentImage = $settings->logo;
        $currentImages = $settings->photo;
        $filename = null;
        if (request()->hasFile('logo')) {
            $file = request()->File('logo');
            $filename = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/setting/logo/', $filename);
        }
        $filenames = null;
        if (request()->hasFile('photo')) {
            $file = request()->File('photo');
            $filenames = md5($file->getClientOriginalName()) . time() . "photo" . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/setting/photo/', $filenames);
        }
        $settings->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'short_des' => $request->short_des,
            'logo' => ($filename) ? $filename : $currentImage,
            'photo' => ($filenames) ? $filenames : $currentImages,
        ]);

        if ($filename) {
            File::delete('./uploads/setting/logo/' . $currentImage);
        }
        if ($filenames) {
            File::delete('./uploads/setting/photo/' . $currentImages);
        }
        
       toastr()->timeOut(10000)->closeButton()->addSuccess('Setting Updated Succesfully');
        return view('/admin/setting', compact('settings'))->with('data',$data);
    }

     public function profile()
    {
    	return view('/admin/auth/profile');
    } 
    public function profile_update(Request $request)
    {
    	$user = Auth::user();
    	$filename = $user->user_img;
        if (request()->hasFile('user_img')) {
            $file = request()->File('user_img');
            $filename = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/user/', $filename);
            File::delete('./uploads/user/' . $user->user_img);
        }
        $data = $request->all();
        $data['user_img'] = $filename;
        $user->update($data);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Profile Updated Succesfully');
        return redirect()->back();
    }

     public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Password Changed Succesfully');
        return redirect()->back();
    }

     public function login()
    {
        return view('/auth/login');
    }

    public function dashboard()
    {
        return view('/admin/product/index');
    }

    public function orders()
    {
        $vao = Order::where('buy_now', 'no')->first();
        $orders = Order::where('buy_now', 'no')->paginate(5);  
        return view('/admin/Order/index', compact('orders'));
    }

    public function single_orders()
    {
        $vbo = Order::where('buy_now', 'yes')->first(); 
        $single_order = Order::where('buy_now', 'yes')->paginate(5);  
        return view('/admin/Order/single-order', compact('single_order'));
    }
    public function single_order_detail($id)
    {
        $single_order = Order::findorFail($id);
        $ord = Order::where('id', $single_order->id)->orderBy('id')->paginate(5);
        return view('/admin/Order/single-order-detail', compact('single_order', 'ord'));
    }

    public function order_detail($order_id)
    {
        $order = Order::findorFail($order_id);
        $orderitems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(5);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('/admin/Order/order-detail', compact('order', 'orderitems', 'transaction'));
    }

    public function update_order_status(Request $request){        
    $order = Order::find($request->order_id);
    $order->status = $request->order_status;
    if($request->order_status=='delivered')
    {
        $order->delivered_date = Carbon::now();
    }
    else if($request->order_status=='canceled')
    {
        $order->canceled_date = Carbon::now();
    }        
    $order->save();
    if($request->order_status=='delivered')
    {
        $transaction = Transaction::where('order_id',$request->order_id)->first();
        $transaction->status = "approved";
        $transaction->save();
    }
    return back()->with("status", "Status changed successfully!");
}

 public function buy_update_order_status(Request $request){        
    $order = Order::find($request->buy_id);
    $order->status = $request->buy_order_status;
    if($request->buy_order_status=='pending')
    {
        $order->delivered_date = Carbon::now();
    }
    else if($request->order_status=='canceled')
    {
        $order->canceled_date = Carbon::now();
    }
    if($request->order_status=='delivered')
    {
        $order->canceled_date = Carbon::now();
    }          
    $order->save();
    return back()->with("status", "Status changed successfully!");
}

    public function destroy($id)
    {
        $orders = Order::findorFail($id);
        $orders->delete();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Order Deleted Succesfully');
        return redirect()->back();
    }
}
