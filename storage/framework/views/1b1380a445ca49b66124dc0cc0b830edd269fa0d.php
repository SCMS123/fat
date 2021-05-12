
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">MOTOR - PRIVATE CAR INSURANCE</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">MOTOR - PRIVATE CAR INSURANCE ADD</li>
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
                     <h3 class="card-title">MOTOR - PRIVATE CAR INSURANCE  ADD</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                 
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hm3hczr3zv0q/public_html/demo/fat/resources/views/admin/motor_insurance/motor_private_add.blade.php ENDPATH**/ ?>