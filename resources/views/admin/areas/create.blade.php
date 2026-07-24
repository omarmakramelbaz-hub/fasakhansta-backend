@extends('admin.index')
@push('custom-css')
    <link rel="stylesheet" href="{{ url('/dashboard') }}/plugins/tagsinput.css">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center gy-2 mb-2">
                    <div class="col-auto">
                        <h1 class="m-0 text-dark">@if(request('parent')) @lang('main.addCity') @else @lang('main.addArea') @endif</h1>
                    </div><!-- /.col -->
                    <div class="col-auto">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('areas.index') }}"
                                    class="btn btn-primary">@lang('main.showAllareas')</a></li>
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
                        <div class="card">
                            <div class="card-body">
                                <form class="from-prevent-multiple-submits" method="post" action="{{ route('areas.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.areas.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom-js')
    <script src="{{ url('/dashboard') }}/plugins/tagsinput.js"></script>
    <script type="text/javascript">
        $('#keyword').tagsinput('items');
    </script>
@endpush
