@extends('admin.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('main.show') @lang('main.banners') </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                       @can('banner-list')
                       <li class="breadcrumb-item"><a href="{{ url('admin/banners') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.banners')
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
                <div class="card">
                    <div class="card-body show-data">
                        
                    
                         <div class="col-sm-10">
                            <div class="form-group">
                                
                                
                                <label> @lang('main.image')</label>
                                <span>     @if($banner->getFirstMediaUrl('image','thumb'))
                                    <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $banner->id }}"
                                        id="image" src="{{$banner->getFirstMediaUrl('image','thumb')}}" style="width:70%;"
                                        alt="@lang('main.NoImageUploaded')">
                                    @include('admin.components.modal_photo', [
                                        'image' => $banner->getFirstMediaUrl('image','thumb'),
                                        'id' => $banner->id,
                                    ])
                                @else
                                    <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                        style="height: 80px; width: 100px;">
                                @endif</span>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-group">
                                
                                
                                <label> @lang('main.addedBy')</label>
                                <span>{{$banner->admin->name}}</span>
                            </div>
                        </div>
                        @if($banner->title_ar)
                        
                        <div class="col-sm-10">
                            <div class="form-group">
                                
                                
                                <label> @lang('main.title_ar')</label>
                                <span>{{$banner->title_ar}}</span>
                            </div>
                        </div>

                        @endif
                        @if($banner->title_en)
                        <div class="col-sm-10">
                            <div class="form-group">
                                
                                
                                <label> @lang('main.title_en')</label>
                                <span>{{$banner->title_en}}</span>
                            </div>
                        </div>
                        @endif                                

                        <div class="col-sm-10">
                            <div class="form-group">
                                
                                
                                <label> @lang('main.status')</label>
                                <span>{{ __('main.'.$banner->status )}}</span>
                            </div>
                            
                        </div>
                        <div class="col-sm-10">
                           <div class="form-group">
                               
                               
                            <label> @lang('main.created_at')</label>
                            <span>{{$banner->created_at->diffForHumans()}}</span>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@endsection
