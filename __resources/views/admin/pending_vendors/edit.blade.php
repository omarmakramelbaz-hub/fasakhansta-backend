@extends('admin.index')
@section('content')
   
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.show') @lang('main.pendingvendors') </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                         @can('pending_vendor-list')
           <li class="breadcrumb-item"><a href="{{ url('admin/pending_vendors') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.pendingvendors')
        </a></li>  
        @endcan                             </ol>
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
                        <div class="card">
                            <div class="card-body" style="opacity: 1">
                                <form method="post" action="{{route('pending_vendors.update',$pending_vendor->id)}}" enctype="multipart/form-data">
                                    <div class="row">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{$pending_vendor->id}}">
                                    <input type="hidden" name="admin_id" value="{{auth('admin')->user()->id}}">
                                    <input type="hidden" name="type" value="{{$pending_vendor->type}}">
                                    
                                     <div class="form-group col-sm-6">
                                            <label for="full_name"> @lang('main.full_name')</label><span class="text-danger">*</span>
                                            <input type="text" name="full_name" required value=" {{ old('full_name', $pending_vendor->full_name) }} " class="form-control @error('full_name') is-invalid @enderror"
                                                id="full_name">
                                     </div>
                                      <div class="form-group col-sm-6">
                                            <label for="email"> @lang('main.email')</label><span class="text-danger">*</span>
                                            <input type="text" name="email" required value=" {{ old('email', $pending_vendor->email) }} " class="form-control @error('email') is-invalid @enderror"
                                                id="email">
                                     </div>
                                     
                                       <div class="form-group col-sm-6">
                                            <label for="mobile"> @lang('main.mobile')</label><span class="text-danger">*</span>
                                            <input type="text" name="mobile" required value=" {{ old('mobile', $pending_vendor->mobile) }} " class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobile">
                                        </div>
                                         <div class="form-group col-sm-6">
                                            <label for="another_mobile"> @lang('main.another_mobile')</label><span class="text-danger"></span>
                                            <input type="text" name="another_mobile" required value=" {{ old('another_mobile', $pending_vendor->another_mobile) }} " class="form-control @error('another_mobile') is-invalid @enderror"
                                                id="another_mobile">
                                        </div>
                                         <div class="form-group col-sm-6">
                                            <label for="vodafone_cash_mobile"> @lang('main.vodafone_cash_mobile')</label><span class="text-danger">*</span>
                                            <input type="text" name="vodafone_cash_mobile" required value=" {{ old('vodafone_cash_mobile', $pending_vendor->vodafone_cash_mobile) }} " class="form-control @error('vodafone_cash_mobile') is-invalid @enderror"
                                                id="vodafone_cash_mobile">
                                        </div>
                                          <div class="form-group col-sm-6"></div>
                                     
                                     @if($pending_vendor->type=='vendor')
                                        <div class="form-group col-sm-6">
                                            <label for="owner_name"> @lang('main.owner_name')</label><span class="text-danger">*</span>
                                            <input type="text" name="owner_name" required value=" {{ old('owner_name', $pending_vendor->owner_name) }} " class="form-control @error('owner_name') is-invalid @enderror"
                                                id="owner_name">
                                        </div>
                                         <div class="form-group col-sm-6">
                                            <label for="branches_no"> @lang('main.branches_no')</label><span class="text-danger">*</span>
                                            <input type="text" name="branches_no" required value=" {{ old('branches_no', $pending_vendor->branches_no) }} " class="form-control @error('branches_no') is-invalid @enderror"
                                                id="branches_no">
                                        </div>
                                        
                                     @endif
                                     <div class="form-group col-sm-6">
                                            <label for="national_id"> @lang('main.national_id')</label><span class="text-danger">*</span>
                                            <input type="text" name="national_id" required value=" {{ old('national_id', $pending_vendor->national_id) }} " class="form-control @error('national_id') is-invalid @enderror"
                                                id="national_id">
                                     </div>
                                     <div class="form-group col-sm-6">
                                            <label for="national_id_image">@lang('main.national_id_image')</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="file" name="national_id_image" id="national_id_image" class="form-control"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </div>
                                            <div class="col-sm-6">
                                                @if($pending_vendor->getFirstMediaUrl('national_id_image','thumb'))
                                                    <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $pending_vendor->id }}"
                                                        id="image" src="{{$pending_vendor->getFirstMediaUrl('national_id_image','thumb')}}" style="width:70%;"
                                                        alt="@lang('main.NoImageUploaded')">
                                                    @include('admin.components.modal_photo', [
                                                        'image' => $pending_vendor->getFirstMediaUrl('national_id_image','thumb'),
                                                        'id' => $pending_vendor->id,
                                                    ])
                                                @else
                                                    <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                                        style="height: 80px; width: 100px;">
                                                @endif
                                            </div>
                                        </div>
                                     @if($pending_vendor->type=='vendor')
                                         <div class="form-group col-sm-6">
                                            <label for="commercial_registration_no"> @lang('main.commercial_registration_no')</label><span class="text-danger">*</span>
                                            <input type="text" name="commercial_registration_no" required value=" {{ old('commercial_registration_no', $pending_vendor->commercial_registration_no) }} " class="form-control @error('commercial_registration_no') is-invalid @enderror"
                                                id="commercial_registration_no">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="commercial_registration_no_image">@lang('main.commercial_registration_no_image')</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="file" name="commercial_registration_no_image" id="commercial_registration_no_image" class="form-control"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </div>
                                            <div class="col-sm-6">
                                                @if($pending_vendor->getFirstMediaUrl('commercial_registration_no_image','thumb'))
                                                    <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $pending_vendor->id }}"
                                                        id="image" src="{{$pending_vendor->getFirstMediaUrl('commercial_registration_no_image','thumb')}}" style="width:70%;"
                                                        alt="@lang('main.NoImageUploaded')">
                                                    @include('admin.components.modal_photo', [
                                                        'image' => $pending_vendor->getFirstMediaUrl('commercial_registration_no_image','thumb'),
                                                        'id' => $pending_vendor->id,
                                                    ])
                                                @else
                                                    <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                                        style="height: 80px; width: 100px;">
                                                @endif
                                            </div>
                                        </div>
                                     
                                     @endif
                                      @if($pending_vendor->type=='delegate')
                                      <div class="form-group col-sm-6">
                                            <label for="driving_license_no"> @lang('main.driving_license_no')</label><span class="text-danger">*</span>
                                            <input type="text" name="driving_license_no" required value=" {{ old('driving_license_no', $pending_vendor->driving_license_no) }} " class="form-control @error('driving_license_no') is-invalid @enderror"
                                                id="driving_license_no">
                                        </div>
                                         <div class="form-group col-sm-6">
                                            <label for="driving_license_image">@lang('main.driving_license_image')</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="file" name="driving_license_image" id="driving_license_image" class="form-control"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </div>
                                            <div class="col-sm-6">
                                                @if($pending_vendor->getFirstMediaUrl('driving_license_image','thumb'))
                                                    <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $pending_vendor->id }}"
                                                        id="image" src="{{$pending_vendor->getFirstMediaUrl('driving_license_image','thumb')}}" style="width:70%;"
                                                        alt="@lang('main.NoImageUploaded')">
                                                    @include('admin.components.modal_photo', [
                                                        'image' => $pending_vendor->getFirstMediaUrl('driving_license_image','thumb'),
                                                        'id' => $pending_vendor->id,
                                                    ])
                                                @else
                                                    <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                                        style="height: 80px; width: 100px;">
                                                @endif
                                            </div>
                                        </div>
                                     
                                     @endif
                                      @if($pending_vendor->type=='vendor')
                                      <div class="form-group col-sm-6">
                                            <label for="tax_no"> @lang('main.tax_no')</label><span class="text-danger">*</span>
                                            <input type="text" name="tax_no" required value=" {{ old('tax_no', $pending_vendor->tax_no) }} " class="form-control @error('tax_no') is-invalid @enderror"
                                                id="tax_no">
                                        </div>
                                          <div class="form-group col-sm-6">
                                            <label for="tax_no_image">@lang('main.tax_no_image')</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="file" name="tax_no_image" id="tax_no_image" class="form-control"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </div>
                                            <div class="col-sm-6">
                                                @if($pending_vendor->getFirstMediaUrl('tax_no_image','thumb'))
                                                    <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $pending_vendor->id }}"
                                                        id="image" src="{{$pending_vendor->getFirstMediaUrl('tax_no_image','thumb')}}" style="width:70%;"
                                                        alt="@lang('main.NoImageUploaded')">
                                                    @include('admin.components.modal_photo', [
                                                        'image' => $pending_vendor->getFirstMediaUrl('tax_no_image','thumb'),
                                                        'id' => $pending_vendor->id,
                                                    ])
                                                @else
                                                    <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                                        style="height: 80px; width: 100px;">
                                                @endif
                                            </div>
                                        </div>
                                     
                                     @endif
                                      @if($pending_vendor->type=='delegate')
                                      <div class="form-group col-sm-6">
                                            <label for="location"> @lang('main.location')</label><span class="text-danger">*</span>
                                            <input type="text" name="location" required value=" {{ old('location', $pending_vendor->location) }} " class="form-control @error('location') is-invalid @enderror"
                                                id="location">
                                        </div>
                                     
                                     @endif
                                   
                                        
                                        
                                        
                                     
                                     
                                     
                                     
                                     
                                     
                                    <div class="form-group col-sm-6">
                                        <button type="submit" class="btn btn-success">@lang('main.save')</button>
                                    </div>
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