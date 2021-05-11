@extends('admin.layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Policy sub category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Policy sub Category Edit</li>
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
                     <h3 class="card-title">Policy Sub Category Edit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" role="form" action="{{ route('policy_sub_categories.update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                     {{csrf_field()}}
                     <input type="hidden" name="id" value="{{$result->id}}">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="category_id">Category</label>
                           <select name="category_id"  id="category_id" class="form-control">
                               <option value="">Select Category</option>
                               @foreach($categories as $category)
                               <option value="{{$category->id}}" @if($category->id==$result->category_id) selected @endif>{{$category->name}} </option>
                               @endforeach
                               
                           </select>
                          
                        </div>
                        <div class="form-group">
                           <label for="branch_code">Name</label>
                           <input type="text" name="name" value="{{$result->name}}" class="form-control" id="name" placeholder="Enter Name" autocomplete="off" />
                        </div>
                       
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('policy_sub_categories.index')}}" class="btn btn-default btn-secondary">Back</a>
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
         category_id: {
            required: true
         }, 
         name: {
            required: true
         },
        
      },
      messages: {
         category_id: {
            required: "Please select category!",
         }, 
         name: {
            required: "Please enter name!",
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