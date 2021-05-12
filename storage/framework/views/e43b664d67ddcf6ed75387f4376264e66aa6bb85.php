
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
                     <h3 class="card-title">Customer View</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                     <div class="card-body">

                        <div class="form-group">
                           <label for="first_name">First Name:</label>
                           <?php echo e($result->first_name); ?>

                        </div>
                        <div class="form-group">
                           <label for="middle_name">Middle Name:</label>
                           <?php echo e($result->middle_name); ?>

                        </div>
                        <div class="form-group">
                           <label for="last_name">Last Name:</label>
                           <?php echo e($result->last_name); ?>

                        </div>
                        <div class="form-group">
                           <label for="email">Email:</label>
                           <?php echo e($result->email); ?>

                        </div>
                        <div class="form-group">
                           <label for="phone">Phone:</label>
                           <?php echo e($result->phone); ?>

                        </div>
                        <div class="form-group">
                           <label for="address">Address:</label>
                            <?php echo e($result->address); ?>

                           
                        </div>
                        <div class="form-group">
                           <label for="bio">Bio</label>
                            <?php echo e($result->bio); ?>

                           
                        </div>
                        
                        <div class="form-group">
                           <label for="city">City:</label>
                           <?php echo e($result->city); ?>

                        </div>
                        <div class="form-group">
                           <label for="state">State:</label>
                          <?php echo e($result->state); ?>

                        </div>
                        <div class="form-group">
                           <label for="country">Country:</label>
                           <?php echo e($result->country); ?>

                        </div>
                        <div class="form-group">
                           <label for="TIN_number">TIN Number:</label>
                          <?php echo e($result->TIN_number); ?>

                        </div>
                        <div class="form-group">
                           <label for="customer_type">Customer Type:</label>
                            <?php echo e($result->customer_type); ?>

                           
                        </div>
                        <div class="form-group">
                           <label for="license">License:</label>
                           <?php echo e($result->license); ?>

                        </div>
                        <div class="form-group">
                           <label for="area">Area:</label>
                           <?php echo e($result->area); ?>

                        </div>
                  
                     </div>

                     <div class="card-footer">
                        <div>
                           
                           <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-default btn-secondary">Back</a>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')); ?>"></script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hm3hczr3zv0q/public_html/demo/fat/resources/views/admin/customers/view.blade.php ENDPATH**/ ?>