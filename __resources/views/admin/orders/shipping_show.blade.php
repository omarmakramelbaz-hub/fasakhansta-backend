@extends('admin.index')
@push('custom-css')
    <style type="text/css">
        .table th, .table td {
            border-top: none !important;
        }
        table tr:last-child td{
            border-bottom: unset;
        }
        .status{
            width: 100%;
            padding: 0.75rem;
            border-radius: 29px;
            border-inline-start: 4px solid #3498db;
            color: #000;
            margin-inline-end: 10px;
        }        
        .completed {
            background: #4CAF5054;
            border-inline-start: 4px solid #4CAF50;
        }
        .accepted{
            background: #9595ce54;
            border-inline-start: 4px solid #9595ce;
        }
        .pending {
            background: #F0A20254;
            border-inline-start: 4px solid #F0A202;
        }
        .cancelled {
            background: #E74C3C54;
            border-inline-start: 4px solid #E74C3C;
        }
        .declined {
            background: #E74C3C54;
            border-inline-start: 4px solid #E74C3C;
        }
        .shipped {
            background: #3498DB54;
            border-inline-start: 4px solid #3498DB;
        }
        .schedule {
            background: #2ECC7154;
            border-inline-start: 4px solid #2ECC71;
        }
        .d_link{
            text-decoration: underline !important;
        }
        
        .edit{
            position: absolute;
            top: 14px;
            inset-inline-end: 0;
            width: auto;
            display: flex;
            gap: 3px;
            align-items: center;
            background: #dfdfdf !important;
            border-radius: 20px;
            padding:0.22rem 0.75rem;
            font-size: 14px;
        }
        .all_orders .avatar {
            border: 1px solid #fff;
            border-radius: 50%;
            padding: 0px;
            height: 3rem !important;
            width: 3rem !important;
            object-fit: cover;
            background: #fff;
        }
        /*.all_orders .status{*/
        /*    background: #fff;*/
        /*    border-radius: 28px;*/
        /*    padding: 4px;*/
        /*    font-size: 14px;*/
        /*    color: var(--main);*/
        /*    text-align: center;*/
        /*    width: 100%;*/
        /*}*/
        .all_orders p{
            width: max-content;
            margin: 0px;
        }
        .cart-product-item .img-cart {
            width: 100%;
            border-radius: 18px;
            height: 70px;
            object-fit: cover;
            background: var(--white);
            border: 1px solid #CECECE;
            border-radius: 15px;
        }
        .qty {
            background: #fd720140;
            padding: 2px 6px;
            border-radius: 4px;
            min-width: 29px;
            text-align: center;
            font-size: 12px;
        }
        .cart-product-item:last-child{
            border: none !important;
        }
        
        .card {
            border-radius: 1rem !important;
            overflow: hidden;
        }
        .card-footer{
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            /*border-bottom: 1px solid rgba(0, 0, 0, 0.125);*/
        }
        .card-footer::after{
            content: unset;
        }
        .brd_0 td{
            border: none;
        }
        .sub {
            font-size: small;
            padding-block: 3px;
            color: var(--main);
        }
        .icon {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            color: var(--main) !important;
        }
        .price small{
            text-decoration: line-through;
        }
        .note {
            padding: 6px 10px;
            display: flex;
            width: 100% !important;
            gap: 10px;
            font-weight: 600;
            font-size: 13px;
            background: #ffe1c8;
            border-inline-start: 4px solid var(--min-color);
        }
        
    </style>
    
