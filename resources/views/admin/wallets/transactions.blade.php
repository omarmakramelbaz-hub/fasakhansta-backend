@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.wallet transactions')
           
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
                            @lang('main.wallet transactions')
                        @endpush
                        @include('admin.partials.card_header_in_index')
                         
                        <div class="card-body">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-6">
                                <div class="info-box">
                                    <a href="{{ url('/admin/wallets') }}" class="link"></a>
                                    <span class="info-box-icon bg-info">
                                       <i class="fas fa-hand-holding-dollar"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">@lang('main.transfer from') @lang('main.wallets')</span>
                                        <!--<span class="info-box-number mt-2"></span>-->
                                    </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>
                              <div class="col-lg-6 col-md-6 col-6">
                                <div class="info-box">
                                    <a href="{{url('admin/wallet/withdraw')}}" class="link"></a> 
                                    <span class="info-box-icon bg-info">
                                           <i class="fas fa-money-bill-transfer"></i>
                                    </span>
                    
                                  <div class="info-box-content">
                                    <span class="info-box-text">@lang('main.Withdraw from Wallet')</span>
                                    <!--<span class="info-box-number mt-2"></span>-->
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
               
            </div>
        </section>
    </div>
@endsection
