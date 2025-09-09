@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.edit') {{__('main.'.request('parent'))}}  
</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
@can('category-list')
           <li class="breadcrumb-item"><a href="{{ url('admin/categorys?parent='.request('parent')) }}" class="btn btn-primary">@lang('main.showAll') {{__('main.'.request('parent'))}}         </a></li>  
        @endcan                           </ol>
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
                            <div class="card-body">
                                <form method="post" action="{{ route('categorys.update', $category->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('admin.categorys.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection