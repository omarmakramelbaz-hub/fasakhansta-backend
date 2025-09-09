@extends('admin.index')
@push('custom-css')
<style>
    .subtext{
        font-size: 17px;
        display: block;
        margin: 15px 0px;
        width: 113%;
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
                        <h1 class="m-0 text-dark">@lang('main.add') @lang('main.vendor branch')
                            <small class="text-danger subtext">(@lang('main.create accounts for every branch'))</small>
                        </h1>
                        <p>@lang('main.after acceptance will sent emails for') {{$pending->email}}</p>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                        @can('user-list')
                           <li class="breadcrumb-item"><a href="{{ url('admin/users?account_type=vendor') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.vendors')
                        </a></li>  
                        @endcan      
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
                    <div class="col-lg-12 col-md-12">
                        @include('admin.layouts.alerts')
                        <div class="">
                            <div class="">
                                <form method="post" action="{{route('pending_vendors.transferVendor')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$pending->id}}">
                                    <div class="row gy-4">
                                    @for($i=0; $i<$pending->branches_no; $i++)
                                    <div class=" col-md-6">
                                        <div class="card px-4 py-3">
                                           <fieldset class=" row gy-1" >
                                        <legend>@lang('main.create vendor account') {{$i+1}} :</legend>
                                        <input type="hidden" name="added_by[{{$i}}]" value="{{auth('admin')->user()->id}}">
                                        <input type="hidden" name="email[{{$i}}]" value="@if($i==0){{$pending->email}}@endif">

                                          <div class="form-group col-sm-6">
                                            <label for="name"> @lang('main.name')</label><span class="text-danger">*</span>
                                            <input type="text" name="name[{{$i}}]" required value="@if($i==0) {{ old('name,'.$i, $pending->full_name) }} @endif"
                                                class="form-control  @error('name') is-invalid @enderror" id="name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="mobile"> @lang('main.mobile')</label><span class="text-danger">*</span>
                                            <input type="text" name="mobile[{{$i}}]" required value="@if($i==0) {{ old('mobile.'.$i, $pending->mobile) }} @endif" class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobile">
                                        </div>
                                        <input type="hidden" name="roles_name[0][{{$i}}]" value="vendor"/>
                                        <div class="form-group col-sm-6">
                                            <label for="password"> @lang('main.Password')</label><span class="text-danger">*</span>
                                            <input type="password" name="password[{{$i}}]" required value=""
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="@lang('main.EnterPassword')">
                                            <button type="button" class="show-pass" toggle="#password">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="area_id"> @lang('main.resturant in city')</label><span class="text-danger">*</span>
                                            <select class="form-select" required name="area_id[{{$i}}]">
                                            @foreach(\App\Models\Area::whereNotNull('parent_id')->get() as $area)
                                            <option value="{{$area->id}}">{{$area->title}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                         
                                        <div class="form-group col-sm-12">
                                            <label for="resturant_name"> @lang('main.resturant_name') <small>@lang('main.resturant name inside app')</small></label><span class="text-danger">*</span>
                                            <input type="text" name="resturant_name[{{$i}}]" required value="{{ old('resturant_name.'.$i) }}"
                                                class="form-control  @error('resturant_name') is-invalid @enderror" id="resturant_name" placeholder="@lang('main.enter') @lang('main.Name')">
                                        </div>
                                        
                                    </fieldset>
                                        </div>
                                    </div>

                                    @endfor
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button type="submit" class="btn btn-success">@lang('main.save')</button>
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