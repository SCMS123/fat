<?php 

$productTypes = DB::table('products')->select('type')->groupby('type')->get();
$brands = DB::table('dealers')->where('status','1')->get();

?>

<section>
    <div class="container-fluid">
        <div class="row">
            
            <div class="menu-panel">
				<div class="container-xxl container-xl container-md container-sm">
					<div class="row">
					    
					    <div class="col-xl-4 col-lg-4 col-md-4">
					        <div class="logo">
					            <a href="{{route('home')}}"><img src="{{asset('assets/front/images/logo.png')}}" alt=""></a>
					        </div>
					    </div>

						<div class="col-xl-5 col-lg-5 col-md-5">
							<ul class="ftr-links ftr-contact top-call">
									<li>Call: <a href="tel:+353(0)45863542">+353 (0)45 863542</a></li>
									<li>Email: <a href="mailto:enquiries@fjsplant.ie">enquiries@fjsplant.ie</a></li>
							</ul>
						</div>

						<div class="col-xl-3 col-lg-3 col-md-3">
								<div id="wrapper">
    
                                <!-- Sidebar -->
                            <nav class="navbar navbar-inverse fixed-top cus-fixed" id="sidebar-wrapper" role="navigation">
                                <ul class="nav sidebar-nav">
                                   <!-- <div class="sidebar-header">
                                   <div class="sidebar-brand">
                                     <a href="#">Brand</a></div></div> -->
                            
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li class="dropdown"><a href="#" class="dropdown-toggle"  data-toggle="dropdown">Our Company <span class="caret"></span></a>
                                        <ul class="dropdown-menu animated fadeInLeft" role="menu">
                                            <div class="dropdown-header"></div>
                                                <li><a href="{{route('about_us')}}">About Us</a></li>
                                                <li><a href="#">Our Team</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li class="dropdown"><a href="#" class="dropdown-toggle"  data-toggle="dropdown">Brand <span class="caret"></span></a>
                                        <ul class="dropdown-menu animated fadeInLeft" role="menu">
                                     
                                            <div class="dropdown-header"></div>
                                            @foreach($brands as $brand)
                                                <li><a href="{{route('brand',$brand->name)}}">{{$brand->name}}</a></li>
                                            @endforeach
                                  
                                        </ul>
                                    </li>
                                  
                                    <li><a href="{{route('services')}}">Service</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle"  data-toggle="dropdown">Stock <span class="caret"></span></a>
                                        <ul class="dropdown-menu animated fadeInLeft" role="menu">
                                            <div class="dropdown-header"></div>
                                            @foreach($productTypes as $productType)
                                                <li><a href="{{route('productsFilter')}}?type={{$productType->type}}">{{$productType->type}} Machinery</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{route('news')}}">News</a></li>
                                    <li><a href="{{route('contact_us')}}">Contact Us</a></li>
                                </ul>
                            </nav>
                                <!-- /#sidebar-wrapper -->
                        
                                <!-- Page Content -->
                                <div id="page-content-wrapper">
                                    <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                                        <i class="icofont-navigation-menu"></i> Menu
                                    </button>
                                    
                                    
                                </div>
                                <!-- /#page-content-wrapper -->
                        
                            </div>
						</div>
					</div>
				</div>
			</div>
            
            
        </div>
    </div>
</section>