
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Policy Sub Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Policy Sub Category Add</li>
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
               <?php if(count($errors) > 0): ?>       
                  <div class="alert alert-danger alert-dismissable">
                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span><?php echo e($error); ?></span><br/>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                  </div>         
               <?php endif; ?>
              
              <?php if(Session::has('message')): ?>
                  <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('message')); ?></p>
              <?php endif; ?>
        
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Sub Category Add</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" role="form" action="<?php echo e(route('policy_sub_categories.save')); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                 <?php echo e(csrf_field()); ?>

                     <div class="card-body">

                         <div class="form-group">
                           <label for="category_id">Category</label>
                           <select name="category_id" id="category_id" class="form-control">
                              <option value="">Select Category</option>
                              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                           
                        </div>
                       
                        
                        
                        <div class="form-group">
                           <label for="name">Name</label>
                           <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" autocomplete="off" />
                        </div>
                        
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="<?php echo e(route('policy_sub_categories.index')); ?>" class="btn btn-default btn-secondary">Back</a>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')); ?>"></script>

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
         } 
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hm3hczr3zv0q/public_html/demo/fat/resources/views/admin/policysubcategories/add.blade.php ENDPATH**/ ?>