@extends('front.layout.master')
@section('content')



<link rel="stylesheet" href="{{asset('assets/front/css/products.css')}}">

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="slider-bg">
				<div class="row">
					<div class="col-lg-12 p-0">

						<div class="slider-panel">
						    
						    <video loop="true" autoplay="autoplay" muted playsinline>
								<source src="{{asset('assets/front/images/banner.mp4')}}" type="video/mp4">
							</video>
							
							
<!--							<div id="carouselExampleCaptions" class="carousel slide p-0" data-bs-ride="carousel">-->
  
	 
<!--  <div class="carousel-inner">-->
<!--    <div class="carousel-item active">-->
<!--      <img src="{{asset('assets/front/images/slider1.png')}}" class="img-fluid d-block mx-auto" alt="">-->
<!--    </div>-->

<!--    <div class="carousel-item">-->
<!--      <img src="{{asset('assets/front/images/slider2.png')}}" class="img-fluid d-block mx-auto" alt="">-->
<!--    </div>-->

<!--    <div class="carousel-item">-->
<!--      <img src="{{asset('assets/front/images/slider3.png')}}" class="img-fluid d-block mx-auto" alt="">-->
<!--    </div>-->
<!--  </div>-->

<!--  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">-->
<!--    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--    <span class="visually-hidden">Previous</span>-->
<!--  </button>-->
<!--  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">-->
<!--    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--    <span class="visually-hidden">Next</span>-->
<!--  </button>-->
<!--</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</section>


<section>
	<div class="container-xxl container-xl container-md container-sm">
		<form action="{{route('productsFilter')}}" method="GET">
			<!-- {{csrf_field()}} -->
			<div class="filter-search">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
						<select class="" name="type" id="type">
							<option value="">Choose Type</option>
							<option value="New">New</option>
							<option value="Used">Used</option>
						</select>
					</div>
						
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
						<select class="" name="dealer_id[]" id="dealer_id">
							<option value="">Choose Make</option>
							@foreach($dealers as $dealer)
								<option value="{{$dealer->id}}">{{$dealer->name}}</option>
							@endforeach
						</select>
					</div>
						
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
						<select class="" name="model[]" id="model">
							<option value="">Choose Model</option>
							@foreach($models as $model)
								<option value="{{$model->model}}">{{$model->model}}</option>
							@endforeach
						</select>
					</div>
						
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
						<button type="submit" id="filter_button"><i class="icofont-search-2"></i></button>
					</div>
					<span id="filter_error"></span>
				</div>
			</div>
		</form>
	</div>
</section>
	

	
<section class="top-space home-about-panel">
	<div class="container-xxl container-xl container-md container-sm">
		<div class="row">
			<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
				<div class="machine-section">
				    <img src="{{asset('assets/front/images/machine01.jpg')}}" alt="" class="img-fluid d-block mx-auto">
				</div>
			</div>
			
			<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
				<div class="web-content"> <!--  about-section -->
					<h1>About Us</h1>
					<p>FJS Plant was established in 1993 we are based approximately 25 miles from Dublin city centre. FJS Plant currently employ 22 skilled and highly experienced Staff across the area of Sales, Service, Repair, Spare Parts, Marketing and Administration. They are now a market leader in the Sales, Supply and Service of mobile plant and demolition equipment in Ireland.</p>
					<a href="{{route('about_us')}}">Read More</a>
				</div>
			</div>
		</div>
	</div>
</section>
	
	
<section class="top-space">
	<div class="container-fluid">
		<div class="row">
			<div class="product-panel">
				<div class="container-xxl container-xl container-md container-sm">
					<div class="row">
						<div class="col-xxl-12">
							<div class="web-content">
								<h2 class="text-center">Machine Categories</h2>
							</div>
						</div>


						<div class="owl-slider">
							<div class="owl-carousel" id="carousel">

								@foreach($categories as $category)
								<div class="item">
									<div class="product-box">
										<div class="product-icon">
											<img src="{{url('/public/admin/clip-one/assets/categories/original')}}/{{$category->image}}" alt="" class="img-fluid d-block mx-auto">
										</div>
										
										<div class="product-text web-content">
											<h3>{{$category->name}}</h3>
											<p>{{ \Illuminate\Support\Str::limit($category->description, 70, $end='...') }}</p>
											<a href="{{route('productsByCategory',$category->id)}}">Continue <span></span></a>
										</div>
									</div>
								</div>
								@endforeach
									
							</div>
						</div>
						
											
						<!-- <div class="col-xxl-12">
							<div class="web-content text-center">
								<a href="#" class="pt-3 pb-3">All Categories</a>
							</div>
						</div> -->
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	
	
	
<section class="top-space">
	<div class="container-xxl container-xl container-md container-sm">
		<div class="row">
			<div class="col-lg-12">
				<div class="web-content text-center">
					<h4>Clients Testimonials</h4>
				</div>
			</div>
			
			
	<div class="col-lg-12">
	<div class="gtco-testimonials">
    <div class="owl-carousel owl-carousel1 owl-theme">
      <div>
        <div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>Mick Fox</h5>
            <p class="card-text">“ Fast efficient and friendly ” </p>
          </div>
        </div>
      </div>
      <div>
        <div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>Cathal Phibbs</h5>
            <p class="card-text">“ Excellent customer service, and quality products ” </p>
          </div>
        </div>
      </div>
      <div>
        <div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>Paul Clare</h5>
            <p class="card-text">“ Purchased this girl 28 months ago and its has never missed a beat ” </p>
          </div>
        </div>
      </div>
		<div>
			<div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>Sale Kildare</h5>
            <p class="card-text">“ Great service ” </p>
          </div>
        </div>
		</div>
        
		  
		<div>
			<div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>Glenn Power</h5>
            <p class="card-text">“ Great staff and service ” </p>
          </div>
        </div>
		</div>
		  
		<div>
			<div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>Finbarr Sullivan</h5>
            <p class="card-text">“ Been in here lately good people make a great business they looked after me really well 1 top roller and hub oil change very quick . Thanks guys and lovely girls in office cheers ” </p>
          </div>
        </div>
		</div>
		  
		<div>
			<div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>KNR Turbines</h5>
            <p class="card-text">“ Excellent machines ” </p>
          </div>
        </div>
		</div> 
		 
		<div>
			<div class="card text-center"><img class="card-img-top" src="{{asset('assets/front/images/testi.jpg')}}" alt="">
          <div class="card-body">
            <h5>William Mullally</h5>
            <p class="card-text">“ Excellent ” </p>
          </div>
        </div>
		</div>
		  
    </div>
  </div>
			</div>
		</div>
	</div>
</section>

	
	
<section>
	<div class="container-xxl container-xl container-md container-sm">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="web-content text-center">
					<h4>Brands</h4>
				</div>
			</div>
			
			<div class="col-lg-12">
    			<div class="customer-logos slider">
    				@foreach($dealers as $dealer)
      				<div class="slide"><img src="{{url('/public/admin/clip-one/assets/dealers/original')}}/{{$dealer->image}}" alt=""></div>
      				@endforeach
   				</div>
			</div>
		</div>
	</div>
</section>


@endsection

@section('script')
<script  src="{{asset('assets/front/js/products.js')}}"></script>

<script>
	$('#filter_button').on('click',function(){
		var type = $('#type').val();
		var dealer_id = $('#dealer_id').val();
		var make = $('#make').val();
		var model = $('#model').val();

		if (type == '' && dealer_id == '' && make == '' && model == '') {
			toastr.error('Please choose atleast one.', 'Error');
			return false;
		}
	});
</script>
@endsection