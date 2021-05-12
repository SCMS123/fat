@extends('admin.layout.master')
@section('content')



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Motor Cycle Insurance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Motor Cycle Insurance View</li>
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
               <!-- @if (count($errors) > 0)       
                  <div class="alert alert-danger alert-dismissable">
                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                     @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br/>
                     @endforeach    
                  </div>         
               @endif
              
              @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message')}}</p>
              @endif -->
        
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Motor Cycle Insurance View</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                     <div class="card-body">

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="customer_id">Customer</label>
                                 {{$result->customer_id}}
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="title">Title</label>
                                 {{ $result->title }}
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="registration_number">Registration Letters and Number</label>
                                 {{ $result->registration_number }}
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="make">Make of Cycle</label>
                                 {{ $result->make }}
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="cubic_capacity">Cubic Capacity</label>
                                 {{ $result->cubic_capacity }}
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="manufacture_year">Year of Manufacture</label>
                                 {{ $result->manufacture_year }}
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="chassis_number">Chassis Number</label>
                                 {{ $result->chassis_number }}
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="seating_capacity">Total Seating Capacity</label>
                                 {{ $result->seating_capacity }}
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="max_carrying_capacity">Maker’s Maximum Carrying Capacity</label>
                                 {{ $result->max_carrying_capacity }}
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="price_paid">Price paid by Proposer</label>
                                 {{ $result->price_paid }}
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="purchase_date">Purchased Date</label>
                                 {{ $result->purchase_date }}
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="present_value_estimate">Proposer's Estimate of Present Value</label>
                                 {{ $result->present_value_estimate }}
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="insurance_cover">Insurance Cover Type</label>
                           {{$result->insurance_cover}}
                          
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="attachment">Renewal Notice </label>
                                 <a href="{{ asset('/public/admin/clip-one/assets/motor_insurance/renewal_notice')}}/{{ $result->renewal_notice }}" target="_blank" downlaod="{{$result->renewal_notice}}"><span>{{$result->renewal_notice}}</span></a>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="card card-info">
                                 <div class="card-header">Comment panel</div>
                                    <div class="card-body">
                                       <form id="quickForm" action="{{ route('motor_insurance.comment') }}" method="POST">
                                          {{csrf_field()}}
                                          <input type="hidden" name="policy_id" value="{{ $result->id }}">
                                          <textarea name="comment" class="form-control" placeholder="write a comment..." rows="3"></textarea><br>
                                          <button type="submit" class="btn btn-info float-right">Post</button>
                                          <div class="clearfix"></div>
                                       </form>
                                       <hr>
                                       
                                       <ul class="media-list">
                                       @foreach($comments as $comment)
                                       <?php
                                          $user = DB::table('users')->where('id',$comment->comment_by)->first();
                                          $timeAgo = App\Helpers\AdminHelper::time_elapsed_string($comment->created_at);
                                       ?>
                                          <li class="media">
                                              <a href="#" class="float-left">
                                                  <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle" style="width: 60px">
                                              </a>
                                              <div class="media-body">
                                                  <span class="text-muted float-right">
                                                      <small class="text-muted">{{$timeAgo}}</small>
                                                  </span>
                                                  <strong class="text-success">by {{$user->name}}</strong>
                                                  <p>{{$comment->comment}}</a>
                                                  </p>
                                              </div>
                                          </li>
                                          <hr>
                                       @endforeach

                                      </ul>
                                    </div>
                                 </div>
                              </div>

                           </div>
                        </div>

                     </div>
                     <div class="card-footer">
                        <div>
                           <a href="{{route('motor_insurance.index')}}" class="btn btn-muted btn-secondary">Back</a>
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
         comment: {
            required: true
         }
      },
      messages: {
         comment: {
            required: "",
         }
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