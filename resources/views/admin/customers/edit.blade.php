@extends('admin.layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Customer</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Customer Edit</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
<!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
       
            <div class="col-lg-12"> 
               @if (count($errors) > 0)       
                  <div class="alert alert-danger alert-dismissable">
                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                     @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br/>
                     @endforeach    
                  </div>         
               @endif
              
              @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message')}}</p>
              @endif
        
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Customer Edit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" role="form" action="{{ route('customers.update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                 {{csrf_field()}}
                 <input type="hidden" name="id" value="{{$result->id}}">
                     <div class="card-body">

                        <div class="form-group">
                           <label for="first_name">First Name</label>
                           <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" value="{{$result->first_name}}" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="middle_name">Middle Name</label>
                           <input type="text" name="middle_name" class="form-control" id="middle_name" value="{{$result->middle_name}}" placeholder="Enter Middle Name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="last_name">Last Name</label>
                           <input type="text" name="last_name" class="form-control" id="last_name" value="{{$result->last_name}}" placeholder="Enter Last Name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" name="email" class="form-control" id="email" value="{{$result->email}}" placeholder="Enter Email" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="phone">Phone</label>
                           <input type="text" name="phone" class="form-control" id="phone" value="{{$result->phone}}" placeholder="Enter Phone" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="address">Address</label>
                           <textarea name="address" class="form-control" id="address" placeholder="Enter Address" autocomplete="off"> {{$result->address}}</textarea>
                           
                        </div>
                        <div class="form-group">
                           <label for="bio">Bio</label>
                           <textarea name="bio" class="form-control" id="bio" placeholder="Enter Bio" autocomplete="off"> {{$result->bio}}</textarea>
                           
                        </div>
                        
                        <div class="form-group">
                           <label for="city">City</label>
                           <input type="text" name="city" class="form-control" id="city" value="{{$result->city}}" placeholder="Enter City" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="state">State</label>
                           <input type="text" name="state" class="form-control" id="state" value="{{$result->state}}" placeholder="Enter State" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="country">Country</label>
                           <input type="text" name="country" class="form-control" id="country"  value="{{$result->country}}" placeholder="Enter Country" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="TIN_number">TIN Number</label>
                           <input type="text" name="TIN_number" class="form-control" id="TIN_number"  value="{{$result->TIN_number}}" placeholder="Enter TIN_number" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="customer_type">Customer Type</label>
                           <select name="customer_type" class="form-control" id="customer_type">
                               <option value="">Select Type</option>
                               <option value="Corporate" @if($result->customer_type == 'Corporate') selected @endif>Corporate</option>
                               <option value="Individual" @if($result->customer_type == 'Individual') selected @endif>Individual</option>
                               <option value="Government" @if($result->customer_type == 'Government') selected @endif>Government</option>
                               <option value="etc" @if($result->customer_type == 'etc') selected @endif>etc</option>
                           </select>
                          
                        </div>
                        <div class="form-group">
                           <label for="license">License</label>
                           <input type="text" name="license" class="form-control" id="license" value="{{$result->license}}" placeholder="Enter License" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="area">Area</label>
                           <input type="text" name="area" class="form-control" id="area" placeholder="Enter Area" value="{{$result->area}}" autocomplete="off" />
                        </div>
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('customers.index')}}" class="btn btn-default btn-secondary">Back</a>
                        </div>
                     </div>
                  </form>
               </div> 
            </div>
            <div class="col-lg-2"></div>
         </div>
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>

@endsection

@section('script')
<script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script>
$(function () {
   $('#quickForm').validate({
      rules: {
         first_name: {
            required: true
         },
         last_name: {
            required: true
         },
         email: {
            required: true
         },
         phone: {
            required: true
         },
         address: {
            required: true
         },
         bio: {
            required: true
         },
         city: {
            required: true
         },
         state: {
            required: true
         },
         country: {
            required: true
         },
         TIN_number: {
            required: true
         },
         customer_type: {
            required: true
         },
         license: {
            required: true
         },
         area: {
            required: true
         },
         
      },
      messages: {
         first_name: {
            required: "Please enter first name!",
         },
         last_name: {
            required: "Please enter last name!",
         },
         email: {
            required: "Please enter email !",
         },
         phone: {
            required: "Please enter phone !",
         },
         address: {
            required: "Please enter address !",
         },
         bio: {
            required: "Please enter bio !",
         },
         city: {
            required: "Please enter city !",
         },
         state: {
            required: "Please enter state !",
         },
         country: {
            required: "Please enter country !",
         },
         TIN_number: {
            required: "Please enter TIN Number !",
         },
         customer_type: {
            required: "Please select customer type!",
         },
         license: {
            required: "Please enter license!",
         },
         area: {
            required: "Please enter area!",
         },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
         error.addClass('invalid-feedback');
         element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
         $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass('is-invalid');
      }
   });
});

</script>

@endsection