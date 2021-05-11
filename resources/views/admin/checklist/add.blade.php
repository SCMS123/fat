@extends('admin.layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Checklist</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Checklist Add</li>
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
                     <h3 class="card-title">Checklist Add</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" role="form" action="{{ route('checklist.save') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                 {{csrf_field()}}
                     <div class="card-body">

                        <div class="form-group">
                           <label for="policy_category_id">Policy Category </label>
                           <select name="policy_category_id"  id="policy_category_id" class="form-control">
                               <option value="">Select Policy Category</option>
                               @foreach($policycategory as $policycat)
                               <option value="{{$policycat->id}}">{{$policycat->name}}</option>
                               @endforeach
                               
                           </select>
                          
                        </div>
                         <div class="form-group">
                           <label for="policy_category_id">Policy Sub Category </label>
                           <select name="policy_sub_category_id"  id="policy_sub_category_id" class="form-control">
                               <option value="">Select Policy Sub Category</option>
                               @foreach($policysubcategory as $policysubcat)
                               <option value="{{$policysubcat->id}}">{{$policysubcat->name}}</option>
                               @endforeach
                               
                           </select>
                          
                        </div>
                        <div class="form-group">
                           <label for="title">Check List Title</label>
                           <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" autocomplete="off" />
                        </div>
                        
                       
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('checklist.index')}}" class="btn btn-default btn-secondary">Back</a>
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
         policy_category_id: {
            required: true
         },
         policy_sub_category_id: {
            required: true
         },
          title: {
            required: true
         },
      },
      messages: {
         policy_category_id: {
            required: "Please select policy category",
         },
         policy_sub_category_id: {
            required: "Please select policy sub category",
         },
         title: {
            required: "Please enter title !",
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