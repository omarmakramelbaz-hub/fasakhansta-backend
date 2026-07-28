@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.show') @lang('main.feature') </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                         @can('feature-list')
           <li class="breadcrumb-item"><a href="{{ url('admin/features') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.features')
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
                                        
                                    
                                    <label> @lang('main.AdminName')</label>
                                    <span>{{$feature->admin->name}}</span>
                                </div>
                                @if($feature->title_ar)
                                    </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        
                                    
                                    <label> @lang('main.title_ar')</label>
                                    <span>{{$feature->title_ar}}</span>
                                </div>
                                @endif
                                    </div>
                                @if($feature->title_en)
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        
                                    
                                    <label> @lang('main.title_en')</label>
                                    <span>{{$feature->title_en}}</span>
                                </div>
                                @endif
                                    </div>
                                @if($feature->description_ar)
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        
                                    
                                    <label> @lang('main.description_ar')</label>
                                    <span>{!! $feature->description_ar !!}</span>
                                </div>
                                @endif
                                    </div>
                                @if($feature->description_en)
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        
                                    
                                    <label> @lang('main.description_en')</label>
                                    <span>{!! $feature->description_en !!}</span>
                                </div>
                                @endif
                                    </div>

                                <div class="col-sm-10">
                                    <div class="form-group">
                                        
                                    
                                    <label> @lang('main.status')</label>
                                    <span>{{ __('main.'.$feature->status )}}</span>
                                </div>
                                
                                    </div>
                                 <div class="col-sm-10">
                                     <div class="form-group">
                                         
                                     
                                    <label> @lang('main.created_at')</label>
                                    <span>{{$feature->created_at->diffForHumans()}}</span>
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
