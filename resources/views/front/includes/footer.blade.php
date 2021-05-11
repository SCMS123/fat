<?php 

  $categories = DB::table('categories')->take(8)->get();

?>

<footer class="top-space" id="footer_class">
  <div class="container-fluid">
    <div class="row">
      <div class="footer-panel">
        <div class="container-xxl container-xl container-md container-sm">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
              <div class="ftr-box">
                <div class="logo">
                    <a href="index.html">
                    <img src="{{asset('assets/front/images/logo.png')}}" alt="" class="img-fluid">
                    </a>
                  </div>
                
                <ul class="ftr-socials">
                  <li><a href="https://www.facebook.com/fjsplant/" target="_blank"><i class="icofont-facebook"></i></a></li>
                  <li><a href="https://www.linkedin.com/in/fjs-plant-a49869199/" target="_blank"><i class="icofont-linkedin"></i></a></li>
                  <li><a href="https://www.instagram.com/fjsplant/" target="_blank"><i class="icofont-instagram"></i></a></li>
                </ul>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
              <div class="ftr-box">
                <h6>FJS Plant</h6>
                <ul class="ftr-links">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('about_us')}}">About Us</a></li>
                    <!-- <li><a href="#">Brand</a></li> -->
                    <li><a href="{{route('services')}}">Service</a></li>
                    <li><a href="{{route('contact_us')}}">Contact Us</a></li>
                    <li><a href="{{route('our_team')}}">Our Team</a></li>
                    <li><a href="{{route('news')}}">News</a></li>
                    <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                  </ul>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
              <div class="ftr-box">
                <h6>Machines</h6>
                <ul class="ftr-links">
                  @foreach($categories as $category)
                    <li><a href="{{route('productsByCategory',$category->id)}}">{{$category->name}}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
              <div class="ftr-box">
                <h6>Contact Us</h6>
                <ul class="ftr-links ftr-contact">
                  <li>Call: <a href="#">+353 (0)45 863542</a></li>
                  <li>Email: <a href="mailto:enquiries@fjsplant.ie">enquiries@fjsplant.ie</a></li>
                  <li>Address:<br> Timahoe, Donadea, Naas Co.<br> Kildare, W91 A789</li>
                </ul>
                
                <ul class="ftr-socials">
                    <li><a href="#" target="_blank"><i class="icofont-facebook"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-twitter"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-instagram"></i></a></li>
                    <li><a href="#" target="_blank"><i class="icofont-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
      <div class="copyright-panel">
        <p>Copyright  2021 | All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>
  
  
  
</body> 
<script src="{{asset('assets/front/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/front/js/stellarnav.js')}}"></script>
  
   <script type="text/javascript">
//     jQuery(document).ready(function($) {
//       jQuery('.stellarnav').stellarNav({
//         theme: 'dark',
//         breakpoint: 960,
//         position: 'right',
//       });
//     });
  </script>
  
<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
<script src="{{asset('assets/front/js/testi1.js')}}"></script>
<script  src="{{asset('assets/front/js/testi2.js')}}"></script>
<script src="{{asset('assets/front/js/logo1.js')}}"></script>
<script  src="{{asset('assets/front/js/logo2.js')}}"></script>
<script  src="{{asset('assets/front/js/sidebar.js')}}"></script>

<script  src="{{asset('assets/front/js/category-filter.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="{{asset('assets/admin/plugins/toastr/toastr.min.js')}}"></script>


<script>
    baguetteBox.run('.tz-gallery');
    $('.category-filter .category-button').categoryFilter();
</script>

<script type="text/javascript">
   @if(Session::has('message'))
      var type = "{{ Session::get('alert-type', 'info') }}";
      switch(type){
         case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

         case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

         case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
                
         case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
      }
   @endif
</script>


<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js'></script>

</html>