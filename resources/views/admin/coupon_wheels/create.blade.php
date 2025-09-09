@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.Addcoupon_wheel')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('coupon_wheels.index') }}"
                                    class="btn btn-primary">@lang('main.ShowAllcoupon_wheels')</a></li>
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
                                <form class="from-prevent-multiple-submits" method="post" action="{{ route('coupon_wheels.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.coupon_wheels.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection