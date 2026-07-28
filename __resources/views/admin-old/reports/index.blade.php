@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .card-i{
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-radius: 10px;
            border: 1px solid #d1d1d1;
            padding: 30px 10px;
            background: transparent;
        }
        .card-i i{
            font-size: 36px;
            color: var(--min-color);
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
                        <h1 class="m-0 text-dark">@lang('main.showAll') @lang('main.reports')
            {{-- <small class="countModule">( ) </small> --}}
                        </h1>
                    </div><!-- /.col -->
                   
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="">
                    <div class="card">
                        @push('card_title')
                        {{ __('main.reports' ) }}
                        @endpush
                        @include('admin.partials.card_header_in_index')

                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-6 col-sm-4">
                                    <a href="{{route('reports.orders',['q' => 'daily'])}}" class="card-i h-100">
                                        <i class="fa fa-file"></i>
                                        <div class="footer-i">
                                            <h5 class="text-center mt-3">@lang('main.orders report')</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-4">
                                    <a href="{{route('reports.resturants')}}" class="card-i h-100">
                                        <i class="fa fa-file"></i>
                                        <div class="footer-i">
                                            <h5 class="text-center mt-3">@lang('main.resturants report')</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-4">
                                    <a href="{{route('reports.vendors')}}" class="card-i h-100">
                                        <i class="fa fa-file"></i>
                                        <div class="footer-i">
                                            <h5 class="text-center mt-3">@lang('main.vendors report')</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-4">
                                    <a href="{{route('reports.delegates')}}" class="card-i h-100">
                                        <i class="fa fa-file"></i>
                                        <div class="footer-i">
                                            <h5 class="text-center mt-3">@lang('main.delegates report')</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-4">
                                    <a href="{{route('reports.customers')}}" class="card-i h-100">
                                        <i class="fa fa-file"></i>
                                        <div class="footer-i">
                                            <h5 class="text-center mt-3">@lang('main.customers report')</h5>
                                        </div>
                                    </a>
                                </div>

                            </div>
                 </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
