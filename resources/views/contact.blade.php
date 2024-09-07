@extends('frontlayout.master')
@extends('frontlayout.header-main')
@section('page-title')
	Contact 
@endsection
@section('main-content')
<div class="page-content bg-light">
		
		<!--banner-->
		<div class="contact-bnr bg-light">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="contact-info style-1 text-start text-white">
							<h2 class="title wow fadeInUp" data-wow-delay="0.1s">DISCOVER US</h2>
							<p class="text wow fadeInUp" data-wow-delay="0.2s"><span class="text-decoration-underline"><a  href="our-team.html">OnlineStore is here to help you;</a></span> <br> Our experts are available to answer any questions you might have. We’ve got the answers.</p>
							<div class="contact-bottom wow fadeInUp" data-wow-delay="0.3s">
								<div class="contact-left">
									<h3>Contact Us</h3>
									@php
		                           		$data=DB::table('settings')->first();     
		                        	@endphp
									<ul>
										<li>{{$data->phone}}</li>
										<li>{{$data->email}}</li>
									</ul>
								</div>	
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="contact-area1 style-1 m-r20 m-md-r0 wow fadeInUp" data-wow-delay="0.5s">
							<form class="dz-form dzForm" method="POST" action="script/contact_smtp.php">
								<input type="hidden" class="form-control" name="dzToDo" value="Contact">
								<input type="hidden" class="form-control" name="reCaptchaEnable" value="0">
								<div class="dzFormMsg"></div>
								<label class="form-label">Your Name</label>
								<div class="input-group">
									<input required type="text" class="form-control" name="dzName">
								</div>
								<label class="form-label">Email Address</label>
								<div class="input-group">
									<input required type="text" class="form-control" name="dzEmail">
								</div>
								<label class="form-label">Phone Number</label>
								<div class="input-group">
									<input required type="text" class="form-control" name="dzPhoneNumber">
								</div>
								<label class="form-label">Massage</label>
								<div class="input-group m-b30">
									<textarea name="dzMessage" rows="4" required class="form-control m-b10"></textarea>
								</div>
								<div class="input-recaptcha m-b30">
									<div class="g-recaptcha" data-sitekey="<!-- Put Your Recaptcha Secret Kye -->" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
									<input class="form-control d-none" style="display:none;" data-recaptcha="true" required data-error="Please complete the Captcha">
								</div>
								<div>
									<button name="submit" type="submit" value="submit" class="btn w-100 btn-white btnhover">SUBMIT</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="content-inner-2 pt-0">
			<div class="map-iframe map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.65046970649679!3d26.88544791796718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1500819483219" style="border:0; width:100%; min-height:100%; margin-bottom: -8px;" allowfullscreen></iframe>
			</div>
		</div>
	
	</div>
@endsection
