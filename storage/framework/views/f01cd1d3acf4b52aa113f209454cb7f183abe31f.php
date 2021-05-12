
<?php $__env->startSection('content'); ?>

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
                  <li class="breadcrumb-item active">Customer Add</li>
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
                     <h3 class="card-title">Customer Add</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" role="form" action="<?php echo e(route('customers.save')); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                 <?php echo e(csrf_field()); ?>

                     <div class="card-body">

                        <div class="form-group">
                           <label for="first_name">First Name</label>
                           <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="middle_name">Middle Name</label>
                           <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Enter Middle Name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="last_name">Last Name</label>
                           <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="phone">Phone</label>
                           <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="address">Address</label>
                           <textarea name="address" class="form-control" id="address" placeholder="Enter Address" autocomplete="off"> </textarea>
                           
                        </div>
                        <div class="form-group">
                           <label for="bio">Bio</label>
                           <textarea name="bio" class="form-control" id="bio" placeholder="Enter Bio" autocomplete="off"> </textarea>
                           
                        </div>
                        
                        <div class="form-group">
                           <label for="city">City</label>
                           <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="state">State</label>
                           <input type="text" name="state" class="form-control" id="state" placeholder="Enter State" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="country">Country</label>
                           <input type="text" name="country" class="form-control" id="country" placeholder="Enter Country" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="TIN_number">TIN Number</label>
                           <input type="text" name="TIN_number" class="form-control" id="TIN_number" placeholder="Enter TIN_number" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="customer_type">Customer Type</label>
                           <select name="customer_type" class="form-control" id="customer_type">
                               <option value="">Select Type</option>
                               <option value="Corporate">Corporate</option>
                               <option value="Individual">Individual</option>
                               <option value="Government">Government</option>
                               <option value="etc">etc</option>
                           </select>
                          
                        </div>
                        <div class="form-group">
                           <label for="license">License</label>
                           <input type="text" name="license" class="form-control" id="license" placeholder="Enter License" autocomplete="off" />
                        </div>
                        <div class="form-group">
                           <label for="area">Area</label>
                           <input type="text" name="area" class="form-control" id="area" placeholder="Enter Area" autocomplete="off" />
                        </div>
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-default btn-secondary">Back</a>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fat\resources\views/admin/customers/add.blade.php ENDPATH**/ ?>