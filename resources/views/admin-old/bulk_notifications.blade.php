@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@lang('main.notifications')</h1>
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
          <ul class="nav nav-pills mb-3 user-pills" id="pills-tab" role="tablist">
            @if(auth('admin')->user()->account_type != 'operator' && auth('admin')->user()->account_type != 'admin')
            <li class="nav-item mt-3 ml-3 mb-3">
              <a class="nav-link active" id="pills-user_notifies-tab" data-bs-toggle="pill" data-bs-target="#pills-user_notifies" type="button" role="tab" aria-controls="pills-user_notifies" aria-selected="true"><i class="fa fa-paperclip"></i> @lang('main.send user_notifies')</a>
            </li>
            @endif
            <li class="nav-item mt-3 ml-3 mb-3">
              <a class="nav-link @if(auth('admin')->user()->account_type == 'operator') active @endif" id="pills-valet_notifies-tab" data-bs-toggle="pill" data-bs-target="#pills-valet_notifies" type="button" role="tab" aria-controls="pills-valet_notifies" aria-selected="true"> <i class="fa fa-blog"></i> @lang('main.send valet_notifies')</a>
            </li>
          </ul>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-user_notifies" role="tabpanel" aria-labelledby="pills-user_notifies-tab">
              <form method="post" action="{{route('notifications.sendNotify',['for'=>'user'])}}">
                @csrf
                <div class="form-group col-sm-10">
                  <label for="user_id"> @lang('main.user_id')</label><span class="text-danger">*</span>
                  <select name="user_id[]" multiple id="user_id" class="form-select selectize"> 
                    <option value="">@lang('main.choose')</option> 
                    @foreach(\App\Models\User::where('account_type','user')->get() as $user)
                    <option value="{{$user->id}}">{{($user->name) ?? $user->email}}</option> 
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-10">
                  <label for="title"> @lang('main.title')</label><span class="text-danger">*</span>
                  <input type="text" name ="title" required value="{{old('title')}}" class="form-control" id="title" placeholder="@lang('main.enter title')">
                </div>

                <div class="form-group col-sm-10">
                  <label for="body">@lang('main.body')</label>
                  <input type="text" name="body" value="{{old('body')}}" class="form-control" id="body" placeholder="@lang('main.enter body')">
                </div>
                

                <div class="form-group col-sm-10">
                  <button type="submit" class="btn btn-success">@lang('main.send')</button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="pills-valet_notifies" role="tabpanel" aria-labelledby="pills-valet_notifies-tab">
              <form method="post" action="{{route('notifications.sendNotify',['for'=>'valet'])}}">
                @csrf
                <div class="form-group col-sm-10">
                  <label for="valet_id"> @lang('main.valet_id')</label><span class="text-danger">*</span>
                  <select name="valet_id[]" multiple id="valet_id" class="form-select selectize">  
                    <option value="">@lang('main.choose')</option> 
                    @foreach(\App\Models\User::where('account_type','valet')->get() as $valet)
                    <option value="{{$valet->id}}">{{($valet->name)?? $valet->email}}</option> 
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-sm-10">
                  <label for="title"> @lang('main.title')</label><span class="text-danger">*</span>
                  <input type="text" name ="title" required value="{{old('title')}}" class="form-control" id="title" placeholder="@lang('main.enter title')">
                </div>

                <div class="form-group col-sm-10">
                  <label for="body">@lang('main.body')</label>
                  <input type="text" name="body" value="{{old('body')}}" class="form-control" id="body" placeholder="@lang('main.enter body')">
                </div>
                

                <div class="form-group col-sm-10">
                  <button type="submit" class="btn btn-success">@lang('main.send')</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
