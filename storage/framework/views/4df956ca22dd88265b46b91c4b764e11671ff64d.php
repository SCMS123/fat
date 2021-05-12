<?php
   $current_route = \Request::route()->getName();
   $current_route_array = explode('.', $current_route);
   $checkRoute = DB::table('roles')->where('name_slug',$current_route_array[0])->first();

   $sections = DB::table('sections')->where('section_slug','!=','modules')->orderBy('section_order','ASC')->get();
?>

<style>
   [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-treeview {
    padding: 0 0 0 30px;
    font-size: 13px;
}
.nav-treeview i{
    font-size: 9px;
    position: relative;
    top: -1px;
    margin: 0 2px 0 0;
}
[class*='sidebar-dark'] .brand-link {
    border-bottom: 1px solid #ffffff2b;
}
[class*=sidebar-dark] .user-panel{
    border-bottom: 0px solid #4f5962;
}
[class*='sidebar-dark-'] {
    background-color: #505050;
}
.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
    background-color: #ff7224;
}
link.active, [class*='sidebar-dark-'] .nav-treeview > .nav-item > .nav-link.active:hover, [class*='sidebar-dark-'] .nav-treeview > .nav-item > .nav-link.active:focus {
    background-color: #ffc6a6;
}
[class*='sidebar-dark-'] .nav-treeview > .nav-item > .nav-link.active, [class*='sidebar-dark-'] .nav-treeview > .nav-item > .nav-link.active:hover, [class*='sidebar-dark-'] .nav-treeview > .nav-item > .nav-link.active:focus {
    background-color: #ffc6a6;
}
</style>
  
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
   <a href="index3.html" class="brand-link" style="background-color: #fff;">
      <img src="https://firstassurance.co.tz/images/logo.svg" alt="AdminLTE Logo" class="">
      <span class="brand-text font-weight-light">&nbsp;</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <!--<div class="image">-->
         <!--   <img src="https://firstassurance.co.tz/images/logo.svg" class="img-circle elevation-2" alt="User Image">-->
         <!--</div>-->
         <!--<div class="info">-->
         <!--   <a href="#" class="d-block">Admin</a>-->
         <!--</div>-->
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
               <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php if($current_route == 'admin.dashboard'){echo 'active';} ?>"><i class="nav-icon fas fa-tachometer-alt"></i><p>
                Dashboard</p></a>
            </li>

            <li class="nav-item <?php if($current_route == 'actions.index' || $current_route == 'sections.index' || $current_route == 'roles.index' || $current_route == 'actions.add' || $current_route == 'actions.edit' || $current_route == 'sections.add' || $current_route == 'sections.edit' || $current_route == 'roles.add' || $current_route == 'roles.edit'){echo 'menu-open';} ?>">

               <a href="#" class="nav-link <?php if($current_route == 'actions.index' || $current_route == 'sections.index' || $current_route == 'roles.index' || $current_route == 'actions.add' || $current_route == 'actions.edit' || $current_route == 'sections.add' || $current_route == 'sections.edit' || $current_route == 'roles.add' || $current_route == 'roles.edit'){echo 'active';} ?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>Modules<i class="fas fa-angle-left right"></i></p>
               </a>

               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?php echo e(url('/admin/actions/index')); ?>" class="nav-link <?php if($current_route == 'actions.index' || $current_route == 'actions.add' || $current_route == 'actions.edit'){echo 'active';} ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Actions</p>
                     </a>
                  </li>
               </ul>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?php echo e(url('/admin/sections/index')); ?>" class="nav-link <?php if($current_route == 'sections.index' || $current_route == 'sections.add' || $current_route == 'sections.edit'){echo 'active';} ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sections</p>
                     </a>
                  </li>
               </ul>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?php echo e(url('/admin/roles/index')); ?>" class="nav-link <?php if($current_route == 'roles.index' || $current_route == 'roles.add' || $current_route == 'roles.edit'){echo 'active';} ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                     </a>
                  </li>
               </ul>
            </li>
            <!-- Master -->
            <?php 
            $section = App\Helpers\AdminHelper::getTableData('sections','14');
            $getRoleSection = App\Helpers\AdminHelper::getRoleSection(Auth::user()->id,$section->id);
            if (Auth::user()->user_type == 'admin' || !empty(array_filter($getRoleSection)) > 0) { ?>

               <li class="nav-item <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'menu-open';} ?>">
                  <a href="#" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'active';} ?>">
                     <i class="nav-icon fas fa-stream"></i>
                     <p><?php echo e($section->section_title); ?><i class="fas fa-angle-left right"></i></p>
                  </a>
                  <?php 
                  $roles=DB::table('roles')->where('section_id',$section->id)->orderBy('order','ASC')->get(); ?>
   
                  <?php if(!empty($roles)): ?>
                  
                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','37');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','24');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','25');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>

                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','26');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','27');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','28');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','29');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','31');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                  <?php endif; ?>

               </li>
            <?php } ?>

            <!-- User Management -->
            <?php 
            $section = App\Helpers\AdminHelper::getTableData('sections','3');
            $getRoleSection = App\Helpers\AdminHelper::getRoleSection(Auth::user()->id,$section->id);
            if (Auth::user()->user_type == 'admin' || !empty(array_filter($getRoleSection)) > 0) { ?>

               <li class="nav-item <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'menu-open';} ?>">
                  <a href="#" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'active';} ?>">
                     <i class="nav-icon fas fa-stream"></i>
                     <p><?php echo e($section->section_title); ?><i class="fas fa-angle-left right"></i></p>
                  </a>
                  <?php 
                  $roles=DB::table('roles')->where('section_id',$section->id)->orderBy('order','ASC')->get(); ?>
   
                  <?php if(!empty($roles)): ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','4');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                  <?php endif; ?>

               </li>
            <?php } ?>

            <!-- Customer Management -->
            <?php 
            $section = App\Helpers\AdminHelper::getTableData('sections','15');
            $getRoleSection = App\Helpers\AdminHelper::getRoleSection(Auth::user()->id,$section->id);
            if (Auth::user()->user_type == 'admin' || !empty(array_filter($getRoleSection)) > 0) { ?>

               <li class="nav-item <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'menu-open';} ?>">
                  <a href="#" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'active';} ?>">
                     <i class="nav-icon fas fa-stream"></i>
                     <p><?php echo e($section->section_title); ?><i class="fas fa-angle-left right"></i></p>
                  </a>
                  <?php 
                  $roles=DB::table('roles')->where('section_id',$section->id)->orderBy('order','ASC')->get(); ?>
   
                  <?php if(!empty($roles)): ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','30');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->id == $rol->id){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                  <?php endif; ?>

               </li>
            <?php } ?>

            <!-- Policy Management -->
            <?php 
            $section = App\Helpers\AdminHelper::getTableData('sections','16');
            $getRoleSection = App\Helpers\AdminHelper::getRoleSection(Auth::user()->id,$section->id);
            if (Auth::user()->user_type == 'admin' || !empty(array_filter($getRoleSection)) > 0) { ?>

               <li class="nav-item <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'menu-open';} ?>">
                  <a href="#" class="nav-link <?php if(!empty($checkRoute) && $checkRoute->section_id == $section->id){echo 'active';} ?>">
                     <i class="nav-icon fas fa-stream"></i>
                     <p><?php echo e($section->section_title); ?><i class="fas fa-angle-left right"></i></p>
                  </a>
                  <?php 
                  $roles=DB::table('roles')->where('section_id',$section->id)->orderBy('order','ASC')->get(); ?>
   
                  <?php if(!empty($roles)): ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','32');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && ($checkRoute->id == '32' || $checkRoute->id == '33' || $checkRoute->id == '34')){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p><?php echo e($rol->name); ?></p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                     <?php 
                     $rol = App\Helpers\AdminHelper::getTableData('roles','36');
                     $adminPermissions = App\Helpers\AdminHelper::getAdminPermissions(Auth::user()->id,$rol->id); 
                     if (Auth::user()->user_type == 'admin' || !empty($adminPermissions)) { ?>

                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo e(route($rol->url)); ?>" class="nav-link <?php if(!empty($checkRoute) && ($checkRoute->id == '36')){echo 'active';} ?>">
                                 <i class="fas fa-chevron-right"></i>
                                 <p>Miscellaneous Insurance</p>
                              </a>
                           </li>
                        </ul>
                     <?php } ?>

                  <?php endif; ?>

               </li>
            <?php } ?> 

         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>

 <?php /**PATH /home/hm3hczr3zv0q/public_html/demo/fat/resources/views/admin/includes/sidebar.blade.php ENDPATH**/ ?>