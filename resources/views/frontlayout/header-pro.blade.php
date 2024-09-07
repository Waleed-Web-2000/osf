@section('header')
	<header class="site-header mo-left border-bottom">		
		<!-- Main Header -->
		<div class="sticky-header main-bar-wraper navbar-expand-lg">
			<div class="main-bar clearfix">
				<div class="container-fluid clearfix d-lg-flex d-block">
					
					<!-- Website Logo -->
					<div class="logo-header logo-dark me-md-5">
						@php
                                $data=DB::table('settings')->first();
                                
                        @endphp
						<img src="/uploads/setting/logo/{{$data->logo}}" alt="">
					</div>
					
					<!-- Nav Toggle Button -->
					<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
				
					<!-- Main Nav -->
					<div class="header-nav w3menu navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
						<div class="logo-header logo-dark">
							<a href="/"><h4 class="title">OnlineStore</h4></a>
						</div>
						<ul class="nav navbar-nav">
							<li class="has-mega-menu sub-menu-down auto-width menu-left">
								<a href="/"><span>Home</span><i class="fas fa-chevron-down tabindex" ></i></a>
							</li>
							<li class="has-mega-menu sub-menu-down">
								<a href="{{ route('shop') }}"><span>Shop&nbsp;<div class="badge badge-sm rounded badge-animated">New</div></span><i class="fas fa-chevron-down tabindex" ></i></a>
							</li>
							<li class="has-mega-menu sub-menu-down auto-width">
								<a href="{{ route('about') }}"><span>About</span><i class="fas fa-chevron-down tabindex"></i></a>
							</li>
							<li class="has-mega-menu sub-menu-down">
								<a href="{{ route('contact') }}"><span>Contact</span><i class="fas fa-chevron-down tabindex"></i></a>
							</li>
						</ul>
						<div class="dz-social-icon">
							<ul>
								<li><a class="fab fa-facebook-f" target="_blank" href="https://www.facebook.com/dexignzone"></a></li>
								<li><a class="fab fa-twitter" target="_blank" href="https://twitter.com/dexignzones"></a></li>
								<li><a class="fab fa-linkedin-in" target="_blank" href="https://www.linkedin.com/showcase/3686700/admin/"></a></li>
								<li><a class="fab fa-instagram" target="_blank" href="https://www.instagram.com/dexignzone/"></a></li>
							</ul>
						</div>
					</div>
				
					<!-- EXTRA NAV -->
					<div class="extra-nav">
						<div class="extra-cell">						
							<ul class="header-right">
								<li class="nav-item search-link">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
										<i class="iconly-Light-Search"></i>
									</a>
								</li>
								
								<li class="nav-item cart-link">
									<a href="{{route('cart.index')}}" class="nav-link cart-btn"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
										<i class="iconly-Broken-Buy"></i>
										@if(Cart::instance('cart')->content()->count()>0)
										<span class="badge badge-circle">{{Cart::instance('cart')->content()->count()}}</span>
										@endif
									</a>
								</li>
								
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- Main Header End -->
		
		<!-- SearchBar -->
		<div class="dz-search-area dz-offcanvas offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
				&times;
			</button>
			<div class="container">
				<form class="header-item-search">
					<div class="input-group search-input">
						<select class="default-select">
							<option>All Categories</option>
							@forelse ( $categories as $category )
							<a href="{{ route('product-cat', $category->slug)}}"><option>{{$category->title}}</option></a>
							@empty
							@endforelse
						</select>
						<input type="search" class="form-control" placeholder="Search Product">
						<button class="btn" type="button">
							<i class="iconly-Light-Search"></i>
						</button>
					</div>
					<ul class="recent-tag">
						<li class="pe-0"><span>Top Search :</span></li>
						@forelse ( $search_categories as $category )
						<li><a href="{{ route('product-cat', $category->slug)}}">{{$category->title}}</a></li>
						@empty
						@endforelse
					</ul>
				</form>
				<div class="row">
					<div class="col-xl-12">
						<h5 class="mb-3">You May Also Like</h5>
						<div class="swiper category-swiper2">
							<div class="swiper-wrapper">
								@forelse ( $products as $product )
								<div class="swiper-slide">
									<div class="shop-card">
										<div class="dz-media ">
											@if ( $product->image == 'No image found' )
												<img src="/uploads/no-img.jpg" alt="banner-media">
											@else
												<img src="/uploads/product/{{$product->image}}" alt="banner-media">
											@endif
										</div>
										<div class="dz-content">
											<h6 class="title"><a href="{{ route('product-detail', $product->slug)}}">{{Str::limit($product->name, 13, '...')}}</a></h6>
											<h6 class="price">&#036;{{ $product->sale_price }}</h6>
										</div>
									</div>
								</div>
								@empty
									<div class="alert alert-danger">No record found!</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- SearchBar -->
		
		<!-- Sidebar cart -->
		<div class="offcanvas dz-offcanvas offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight">
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
				&times;
			</button>
			<div class="offcanvas-body">
				<div class="product-description">
					<div class="dz-tabs">
						<ul class="nav nav-tabs center" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="shopping-cart" data-bs-toggle="tab" data-bs-target="#shopping-cart-pane" type="button" role="tab" aria-controls="shopping-cart-pane" aria-selected="true">Shopping Cart
									@if(Cart::instance('cart')->content()->count()>0)
										<span class="badge badge-light">{{Cart::instance('cart')->content()->count()}}</span>
										@endif
								</button>
							</li>
						</ul>
						<div class="tab-content pt-4" id="dz-shopcart-sidebar">
							<div class="tab-pane fade show active" id="shopping-cart-pane" role="tabpanel" aria-labelledby="shopping-cart" tabindex="0">
								<div class="shop-sidebar-cart">
									@if ($items->count()>0)
									<ul class="sidebar-cart-list">
										@foreach ($items as $item)
										<li>
											<div class="cart-widget">
												<div class="dz-media me-3">
													<img src="{{asset('uploads/product')}}/{{$item->model->product_img}}" alt="">
												</div>
												<div class="cart-content">
													<h6 class="title"><a href="product-thumbnail.html">{{$item->name}}</a></h6>
													<div class="d-flex align-items-center">
														<div class="btn-quantity light quantity-sm me-3">
															<form method="POST" action="{{route('cart.quantity.decrease',['rowId'=>$item->rowId])}}">
															{{ csrf_field() }}
															@method('PUT')
															<button type="submit" class="ms-1 mb-1 qty-control__decrease"><i class="fa-solid fa-minus"></i></button>
															</form>
															<input type="text" name="quantity" min="1" value="{{$item->qty}}">
															<form method="POST" action="{{route('cart.quantity.increase',['rowId'=>$item->rowId])}}">
															{{ csrf_field() }}
															@method('PUT')
															<button type="submit" class="ms-1 mt-1 qty-control__increase"><i class="fa-solid fa-plus"></i></button>
															</form>
														</div>
														<h6 class="dz-price mb-2">${{$item->price}}</h6>
													</div>
												</div>
												<form method="POST" action="{{route('cart.item.remove',['rowId'=>$item->rowId])}}">
											{{ csrf_field() }}
											@method('DELETE')
											<button type="submit" class="btn btn-secondary remove-cart"><i class="ti-close"></i></button>
											</form>
											</div>
										</li>
										@endforeach	
									</ul>
									@endif
									<div class="cart-total">
										<h5 class="mb-0">Subtotal:</h5>
										<h5 class="mb-0">${{Cart::instance('cart')->subtotal()}}</h5>
									</div>
									<div class="mt-auto">
										<div class="shipping-time">													
											<div class="dz-icon">
												<i class="flaticon flaticon-ship"></i>
											</div>
											<div class="shipping-content">
												<h6 class="title pe-4">Congratulations , you've got free shipping!</h6>
												<div class="progress">
													<div class="progress-bar progress-animated border-0" style="width: 75%;" role="progressbar">
														<span class="sr-only">75% Complete</span>
													</div>
												</div>
											</div>
										</div>
										<a href="{{route('cart.index')}}" class="btn btn-secondary btn-block">View Cart</a>
										<a href="{{route('shop')}}" class="btn btn-outline-secondary btn-block m-b20">Shop More</a>	
									</div>	
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</header>
@endsection