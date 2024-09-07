@extends('frontlayout.master')
@extends('frontlayout.header-main')
@section('page-title')
	Home 
@endsection
@section('main-content')
	<div class="page-content bg-light">
	
		<div class="main-slider-wrapper">

			<div class="slider-inner">
				
				<div class="row">
					
					<div class="col-lg-6">
						<div class="slider-main">
							@forelse ( $products as $product )
							<div class="slick-slide">
								<div class="content-info">
									<h1 class="title">{{Str::limit($product->name, 13, '...')}}</h1>
									<div class="swiper-meta-items">
										<div class="meta-content">
											<span class="price-name">Price</span>
											<span class="price-num d-inline-block">@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif</span>
										</div>
									</div>
									<div class="content-btn m-b30">
										@if(Cart::instance("cart")->content()->Where('id',$product->id)->count()>0)
    										<a href="{{route('cart.index')}}" class="btn btn-secondary me-xl-3 me-2 btnhover20">Go to Cart</a>
											@else
										<form method="POST" action="{{route('cart.add')}}">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{$product->id}}"/>
										<input type="hidden" name="title" value="{{$product->name}}"/>
										<input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->price : $product->sale_price}}"/>
										<input type="hidden" name="product_img" value="{{$product->image}}"/>
										<input type="hidden" name="quantity" value="1"/>
										<button class="btn btn-secondary me-xl-3 me-2 btnhover20" type="submit" >ADD TO CART</button> 
										@endif
										<a href="{{ route('product-detail', $product->slug)}}" class="btn btn-outline-secondary btnhover20">VIEW DETAIL </a>
									</div>
								</div>
							</div>
							@empty
								<div class="alert alert-danger">No record found!</div>
							@endforelse
						</div>
					</div>
					<div class="col-lg-6">
						<div class="slider-thumbs">
							@forelse ( $products as $product )
							<div class="slick-slide">
								<div class="banner-media" data-name="
									@if ($product->condition == '0')
									Hot
									@else
									Trending
									@endif
								">
									<div class="img-preview">
										@if ( $product->image == 'No image found' )
											<img src="uploads/no-img.jpg" alt="banner-media">
										@else
											<img src="/uploads/product/{{$product->image}}" alt="banner-media">
										@endif
									</div>
								</div>
							</div>
							@empty
								<div class="alert alert-danger">No record found!</div>
							@endforelse
						</div>
					</div>
				</div>

				<div class="bottom-content align-items-end wow fadeInUp" data-wow-delay="1.0s">
					<svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" viewBox="0 0 76 76" fill="none">
						<path d="M52.6617 37.6496L58.7381 40.0325L75.0609 49.0874L66.6016 63.7422L49.9214 54.6872L45.1557 50.7554L46.1088 57.1892V75.18H28.952V57.1892L30.0243 50.5171L24.9011 54.6872L8.45924 63.7422L0 49.0874L16.3228 39.7942L22.3991 37.6496L16.3228 35.1475L0 26.2117L8.45924 11.557L25.1394 20.4928L30.0243 24.6629L28.952 18.3482V0H46.1088V18.3482L45.1557 24.4246L49.9214 20.4928L66.6016 11.557L75.0609 26.2117L58.7381 35.3858L52.6617 37.6496Z" fill="black" />
					</svg>
					<div>
						<span class="sub-title">Best Products</span>
						<h4 class="title">Top trending & Best Selling Items</h4>
					</div>
				</div>
				<svg class="star-1" xmlns="http://www.w3.org/2000/svg" width="94" height="94" viewBox="0 0 94 94" fill="none">
					<path d="M47 0L53.8701 30.4141L80.234 13.766L63.5859 40.1299L94 47L63.5859 53.8701L80.234 80.234L53.8701 63.5859L47 94L40.1299 63.5859L13.766 80.234L30.4141 53.8701L0 47L30.4141 40.1299L13.766 13.766L40.1299 30.4141L47 0Z" fill="#FEEB9D" />
				</svg>
				<svg class="star-2" xmlns="http://www.w3.org/2000/svg" width="82" height="94" viewBox="0 0 82 94" fill="none">
					<path d="M41 0L45.277 39.592L81.7032 23.5L49.554 47L81.7032 70.5L45.277 54.408L41 94L36.723 54.408L0.296806 70.5L32.446 47L0.296806 23.5L36.723 39.592L41 0Z" fill="black" />
				</svg>
				<a class="animation-btn popup-youtube" href="https://www.youtube.com/watch?v=YwYoyQ1JdpQ">
					<div class="text-row word-rotate-box c-black">
						<span class="word-rotate"> Best Items Ever </span>
						<i class="fa-solid fa-play text-dark badge__emoji"></i>
					</div>
				</a>
			</div>
		</div>
		<!-- Shop Section Start -->
		<section class="shop-section overflow-hidden">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-lg-8 left-box">
						<div class="swiper swiper-shop">
							<div class="swiper-wrapper">
							@forelse ( $categories as $category )
								<div class="swiper-slide">
									<div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.2s">
										<div class="dz-media">
										@if ( $category->category_img == 'No image found' )
											<img src="uploads/no-img.jpg" alt="banner-media">
										@else
											<img src="/uploads/category/{{$category->category_img}}" width="500" height="500" alt="banner-media">
										@endif
										</div>
										<h6 class="product-name"><a href="{{route('product-cat', $category->slug)}}">{{$category->title}}</a></h6>
									</div>
								</div>
							@empty
								<div class="alert alert-danger">No record found!</div>
							@endforelse
							</div>
						</div>
						<a class="icon-button" href="shop-standard.html">
							<div class="text-row word-rotate-box c-black border-secondary">
								<span class="word-rotate">More Collection Explore </span>
								<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 35 35" fill="none">
									<path d="M32.2645 16.9503H4.08145L10.7508 10.4669C11.2604 9.97176 10.5046 9.1837 9.98813 9.68289C9.98815 9.68286 2.35193 17.1063 2.35193 17.1063C2.12911 17.3092 2.14686 17.6755 2.35196 17.8903C2.35193 17.8903 9.98815 25.3169 9.98815 25.3169C10.5021 25.81 11.2622 25.0367 10.7508 24.5328C10.7508 24.5329 4.07897 18.0441 4.07897 18.0441H32.2645C32.9634 18.0375 32.9994 16.9636 32.2645 16.9503Z" fill="#000"></path>
								</svg>
							</div>
						</a>
					</div>
					<div class="col-lg-4 right-box">
						<div>
							<h3 class="title wow fadeInUp" data-wow-delay="1.2s">Featured Categories</h3>
							<p class="text wow fadeInUp" data-wow-delay="1.4s">Discover the most trending categories in our store.</p>
							<div class="pagination-align wow fadeInUp" data-wow-delay="1.6s">
								<div class="shop-button-prev">
									<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
										<path d="M32.2645 16.9503H4.08145L10.7508 10.4669C11.2604 9.97176 10.5046 9.1837 9.98813 9.68289C9.98815 9.68286 2.35193 17.1063 2.35193 17.1063C2.12911 17.3092 2.14686 17.6755 2.35196 17.8903C2.35193 17.8903 9.98815 25.3169 9.98815 25.3169C10.5021 25.81 11.2622 25.0367 10.7508 24.5328C10.7508 24.5329 4.07897 18.0441 4.07897 18.0441H32.2645C32.9634 18.0375 32.9994 16.9636 32.2645 16.9503Z" fill="white"/>
									</svg>
								</div>
								<div class="shop-button-next">
									<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
									  <path d="M2.73549 16.9503H30.9186L24.2492 10.4669C23.7396 9.97176 24.4954 9.1837 25.0119 9.68289L32.6481 17.1063C32.8709 17.3092 32.8531 17.6755 32.648 17.8903L25.0118 25.3169C24.4979 25.81 23.7378 25.0367 24.2492 24.5328L30.921 18.0441H2.73549C2.03663 18.0375 2.00064 16.9636 2.73549 16.9503Z" fill="white"/>
									</svg>
								</div>
							</div>
						</div>
						<a class="icon-button" href="shop-standard.html">
							<div class="text-row word-rotate-box c-black border-white">
								<span class="word-rotate">More Collection Explore </span>
								<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 35 35" fill="none">
									<path d="M32.2645 16.9503H4.08145L10.7508 10.4669C11.2604 9.97176 10.5046 9.1837 9.98813 9.68289C9.98815 9.68286 2.35193 17.1063 2.35193 17.1063C2.12911 17.3092 2.14686 17.6755 2.35196 17.8903C2.35193 17.8903 9.98815 25.3169 9.98815 25.3169C10.5021 25.81 11.2622 25.0367 10.7508 24.5328C10.7508 24.5329 4.07897 18.0441 4.07897 18.0441H32.2645C32.9634 18.0375 32.9994 16.9636 32.2645 16.9503Z" fill="white"></path>
								</svg>
							</div>
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Shop Section End -->
		
		<!-- About Section Start -->
		<section class="content-inner overflow-hidden">
			<div class="container">
				<div class="row about-style1">
					<div class="col-lg-6 col-md-12 m-b30">
						<div class="about-thumb wow fadeInUp  position-relative" data-wow-delay="0.2s">
							@if ($one_category->category_img == 'No image found')
									<img src="/uploads/no-img.jpg" alt="image">
							@else
									<img src="/uploads/category/{{ $one_category->category_img}}" alt="image">
							@endif	
							<a href="{{route('product-cat', $category->slug)}}" class="btn btn-outline-secondary btn-light btn-xl">{{$one_category->title}}</a>	
						</div>
					</div>
					<div class="col-lg-6 col-md-12 align-self-center">
						<div class="about-content">
							<div class="section-head style-1 wow fadeInUp" data-wow-delay="0.4s">
								<h3 class="title ">About Online Store</h3>
								<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
							</div>
							<a class="service-btn-2 wow fadeInUp" data-wow-delay="0.6s" href="{{route('about')}}" >
								<span class="icon-wrapper">
									<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12.832 31.1663L31.1654 12.833" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M12.832 12.833H31.1654V31.1663" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
							</a>
							<div class="row">
								@forelse ( $three_category as $category )
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="shop-card style-6 wow fadeInUp" data-wow-delay="1.0s">
										<div class="dz-media">
											@if ($category->category_img == 'No image found')
													<img src="/uploads/no-img.jpg" alt="image">
											@else
													<img src="/uploads/category/{{ $category->category_img}}" alt="image">
											@endif	
										</div>
										<div class="dz-content">
											<a href="{{route('product-cat', $category->slug)}}" class="btn btn-outline-secondary btn-light btn-md">{{$category->title}}</a>
										</div>
										<span class="sale-badge">10%<br>Sale <img src="/assets/images/star.png" alt=""></span>
									</div>
								</div>
								@empty
									<div class="alert alert-danger"> No Record Found</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- About Section End -->
		
		<!-- Dz Silder Start -->
		<section class="content-inner-3 overflow-hidden">
			<div class="dz-features-wrapper overflow-hidden">
				<ul class="dz-features text-wrapper">
					@forelse ( $categories as $category )
					<li class="item">
						<h2 class="title">{{$category->title}}</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewBox="0 0 61 60" fill="none">
						<path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"/>
						</svg>
					</li>
					@empty
						<div class="alert alert-danger">No Record Found!</div>
					@endforelse
				</ul>
			</div>
		</section>
		<!-- Dz Silder End -->
		
		<!-- Products Section Start -->
		<section class="content-inner">
			<div class="container">
				<div class=" row justify-content-md-between align-items-start">
					<div class="col-lg-6 col-md-12">
						<div class="section-head style-1 m-b30  wow fadeInUp" data-wow-delay="0.2s">
							<div class="left-content">
								<h2 class="title">Most popular products</h2>
							</div>
						</div>	
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="site-filters clearfix style-1 align-items-center wow fadeInUp ms-lg-auto" data-wow-delay="0.1s">
							<ul class="filters" data-bs-toggle="buttons">

								<li class="btn active">
									<input type="radio">
									ALL
								</li>
								@forelse ( $categories as $key=>$category )
								<li data-filter=".{{$category->id}}" class="btn">
									<input type="radio">
									{{$category->title}}
								</li>
								@empty
								<div class="alert alert-danger">No Record Found</div>
								@endforelse
											
							</ul>			
						</div>
					</div>
				</div>
				<div class="clearfix">
					<ul id="masonry" class="row g-xl-4 g-3">
						@forelse ( $productss as $key=>$product )
						<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 {{$product->category_id}} wow fadeInUp" data-wow-delay="0.1s">
							<div class="shop-card">
								<div class="dz-media">
									@if ($product->image == 'No image found')
										<img src="/uploads/no-img.jpg" width="500" height="500" class="img-thumbnail" alt="image">
									@else
										<img src="/uploads/product/{{ $product->image }}" width="500" height="500" class="img-thumbnail" alt="{{ $product->name }}">
									@endif
									<div class="shop-meta">

									@if(Cart::instance("cart")->content()->Where('id',$product->id)->count()>0)
    										<a href="{{route('cart.index')}}" class="btn btn-secondary btn-md btn-rounded"><span class="d-md-block d-none">Go to Cart</span></a>
											@else
										<form method="POST" action="{{route('cart.add')}}">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{$product->id}}"/>
										<input type="hidden" name="title" value="{{$product->name}}"/>
										<input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->price : $product->sale_price}}"/>
										<input type="hidden" name="product_img" value="{{$product->image}}"/>
										<input type="hidden" name="quantity" value="1"/>

										<button class="btn btn-secondary btn-md btn-rounded" type="submit" ><span class="d-md-block d-none" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add to cart </span></button> 
										@endif
									</form>
									</div>							
								</div>
								<div class="dz-content">
									<h5 class="title"><a href="shop-list.html">{{$product->name}}</a></h5>
									<h5 class="price">Rs/{{$product->sale_price}}</h5>
								</div>
								<div class="product-tag">
									@if($product->condition=='trending')
                                     	<span class="badge ">Trending</span>
                                     @elseif($product->condition=='hot')
                                     	<span class="badge ">Hot</span>
                                     @else($product->condition=='sale')
                                        <span class="badge ">Sale</span>
                                     @endif
								</div>
							</div>
						</li>
						@empty
							<div class="alert alert-danger">No Record Found</div>
						@endforelse
					</ul>
				</div>
			</div>
		</section>
		<!-- Products Section Start -->

		<!-- Collection Section Start -->
		<!-- <section class="adv-area">
			<div class="container-fluid px-0">
				<div class="row product-style2 g-0">
					<div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
						<div class="product-box style-4">
							<div class="product-media" >
								@if ($one_category->category_img == 'No image found')
									<img src="/uploads/no-img.jpg" alt="image">
							@else
									<img src="/uploads/category/{{ $one_category->category_img}}" width="500" height="500" alt="image">
							@endif
							</div>
							<div class="sale-box">
								<div class="badge style-1 mb-1">Top Selling</div>	
								<h2 class="sale-name">{{Str::limit($one_category->title, 5, '..')}}</h2>
								<a href="{{route('product-cat', $one_category->slug)}}" class="btn btn-outline-secondary btn-lg text-uppercase">Shop Now</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
						<div class="product-box style-4">
							<div class="product-media align-items-end">
							@if ($one_category->category_img == 'No image found')
									<img src="/uploads/no-img.jpg" alt="image">
							@else
									<img src="/uploads/category/{{ $one_category->category_img}}" width="500" height="500" alt="image">
							@endif
							</div>
							<div class="product-content">
								<div class="main-content">
									<div class="badge style-1 mb-3">Top Selling Collection</div>
									<h2 class="product-name">{{Str::limit($one_category->title, 15, '...')}}</h2>
								</div>
								<a href="{{route('product-cat', $one_category->slug)}}" class="btn btn-secondary btn-lg text-uppercase">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> -->
		<!-- Collection Section End -->
		
		<!-- About Section Start -->
		<section class="content-inner-2 overflow-hidden">
			<div class="container">
				<div class="row  align-items-xl-center align-items-start">
					<div class=" col-lg-5 col-md-12 m-b30 align-self-center">
						<div class="dz-media style-1 img-ho1 wow fadeInUp" data-wow-delay="0.2s">
							@if ($one_category->category_img == 'No image found')
									<img src="/uploads/no-img.jpg" alt="image">
							@else
									<img src="/uploads/category/{{ $one_category->category_img}}" alt="image">
							@endif
						</div>
					</div>	
					<div class="col-lg-7 col-md-12 col-sm-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-8 col-md-8 col-sm-12">
								<div class="section-head style-1 wow fadeInUp" data-wow-delay="0.4s">
									<div class="left-content">
										<h2 class="title">Users Who Viewed This Also Checked Out These Similar Products</h2>
									</div>
								</div>	
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 text-md-end wow fadeInUp" data-wow-delay="0.6s">	
								<a class="icon-button d-md-block d-none ms-md-auto m-b30" href="{{route('shop')}}">
									<div class="text-row word-rotate-box c-black">
										<span class="word-rotate">all products - all products - </span>
										<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
											<g clip-path="url(#clip0_85_1327)">
											  <path d="M31.3072 10.7239L39.5891 19.0059C39.8523 19.2696 40.0001 19.627 40.0001 19.9995C40.0001 20.3721 39.8523 20.7295 39.5891 20.9932L31.3072 29.2752C31.1236 29.4582 30.8748 29.5608 30.6156 29.5606C30.3564 29.5604 30.1078 29.4573 29.9245 29.274C29.7412 29.0907 29.6381 28.8422 29.6379 28.5829C29.6377 28.3237 29.7404 28.075 29.9234 27.8913L36.8368 20.9781L0.978516 20.9781C0.718997 20.9781 0.470108 20.875 0.2866 20.6915C0.103093 20.508 -1.17109e-07 20.2591 -1.14015e-07 19.9995C-1.1092e-07 19.74 0.103093 19.4911 0.2866 19.3076C0.470108 19.1241 0.718997 19.021 0.978516 19.021L36.8368 19.021L29.9234 12.1077C29.7404 11.9241 29.6377 11.6754 29.6379 11.4162C29.6381 11.1569 29.7412 10.9084 29.9245 10.7251C30.1078 10.5418 30.3564 10.4387 30.6156 10.4385C30.8748 10.4383 31.1236 10.5409 31.3072 10.7239Z" fill="black"/>
											</g>
											<defs>
											  <clipPath id="clip0_85_1327">
												<rect width="40" height="40" fill="white" transform="matrix(-1.19249e-08 1 1 1.19249e-08 0 0)"/>
											  </clipPath>
											</defs>
										</svg>
									</div>
								</a>
							</div>	
						</div>
						<div class="row">
							@forelse ( $three_product as $product )
							<div class="col-lg-4 col-md-4 col-sm-6 m-b15">
								<div class="shop-card style-5 wow fadeInUp" data-wow-delay="0.8s">
									<div class="dz-media">
										@if ($product->image == 'No image found')
												<img src="/uploads/no-img.jpg" alt="image">
										@else
												<img src="/uploads/product/{{ $product->image}}" alt="{{$product->name}}">
										@endif
									</div>
									<div class="dz-content">
										<div>
											<span class="sale-title">up to 10% off</span>
											<h6 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h6>
										</div>
										<h6 class="price">
											@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif
										</h6>
									</div>
								</div>
							</div>
							@empty
								<div class="alert alert-danger">No Record Found!</div>
							@endforelse
						</div>	
					</div>
				</div>
			</div>
		</section>
		<!-- About Section End -->

		<!-- About Section -->
		<section class="content-inner overflow-hidden p-b0">
			<div class="container">
				<div class="row ">
					<div class="col-lg-6 col-md-12 align-self-center">
						<div class="row">
							@forelse ( $four_products as $product )
							<div class="col-lg-6 col-md-6 col-sm-6 m-b30">
								<div class="shop-card style-3 wow fadeInUp" data-wow-delay="0.2s">
									<div class="dz-media">
										@if ($product->image == 'No image found')
												<img src="/uploads/no-img.jpg" alt="image">
										@else
												<img src="/uploads/product/{{ $product->image}}" alt="{{$product->name}}">
										@endif
									</div>
									<div class="dz-content">
										<div>
											<span class="sale-title">up to 10% off</span>
											<h6 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h6>
										</div>

										<h6 class="price">
											@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif
										</h6>
									</div>
										<span class="sale-badge">Sale <img src="/assets/images/star.png" alt=""></span>
								</div>
							</div>
							@empty
								<div class="alert alert-danger">No Record Found!</div>
							@endforelse
						</div>	
					</div>
					<div class="col-lg-6 col-md-12 m-b30">
						<div class="about-box style-1  clearfix h-100 right">
							<div class="dz-media h-100">
								<img src="/assets/images/about/pic1.jpg" alt="">
								<div class="media-contant">
									<h2 class="title">Great saving on everyday essentials</h2> 
									<h5 class="sub-title">Up to 10% off</h5>
									<a href="{{route('shop')}}" class="btn btn-white btn-lg">See All</a>
								</div>
								<svg class="title animation-text" viewBox="0 0 1320 300">
									<text x="0" y="">Great saving</text>
								</svg>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- About Section -->	

		<!-- Map Area Start-->
		<section class="content-inner-3 overflow-hidden " id="Maping">
			<div class="container-fluid p-0">
				<div class="row align-items-start">			
					<div class="col-xl-5 col-lg-12 col-md-12 custom-width">
						<div class="section-head style-1 wow fadeInUp d-lg-flex align-items-end justify-content-between" data-wow-delay="0.1s">
							<div class="left-content">
								<h2 class="title">Recommended Products</h2>
								<p class="text-capitalize text-secondary m-0">Up to 10% off</p>
							</div>
							<a href="{{route('shop')}}" class="text-secondary font-14 d-flex align-items-center gap-1 m-b15">See All 
								<i class="icon feather icon-chevron-right font-18"></i>
							</a>			
						</div>
						<div class="swiper swiper-shop2 swiper-visible">
							<div class="swiper-wrapper">
								@forelse ($products as $product)
								@if ($product->recommended == 'yes')
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.1s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											@if ($product->image == 'No image found')
												<img src="/uploads/no-img.jpg" alt="image">
											@else
													<img src="/uploads/product/{{ $product->image}}" alt="{{$product->name}}">
											@endif
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="{{route('product-detail', $product->slug)}}">{{Str::limit($product->name, 18, '..')}}</a></h5>
											<span class="sale-title text-success">up to 10% off</span>
										</div>
									</div>
								</div>
								@endif
								@empty
									<div class="alert alert-danger">No Record Found!</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</section>

		<!-- Blockbuster deal Start -->
		<section class="content-inner-2 overflow-hidden">
			<div class="container">
				<div class="section-head style-1 wow fadeInUp d-lg-flex justify-content-between" data-wow-delay="0.2s">
					<div class="left-content">
						<h2 class="title">Blockbuster deals</h2>
					</div>
					<a href="{{route('shop')}}" class="text-secondary font-14 d-flex align-items-center gap-1">See all deals 
						<i class="icon feather icon-chevron-right font-18"></i>
					</a>			
				</div>
				<div class="swiper swiper-four swiper-visible">
					<div class="swiper-wrapper">
					@forelse ($products as $product)
					@if ($product->recommended == 'no')	
						<div class="swiper-slide">
							<div class="shop-card style-2 wow fadeInUp" data-wow-delay="0.4s">
								<div class="dz-media">
									@if ($product->image == 'No image found')
										<img src="/uploads/no-img.jpg" alt="image">
									@else
										<img src="/uploads/product/{{ $product->image}}" alt="{{$product->name}}">
									@endif
								</div>
								<div class="dz-content">
									<div>
										<span class="sale-title">up to 10% off</span>
										<h5 class="title"><a href="{{route('product-detail', $product->slug)}}">{{Str::limit($product->name, 18, '..')}}</a></h5>
									</div>
									<h6 class="price">
										@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif
									</h6>
								</div>
							</div>
						</div>
						@endif
						@empty
							<div class="alert alert-danger">No Record Found!</div>
						@endforelse
					</div>
				</div>
			</div>
		</section>
		<!-- Blockbuster deal Start -->

		<!-- Offer Section Start -->
		<!-- <section class="content-inner-2">
			<div class="container">	
				<div class="section-head style-1 wow fadeInUp d-flex justify-content-between m-b30" data-wow-delay="0.2s">
					<div class="left-content">
						<h2 class="title">Featured offer for you</h2>
					</div>
					<a href="{{route('shop')}}" class="text-secondary font-14 d-flex align-items-center gap-1">See All 
						<i class="icon feather icon-chevron-right font-18"></i>
					</a>			
				</div>
			</div>
			<div class="container-fluid px-3">
				<div class="swiper swiper-product">
					<div class="swiper-wrapper product-style2">
					@forelse ($feture_category as $category)
						<div class="swiper-slide">
							<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.6s">
								<div class="product-media">
									@if ($category->category_img == 'No image found')
										<img src="/uploads/no-img.jpg" alt="{{$category->title}}">
									@else
										<img src="/uploads/category/{{ $category->category_img}}" width="500" height="500" alt="{{$category->title}}">
									@endif
								</div>
								<div class="product-content">
									<div class="main-content">
										<span class="offer me-5">Sale Up to 10% Off</span>
										<h2 class="sub-title1 me-4">{{Str::limit($category->title, 10, '...')}}</span></h2>
										<a href="{{route('product-cat', $category->slug)}}" class="me-3 mb-4 btn btn-outline-secondary btn-rounded btn-lg">Shop Now</a>
									</div>
								</div>
							</div>
						</div>
						@empty
							<div class="alert alert-danger">No Record Found</div>
						@endforelse
					</div>
				</div>
			</div>
		</section> -->
		<!-- Product End -->
		
		<!-- Featured Section Start -->
		<section class="content-inner  overflow-hidden">
			<div class="container">	
				<div class="section-head style-1 wow fadeInUp d-flex justify-content-between" data-wow-delay="0.2s">
					<div class="left-content">
						<h2 class="title">Featured now</h2>
					</div>
					<a href="{{route('shop')}}" class="text-secondary font-14 d-flex align-items-center gap-1">See All 
						<i class="icon feather icon-chevron-right font-18"></i>
					</a>			
				</div>
				<div class="swiper swiper-product2 swiper-visible ">
					<div class="swiper-wrapper">
						@forelse ($feature_product as $product)
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.4s">
								<div class="dz-media">
									@if ($product->image == 'No image found')
										<img src="/uploads/no-img.jpg" alt="image">
									@else
										<img src="/uploads/product/{{ $product->image}}" alt="image">
									@endif
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h6>
										<span class="sale-title">Up to 10% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif</h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
						@empty
							<div class="alert alert-danger">No Record Found</div>
						@endforelse
					</div>
				</div>
			</div>
		</section>
		<!-- Featured Section End -->
		
		<!-- About Section -->
		
		<!-- About Section -->

		<!-- company-box Start -->
		
		<!-- company-box End -->
		
		<!-- Blog Start -->
		
		<!-- Blog End -->

		<!-- collection-bx -->
		<section class="collection-bx content-inner-3 overflow-hidden">
			<div class="container">
				<h2 class="title wow fadeInUp" data-wow-delay="0.2s">Upgrade your style with our  top-notch collection.</h2>
				<div class="text-center">	
					<a href="{{route('shop')}}" class="btn btn-secondary btn-lg wow fadeInUp m-b30" data-wow-delay="0.4s">All Collections</a>
				</div>	
			</div>
			<div class="collection1">
				@if ($bottom_category->category_img == 'No image found')
					<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
				@else
					<img src="/uploads/category/{{ $bottom_category->category_img}}" width="190" height="220" alt="image">
				@endif
			</div>
			<div class="collection2">
				@if ($bottom_category->category_img == 'No image found')
					<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
				@else
					<img src="/uploads/category/{{ $bottom_category->category_img}}" width="" height="" alt="image">
				@endif
			</div>
			<div class="collection3">
				@if ($bottom_category->category_img == 'No image found')
					<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
				@else
					<img src="/uploads/category/{{ $bottom_category->category_img}}" width="190" height="220" alt="image">
				@endif
			</div>
			<div class="collection4">
				@if ($bottom_category->category_img == 'No image found')
					<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
				@else
					<img src="/uploads/category/{{ $bottom_category->category_img}}" width="190" height="220" alt="image">
				@endif
			</div>
			<div class="collection5">
				@if ($bottom_category->category_img == 'No image found')
					<img src="/uploads/no-img.jpg" width="200" height="100" alt="image">
				@else
					<img src="/uploads/category/{{ $bottom_category->category_img}}" width="200" height="100" alt="image">
				@endif
			</div>
		</section>
		<!-- collection-bx -->
		
	</div>
@endsection