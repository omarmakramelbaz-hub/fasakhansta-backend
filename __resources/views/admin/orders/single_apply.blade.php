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
            padding: 13px;
            border-radius: 8px;
            border-inline-start: 4px solid #3498db;
            color: #000;
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
        .new_order{
            background: #65b6b854;
            border-inline-start: 4px solid #65b6b8;
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
            height: 3.5rem !important;
            width: 3.5rem !important;
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
            height: 100px;
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
            gap: 5px;
            height: 35px;
            padding-inline: 1rem;
            border-radius: 29px;
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
                    <h1 class="m-0 text-dark">@lang('main.show') @lang('main.order') #{{$order->order_no}}</h1>
                </div><!-- /.col -->
                <div class="col-6">
                    <ol class="breadcrumb float-sm-left">
                       
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
                {{--<p class="mb-0">
                    <!--@lang('main.order') #{{$order->order_no}} -->
                    @if($order->order_type == 'default')
                    <span class="status {{$order->status}}">
                        @lang('main.order') #{{$order->order_no}} {{__('main.order-'.$order->status)}}</span>
                    @elseif($order->order_type == 'schedule')
                    <span class="status schedule">   @lang('main.order') #{{$order->order_no}} {{__('main.order-'.$order->status)}}  ( @lang('main.order-schedule'))
                    </span>  @lang('main.order will sent in') 
                    <div class="d-flex align-items-center gap-2">
                        <p class="mb-0 fw-bold"><i class="fas fa-calendar-day"></i> 
                         {{ \Carbon\Carbon::parse($order->schedule_date)->format('d/m/Y') }}
                        </p>
                        <p class="mb-0"><i class="fas fa-clock"></i> 
                            {{ \Carbon\Carbon::parse($order->schedule_date)->format('h:i A') }}
                        </p>
                    </div>
                    @else
                     <span class="status {{$order->status}}">
                        @lang('main.order') #{{$order->order_no}} {{__('main.order-'.$order->status)}}</span>
                    @endif
                </p> --}}
                <p class="mb-0">
                    <!--@lang('main.order') #{{$order->order_no}} -->
                    @if(($order->order_type == 'schedule' || $order->order_type == 'another_zone') && $order->schedule_date != null && $order->status == 'pending')
                     <div class="d-flex align-items-center gap-2 px-3 status schedule"> 
                        @lang('main.order-schedule') @lang('main.on date') 
                        <div class="d-flex align-items-center gap-2">
                            <p class="mb-0"><i class="fas fa-calendar-day"></i> 
                                {{ \Carbon\Carbon::parse($order->schedule_date)->format('d/m/Y') }}
                            </p>
                            <p class="mb-0"><i class="fas fa-clock"></i> 
                                {{ \Carbon\Carbon::parse($order->schedule_date)->format('h:i A') }}
                            </p>
                        </div>
                     </div> 
                    @else
                        <span class="status {{$order->status}}">
                            {{__('main.order-'.$order->status)}}
                        </span>
                     @endif
                     
                    {{--@if($order->order_type == 'default')
                        <span class="status {{$order->status}}">
                            {{__('main.order-'.$order->status)}}
                        </span>
                    @elseif($order->order_type == 'schedule')
                        @lang('main.order-schedule') @lang('main.on date') $order->schedule_date
                    @endif--}}
                </p> 
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="card">
                    {{--<div class="card-header" style="border-radius:1rem 1rem 0 0;">
                        <div class="detail">
                            @lang('main.order items') ({{count($order->carts)}})                                                 
                            <p style="float: left;">{{ $order->order_date ?? $order->created_at }}</p>

                        </div>
                    </div>--}}
                    
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
                                    <p class="mb-2 fw-bold">{{$order->user?->name}}</p>
                                    <!--<p class="mb-0 fw-bold">#{{$order->order_no}}</p>-->
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
                                <div class="d-flex align-items-center justify-content-end mb-0 gap-1">
                                    @if($order->status != 'completed' && $order->status != 'cancelled')
                                    <a href="tel:{{ $order->user_address?->mobile }}" class="icon">
                                        <span>{{ $order->user_address?->mobile }}</span>
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    @endif
                                    
                                    
                                </div>
                                <!--<p class="mb-0 fw-bold status">{{__('main.'.$order->status)}}</p>-->
                            </div>
                        </div>
                    </div>
                    
                    @php $sum_total=0; @endphp
                    <div class="card-body pt-2 pb-0">
                        <div class="d-flex gap-2 align-items-center border-bottom m-0 py-3">
                            @if($order->user_address)
                            <i class="fs-2 fa-solid fa-location-dot" style="color: #a6a6a6;"></i>
                            <div class="">
                                <p>@lang('main.Delivery location') </p>
                                <span>@lang('main.area_name') : {{ $order->user_address?->area_name }},</span>
                                <span>@lang('main.street_name') : {{ $order->user_address?->street_name }},</span>
                                <span>@lang('main.floor_no') : {{ $order->user_address?->floor_no }}</span>
                            </div>
                            @else
                                <h5>@lang('main.no user address yet')</h5>
                            @endif
                        </div>
                         @if($order->notes)
                             <div class="d-flex gap-2 align-items-center border-bottom m-0 py-3">
                                <i class="fs-2 fa-solid fa-circle-info" style="color: #a6a6a6;"></i>
                                <div class="">
                                    <p>@lang('main.notes') </p>
                                    <span> {{ $order->notes }}</span>
                                 
                                </div>
                            </div>
                          @endif
                        @if($order->delegate_from_out)
                        <p class="border-bottom w-100 m-0 py-3">@lang('main.delegate_from_out'): {{__('main.'.$order->delegate_from_out)}}</p>
                        @endif
                        @if($order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null) && !($order->status =='completed' && $order->updated_at < \Carbon\Carbon::now()->subHours(6)))
                        <div class="d-flex align-items-center justify-content-between border-bottom m-0 py-2">
                            <p class="m-0">@lang('main.delegate_name'): {{$order->delegate?->name}}</p>
                            <div class="d-flex align-items-center justify-content-end mb-1 gap-1">
                                    <a href="{{url('/admin/chat/?user_id='.$order->delegate_id)}}" class="icon">
                                         <i class="far fa-comment-dots"></i>
                                    </a>
                                    <a href="tel:{{ $order->delegate?->mobile }}" class="icon"><i class="fas fa-phone"></i></a>
                                </div>
                            <!--<a href="{{route('users.show',['account_type' => 'delegate',$order->delegate_id])}}" class="d_link">@lang('main.show delegate')</a>-->
                        </div>
                        @endif
                      
                        @foreach($order->carts as $val)
                        {{--<div class="row align-items-center item mb-3">
                            <div class="col-sm-2">
                                @if ($val->resturant_product?->getFirstMediaUrl('product_image','thumb'))
                                <img class="cursor-img" data-bs-toggle="modal" data-bs-target="#exampleModaly{{ $val->resturant_product?->id }}" id="image" accept="image/png, image/jpeg, image/webp, image/jpg" src="{{ $val->resturant_product?->getFirstMediaUrl('product_image','thumb') }}" style="width:80px;" alt="@lang('main.NoImageUploaded')">
                                @include('admin.components.modal_photo', [
                                'image' => $val->resturant_product?->getFirstMediaUrl('product_image','thumb'),
                                'id' => 'y'.$val->resturant_product?->id,
                                ])
                                @else
                                <img id="image" src="{{$val->resturant?->getFirstMediaUrl('logo','thumb')}}" style="object-fit:contain; width:100%">
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <h5>{{$val->resturant_product?->product_name}}</h5>
                                <p class="mb-1">{{$val->price}} @lang('main.egp') /  @lang('main.per unit') : {{$val->qty}}</p>
                                <p class="mb-1">{{$val->resturant_product?->product?->category?->name}} / {{$val->resturant_product?->product?->subcategory?->name}} / {{$val->resturant_product?->product?->name}}</p>
                                    @if(! empty($val->product_feature) ) 
                                    <p class="mb-1">
                                     @if($val->product_feature1?->name=='kilo' || $val->product_feature1?->name=='half' || $val->product_feature1?->name=='quarter')
                                        @lang('main.product_feature_val')
                                     @endif 
                                    {{__('main.'.\App\Models\ProductFeature::where('id',$val->product_feature)->first()?->name)}}</p>
                                    @endif
                                 @if(! empty($val->product_clean) )
                                <p class="mb-0">
                                    <span>@lang('main.product_add_on') :</span>
                                    <span>{{ __('main.'.$val->product_clean) }}</span>
                                </p>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <p class="mb-1">{{$val->price}} @lang('main.egp')</p>
                                <p>@lang('main.subtotal') {{$val->price * $val->qty}} @lang('main.egp')</p>
                            </div>
                        </div>--}}
                        <div class="cart-product-item  border-bottom base_product0">
                                        <div class="row gy-2 position-relative pt-3 pb-3 align-items-center">
                                            <div class="col-md-3 col-12">
                                                @if ($val->resturant_product?->getFirstMediaUrl('product_image','thumb'))
                                                <img class="img-cart mb-md-0 mb-3" src="{{ $val->resturant_product?->getFirstMediaUrl('product_image','thumb') }}">
                                                @else
                                                <img class="img-cart mb-md-0 mb-3" src="{{$val->resturant?->getFirstMediaUrl('logo','thumb')}}" style="object-fit:contain; width:100%">
                                                @endif
                                            </div>
                                            <div class="col-md-9 col-12">
                                    <div class="cart-product-name">
                                        <p>{{$val->resturant_product?->product?->category?->name}} / {{$val->resturant_product?->product?->subcategory?->name}} / {{$val->resturant_product?->product?->name}}</p>
                                        <div class="d-flex align-items-center justify-content-between my-1">
                                            <h6 class="fw-bold m-0">
                                               {{$val->resturant_product?->product_name}}
                                            </h6>
                                            <p class="price fs-6 d-flex align-items-center gap-1">
                                                @if($val->updated_total)
                                                <small>
                                                    {{$val->price}} @lang('main.egp')
                                                </small>
                                                <span>
                                                    {{$val->updated_total}} @lang('main.egp')
                                                </span>
                                                @else
                                                <span>
                                                    {{$val->price}} @lang('main.egp')
                                                </span>
                                                @endif
                                            </p>
                                        </div>
                                        @if(! empty($val->product_clean) )
                                        <p class="mb-1">
                                            <span>@lang('main.product_add_on') :</span>
                                            <span>{{ __('main.'.$val->product_clean) }}</span>
                                        </p>
                                        @endif
                                    </div>
                                    <div class="product-quantity d-flex flex-wrap gap-3 align-items-center justify-content-between">
                                        <div class="d-flex gap-3 align-items-center">
                                            @if(! empty($val->product_feature) || ! empty($value->product_clean)) 
                                            <div class="d-flex align-items-center gap-2">
                                                
                                                @if(! empty($val->product_feature) ) 
                                                
                                                @if($val->product_feature1?->name=='kilo' || $val->product_feature1?->name=='half' || $val->product_feature1?->name=='quarter')
                                                 <p>@lang('main.product_feature_val')</p>
                                                @endif
                                               
                                                <p class="mb-0 qty"> {{__('main.'.\App\Models\ProductFeature::where('id',$val->product_feature)->first()?->name)}}
                                                </p>
                                                @endif
                                            </div>
                                            @endif
                                            <div class="d-flex align-items-center gap-2">
                                                <p>@lang('main.qty')</p>
                                                <p class="qty">{{$val->qty}}</p>
                                            </div>
                                        </div>
                                        <div class="product-full-price mint fw-bold">
                                            <h6 class="d-inline-block fw-bold">@lang('main.subtotal')</h6>
                                            <span class="fs-6 px-1 px-md-1 total_price_0">{{$val->updated_total?$val->updated_total:$val->price * $val->qty}} @lang('main.egp')</span>
                                        </div>
                                    </div>
                                </div>
                                            @if($val->updated_total)
                                            <div class="col-12">
                                                <p class="note m-0">
                                                @lang('main.The price has been modified from')
                                                 {{$val->price*$val->qty}} @lang('main.egp') 
                                                 @lang('main.to')
                                                 {{$val->updated_total}} @lang('main.egp') 
                                                 @lang('main.and the reason is') 
                                                 {{$val->reason_update_total}}
                                                </p>
                                            </div>
                                            @endif
                                            @if(auth('admin')->user()->account_type=='vendor' && ($order->status == 'pending' || $order->status == 'accepted' || $order->status == 'another_delegate'  ) && $val->updated_total == null && ($val->product_feature1?->name == 'kilo' || $val->product_feature1?->name == 'half' || $val->product_feature1?->name == 'quarter') )
                                            <button type="button" class="btn edit" data-bs-toggle="modal" data-bs-target="#editItem{{$val->id}}">
                                             <i class="fa-solid fa-pencil"></i>
                                             <span>@lang('main.update')</span>
                                            </button>
                                            @endif
                                            <div class="modal fade" id="editItem{{$val->id}}" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('main.change price') #{{$order->order_no}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body p-5">
                                                        <form  method="post" action="{{route('updateOrderTotalPrice',$order->id)}}">
                                                            @csrf                      
                                                            <input name="item_id" value="{{$val->id}}" type="hidden">
                                                            <div class="row gy-3 p-md-4">
                                                                <div class="form-group col-sm-12">
                                                                    <label for=""> @lang('main.price after update') </label>
                                                                    <input type="number" min="0" name="total" value="{{$val->price * $val->qty}}" class="form-control " id="" required placeholder="">
                                                                </div>
                                                                
                                                                <div class="form-group col-sm-12">
                                                                    <label for="">@lang('main.reason for update')</label>
                                                                    <input type="text" name="reason" value="{{old('reason',$val->reason)}}" class="form-control " id="password" required="" placeholder="">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button type="sumbit" class="btn btn-primary">@lang('main.Save changes') </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                      </div>
                                                </div>
                                              </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                        @php $sum_total+=$val->total; @endphp 
                        @endforeach
                        
                        @php $grand_total = ['0' => $sum_total]; @endphp
                    
                        {{--<div class="col-sm-12 card-footer rounded-4 mt-3">
                            <p> @lang('main.subtotal') {{$order->total_price}} @lang('main.egp')</p>
                            <p class="mb-0"> @lang('main.discount') @if($order->coupon_id) {{($order->total_price) - ($order->price_after_discount) }}  @else 0 @endif @lang('main.egp')</p>
                            <p>@lang('main.shipping') {{$shipping_price}} @lang('main.egp')
                            </p>
                            @if($order->user_address)
                                <p> @lang('main.grand_total') @if($order->coupon_id) {{$order->price_after_discount + $shipping_price}} @else {{$order->total_price + $shipping_price}} @endif @lang('main.egp')</p>
                            @else
                            <p> @lang('main.grand_total') {{$sum_total}} @lang('main.egp')</p>
                            @endif
                        </div>--}}
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <label class="card-header" style="border-radius:1rem 1rem 0 0;" > @lang('main.order summary')</label>
                    <div class="card-body">
                        
                        <div class="d-flex gap-2 align-items-center justify-content-between m-0 pb-2">
                            <span>@lang('main.payment_type') </span>
                            <span id="productsPrice">{{__('main.'.$order->payment_type)}}</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between m-0 pb-2">
                            <span>@lang('main.total_cart') </span>
                            <span id="productsPrice">{{$order->updated_total}} @lang('main.egp')</span>
                        </div>
                        <div class="sub d-flex gap-2 align-items-center justify-content-between m-0 pb-1">
                            <span>@lang('main.vendor_percentage') </span>
                            <span id="productsPrice">{{$order->vendor_percentage}} @lang('main.egp')</span>
                        </div>
                        <div class="sub d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3">
                            <span>@lang('main.vendor_tax') </span>
                            <span id="productsPrice"> {{$order->vendor_tax}} @lang('main.egp')</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 py-3">
                            <span>@lang('main.delivery_price')</span>
                            <div class="shipping" id="shipping"> {{$order->delivery_price}} @lang('main.egp')</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 py-3">
                            <span>@lang('main.service_fees')</span>
                            <div class="shipping" id="shipping"> {{$order->service_fees}} @lang('main.egp')</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 py-3">
                            <span>@lang('main.tax')</span>
                            <div class="shipping" id="shipping"> {{$order->tax}} @lang('main.egp')</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between m-0 pt-3">
                            <span> @lang('main.grand_price')</span>
                            <span id="finalPrice"> {{$order->grand_total}} @lang('main.egp')</span>
                        </div>
                        
                        {{--<table class="table">
                            <tr>
                                <td>
                                    <span>@lang('main.total_cart') </span>
                                </td>
                                <td>
                                    <span id="productsPrice">{{$order->total}} @lang('main.egp')</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.vendor_percentage') </span>
                                </td>
                                <td>
                                    <span id="productsPrice">{{$order->vendor_percentage}} @lang('main.egp')</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.vendor_tax') </span>
                                </td>
                                <td>
                                    <span id="productsPrice"> {{$order->vendor_tax}} @lang('main.egp')</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.delivery_price')</span>
                                </td>
                                <td>    
                                    <div class="shipping" id="shipping"> {{$order->delivery_price}} @lang('main.egp')</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.service_fees')</span>
                                </td>
                                <td>    
                                    <div class="shipping" id="shipping"> {{$order->service_fees}} @lang('main.egp')</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.tax')</span>
                                </td>
                                <td>    
                                    <div class="shipping" id="shipping"> {{$order->tax}} @lang('main.egp')</div>
                                </td>
                            </tr>
                            <!--<tr>-->
                            <!--    <td>-->
                            <!--        <span>@lang('main.discount')</span>-->
                            <!--    </td>-->
                            <!--    <td>-->
                            <!--        <span id='discount'>@if($order->coupon_id) {{($order->total_price) - ($order->price_after_discount) }}  @else 0 @endif @lang('main.egp')</span>-->
                            <!--        <input type="hidden" name="old_price" id="old_price">-->
                            <!--    </td>-->
                            <!--</tr>-->
                            <tr>
                                <td>
                                    <span> @lang('main.grand_price')</span>
                                </td>
                                <td>
                                    <span id="finalPrice"> {{$order->grand_total}} @lang('main.egp')</span>
                                
                                </td>
                            </tr>
                        </table>
                        --}}
                    </div>
                </div>
                {{--<div class="card">
                    <label class="card-header" style="border-radius:1rem 1rem 0 0;" > @lang('main.customer')</label>
                    <div class="card-body">
                        <div class="form-group">
                            @if( $order->user)
                            <p>{{ $order->user?->name }}</p>
                            <p><a href="mailto:{{ $order->user?->email }}">{{ $order->user?->email }}</a></p>
                            <p><a href="tel:{{ $order->user?->mobile }}">{{ $order->user?->mobile }}</a></p>
                            @else
                            <p>{{ $order->user_address?->username }}</p>
                            <p><a href="mailto:{{ $order->user_address?->email }}">{{ $order->user_address?->email }}</a></p>
                            <p><a href="tel:{{ $order->user_address?->mobile }}">{{ $order->user_address?->mobile }}</a></p>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <label class="card-header" style="border-radius:1rem 1rem 0 0;"> @lang('main.billing address')</label>
                    <div class="card-body">
                        @if($order->user_address)
                        <div class="form-group">
                            <p>@lang('main.area_name') : {{ $order->user_address?->area_name }}</p>
                            <p>@lang('main.apartment_name') : {{ $order->user_address?->apartment_name }}</p>
                            <p>@lang('main.floor_no') : {{ $order->user_address?->floor_no }}</p>
                            <p>@lang('main.street_name') : {{ $order->user_address?->street_name }}</p>
                            <p>@lang('main.mobile') : {{ $order->user_address?->mobile }}</p>
                            <p>@lang('main.address_name') : {{ $order->user_address?->address_name }}</p>
                            <p>@lang('main.address_type') : {{ __('main.'.$order->user_address?->type) }}</p>

                        </div>
                        @else
                        <h5>@lang('main.no user address yet')</h5>
                        @endif
                    </div>
                </div>--}}
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