@endpush
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row gy-2 mb-2">
                <div class="col-6">
                    <h1 class="m-0 text-dark">@lang('main.show') @lang('main.order') #{{$order->order_no}} </h1>
                </div><!-- /.col -->
                <div class="col-6">
                    <ol class="breadcrumb float-sm-left">
                       @can('order-list')
                       <li class="breadcrumb-item"><a href="{{ url('admin/orders') }}" class="btn btn-primary">@lang('main.showAll') @lang('main.orders')
                       </a></li>  
                       @endcan
                    </ol>
                </div><!-- /.col -->
           </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
   <!-- Main content -->
    <section class="content all_orders">
        <div class="container-fluid">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4">
            <div class="">
                <p class="mb-0">
                    <span class="status {{$order->status}}">
                        {{ __('main.'.$order->status) }}
                    </span>
                </p> 
            </div>
            <div class="">
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                    @if($order->user?->gender == 'female')
                                        <img class="avatar" id="image" src="{{ url('dashboard/dist/img/female_profile.svg') }}"
                                                style="object-fit:contain; width:100%;">
                                    @elseif($order->user?->gender == 'male')
                                        <img class="avatar" id="image" src="{{ url('dashboard/dist/img/male_profile.svg') }}"
                                                style="object-fit:contain; width:100%;">
                                    @endif                    
                                <div>
                                    <p class="mb-1 fw-bold">{{$order->user?->name}}</p>
                                    <div class="d-flex align-items-center gap-2">
                                        <p class="mb-1"><i class="fas fa-calendar-day"></i> 
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                        </p>
                                        <p class="mb-1"><i class="fas fa-clock"></i> 
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{url('/admin/chat/?user_id='.$order->user_id)}}" class="icon" target="_blank">
                                         <i class="far fa-comment-dots"></i>
                                    </a>
                                    <a href="tel:{{ $order->user_address?->mobile }}" class="icon">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-0">
                        <div class="border-bottom m-0 py-2">
                            <!--@lang('main.details')-->
                             <p>@lang('main.details') : {{$order->shipping?->description}}</p>
                        </div>
                        
                        @if($order->shipping)
                        <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2">
                            <i class="fs-2 fa-solid fa-location-dot" style="color: #a6a6a6;"></i>
                            <div class="">
                                <p>@lang('main.from_address')</p>
                                <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ $order->shipping?->from_lat }},{{ $order->shipping?->from_lng }}">{{ $order->shipping?->from_address }}</a>
                            </div>
                        </div>
                        <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2">
                            <i class="fs-2 fa-solid fa-location-dot" style="color: #a6a6a6;"></i>
                            <div class="">
                                <p>@lang('main.to_address')</p>
                                <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ $order->shipping?->to_lat }},{{ $order->shipping?->to_lng }}">{{ $order->shipping?->to_address }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null) && !($order->status =='completed' && $order->updated_at < \Carbon\Carbon::now()->subHours(6)))

                            <div class="d-flex align-items-center justify-content-between border-bottom m-0 py-2">
                            <p class="m-0">@lang('main.delegate_name'): {{$order->delegate?->name}}</p>
                            <div class="d-flex align-items-center justify-content-end mb-1 gap-1">
                                    <a href="{{url('/admin/chat/?user_id='.$order->delegate_id)}}" class="icon"  target="_blank">
                                         <i class="far fa-comment-dots"></i>
                                    </a>
                                    <a href="tel:{{ $order->delegate?->mobile }}" class="icon"><i class="fas fa-phone"></i></a>
                                </div>
                            <!--<a href="{{route('users.show',['account_type' => 'delegate',$order->delegate_id])}}" class="d_link">@lang('main.show delegate')</a>-->
                        </div>
                            @if($order->status == 'shipped')
                                <div class="d-flex justify-content-between border-bottom py-3">
                                    <p class="m-0">@lang('main.cancelled order and Discount order total price from delegate')</p>
                                    <a href="{{route('orders.cancel_order_delegate',$order->id)}}" class="d_link">@lang('main.cancelled')</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <label class="card-header" style="border-radius:1rem 1rem 0 0;" > @lang('main.order summary')</label>
                    <div class="card-body">
                        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3">
                            <span>@lang('main.expected_price') </span>
                            <span id="productsPrice">{{$order->shipping?->expected_price}} @lang('main.egp')</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between m-0 py-2">
                            <span>@lang('main.actual_price')</span>
                            <span class="shipping" id="shipping"> {{$order->shipping?->actual_price}} @lang('main.egp')</span>
                        </div>
                        @if($order->delegate)
                        <div class="sub d-flex gap-2 align-items-center justify-content-between m-0 pb-1">
                            <span>@lang('main.delegate_percentage')</span>
                            <span>{{$order->delegate_percentage}} @lang('main.egp')</span>
                        </div>
                        <div class="sub d-flex gap-2 align-items-center justify-content-between m-0">
                            <span>@lang('main.delegate_tax') </span>
                            <span> {{$order->delegate_to_app_percentage}} @lang('main.egp')</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
@push('custom-js')
<script>
$('#body').summernote({
        height: 200,
    });
</script>
@endpush