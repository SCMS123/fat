@extends('admin.layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Motor Private Insurance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Motor Private Insurance Edit</li>
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
                     <h3 class="card-title">Motor Private Insurance Edit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" action="{{route('motor_private.update')}}" method="POST" enctype="multipart/form-data" >
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

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="registration_number">Registration Letters and Number</label>
                                 <input type="text" name="registration_number" value="{{ $result->registration_number }}" class="form-control" id="registration_number"  placeholder="Enter Registration Number" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="make">Make of Cycle</label>
                                 <input type="text" name="make" value="{{ $result->make }}" class="form-control" id="make" placeholder="Enter Make" required>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="cubic_capacity">Cubic Capacity</label>
                                 <input type="text" name="cubic_capacity" class="form-control" id="cubic_capacity" value="{{ $result->cubic_capacity }}" required>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="manufacture_year">Year of Manufacture</label>
                                 <input type="text" name="manufacture_year" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" data-mask id="manufacture_year" value="{{ $result->manufacture_year }}" required>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="chassis_number">Chassis Number</label>
                                 <input type="text" name="chassis_number" class="form-control" id="chassis_number" placeholder="Enter Chassis Number" value="{{ $result->chassis_number }}" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="body_type">Type Of Body</label>
                                 <input type="text" name="body_type" class="form-control" id="body_type" placeholder="Enter Type of Body" value="{{ $result->body_type }}" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="seating_capacity">Total Seating Capacity</label>
                                 <input type="number" name="seating_capacity" class="form-control" id="seating_capacity" placeholder="Enter Total Seating Capacity" min="1" step="0.02" value="{{ $result->seating_capacity }}" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="max_carrying_capacity">Maker’s Maximum Carrying Capacity</label>
                                 <input type="number" name="max_carrying_capacity" class="form-control" id="max_carrying_capacity" placeholder="Enter Maximum Carrying Capacity" min="1" step="0.02" value="{{ $result->max_carrying_capacity }}" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="price_paid">Price paid by Proposer</label>
                                 <input type="number" name="price_paid" class="form-control" id="price_paid" placeholder="Enter Price paid by Proposer" min="1" step="0.02" value="{{ $result->price_paid }}" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="purchase_date">Purchased Date</label>
                                 <input type="date" name="purchase_date" class="form-control" id="purchase_date" value="{{ $result->purchase_date }}" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="present_value_estimate">Proposer's Estimate of Present Value</label>
                                 <input type="number" name="present_value_estimate" class="form-control" id="present_value_estimate" value="{{ $result->present_value_estimate }}" required>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="insurance_cover">Insurance Cover Type</label>
                           <select name="insurance_cover" class="insurance_cover form-control" id="insurance_cover" data-placeholder="Select a insurance cover" style="width: 100%;" required>
                              <option value="">Select Insurance Cover Type</option>
                              <option value="COMPRESSIVE" {{$result->insurance_cover == 'COMPRESSIVE' ? 'selected' : ''}}>COMPRESSIVE</option>
                              <option value="THIRD PARTY FIRE AND THEFT" {{$result->insurance_cover == 'THIRD PARTY FIRE AND THEFT' ? 'selected' : ''}}>THIRD PARTY FIRE AND THEFT</option>
                              <option value="THIRD PARTY ONLY" {{$result->insurance_cover == 'THIRD PARTY ONLY' ? 'selected' : ''}}>THIRD PARTY ONLY</option>
                           </select>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="attachment">Renewal Notice (<span class="text-xs text-primary">Are you entitled to a ‘No claim Bonus’ from previous Insurers in respect of any of the Cycle described in this Proposal? If so, please attach Renewal Notice</span>)</label>
                                 <input type="file" name="renewal_notice" class="form-control" id="renewal_notice" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf"><br>
                                 <i class="far fa-file-{{$icons[$ext[1]]}} fa-5x text-center"/></i>
                                 <a class="" href="{{ asset('/public/admin/clip-one/assets/motor_insurance/renewal_notice')}}/{{ $result->renewal_notice }}" target="_blank" downlaod="{{$result->renewal_notice}}"><span>{{$result->renewal_notice}}</span></a>
                              </div>
                           </div>
                        </div>

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('motor_private.index')}}" class="btn btn-default btn-secondary">Back</a>
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
         body_type: {
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
         body_type: {
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