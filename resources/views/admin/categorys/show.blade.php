@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.show') {{__('main.'.request('parent'))}} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
 @can('category-list')
           <li class="breadcrumb-item"><a href="{{ url('admin/categorys?parent='.request('parent')) }}" class="btn btn-primary">@lang('main.showAll') {{__('main.'.request('parent'))}}  
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
                                        <span>{{$category->admin->name}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('main.created_at')</label>
                                        <span>{{$category->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>      
                                @if($category->parent)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('main.category_ar') </label>
                                        <span>{{$category->parent?->name_ar}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('main.category_en')</label>
                                        <span>{{$category->parent?->name_en}}</span>
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@if($category->parent) @lang('main.subcategory_ar') @else @lang('main.category_ar') @endif</label>
                                        <span>{{$category->name_ar}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@if($category->parent) @lang('main.subcategory_en') @else @lang('main.category_en') @endif</label>
                                        <span>{{$category->name_en}}</span>
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
