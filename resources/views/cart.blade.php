@extends('frontlayout.master')
@extends('frontlayout.header-main')
@section('page-title')
	Cart
@endsection
@section('main-content')
	<div class="page-content bg-light">
		<!--Banner Start-->
		<div class="dz-bnr-inr" >
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Cart</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item">Cart</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->

		
		<!-- contact area -->
		<section class="content-inner shop-account">
			<!-- Product -->
			<div class="container">
				<div class="row">
					@if ($items->count()>0)
					<div class="col-lg-8">
						
						<div class="table-responsive">
							<table class="table check-tbl">
								<thead>
									<tr>
										<th>Product</th>
										<th></th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Subtotal</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($items as $item)
									<tr>
										<td class="product-item-img"><img src="{{asset('uploads/product')}}/{{$item->model->image}}" alt="/"></td>
										<td class="product-item-name">{{$item->name}}</td>
										<td class="product-item-price">Rs/{{$item->price}}</td>
										<td class="product-item-quantity">
											<div class="position-relative qty-control">
												<form method="POST" action="{{route('cart.quantity.decrease',['rowId'=>$item->rowId])}}">
												{{ csrf_field() }}
												@method('PUT')
												<button type="submit" class="btn  qty-control__decrease"><i class="fa-solid fa-minus"></i></button>
												</form>										
												<div class="quantity btn-quantity style-1 ms-3">
												<input type="text" name="quantity" min="1" value="{{$item->qty}}">
												</div>
												<form method="POST" action="{{route('cart.quantity.increase',['rowId'=>$item->rowId])}}">
												{{ csrf_field() }}
												@method('PUT')
												<button type="submit" class="btn qty-control__increase "><i class="fa-solid fa-plus"></i></button>
												</form>
											</div>
										</td>
										<td class="product-item-totle ">Rs/{{$item->price()}}</td>
										<td class="product-item-close">
											<form method="POST" action="{{route('cart.item.remove',['rowId'=>$item->rowId])}}">
											{{ csrf_field() }}
											@method('DELETE')
											<button type="submit" class="btn btn-secondary remove-cart"><i class="ti-close"></i></button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						
						<div class="row shop-form m-t30">
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group mb-0">
										<input name="dzEmail" required="required" type="text" class="form-control" placeholder="Coupon Code">
										<div class="input-group-addon">
											<button name="submit" value="Submit" type="submit" class="btn coupon">
												Apply Coupon
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-end">
								<form action="{{route('cart.clear')}}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-secondary">Clear Cart</button>
								</form>
								
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<h4 class="title mb15">Cart Total</h4>

						<div class="cart-detail">
							<a href="javascript:void(0);" class="btn btn-outline-secondary w-100 m-b20">Cash On Delivery</a>
							<div class="icon-bx-wraper style-4 m-b15">
								<div class="icon-bx">
									<i class="flaticon flaticon-ship"></i>
								</div>
								<div class="icon-content">
									<span class=" font-14">FREE</span>
									<h6 class="dz-title">Enjoy Free Shipping</h6>
								</div>
							</div>
							
							<div class="save-text">
								<i class="icon feather icon-check-circle"></i>
								<span class="m-l10">Feel Free To Checkout</span>
							</div>
							<table>
								<tbody>
									<tr class="total">
										<td>
											<h6 class="mb-0">Total</h6>
										</td>
										<td class="price">
											Rs/{{Cart::instance('cart')->subtotal()}}
										</td>
									</tr>
								</tbody>
							</table>
							<a href="{{route('cart.checkout')}}" class="btn btn-secondary w-100">Checkout</a>
						</div>
					</div>
					@else
							<div class="alert alert-danger">No Item Found In Your Cart!</div>
							<a href="/" class="btn btn-secondary w-100 text-center">Home</a>
						@endif
				</div>
			</div>
			<!-- Product END -->
		</section>
		<!-- contact area End--> 

	</div>
@endsection

@push('scripts')

<script>
	$(function(){
		$(".qty-control__decrease").on("click",function(){
			$(this).closest('form').submit();
		});
		$(".qty-control__increase").on("click",function(){
			$(this).closest('form').submit();
		});
		$('.remove-cart').on("click",function(){
			$(this).closest('form').submit();
		});

	})
</script>

@endpush	
		
	
	