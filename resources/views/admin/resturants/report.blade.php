@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .select2-container {
            width: max-content !important;
            min-width: 198px;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row gy-3 mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">@lang('main.showAll')  @lang('main.reports')</h1>
                    </div><!-- /.col -->
                    <div class="col-6">
                 
                    </div><!-- /.col -->
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <i class="fa fa-file"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.orders_num')</span>
                                <span class="info-box-number mt-2">
                                    {{$data['orders_count']}}
                                </span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <i class="fa fa-file"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.total_grand_total')</span>
                                <span class="info-box-number mt-2">
                                    {{$data['orders']->sum('grand_total')}} @lang('main.egp')
                                </span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <i class="fa fa-file"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.total_resturant_precntage')</span>
                                <span class="info-box-number mt-2">
                                    {{$data['orders']->sum('vendor_percentage')}} @lang('main.egp')
                                </span>
                            </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    <div class="col-3">
                        <div class="info-box" style="text-align: start;">
                            <span class="info-box-icon bg-info" style="width: 70px">
                                <i class="fa fa-file"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('main.total_app_percentage')</span>
                                <span class="info-box-number mt-2">
                                 {{$data['orders']->sum('app_percentage')}} @lang('main.egp')
                                </span>
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
                                        <option value="day" @if(request('report_type') == 'day') selected @endif>@lang('main.day')</option>
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
                                        <th>@lang('main.delivery_price') @lang('main.for_resturant')</th>
                                        <th>@lang('main.date')</th>
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
                                               @lang('main.out_resturant')
                                            </td>
                                            @endif
                                            <td>{{$order->created_at->format('Y-m-d H:i')}}</td>
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
