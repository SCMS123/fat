
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Motor PSV Insurance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Motor PSV Insurance Edit</li>
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
                     <h3 class="card-title">Motor PSV Insurance Edit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" action="<?php echo e(route('motor_psv.update')); ?>" method="POST" enctype="multipart/form-data" >
                     <?php echo e(csrf_field()); ?>

                     <input type="hidden" name="id" value="<?php echo e($result->id); ?>">
                     <input type="hidden" name="category_id" value="<?php echo e($result->category_id); ?>">
                     <input type="hidden" name="sub_category_id" value="<?php echo e($result->sub_category_id); ?>">
                     <div class="card-body">

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="customer_id">Select Customer</label>
                                 <select name="customer_id" class="customer_id select12 form-control" id="customer_id" data-placeholder="Select Customer" style="width: 100%;" required>
                                    <option value="">Select Customer</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($value->id); ?>" <?php echo e($result->customer_id == $value->id ? 'selected' : ''); ?> ><?php echo e($value->first_name); ?> <?php echo e($value->middle_name); ?> <?php echo e($value->last_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                              </div>
                           </div>

                           <!-- <div class="col-md-6">
                              <div class="form-group">
                                 <label for="sub_category_id">Sub-Category</label>
                                 <select name="sub_category_id" class="sub_category_id select12 form-control" id="sub_category_id" data-placeholder="Select a Sub-Category" style="width: 100%;" required >
                                    <option value="">Select Sub-Category</option>
                                    <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($value->id); ?>" <?php echo e($result->sub_category_id == $value->id ? 'selected' : ''); ?>><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                              </div>
                           </div> -->
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="title">Title</label>
                                 <input type="text" name="title" value="<?php echo e($result->title); ?>" class="form-control" id="title" placeholder="Enter Title" required>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="registration_number">Registration Letters and Number</label>
                                 <input type="text" name="registration_number" value="<?php echo e($result->registration_number); ?>" class="form-control" id="registration_number"  placeholder="Enter Registration Number" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="make">Make of Cycle</label>
                                 <input type="text" name="make" value="<?php echo e($result->make); ?>" class="form-control" id="make" placeholder="Enter Make" required>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="cubic_capacity">Cubic Capacity</label>
                                 <input type="text" name="cubic_capacity" class="form-control" id="cubic_capacity" value="<?php echo e($result->cubic_capacity); ?>" required>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="manufacture_year">Year of Manufacture</label>
                                 <input type="text" name="manufacture_year" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" data-mask id="manufacture_year" value="<?php echo e($result->manufacture_year); ?>" required>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="chassis_number">Chassis Number</label>
                                 <input type="text" name="chassis_number" class="form-control" id="chassis_number" placeholder="Enter Chassis Number" value="<?php echo e($result->chassis_number); ?>" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="body_type">Type Of Body</label>
                                 <input type="text" name="body_type" class="form-control" id="body_type" placeholder="Enter Type of Body" value="<?php echo e($result->body_type); ?>" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="seating_capacity">Total Seating Capacity</label>
                                 <input type="number" name="seating_capacity" class="form-control" id="seating_capacity" placeholder="Enter Total Seating Capacity" min="1" step="0.02" value="<?php echo e($result->seating_capacity); ?>" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="max_carrying_capacity">Maker’s Maximum Carrying Capacity</label>
                                 <input type="number" name="max_carrying_capacity" class="form-control" id="max_carrying_capacity" placeholder="Enter Maximum Carrying Capacity" min="1" step="0.02" value="<?php echo e($result->max_carrying_capacity); ?>" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="price_paid">Price paid by Proposer</label>
                                 <input type="number" name="price_paid" class="form-control" id="price_paid" placeholder="Enter Price paid by Proposer" min="1" step="0.02" value="<?php echo e($result->price_paid); ?>" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="purchase_date">Purchased Date</label>
                                 <input type="date" name="purchase_date" class="form-control" id="purchase_date" value="<?php echo e($result->purchase_date); ?>" required>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="present_value_estimate">Proposer's Estimate of Present Value</label>
                                 <input type="number" name="present_value_estimate" class="form-control" id="present_value_estimate" value="<?php echo e($result->present_value_estimate); ?>" required>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="insurance_cover">Insurance Cover Type</label>
                           <select name="insurance_cover" class="insurance_cover form-control" id="insurance_cover" data-placeholder="Select a insurance cover" style="width: 100%;" required>
                              <option value="">Select Insurance Cover Type</option>
                              <option value="COMPRESSIVE" <?php echo e($result->insurance_cover == 'COMPRESSIVE' ? 'selected' : ''); ?>>COMPRESSIVE</option>
                              <option value="THIRD PARTY FIRE AND THEFT" <?php echo e($result->insurance_cover == 'THIRD PARTY FIRE AND THEFT' ? 'selected' : ''); ?>>THIRD PARTY FIRE AND THEFT</option>
                              <option value="THIRD PARTY ONLY" <?php echo e($result->insurance_cover == 'THIRD PARTY ONLY' ? 'selected' : ''); ?>>THIRD PARTY ONLY</option>
                           </select>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="attachment">Renewal Notice (<span class="text-xs text-primary">Are you entitled to a ‘No claim Bonus’ from previous Insurers in respect of any of the Cycle described in this Proposal? If so, please attach Renewal Notice</span>)</label>
                                 <input type="file" name="renewal_notice" class="form-control" id="renewal_notice" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf"><br>
                                 <i class="far fa-file-<?php echo e($icons[$ext[1]]); ?> fa-5x text-center"/></i>
                                 <a class="" href="<?php echo e(asset('/public/admin/clip-one/assets/motor_insurance/renewal_notice')); ?>/<?php echo e($result->renewal_notice); ?>" target="_blank" downlaod="<?php echo e($result->renewal_notice); ?>"><span><?php echo e($result->renewal_notice); ?></span></a>
                              </div>
                           </div>
                        </div>

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="<?php echo e(route('motor_psv.index')); ?>" class="btn btn-default btn-secondary">Back</a>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fat\resources\views/admin/motor_psv/edit.blade.php ENDPATH**/ ?>