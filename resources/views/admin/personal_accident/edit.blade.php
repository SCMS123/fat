@extends('admin.layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Personal Accident Insurance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Personal Accident Insurance Edit</li>
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
                     <h3 class="card-title">Personal Accident Insurance Edit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" action="{{route('personal_accident.update')}}" method="POST" enctype="multipart/form-data" >
                     {{csrf_field()}}
                     <input type="hidden" name="id" value="{{$result->id}}">
                     <input type="hidden" name="category_id" value="{{$result->category_id}}">
                     <input type="hidden" name="sub_category_id" value="{{$result->sub_category_id}}">
                     <div class="card-body">

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="customer_id">Select Customer</label>
                                 <select name="customer_id" class="customer_id select12 form-control" id="customer_id" data-placeholder="Select Customer" style="width: 100%;" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $value)
                                       <option value="{{$value->id}}" {{$result->customer_id == $value->id ? 'selected' : ''}} >{{$value->first_name}} {{$value->middle_name}} {{$value->last_name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <!-- <div class="col-md-6">
                              <div class="form-group">
                                 <label for="sub_category_id">Sub-Category</label>
                                 <select name="sub_category_id" class="sub_category_id select12 form-control" id="sub_category_id" data-placeholder="Select a Sub-Category" style="width: 100%;" required >
                                    <option value="">Select Sub-Category</option>
                                    @foreach($sub_categories as $value)
                                       <option value="{{$value->id}}" {{$result->sub_category_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div> -->
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="title">Title</label>
                                 <input type="text" name="title" value="{{ $result->title }}" class="form-control" id="title" placeholder="Enter Title" required>
                              </div>
                           </div>

                           

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('personal_accident.index')}}" class="btn btn-default btn-secondary">Back</a>
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
$('.select12').select2({
   theme: 'bootstrap4'
});

$('#manufacture_year').inputmask('yyyy', { 'placeholder': 'yyyy' });

$(function () {
   $('#quickForm').validate({
      rules: {
         customer_id: {
            required: true
         },
         sub_category_id: {
            required: true
         },
         title: {
            required: true
         },
         registration_number: {
            required: true
         },
         make: {
            required: true
         },
         cubic_capacity: {
            required: true
         },
         manufacture_year: {
            required: true
         },
         chassis_number: {
            required: true
         },
         seating_capacity: {
            required: true
         },
         max_carrying_capacity: {
            required: true
         },
         price_paid: {
            required: true
         },
         purchase_date: {
            required: true
         },
         present_value_estimate: {
            required: true
         },
         insurance_cover: {
            required: true
         },
      },
      messages: {
         customer_id: {
            required: "",
         },
         sub_category_id: {
            required: "",
         },
         title: {
            required: "",
         },
         registration_number: {
            required: "",
         },
         make: {
            required: "",
         },
         cubic_capacity: {
            required: "",
         },
         manufacture_year: {
            required: "",
         },
         chassis_number: {
            required: "",
         },
         seating_capacity: {
            required: "",
         },
         max_carrying_capacity: {
            required: "",
         },
         price_paid: {
            required: "",
         },
         purchase_date: {
            required: "",
         },
         present_value_estimate: {
            required: "",
         },
         insurance_cover: {
            required: "",
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