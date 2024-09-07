@extends('frontlayout.master')
@extends('frontlayout.header-main')
@section('page-title')
	Checkout
@endsection
@section('main-content')
<div class="page-content bg-light">

        <!-- inner page banner End-->
        <div class="content-inner-1 pt-5">
            <div class="container pt-5">
                <div class="row shop-checkout">
                    <div class="col-xl-8">
                        <h4 class="title m-b15">Billing details</h4>
                        <div class="accordion dz-accordion accordion-sm" id="accordionFaq">
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                        Have a coupon? Click here to enter your code
                                        <span class="toggle-close"></span>
                                    </a>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p class="m-b0">If your order has not yet shipped, you can contact us to change your shipping address</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form name="checkout-form" action="{{route('cart.place.an.order')}}" method="POST" class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group m-b25">
                                    <label class="label-title">Name</label>
                                    <input name="name" required="" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group m-b25">
                                    <label class="label-title">Phone</label>
                                    <input name="phone" required="" class="form-control">
                                </div>
                            </div>                    
                            
                            
                            <div class="col-md-12">
                                <div class="form-group m-b25">
                                    <label class="label-title">City</label>
                                    <input name="city" required="" class="form-control">
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group m-b25">
                                    <label class="label-title">Address</label>
                                    <input name="address" required="" class="form-control">
                                </div>
                            </div>
                        
                    </div>
                    <div class="col-xl-4 side-bar">
                        <h4 class="title m-b15 text-center">Your Order</h4>
                        <div class="order-detail sticky-top">
                            @foreach (Cart::instance('cart')->content() as $item)
                            <div class="cart-item style-1">
                                <div class="dz-media">
                                    <img src="{{asset('uploads/product')}}/{{$item->model->image}}" alt="/">
                                </div>
                                <div class="dz-content">
                                    <h6 class="title mb-0">{{$item->name}}</h6>
                                    <span class="price">Rs/{{$item->price}} x {{$item->qty}}</span>
                                </div>
                            </div>
                            @endforeach 
                            <table>
                                <tbody>
                                    <tr class="subtotal">
                                        <td>Subtotal</td>
                                        <td class="price">Rs/{{Cart::instance('cart')->subtotal()}}</td>
                                    </tr>    
                                </tbody>
                            </table>
                            
                            <div class="accordion dz-accordion accordion-sm mt-3" id="accordionFaq1">
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading1">
                                        <div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse1" role="navigation"  aria-expanded="true" aria-controls="collapse1">
                                            <input class="form-check-input radio" type="radio" name="mode" value="card">
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Direct bank transfer
                                            </label>
                                        </div>
                                    </div>
                                    <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordionFaq1">
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading2">
                                        <div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse2" role="navigation" aria-expanded="true" aria-controls="collapse2">
                                            <input class="form-check-input radio" type="radio" name="mode" value="cod">
                                            <label class="form-check-label" for="flexRadioDefault5">
                                                Cash on delivery
                                            </label>
                                        </div>
                                    </div>
                                    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="collapse2" data-bs-parent="#accordionFaq1">
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading3">
                                        <div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse3" role="navigation" aria-expanded="true" aria-controls="collapse3">
                                            <input class="form-check-input radio" type="radio" name="mode" value="payapal">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                Paypal
                                            </label>
                                        </div>
                                    </div>
                                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionFaq1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-secondary w-100">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection