@extends('frontlayout.master')
@extends('frontlayout.header-main')
@section('page-title')
	{{$category->title}}
@endsection
@section('main-content')
	<div class="page-content bg-light pt-5">		
		<section class="content-inner-3">
			<div class="container">
				<div class="row">
					<div class="col-xl-3">
						<div class="sticky-xl-top"> 
							<a href="javascript:void(0);" class="panel-close-btn">
								<svg width="35" height="35" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<div class="shop-filter mt-xl-2 mt-0">
								<aside>
									<div class="d-flex align-items-center justify-content-between m-b30">
										<h6 class="title mb-0 fw-normal d-flex">
											<i class="flaticon-filter me-3"></i>
											Filter
										</h6>
									</div>
									<div class="widget widget_search">
										<div class="form-group">
											<div class="input-group">
												<input name="dzSearch" required="required" type="search" class="form-control" placeholder="Search Product">
												<div class="input-group-addon">
													<button name="submit" value="Submit" type="submit" class="btn">
														<i class="icon feather icon-search"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="widget widget_categories">
										<h6 class="widget-title">Category</h6>
										<ul>
											@forelse ($categories as $category)
											<li class="cat-item cat-item-26"><a href="{{route('product-cat', $category->slug)}}">{{$category->title}}</a> {{$category->productss->count()}}</li> @empty
											@endforelse
										</ul>
									</div>
									
									<div class="widget widget_tag_cloud">
										<h6 class="widget-title">Tags</h6>
										<div class="tagcloud">
										@forelse ($products as $product) 
											<a href="{{route('product-detail', $product->slug)}}">{{$product->tags}}</a>
										@empty
										<div class="alert alert-danger">No Tags Found</div>
										@endforelse
										</div>
									</div>
									<a href="javascript:void(0);" class="btn btn-sm font-14 btn-secondary btn-sharp">RESET</a>
								</aside>
							</div>
						</div>
					</div>
					<div class="col-xl-9">
						<div class="filter-wrapper">
							<div class="filter-left-area">								
								<ul class="filter-tag">
									<li>
										<a href="javascript:void(0);" class="tag-btn">Dresses 
											<i class="icon feather icon-x tag-close"></i>
										</a>
									</li>
								</ul>
								<span>Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}}
                                        of  {{$products->total()}} entries</span>
							</div>
							<div class="filter-right-area">
								<a href="javascript:void(0);" class="panel-btn">
									<svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="20" height="20"><g id="Layer_28" data-name="Layer 28"><path d="M2.54,5H15v.5A1.5,1.5,0,0,0,16.5,7h2A1.5,1.5,0,0,0,20,5.5V5h2.33a.5.5,0,0,0,0-1H20V3.5A1.5,1.5,0,0,0,18.5,2h-2A1.5,1.5,0,0,0,15,3.5V4H2.54a.5.5,0,0,0,0,1ZM16,3.5a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5v2a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5Z"></path><path d="M22.4,20H18v-.5A1.5,1.5,0,0,0,16.5,18h-2A1.5,1.5,0,0,0,13,19.5V20H2.55a.5.5,0,0,0,0,1H13v.5A1.5,1.5,0,0,0,14.5,23h2A1.5,1.5,0,0,0,18,21.5V21h4.4a.5.5,0,0,0,0-1ZM17,21.5a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5v-2a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5Z"></path><path d="M8.5,15h2A1.5,1.5,0,0,0,12,13.5V13H22.45a.5.5,0,1,0,0-1H12v-.5A1.5,1.5,0,0,0,10.5,10h-2A1.5,1.5,0,0,0,7,11.5V12H2.6a.5.5,0,1,0,0,1H7v.5A1.5,1.5,0,0,0,8.5,15ZM8,11.5a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5v2a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5Z"></path></g></svg>
									Filter
								</a>
								
								<div class="shop-tab">
									<ul class="nav" role="tablist" id="dz-shop-tab">
										<li class="nav-item" role="presentation">
											<a href="#tab-list-list" class="nav-link active" id="tab-list-list-btn" data-bs-toggle="pill" data-bs-target="#tab-list-list" role="tab" aria-controls="tab-list-list" aria-selected="true">
												<svg width="512" height="512" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
													<g clip-path="url(#clip0_121_190)">
													<path d="M42.667 373.333H96C119.564 373.333 138.667 392.436 138.667 416V469.333C138.667 492.898 119.564 512 96 512H42.667C19.103 512 0 492.898 0 469.333V416C0 392.436 19.103 373.333 42.667 373.333Z" fill="black"></path>
													<path d="M42.667 186.667H96C119.564 186.667 138.667 205.77 138.667 229.334V282.667C138.667 306.231 119.564 325.334 96 325.334H42.667C19.103 325.333 0 306.231 0 282.667V229.334C0 205.769 19.103 186.667 42.667 186.667Z" fill="black"></path>
													<path d="M42.667 0H96C119.564 0 138.667 19.103 138.667 42.667V96C138.667 119.564 119.564 138.667 96 138.667H42.667C19.103 138.667 0 119.564 0 96V42.667C0 19.103 19.103 0 42.667 0Z" fill="black"></path>
													<path d="M230.565 373.333H468.437C492.682 373.333 512.336 392.436 512.336 416V469.333C512.336 492.897 492.682 512 468.437 512H230.565C206.32 512 186.666 492.898 186.666 469.333V416C186.667 392.436 206.32 373.333 230.565 373.333Z" fill="black"></path>
													<path d="M230.565 186.667H468.437C492.682 186.667 512.336 205.77 512.336 229.334V282.667C512.336 306.231 492.682 325.334 468.437 325.334H230.565C206.32 325.334 186.666 306.231 186.666 282.667V229.334C186.667 205.769 206.32 186.667 230.565 186.667Z" fill="black"></path>
													<path d="M230.565 0H468.437C492.682 0 512.336 19.103 512.336 42.667V96C512.336 119.564 492.682 138.667 468.437 138.667H230.565C206.32 138.667 186.666 119.564 186.666 96V42.667C186.667 19.103 206.32 0 230.565 0Z" fill="black"></path>
													</g>
													<defs>
													<clipPath id="clip0_121_190">
													<rect width="512" height="512" fill="white"></rect>
													</clipPath>
													</defs>
												</svg>
											</a>
										</li>
										<li class="nav-item" role="presentation">
											<a href="#tab-list-column" class="nav-link" id="tab-list-column-btn" data-bs-toggle="pill" data-bs-target="#tab-list-column" role="tab" aria-controls="tab-list-column" aria-selected="false">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512" height="512">
													<g>
														<path d="M85.333,0h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   C38.205,234.667,0,196.462,0,149.333v-64C0,38.205,38.205,0,85.333,0z"></path>
														<path d="M362.667,0h64C473.795,0,512,38.205,512,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   c-47.128,0-85.333-38.205-85.333-85.333v-64C277.333,38.205,315.538,0,362.667,0z"></path>
														<path d="M85.333,277.333h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   C38.205,512,0,473.795,0,426.667v-64C0,315.538,38.205,277.333,85.333,277.333z"></path>
														<path d="M362.667,277.333h64c47.128,0,85.333,38.205,85.333,85.333v64C512,473.795,473.795,512,426.667,512h-64   c-47.128,0-85.333-38.205-85.333-85.333v-64C277.333,315.538,315.538,277.333,362.667,277.333z"></path>
													</g>
												</svg>
											</a>
										</li>
										<li class="nav-item" role="presentation">
											<a href="#tab-list-grid" class="nav-link" id="tab-list-grid-btn" data-bs-toggle="pill" data-bs-target="#tab-list-grid" role="tab" aria-controls="tab-list-grid" aria-selected="false">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_2" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512" height="512"><g>
													<path d="M42.667,373.333H96c23.564,0,42.667,19.103,42.667,42.667v53.333C138.667,492.898,119.564,512,96,512H42.667   C19.103,512,0,492.898,0,469.333V416C0,392.436,19.103,373.333,42.667,373.333z"></path>
													<path d="M416,373.333h53.333C492.898,373.333,512,392.436,512,416v53.333C512,492.898,492.898,512,469.333,512H416   c-23.564,0-42.667-19.102-42.667-42.667V416C373.333,392.436,392.436,373.333,416,373.333z"></path>
													<path d="M42.667,186.667H96c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.103,42.667-42.667,42.667H42.667   C19.103,325.333,0,306.231,0,282.667v-53.333C0,205.769,19.103,186.667,42.667,186.667z"></path>
													<path d="M416,186.667h53.333c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.102,42.667-42.667,42.667H416   c-23.564,0-42.667-19.103-42.667-42.667v-53.333C373.333,205.769,392.436,186.667,416,186.667z"></path>
													<path d="M42.667,0H96c23.564,0,42.667,19.103,42.667,42.667V96c0,23.564-19.103,42.667-42.667,42.667H42.667   C19.103,138.667,0,119.564,0,96V42.667C0,19.103,19.103,0,42.667,0z"></path>
													<path d="M229.333,373.333h53.333c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.103,42.667-42.667,42.667h-53.333   c-23.564,0-42.667-19.102-42.667-42.667V416C186.667,392.436,205.769,373.333,229.333,373.333z"></path>
													<path d="M229.333,186.667h53.333c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.103,42.667-42.667,42.667h-53.333   c-23.564,0-42.667-19.103-42.667-42.667v-53.333C186.667,205.769,205.769,186.667,229.333,186.667z"></path>
													<path d="M229.333,0h53.333c23.564,0,42.667,19.103,42.667,42.667V96c0,23.564-19.103,42.667-42.667,42.667h-53.333   c-23.564,0-42.667-19.103-42.667-42.667V42.667C186.667,19.103,205.769,0,229.333,0z"></path>
													<path d="M416,0h53.333C492.898,0,512,19.103,512,42.667V96c0,23.564-19.102,42.667-42.667,42.667H416   c-23.564,0-42.667-19.103-42.667-42.667V42.667C373.333,19.103,392.436,0,416,0z"></path>
												</g>
												</svg>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 tab-content shop-" id="pills-tabContent">
								<div class="tab-pane fade show active" id="tab-list-list" role="tabpanel" aria-labelledby="tab-list-list-btn">
									<div class="row">
										@forelse ( $productss as $product )
										<div class="col-md-12 col-sm-12">
											<div class="dz-shop-card style-2">
												<div class="dz-media">
													@if ($product->image == 'No image found')
														<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
													@else
														<img src="/uploads/product/{{ $product->image}}" width="190" height="220" alt="image">
													@endif
												</div>
												<div class="dz-content">
													<div class="dz-header">
														<div>
															<h4 class="title mb-0"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h4>
															<ul class="dz-tags">
																
																<li><a href="{{ route('product-cat' , $product->category->slug)}}">
																	{{$product->category->title}}
																</a></li>
															</ul>
														</div>
														<div class="review-num">
															<ul class="dz-rating">
																<li class="star-fill">
																	<i class="flaticon-star-1"></i>
																</li>										
																<li class="star-fill">
																	<i class="flaticon-star-1"></i>
																</li>
																<li class="star-fill">
																	<i class="flaticon-star-1"></i>
																</li>
																<li>
																	<i class="flaticon-star-1"></i>
																</li>
																<li>
																	<i class="flaticon-star-1"></i>
																</li>
															</ul>
															<span><a href="javascript:void(0);"> 370 Review</a></span>
														</div>
													</div>
													<div class="dz-body">
														<div class="dz-rating-box">
															<div>
																<p class="dz-para">{{$product->description}}</p>
															</div>
														</div>
														<div class="rate">
															<div class="d-flex align-items-center mb-xl-3 mb-2">
																<div class="meta-content">
																	<span class="price-name">Price</span>
																	<span class="price">@if ($product->sale_price)
																<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
																@else
																Rs/{{$product->price}}
																@endif</span>
																</div>
															</div>
															<div class="d-flex">
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
																<button class="btn btn-secondary btn-md btn-icon" type="submit" ><i class="icon feather icon-shopping-cart d-md-none d-block"></i><span class="d-md-block d-none">Add to cart</span></button>
																@endif
															</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@empty
											<div class="alert alert-danger">No Record Found!</div>
										@endforelse
									</div>
								</div>
								<div class="tab-pane fade" id="tab-list-column" role="tabpanel" aria-labelledby="tab-list-column-btn">
									<div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
										@forelse ( $products as $product ) 
										<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 m-md-b15 m-sm-b0 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													@if ($product->image == 'No image found')
														<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
													@else
														<img src="/uploads/product/{{ $product->image}}" width="190" height="220" alt="{{$product->name}}">
													@endif
												<div class="shop-meta">
												@if(Cart::instance("cart")->content()->Where('id',$product->id)->count()>0)
						    										<a href="{{route('cart.index')}}" class="btn btn-secondary btn-md btn-rounded"><i class="fa-solid fa-eye d-md-none d-block"></i><span class="d-md-block d-none">Go to Cart</span></a>
																	@else
																<form method="POST" action="{{route('cart.add')}}">
																{{ csrf_field() }}
																<input type="hidden" name="id" value="{{$product->id}}"/>
																<input type="hidden" name="title" value="{{$product->name}}"/>
																<input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->price : $product->sale_price}}"/>
																<input type="hidden" name="product_img" value="{{$product->image}}"/>
																<input type="hidden" name="quantity" value="1"/>
																<button class="btn btn-secondary btn-md btn-rounded" type="submit" ><i class="fa-solid fa-eye d-md-none d-block"></i><span class="d-md-block d-none">Add to cart</span></button>
																@endif
															</form>
													</div>							
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h5>
													<h5 class="price">@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif</h5>
												</div>
												<div class="product-tag">
													<span class="badge ">Get 10% Off</span>
												</div>
											</div>
										</div>
										@empty
											<div class="alert alert-danger">No Record Found!</div>
										@endforelse
									</div>
								</div>
								<div class="tab-pane fade" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
									<div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
										@forelse ( $products as $product )
										<div class="col-6 col-xl-4 col-lg-4 col-md-4 col-sm-4 m-md-b15 m-sm-b0 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													@if ($product->image == 'No image found')
														<img src="/uploads/no-img.jpg" width="190" height="220" alt="image">
													@else
														<img src="/uploads/product/{{ $product->image}}" width="190" height="220" alt="{{$product->name}}">
													@endif
												<div class="shop-meta">
													@if(Cart::instance("cart")->content()->Where('id',$product->id)->count()>0)
						    										<a href="{{route('cart.index')}}" class="btn btn-secondary btn-md btn-rounded"><i class="fa-solid fa-eye d-md-none d-block"></i><span class="d-md-block d-none">Go to Cart</span></a>
																	@else
																<form method="POST" action="{{route('cart.add')}}">
																{{ csrf_field() }}
																<input type="hidden" name="id" value="{{$product->id}}"/>
																<input type="hidden" name="title" value="{{$product->name}}"/>
																<input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->price : $product->sale_price}}"/>
																<input type="hidden" name="product_img" value="{{$product->image}}"/>
																<input type="hidden" name="quantity" value="1"/>
																<button class="btn btn-secondary btn-md btn-rounded" type="submit" ><i class="fa-solid fa-eye d-md-none d-block"></i><span class="d-md-block d-none">Add to cart</span></button>
																@endif
															</form>
													</div>							
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h5>
													<h5 class="price">@if ($product->sale_price)
													<del>Rs/{{$product->price}}</del>Rs/{{$product->sale_price}}
													@else
													Rs/{{$product->price}}
													@endif</h5>
												</div>
												<div class="product-tag">
													<span class="badge ">Get 10% Off</span>
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
						<div class="row page mt-0">
							<div class="col-md-6">
								<p class="page-text"></p>
							</div>
							<div class="col-md-6">
								<nav aria-label="Blog Pagination">
								<ul class="wgp-pagination pagination style-1 p-t20 ms-5">
									{{$products->links('pagination::bootstrap-5')}}
								</ul>
							</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
