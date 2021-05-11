@extends('admin.layout.master')
@section('content')

<?php 
   $current_route = \Request::route()->getName();
   $routeArr = explode('.', $current_route);
   $section = $routeArr[0];
   $action = $routeArr[1];

   $data = App\Helpers\AdminHelper::checkAddButtonPermission($section,Auth::user()->id);
?>
 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Miscellaneous Insurance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Miscellaneous Insurance List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <section class="content">
      <div class="container-fluid">
         <div class="row">
          
            <div class="col-lg-6 col-6">
               <a href="{{route('personal_accident.index')}}" class="small-box-footer">
                  <div class="small-box bg-info">
                     <div class="inner">
                        <h3></h3>
                        <p>Personal Accident</p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-bag"></i>
                     </div>
                     <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                  </div>
               </a>
            </div>

            <!-- <div class="col-lg-6 col-6">
               <a href="{{route('motor_private.index')}}" class="small-box-footer">
                  <div class="small-box bg-warning">
                     <div class="inner">
                        <h3></h3>
                        <p>Motor Private</p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-bag"></i>
                     </div>
                     <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                  </div>
               </a>
            </div> -->

            <!-- <div class="col-lg-6 col-6">
               <a href="{{route('motor_commercial.index')}}" class="small-box-footer">
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3></h3>
                        <p>Motor Commercial</p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-bag"></i>
                     </div>
                     <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                  </div>
               </a>
            </div> -->

            <!-- <div class="col-lg-6 col-6">
               <a href="{{route('motor_psv.index')}}" class="small-box-footer">
                  <div class="small-box bg-danger">
                     <div class="inner">
                        <h3></h3>
                        <p>Motor PSV</p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-bag"></i>
                     </div>
                     <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                  </div>
               </a>
            </div> -->

         </div>
       
      </div>
   </section>

  </div>
@endsection
@section('script')


@endsection
  


