@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.show') @lang('main.product') </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
 @can('product-list')
           <li class="breadcrumb-item"><a href="{{ url('admin/products') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.products')  
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
                            <div class="card-body">
                                <div class="form-group col-sm-8">
                                    <label> @lang('main.addedBy')</label>
                                    <span>{{$product->admin->name}}</span>
                                </div>
                                
                                <div class="form-group col-sm-8">
                                    <label> @lang('main.product_name')</label>
                                    <span>{{$product->name_ar}}</span>
                                </div>
                               
                                
                                <div class="form-group col-sm-8">
                                    <label> @lang('main.category')</label>
                                    <span>{{$product->category?->name}}</span>
                                </div>
                                <div class="form-group col-sm-8">
                                    <label> @lang('main.product_features')</label>
                                    <span> @foreach($product->product_features as $val)
                                                        {{ __('main.'.$val->name) }} ,
                                           @endforeach
                                    </span>
                                </div>
                               
                                 <div class="form-group col-sm-8">
                                    <label> @lang('main.created_at')</label>
                                    <span>{{$product->created_at->diffForHumans()}}</span>
                                </div>            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
