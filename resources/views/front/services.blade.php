@extends('front.layout.master')
@section('content')

<section>
	<div class="container-fluid">
		<div class="row">
			<!--<div class="inner-header" style="background-image: url({{asset('assets/front/images/services-banner.jpg')}}"></div>-->
			<div class="col-lg-12 p-0">
			    <video loop="true" autoplay="autoplay" muted="" playsinline="" style="height: 500px;">
				    <source src="http://testdmcconsultancy.com/demo/fjs_plant/assets/front/images/services.mp4" type="video/mp4">
    		    </video>
			</div>
		</div>
	</div>
</section>	


<section>
	<div class="container-fluid">
		<div class="row">
			<div class="services-panel">
				<div class="container-xxl container-xl container-md container-sm">
					<div class="row">
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 offset-md-2 border">
							<div class="services-box">
								<div class="web-content">
									<h1>Service</h1>
									<p>Our Customer and Product Support at FJS Plant is second to none. We currently have a fleet of mobile vehicles on the road offering a back up service to all of our customers.</p>
									
									<p>This along with our workshop facility at our depot ensures our customers that all service requirements are carried out to a high standard.</p>
									
									<p>We have a dedicated qualified team of plant fitters to keep your machines up and running 24/7.</p>
									
									<p>In 2018 FJS Plant Repairs were awarded the Service Excellance Reward from Kubota Construction Machiney, Pictured recieving the Award from Gary Walsh Service Manager (Kubota UK) was Frank Smyth (Director/FJS Plant Repairs Ltd).</p>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="top-space">
	<div class="container-xxl container-xl container-md container-sm">
		<div class="tz-gallery">

            <div class="row">
    			<!-- <div class="col-xl-12 col-lg-12 text-center mb-3">
    				<div class="web-content">
    					<h2>Machine Gallery</h2>
    				</div>
    			</div> -->
    			
                @foreach($galleries as $gallery)
                <div class="col-sm-6 col-md-4">
                    <a class="lightbox" href="{{url('/public/admin/clip-one/assets/gallery/original')}}/{{$gallery->image}}">
                        <img src="{{url('/public/admin/clip-one/assets/gallery/original')}}/{{$gallery->image}}" alt="Park">
                    </a>
                </div>
                @endforeach

            </div>

        </div>
		
	</div>
</section>

@endsection