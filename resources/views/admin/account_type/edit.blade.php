@extends('admin.layout.master')
@section('content')

<style type="text/css">
   .clearfix{
      margin-bottom: auto;
      margin-left: 30px;
   }
</style>

<?php
  $sections = DB::table('sections')->where('section_slug','!=','modules')->orderBy('section_order','ASC')->get();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Account Type</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Account Type Edit</li>
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
                     <h3 class="card-title">Account Type Edit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" role="form" action="{{ route('account_type.update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                 {{csrf_field()}}
                     <div class="card-body">
                        <input type="hidden" name="id" value="{{$result->id}}"/>
                        

                        <div class="form-group">
                           <label for="sub_admin">Account Nmae</label>
                           <input type="text" name="account_name" class="form-control" id="account_name" placeholder="Enter Account Name"  value="{{$result->account_name}}" autocomplete="off" />
                        </div>
                        
                        
                        <div class="form-group">
                           <label for="department_id">Sections</label>
                           <select name="section[]" id="section" class="form-control" multiple>
                             
                              <option value="">Select Section</option>
                              @foreach($sections as $section)
                                <?php
                               $exp=explode(',',$result->section);
                               
                               if(in_array($section->id,$exp))
                               {
                                 ?>
                               
                              <option value="{{$section->id}}" selected>{{$section->section_title}}</option>
                              <?php
                               }
                              else
                              {
                               ?>
                              <option value="{{$section->id}}">{{$section->section_title}}</option>
                              <?php
                              }
                              ?>
                            
                              @endforeach
                              
                           </select>
                        </div>
                       
                        
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('account_type.index')}}" class="btn btn-default btn-secondary">Back</a>
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
   // $.validator.setDefaults({
   //    submitHandler: function () {
   //       alert( "Form successful submitted!" );
   //    }
   // });
   $('#quickForm').validate({
      rules: {
         account_name: {
            required: true
         },
         section: {
            required: true
         },
         
      },
      messages: {
         account_name: {
            required: "Please enter account name",
         },
         section: {
            required: "Please select section",
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