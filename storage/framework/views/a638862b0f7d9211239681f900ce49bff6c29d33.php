

<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
   <!--  <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
 -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- <?php if(Auth::user()->user_type == 'admin'): ?> -->
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge"></span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Lead Comments</span>

            <!-- <?php $__currentLoopData = $lead_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php //$timeAgo = App\Helpers\AdminHelper::time_elapsed_string($lead_comment->created_at); ?> -->
            <a href="<?php echo e(route('leads.view',$lead_comment->id)); ?>" class="dropdown-item">
               <!-- Message Start -->
               <div class="media">
                  <!-- <img src="<?php echo e(asset('assets/admin/dist/img/user1-128x128.jpg')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                  <div class="media-body">
                     <h3 class="dropdown-item-title">Test
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                     </h3>
                     <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 1</p>
                  </div>
               </div>
               <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <!-- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
         </div>
      </li>
      <!-- <?php endif; ?> -->

      <!-- <?php if(Auth::user()->user_type == 'admin'): ?> -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge"></span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
               <i class="fas fa-envelope mr-2"></i> new quotes
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
               <i class="fas fa-users mr-2"></i>new sales order created
            </a>

            <!-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
               <i class="fas fa-file mr-2"></i> 3 new reports
               <span class="float-right text-muted text-sm">2 days</span>
            </a> -->

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer"></a>
         </div>
      </li>
      <!-- <?php endif; ?> -->

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="<?php echo e(url('admin/logout')); ?>" class="dropdown-item">Logout</a>
        </div>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar --><?php /**PATH C:\xampp\htdocs\fat\resources\views/admin/includes/navbar.blade.php ENDPATH**/ ?>