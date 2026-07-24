@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row gy-2 mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.show') @lang('main.contracts') </h1>
                                                <small>@lang('main.contract to apply with us')</small>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
 @can('contract-list')
           <li class="breadcrumb-item"><a href="{{ url('admin/contracts') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.contracts')  
        </a></li>  
        @endcan                         </ol>
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
                        <div class="card show-data">
                            <div class="card-body row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                    <label> @lang('main.addedBy')</label>
                                    <span>{{$contract->admin->name}}</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                    <label> @lang('main.created_at')</label>
                                    <span>{{$contract->created_at->diffForHumans()}}</span>
                                    </div>
                                </div> 
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                        <label> @lang('main.type')</label>
                                        <span>{{__('main.'.$contract->type)}}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group gap-2 flex-wrap">
                                        <label> @lang('main.template')</label>
                                        <span>{!! $contract->template !!}</span>
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
