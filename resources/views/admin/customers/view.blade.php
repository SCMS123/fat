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
                  <li class="breadcrumb-item active">Customer View</li>
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
                     <h3 class="card-title">Customer View</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                     <div class="card-body">

                        <div class="form-group">
                           <label for="first_name">First Name:</label>
                           {{$result->first_name}}
                        </div>
                        <div class="form-group">
                           <label for="middle_name">Middle Name:</label>
                           {{$result->middle_name}}
                        </div>
                        <div class="form-group">
                           <label for="last_name">Last Name:</label>
                           {{$result->last_name}}
                        </div>
                        <div class="form-group">
                           <label for="email">Email:</label>
                           {{$result->email}}
                        </div>
                        <div class="form-group">
                           <label for="phone">Phone:</label>
                           {{$result->phone}}
                        </div>
                        <div class="form-group">
                           <label for="address">Address:</label>
                            {{$result->address}}
                           
                        </div>
                        <div class="form-group">
                           <label for="bio">Bio</label>
                            {{$result->bio}}
                           
                        </div>
                        
                        <div class="form-group">
                           <label for="city">City:</label>
                           {{$result->city}}
                        </div>
                        <div class="form-group">
                           <label for="state">State:</label>
                          {{$result->state}}
                        </div>
                        <div class="form-group">
                           <label for="country">Country:</label>
                           {{$result->country}}
                        </div>
                        <div class="form-group">
                           <label for="TIN_number">TIN Number:</label>
                          {{$result->TIN_number}}
                        </div>
                        <div class="form-group">
                           <label for="customer_type">Customer Type:</label>
                            {{$result->customer_type}}
                           
                        </div>
                        <div class="form-group">
                           <label for="license">License:</label>
                           {{$result->license}}
                        </div>
                        <div class="form-group">
                           <label for="area">Area:</label>
                           {{$result->area}}
                        </div>
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           
                           <a href="{{route('customers.index')}}" class="btn btn-default btn-secondary">Back</a>
                        </div>
                     </div>
                  
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



@endsection