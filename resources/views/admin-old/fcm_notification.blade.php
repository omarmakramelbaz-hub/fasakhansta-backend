@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@lang('main.send notifications')</h1>
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
            <!--<h2>Send notification</h2>-->
            <form method="post" action="{{route('fcm_notifications.store')}}">
              @csrf
              <div class="form-group col-sm-10">
                <label for="title"> @lang('main.notify_title')</label>
                <input type="text" name ="title" value="{{old('title')}}" class="form-control" id="title" placeholder="@lang('main.enter title')">
              </div>

              <div class="form-group col-sm-10">
                <label for="body">@lang('main.notify_body')</label>
                <input type="text" name="body" value="{{old('body')}}" class="form-control" id="body" placeholder="@lang('main.enter body')">
              </div>
            <div class="form-group col-sm-10">
                <label for="send_by">@lang('main.send_by')</label><br/>
                <input type="radio" checked name="send_by" value="0" class=""> @lang('main.send by zone')
            </div>
            <div class="form-group col-sm-10">
                <input type="radio" name="send_by" value="1" class=""> @lang('main.send specific users')
                
            </div>
              <div class="form-group col-sm-10 zone"  >
                <label for="zone_id">@lang('main.choose zone')</label>
                <select name="zone_id[]" multiple class="form-control" id="zone_id">
                    <option value="">@lang('main.choose')</option>
                    @foreach(\App\Models\Area::whereNotNull('parent_id')->get() as $val)
                    <option value="{{$val->id}}">{{$val->title}}</option>
                    @endforeach
                </select>
              </div>
              
              <div class="form-group col-sm-10" id="user-choose" >
                <label for="choose_user">@lang('main.choose_user')</label><br/>
                <div class="form-group col-sm-10">
                    <input type="radio" checked name="choose_user" value="0" class=""> @lang('main.select all users')
                
                </div>
                <div class="form-group col-sm-10">
                    
                <input type="radio" name="choose_user" value="1" class=""> @lang('main.select specific users')
                </div>
                <select name="user_id[]" multiple class="form-control " id="show-case">  
                  @foreach($users as $user)
                  <option value="{{$user->id}}"> @lang('main.name'): {{$user->name}} / @lang('main.mobile'): {{$user->mobile}}</option> 
                  @endforeach
                </select>
              </div>

              <div class="form-group col-sm-10">
                <button type="submit" class="btn btn-success">@lang('main.send')</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection










