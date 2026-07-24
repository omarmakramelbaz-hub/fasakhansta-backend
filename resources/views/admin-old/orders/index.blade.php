@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .qty{
            position: relative;
            bottom: 15%;
            right: 87px;
            background: #ff5d00;
            padding: 8px;
            color: #fff;
            border-radius: 25px;
            text-align: center;
            font-size: 13px;
        }
        
        tr p{
            margin-bottom: 0.2rem !important;
        }
        .info{       
            color: #0072ff;
            font-size: 24px;
            line-height: 90px;
        }
        .status{
            width:100% !important;
        }
        thead th , tbody tr td{
            vertical-align:middle !important;
            text-align:center !important;
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
                        <h1 class="m-0 text-dark">@lang('main.showAll') @lang('main.orders')  <small class="countModule">({{$orders->total()}}) </small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            
                        </ol>
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
                            @lang('main.orders')
                        @endpush
                        @include('admin.partials.card_header_in_index')

                        <div class="card-body">
                            {{-- Buttons part --}}
                            @can('order-delete')
                            <div class="btn-group flex-wrap float-left mb-4">
                                @include('admin.partials.button_group', [
                                    'url' => url('admin/ordersDeleteAll'),
                                ])
                            </div>
                            @endcan
                            {{-- search part --}}
                            <div class="float-right mb-4">
                                @include('admin.partials.search_part', [
                                    'route' => route('orders.index'),
                                ])
                            </div>

                            <table class="table table-responsive table-bordered table-hover">
                                <thead>
                                    <th width="50px"><input type="checkbox" id="master"></th>
                                    <th>#</th>
                                    <th>@lang('main.resturant')</th>
                                    <th>@lang('main.order_id,date,status')</th>
                                    <th>@lang('main.grand_total')</th>
                                    <th>@lang('main.customer,email,mobile')</th>
                                    <th>@lang('main.order_type')</th>
                                    <th>@lang('main.details')</th>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td><input type="checkbox" class="sub_chk" data-id="{{ $order->id }}">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->resturant?->name }}</td>
                                            <td>
                                                <p style="font-weight: bolder;">#{{ $order->order_no }}</p>
                                                <p>{{ $order->order_date ?? $order->created_at }}</p>
                                                <p class="status {{$order->status}}">{{ __('main.'.$order->status) }}</p>
                                            </td>
                                            <td>
                                                <p>
                                                {{ $order->grand_total}} @lang('main.egp')
                                                </p>
                                            </td>
                                            <td>
                                                @if($order->user)
                                                <p>{{ $order->user?->name }}</p>
                                                <p><a href="mailto:{{ $order->user?->email }}">{{ $order->user?->email }}</a></p>
                                                <p><a href="tel:{{ $order->user?->mobile }}">{{ $order->user?->mobile }}</a></p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->delegate_from_out && $order->order_type == 'default')
                                                    {{__('main.'.$order->delegate_from_out)}}
                                                @elseif($order->order_type == 'schedule')
                                                    @lang('main.order-schedule')
                                                @else   
                                                    @lang('main.still under process')
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('orders.show',$order->id)}}"><i class="info fa fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="8">
                                            {{ trans('main.Noorders') }}
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $orders->withQueryString()->links() }}
            </div>
        </section>
    </div>
@endsection
