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
                <div class="row gy-3 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.showAll')  </h1>
                    </div><!-- /.col -->
                    <div class="col-6">
                 
                    </div><!-- /.col -->
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <!--<i class="fas fa-user-cog"></i>-->
                                {{$data['orders_count']}}
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.orders_num')</span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <!--<i class="fas fa-user-cog"></i>-->
                                {{$data['total_cash_order']}}
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.total_cash_order')</span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <!--<i class="fas fa-user-cog"></i>-->
                                {{$data['transfer_cash_orders']}}
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.transfer_cash_orders')</span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <!--<i class="fas fa-user-cog"></i>-->
                                {{$data['not_transfer_cash_orders']}}
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.not_transfer_cash_orders')</span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
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
                            @lang('main.resturants')
                        @endpush
                        @include('admin.partials.card_header_in_index')

                        <div class="card-body">
                            
                            {{-- search part --}}
                            <div class="float-right mb-4">
                                <form  method="get" action="{{route('vendor.report',['report_type' => request('report_type')])}}">
                                    <select class="form-select col-md-12" name="report_type" onchange="this.form.submit()">
                                        <option value="">@lang('main.choose')</option>
                                        <option value="week" @if(request('report_type') == 'week') selected @endif>@lang('main.week')</option>
                                        <option value="month" @if(request('report_type') == 'month') selected @endif>@lang('main.month')</option>
                                        <option value="year" @if(request('report_type') == 'year') selected @endif>@lang('main.year')</option>
                                    </select>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>@lang('main.order_no')</th>
                                        <th>@lang('main.grand_total')</th>
                                        <th>@lang('main.vendor_percentage')</th>
                                        <th>@lang('main.delivery_price')</th>
    
                                    </thead>
                                    <tbody>
                                        @forelse($data['orders'] as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $order->order_no }}  
                                            </td>
                                            <td>
                                                {{ $order->grand_total }}  @lang('main.egp')
                                            </td>
                                            <td>
                                                {{ $order->vendor_percentage }}  @lang('main.egp')
                                            </td>
                                            @if($order->delegate_from_out == 'in_resturant')
                                            <td>
                                                {{ $order->delivery_price }} @lang('main.egp')  
                                            </td>
                                            @else
                                            <td>
                                               -
                                            </td>
                                            @endif
                                        </tr>                                         
                                        @empty
                                            <td class="text-center text-muted" style="font-size: 25px" colspan="7">
                                                    {{ trans('main.empty data') }}
                                            </td>
                                        @endforelse
                                    </tbody>
                                </table>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
