@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-right:0px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@lang('main.choose type')</h1>
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
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6 text-center">
                <a href="{{route('chooseTypeChange',['menu'=> 'resturant'])}}" class="card-i">
                  <img src="{{url('/storage/' . app(App\Models\GeneralSettings::class)->logo)}}" style="width: 25%;height: 170px;">
                  <div class="footer-i">
                    <h5 class="text-center mt-5">@lang('main.faskhanista Resturant')</h5>
                  </div>
                </a>
              </div>

              <div class="col-sm-6 text-center">
                <a href="{{route('chooseTypeChange',['menu'=> 'application'])}}" class="card-i">
                  <img src="{{url('/storage/' . app(App\Models\GeneralSettings::class)->favicon)}}" style="width: 25%;height: 170px;">
                  <div class="footer-i">
                    <h5 class="text-center mt-5">@lang('main.faskhaNinja Application')</h5>
                  </div>
                </a>
              </div>
            </div>
          </div>
       </div>
     </div>
   </div>
  </section>
</div>               
@endsection