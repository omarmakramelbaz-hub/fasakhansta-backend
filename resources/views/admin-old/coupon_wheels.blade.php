@extends('admin.index')
@push('custom-css')
    <style type="text/css">
  .span-txt{
    position: absolute;
    top: 39px;
    left: 50px;
    color: red;
    font-weight: bolder;
  }
  form .nav-item{
    border:1px solid #6c757d !important;
    border-radius:30px;
  }
</style>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@lang('main.coupon_wheel')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 card">
          <div class="card-body">
           @if(count($errors))
           <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form method="post" action="{{route('couponWheelUpdate',$coupon_wheel->id)}}" enctype="multipart/form-data">
            @csrf
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="name">@lang('main.wheel name')</label>
                  <input type="text" name="name" value="{{$coupon_wheel->name}}" class="form-control" id="name" placeholder="">
                </div>

                <div class="form-group col-sm-6">
                  <label for="price">@lang('main.wheel price')</label>
                  <input type="number" name="price" value="{{$coupon_wheel->price}}" class="form-control" id="price" placeholder="">
                </div>

                <div class="form-group col-sm-6">
                  <label for="start_date">@lang('main.wheel start_date')</label>
                  <input type="datetime-local" name="start_date" value="{{$coupon_wheel->start_date}}" class="form-control" id="start_date" placeholder="">
                </div>

                <div class="form-group col-sm-6">
                  <label for="end_date">@lang('main.wheel end_date')</label>
                  <input type="datetime-local" name="end_date" value="{{$coupon_wheel->end_date}}" class="form-control" id="end_date" placeholder="">
                </div>
                <div class="form-group col-sm-6">
                  <label for="amount">@lang('main.wheel amount')</label>
                  <input type="number" name="amount" value="{{$coupon_wheel->amount}}" class="form-control" id="amount" placeholder="">
                </div>
                <div class="form-group col-sm-6">
                  <label for="status"> @lang('main.wheel status')</label><span class="text-danger">*</span>
                  <select name="status" class="form-select">
                      <option value="show" @if($coupon_wheel->status == 'show') selected @endif>@lang('main.show')</option>
                      <option value="hide" @if($coupon_wheel->status == 'hide') selected @endif>@lang('main.hide')</option>
                  </select>
              </div>
              </div>
            <button type="submit" class="btn btn-success">@lang('main.save')</button>
         </form>
       </div>
     </div>
   </div>
 </div>
</section>
</div>               
@endsection