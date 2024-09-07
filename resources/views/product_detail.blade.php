@extends('frontlayout.master')
@extends('frontlayout.header-pro')
@section('page-title')
	{{$product_detail->name}}
@endsection
@section('main-content')

	<div class="page-content bg-light">
		<div class="d-sm-flex justify-content-between container-fluid py-3">
			<nav aria-label="breadcrumb" class="breadcrumb-row">
				<ul class="breadcrumb mb-0">
					<li class="breadcrumb-item"><a href="/">Home</a></li>
					<li class="breadcrumb-item">Product Default</li>
				</ul>
			</nav>
		</div>
		
		<section class="content-inner py-0">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-4 col-md-4">
						<div class="dz-product-detail sticky-top">
							<div class="swiper-btn-center-lr">
								<div class="swiper product-gallery-swiper2 rounded" >
									<div class="swiper-wrapper" id="lightgallery2">
										<div class="swiper-slide">
											<div class="dz-media DZoomImage">
												<a class="mfp-link lg-item" href="/uploads/product/{{$product_detail->image}}" data-src="/uploads/product/{{$product_detail->image}}">
													<i class="feather icon-maximize dz-maximize top-left"></i>
												</a>
												@if ($product_detail->image == 'No image found')
													<img src="/uploads/no-img.jpg" alt="image">
												@else
													<img src="/uploads/product/{{$product_detail->image}}" alt="{{$product_detail->title}}">
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="swiper product-gallery-swiper thumb-swiper-lg">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											@if ($product_detail->image == 'No image found')
													<img src="/uploads/no-img.jpg" alt="image">
											@else
													<img src="/uploads/product/{{$product_detail->image}}" alt="{{$product_detail->title}}">
											@endif
										</div>
									</div>
								</div>
							</div>							
						</div>	
					</div>
					<div class="col-xl-8 col-md-8">
						<div class="row">
							<div class="col-xl-7">
								<div class="dz-product-detail style-2 p-t20 ps-0">
									<div class="dz-content">
										<div class="dz-content-footer">
											<div class="dz-content-start">
												<span class="badge bg-secondary mb-2">{{$product_detail->condition}}</span>
												<h4 class="title mb-1">{{$product_detail->name}}</h4>
												<div class="review-num">
													<ul class="dz-rating me-2">
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
													<span class="text-secondary me-2">4.7 Rating</span>
													<a href="javascript:void(0);">(5 customer reviews)</a>
												</div>
											</div>
										</div>
										<p class="para-text">
											{{$product_detail->short_description}}
										</p>
										
										<div class="product-num">
											
											@if($product_detail->options)
											<div class="d-block">

												<label class="form-label">Size</label>
												<div class="btn-group product-size m-0">
													@php 
															$sizes=explode(',',$product_detail->options);
															// dd($sizes);
														@endphp
													@foreach($sizes as $size)
													
													<label class="badge" for="">{{$size}}</label>
													@endforeach
												</div>

											</div>
											@endif
										</div>
										<div class="dz-info"> 
											<ul>
												<li><strong>Category:</strong></li>
												<li><a href="{{route('product-cat', $product_detail->category->slug)}}"> {{$product_detail->category->title}}</a></li>
											</ul>
											<ul>
												<li><strong>SKU:</strong></li>
												<li>{{$product_detail->SKU}}</li>
											</ul>
											<ul>
												<li><strong>Tags:</strong></li>
												<li><a href="">{{$product_detail->tags}}</a></li>							
											</ul>										
										</div>
									</div>
									<div class="banner-social-media">
										<ul>
											<li>
												<a href="https://www.instagram.com/dexignzone/">Instagram</a>
											</li>
											<li>
												<a href="https://www.facebook.com/dexignzone">Facebook</a>
											</li>
											<li>
												<a href="https://twitter.com/dexignzones">twitter</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-5">
								<div class="cart-detail">
									<a href="javascript:void(0);" class="btn btn-outline-secondary w-100 m-b20">Cash On Delivery</a>
									<div class="icon-bx-wraper style-4 m-b15">
										<div class="icon-bx">
											<i class="flaticon flaticon-ship"></i>
										</div>
										<div class="icon-content">
											<span class=" font-14">Enjoy</span>
											<h6 class="dz-title">Free Shipping</h6>
										</div>
									</div>
									<div class="save-text">
										<i class="icon feather icon-check-circle"></i>
										<span class="m-l10">Feel Free To Add To Cart</span>
									</div>
									<table>
										<tbody>
											<tr class="total">
												<td>
													<h6 class="mb-0">Total</h6>
												</td>
												<td class="price">
													@if ($product_detail->sale_price)
													<p><del>Rs/{{$product_detail->price}}</del></p><p>Rs/{{$product_detail->sale_price}}</p>
													@else
													<p>Rs/{{$product_detail->price}}</p>
													@endif
												</td>
											</tr>
										</tbody>
									</table>
									
									@if(Cart::instance("cart")->content()->Where('id',$product_detail->id)->count()>0)
    								<a href="{{route('cart.index')}}" class="btn btn-secondary w-100 mb-3">Go to Cart</a>
									@else
									<form method="POST" action="{{route('cart.add')}}">
										{{ csrf_field() }}
									<input type="hidden" name="id" value="{{$product_detail->id}}"/>
									<input type="hidden" name="title" value="{{$product_detail->name}}"/>
									<input type="hidden" name="price" value="{{$product_detail->sale_price == '' ? $product_detail->price : $product_detail->sale_price}}"/>
									<input type="hidden" name="product_img" value="{{$product_detail->image}}"/>
									<div class="meta-content m-b20 d-flex align-items-end">									
										<div class="btn-quantity light d-xl-block d-sm-none ">
											<label class="form-label">Quantity</label>
											<input  type="number" name="quantity" value="1" min="1"/>		
										</div>
									</div>
									@if($product_detail->quantity == '0')
									<div class="alert alert-danger">Out Stock</div>
									@else
										<button type="submit" class="btn btn-secondary w-100 mb-3">ADD TO CART</button>
									@endif
									</form>
									@endif
									<a href="javascript:void(0);" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
											Buy Now
										</a>
										<div class="modal quick-view-modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered mt-3 mb-3 wow fadeInUp">
						<div class="modal-content">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<i class="icon feather icon-x"></i>
							</button>
							<div class="modal-body">
						<div class="col-xl-12 col-md-12 col-lg-6 ps-5 pe-5 pt-5 pb-5 bg-light">
							<div class="pt-2 mb-0">
								<form name="checkout-form" action="{{route('cart.place.order')}}" method="POST" class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group m-b25 text-center">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                    <input name="name" required="" class="form-control bg-light ">
                                </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group m-b25 text-center">
                                    <label class="label-title">Phone</label>
                                    <input name="phone" required="" class="form-control bg-light">
                                </div>
                            </div>                    
                            
                            
                            <div class="col-md-6">
                                <div class="form-group m-b25 text-center">
                                    <label class="label-title">City</label>
                                    <input name="city" required="" class="form-control bg-light">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group m-b25 text-center">
                                    <label class="label-title">Address</label>
                                    <input name="address" required="" class="form-control bg-light">
                                </div>
                            </div>
                            
                                                      
                            <input type="hidden" name="id" value="{{$product_detail->id}}"/>
                            <input type="hidden" name="buy_now" value="yes"/>
									<input type="hidden" name="title" value="{{$product_detail->name}}"/>
									<input type="hidden" name="price" value="{{$product_detail->sale_price == '' ? $product_detail->price : $product_detail->sale_price}}"/>
									<input type="hidden" name="product_img" value="{{$product_detail->image}}"/>
									<input type="hidden" name="qty" value="1"/>
                   			 </div>
                    	<div class="col-xl-12 text-center">                                             
                            <div class="accordion dz-accordion accordion-sm mt-3 text-center" id="accordionFaq1">
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading2">
                                        <div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse2" role="navigation" aria-expanded="true" aria-controls="collapse2">
                                            <input class="form-check-input radio" type="radio" name="mode" value="cod">
                                            <label class="form-check-label" for="flexRadioDefault5">
                                                Cash on delivery
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-secondary w-100">PLACE ORDER</button>
                        </div>
                    </div>
					</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="content-inner-3 pb-0"> 
			<div class="container">
				<div class="product-description">
					<div class="dz-tabs">					
						<ul class="nav nav-tabs center" id="myTab1" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Description</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Reviews (12)</button>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
								<div class="detail-bx text-center">
									<h5 class="title">{{$product_detail->name}}</h5>
									<p class="para-text">
										{{$product_detail->description}}
									</p>	
								</div>
							</div>
							<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
								<div class="clear" id="comment-list">
									<div class="post-comments comments-area style-1 clearfix">
										<h4 class="comments-title mb-2">Comments (02)</h4>
										<p class="dz-title-text">There are many variations of passages of Lorem Ipsum available.</p>
										<div id="comment">
											<ol class="comment-list">
												<li class="comment even thread-even depth-1 comment" id="comment-2">
													<div class="comment-body">
													  <div class="comment-author vcard">
															<img src="/assets/images/profile4.jpg" alt="/" class="avatar">
															<cite class="fn">Michel Poe</cite> 
													  </div>
												  <div class="comment-content dz-page-text">
													 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
												  </div>
												  <div class="reply">
													 <a rel="nofollow" class="comment-reply-link" href="javascript:void(0);">Reply</a>
												  </div>
											   </div>
											   <ol class="children">
												  <li class="comment byuser comment-author-w3itexpertsuser bypostauthor odd alt depth-2 comment" id="comment-3">
													 <div class="comment-body" id="div-comment-3">
														<div class="comment-author vcard">
														   <img src="/assets/images/profile3.jpg" alt="/" class="avatar">
														   <cite class="fn">Celesto Anderson</cite>
														</div>
														<div class="comment-content dz-page-text">
														   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
														</div>
														<div class="reply">
														   <a class="comment-reply-link" href="javascript:void(0);"> Reply</a>
														</div>
													 </div>
												  </li>
											   </ol>
											</li>
											<li class="comment even thread-odd thread-alt depth-1 comment" id="comment-4">
												<div class="comment-body" id="div-comment-4">
													<div class="comment-author vcard">
														<img src="/assets/images/profile2.jpg" alt="/" class="avatar">
														<cite class="fn">Monsur Rahman Lito</cite>
													</div>
													<div class="comment-content dz-page-text">
														<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
													</div>
													<div class="reply">
														<a class="comment-reply-link" href="javascript:void(0);"> Reply</a>
													</div>
												</div>
											</li>
										 </ol>
									  </div>
									<div class="default-form comment-respond style-1" id="respond">
										<h4 class="comment-reply-title mb-2" id="reply-title">Good Comments</h4>
										<p class="dz-title-text">There are many variations of passages of Lorem Ipsum available.</p>
										<div class="comment-form-rating d-flex">
											<label class="pull-left m-r10 m-b20  text-secondary">Your Rating</label>
											<div class="rating-widget">
												<!-- Rating Stars Box -->
												<div  class="rating-stars">
													<ul id="stars">
														<li class="star" title="Poor" data-value="1">
															<i class="fas fa-star fa-fw"></i>
														</li>
														<li class="star" title="Fair" data-value="2">
															<i class="fas fa-star fa-fw"></i>
														</li>
														<li class="star" title="Good" data-value="3">
															<i class="fas fa-star fa-fw"></i>
														</li>
														<li class="star" title="Excellent" data-value="4">
															<i class="fas fa-star fa-fw"></i>
														</li>
														<li class="star" title="WOW!!!" data-value="5">
															<i class="fas fa-star fa-fw"></i>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<form method="post" id="comments_form" class="comment-form" novalidate>
											   <p class="comment-form-author"><input id="name" placeholder="Author" name="author" type="text" value=""></p>
											   <p class="comment-form-email"><input id="email" required="required" placeholder="Email" name="email" type="email" value=""></p>
											   <p class="comment-form-comment"><textarea id="comments" placeholder="Type Comment Here" class="form-control4" name="comment" cols="45" rows="3" required="required"></textarea></p>
											   <p class="col-md-6 col-sm-12 col-xs-12 form-submit">
												  <button id="submit" type="submit" class="submit btn btn-secondary btnhover3 filled">
												  Submit Now
												  </button>
											   </p>
											</form>
										</div>
									  </div>
								   </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="content-inner-1  overflow-hidden">
			<div class="container">
				<div class="section-head style-2 d-md-flex justify-content-between align-items-center">
					<div class="left-content">
						<h2 class="title mb-0">Related products</h2>
					</div>
					<a href="{{route('shop')}}" class="text-secondary font-14 d-flex align-items-center gap-1">See all products
						<i class="icon feather icon-chevron-right font-18"></i>
					</a>			
				</div>
				<div class="swiper-btn-center-lr">
					<div class="swiper swiper-four">
						<div class="swiper-wrapper">
							@forelse ( $rel_product as $product )
							<div class="swiper-slide">
								<div class="shop-card style-1">
									<div class="dz-media">
										@if ($product->image == 'No image found')
											<img src="/uploads/no-img.jpg" alt="image">
										@else
											<img src="/uploads/product/{{$product->image}}" alt="{{$product->name}}">
										@endif
										<div class="shop-meta">
										@if(Cart::instance("cart")->content()->Where('id',$product->id)->count()>0)
    										<a href="{{route('cart.index')}}" class="btn btn-secondary btn-md btn-rounded">Go to Cart</a>
											@else
										<form method="POST" action="{{route('cart.add')}}">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{$product->id}}"/>
										<input type="hidden" name="title" value="{{$product->name}}"/>
										<input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->price : $product->sale_price}}"/>
										<input type="hidden" name="product_img" value="{{$product->image}}"/>
										<input type="hidden" name="quantity" value="1"/>
										<button class="btn btn-secondary btn-md btn-rounded" type="submit" >ADD TO CART</button> 
										@endif
										</form>
														
										</div>								
									</div>
									<div class="dz-content">
										<h5 class="title"><a href="{{route('product-detail', $product->slug )}}">{{Str::limit($product->name, 18, '..')}}</a></h5>		
										
									</div>
									<div class="product-tag">
										<span class="badge">Get 10% Off</span>
									</div>
									<span class="price">
											@if ($product_detail->sale_price)
													<del>Rs/{{$product_detail->price}}</del>Rs/{{$product_detail->sale_price}}
													@else
													Rs/{{$product_detail->price}}
													@endif</span>
								</div>
							</div>
							@empty
								<div class="alert alert-danger">No Record Found</div>
							@endforelse
						</div>
					</div>
					<div class="pagination-align">
						<div class="tranding-button-prev btn-prev">
							<i class="flaticon flaticon-left-chevron"></i>
						</div>
						<div class="tranding-button-next btn-next">
							<i class="flaticon flaticon-chevron"></i>
						</div>
					</div>
				</div>
			</div>
		</section>	
	</div>

@endsection