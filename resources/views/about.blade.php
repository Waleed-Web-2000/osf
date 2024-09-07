@extends('frontlayout.master')
@extends('frontlayout.header-main')
@section('page-title')
	About 
@endsection
@section('main-content')
<div class="page-content bg-light">
	
		<section class="dz-bnr-inr dz-bnr-inr-sm bg-light">
			<div class="container">
				<div class="dz-bnr-inr-entry ">
					<div class="row align-items-center mt-5 mb-5">
						<div class="col-lg-7 col-md-7">
							<div class="text-start mb-xl-0 mb-4">
								@php
		                           $data=DB::table('settings')->first();     
		                        @endphp
								<h6>{{$data->description}}</h6>
							</div>							
						</div>
						<div class="col-lg-5 col-md-5 ">
							<div class="about-sale  text-start">
								<div class="row">
									<div class="col-lg-5 col-md-6 col-6">
										<div class="about-content">
											<h2 class="title"><span class="counter">200</span>+</h2>
											<p class="text">Items Sale Per Month</p>
										</div>
									</div>
									<div class="col-lg-5 col-md-6 col-6">
										<div class="about-content">
											<h2 class="title">90%</h2>
											<p class="text">Delivery Ratio</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		
		
		<!--Our Mission Section-->
		
		
		<!-- Get In Touch -->
		
		<!-- Get In Touch End -->
		
			
	</div>
@endsection