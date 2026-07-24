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
                    <h1 class="m-0 text-dark">@lang('main.details') #{{$order->order_no}} </h1>
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
                        @lang('main.order-schedule') بتاريخ $order->schedule_date
                    @endif--}}
                </p> 
            </div>
            <div class="">
                <a href="{{ route('download-pdf',['id' =>$order->id,'type' => 'admin']) }}" class="btn btn-primary">@lang('main.download fatoorah')</a>
            </div>
        </div>
        
        
        
        <div class="info-box" style="text-align:start">
            <a href="{{route('resturants.show',$order->resturant_id)}}" class="link"></a>
            <span class="info-box-icon bg-info">
                
                
                @if($order->resturant->getFirstMediaUrl('logo','thumb'))
                            <img class="cursor-img" data-toggle="modal" data-target="#exampleModal{{ $order->resturant->id }}"
                                id="image" src="{{$order->resturant->getFirstMediaUrl('logo','thumb')}}" style="width:70%;"
                                alt="@lang('main.NoImageUploaded')">
                            @include('admin.components.modal_photo', [
                                'image' => $order->resturant->getFirstMediaUrl('logo','thumb'),
                                'id' => $order->resturant->id,
                            ])
                        @else
                            <img id="image" src="{{ url('dashboard/dist/img/no-photo.png') }}"
                                style="height: 80px; width: 100px;">
                        @endif 
                        

            </span>
            <div class="info-box-content">
                <span class="info-box-text"><b> {{$order->resturant?->name}}</b></span>
                <span class="info-box-number mt-2"><a href="{{route('resturants.show',$order->resturant_id)}}"  target="_blank">@lang('main.Quick jump to restaurant details')</a><span>
            </div>
          <!-- /.info-box-content -->
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
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{url('/admin/chat/?user_id='.$order->user_id)}}" class="icon" target="_blank">
                                         <i class="far fa-comment-dots"></i>
                                    </a>
                                    <a href="tel:{{ $order->user_address?->mobile }}" class="icon">
                                        <i class="fas fa-phone"></i>
                                    </a>

                                    
                                </div>
                                <!--<p class="mb-0 fw-bold">-->
                                <!--    {{$order->created_at}}-->
                                <!--    <i class="fas fa-calendar-day ps-1"></i> -->
                                <!--</p>-->
                                <!--<p class="mb-0 fw-bold status">{{__('main.'.$order->status)}}</p>-->
                            </div>
                        </div>
                    </div>
                    
                    @php $sum_total=0; @endphp
                    <div class="card-body pt-2 pb-0">
                        <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2">
                            @if($order->user_address)
                            <i class="fs-2 fa-solid fa-location-dot" style="color: #a6a6a6;"></i>
                            <div class="">
                                <p>@lang('main.Delivery location') </p>
                                <!--<span>@lang('main.area_name') : {{ $order->user_address?->area_name }},</span>-->
                                <!--<span>@lang('main.street_name') : {{ $order->user_address?->street_name }},</span>-->
                                <!--<span>@lang('main.floor_no') : {{ $order->user_address?->floor_no }}</span>-->
                                @lang('main.city_name'): {{$order->user_address?->city_name}},
                                @lang('main.street_name'): {{$order->user_address?->street_name}},
                                <!--@lang('main.address'): {{$order->user_address?->address}}, -->
                                @lang('main.apartment_no'): {{$order->user_address?->apartment_no}}, 
                                @lang('main.floor_no'): {{$order->user_address?->floor_no}}
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
                        @if(!$order->reason && $order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null) && !($order->status =='completed' && $order->updated_at < \Carbon\Carbon::now()->subHours(6)))

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
                        
                        @endif
                          @if($order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null) && $order->status == 'shipped' && auth('admin')->user()->account_type=='admin')
                            <div class="d-flex justify-content-between border-bottom py-3">
                                <p class="m-0">@lang('main.cancelled order and Discount order total price from delegate')  <small class="text-danger">@lang('main.when click on cancelled')</small></p>
                                <div class="d-flex align-items-center justify-content-end mb-1 gap-1">
                                    <a href="{{route('orders.cancel_order_delegate',$order->id)}}" class="d_link">@lang('main.cancelled')</a>
                                </div>
                            </div>
                         @endif
                        @foreach($order->carts as $val)
                        <div class="cart-product-item  border-bottom base_product0">
                                        <div class="row gy-2 position-relative pt-3 pb-3 align-items-center">
                                            <div class="col-md-2 col-12">
                                                @if ($val->resturant_product?->getFirstMediaUrl('product_image','thumb'))
                                                <img class="img-cart mb-md-0 mb-3" src="{{ $val->resturant_product?->getFirstMediaUrl('product_image','thumb') }}">
                                                @else
                                                <img class="img-cart mb-md-0 mb-3" src="{{$val->resturant?->getFirstMediaUrl('logo','thumb')}}" style="object-fit:contain; width:100%">
                                                @endif
                                            </div>
                                            <div class="col-md-10 col-12">
                                                <div class="cart-product-name">
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
                                                    <p class="mb-0">
                                                        <span>@lang('main.product_add_on') :</span>
                                                        <span>{{ __('main.ext-'.$val->product_clean) }}</span>
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
                                                            <!--@if(! empty($val->product_clean) )-->
                                                            <!--<p class="mb-0">-->
                                                            <!--    <span>@lang('main.product_add_on') :</span>-->
                                                            <!--    <span>{{ __('main.'.$val->product_clean) }}</span>-->
                                                            <!--</p>-->
                                                            <!--@endif-->
                                                        </div>
                                                        @endif
                                                        <div class="d-flex align-items-center gap-2">
                                                            <p>الكمية</p>
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
                                                 تم تعديل السعر من {{$val->price*$val->qty}} @lang('main.egp') الى {{$val->updated_total}} @lang('main.egp') 
                                                 والسبب 
                                                 {{$val->reason_update_total}}
                                                </p>
                                            </div>
                                            @endif
                                            
                                            <div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
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
                                                                    <label for="">السعر بعد التعديل</label>
                                                                    <input type="number" name="total" value="{{$val->price * $val->qty}}" class="form-control " id="" required placeholder="">
                                                                </div>
                                                                
                                                                <div class="form-group col-sm-12">
                                                                    <label for="">سبب التعديل</label>
                                                                    <input type="text" name="reason_update_total" value="{{old('reason')}}" class="form-control " id="password" required="" placeholder="">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <button type="sumbit" class="btn btn-primary">حفظ التعديلات</button>
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
                
                {{-- @if($order->status != 'pending')--
                <div class="card">
                    <div class="card-header" style="border-radius:1rem 1rem 0 0;">
                        <div class="detail">
                            @lang('main.order for resturant')
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div>
                                <div class="d-flex justify-content-between border-bottom pb-3">
                                    <p class="m-0">@lang('main.resturant_name'): {{$order->resturant?->name}}</p> 
                                    <a href="{{route('resturants.show',$order->resturant_id)}}" class="d_link">@lang('main.show resturant')</a>
                                </div>
                                
                                <p class="border-bottom m-0 py-3">@lang('main.delegate_from_out'): {{__('main.'.$order->delegate_from_out)}}</p>
                                
                                @if($order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null))
                                <div class="d-flex justify-content-between border-bottom py-3">
                                    <p class="m-0">@lang('main.delegate_name'): {{$order->delegate?->name}}</p>
                                    <a href="{{url('/admin/chat/?user_id='.$order->delegate_id)}}" class="btn btn-primary">@lang('main.contact with messages')</a>
                                    <a href="{{route('users.show',['account_type' => 'delegate',$order->delegate_id])}}" class="d_link">@lang('main.show delegate')</a>
                                </div>
                                    @if($order->status == 'shipped' && auth('admin')->user()->account_type=='admin')
                                    <div class="d-flex justify-content-between border-bottom py-3">
                                        <p class="m-0">@lang('main.cancelled order and Discount order total price from delegate')</p>
                                        <a href="{{route('orders.cancel_order_delegate',$order->id)}}" class="d_link">@lang('main.cancelled')</a>
                                    </div>
                                    @endif
                                @endif
                            </div>
                            
                            <div>
                                <p class="border-bottom m-0 py-3">@lang('main.delegate_percentage'): {{$order->delivery_price}} @lang('main.egp')</p>
                                <p class="border-bottom m-0 py-3">@lang('main.vendor_percentage'): {{$order->vendor_percentage}} @lang('main.egp')</p>
                                <p class="m-0 pt-3">@lang('main.app_percentage'): {{$order->app_percentage}} @lang('main.egp')</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif--}}
                @if($order->status != 'completed')
                {{--<div class="card">
                    <div class="card-body">
                        <h6 class="alert">@lang('main.send email to') : {{($order->user)? $order->user?->email : $order->user_address?->email}} </h6>
                        <style>
                            .alert{
                                background: #56878b6e;
                                border-inline-start: 7px solid #56878b;
                            }
                            .card-body input[type=radio]{
                                margin:.5rem;
                                capacity:#5A9D61;
                            }
                        </style>
                        <form method="post" action="{{route('orders.change_status',$order->id)}}">
                            @csrf
                            <input type="radio" class="" name="status" @if($order->status == 'accepted') checked @endif id="input1" value="accepted"> <label for="input1">@lang('main.accepted')</label> 
                            <input type="radio" class="" name="status" @if($order->status == 'shipped') checked @endif id="input2" value="shipped"> <label for="input2">@lang('main.shipped')</label> 
                            <input type="radio" class="" name="status" @if($order->status == 'completed') checked @endif id="input3" value="completed"> <label for="input3">@lang('main.completed')</label> 
                            <input type="date" value="" name="order_date" class="form-control order_date" style="display:none">
                            <input type="radio" class="" name="status" @if($order->status == 'cancelled') checked @endif id="input4" value="cancelled"> <label for="input4">@lang('main.cancelled')</label> 
                            <textarea name="body" rows="5" id="body"
                                    class="form-control summernote "></textarea>
                            <button type="submit" class="form-control mt-3">
                                @lang('main.save')
                            </button>
                        </form>
                    </div>
                </div>--}}
                @else
                {{--<div class="card">
                    <div class="card-body">
                        
                         <table class="table">
                           <tr>
                                <td>
                                    <span>@lang('main.payment_type') </span>
                                </td>
                                <td>
                                    <span id="productsPrice">{{__('main.'.$order->payment_type)}} </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.vendor_price') </span>
                                </td>
                                <td>
                                    <span id="productsPrice">{{$order->vendor_percentage}} @lang('main.egp')</span>
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
                                    <span>@lang('main.vendor_tax')</span>
                                </td>
                                <td>    
                                    <div class="shipping" id="shipping"> {{$order->vendor_tax}} @lang('main.egp')</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>@lang('main.app_tax')</span>
                                </td>
                                <td>    
                                    <div class="shipping" id="shipping"> {{$order->tax}} @lang('main.egp')</div>
                                </td>
                            </tr>
                           
                           
                        </table>
                    </div>
                </div>--}}
                
                @if($order->transfer_price_by==null)
                <style>
                            .alert{
                                background: #56878b6e;
                                border-inline-start: 7px solid #56878b;
                            }
                            .card-body input[type=radio]{
                                margin:.5rem;
                                capacity:#5A9D61;
                            }
                        </style> 
                    @if($order->payment_type=='cash')
                       <h4 class="alert-danger"> @lang('main.The fees were not distributed through') {{$order->delegate_id==null?__('main.vendor'):__('main.delegate')}}</h4>
                    @else
                      <h4 class="alert-danger">@lang('main.transfer delivery price and vendor price')</h4>
                      
                    <form method="post" action="{{route('orders.transfer_price',$order->id)}}">
                        @csrf
                        
                        <button type="submit" class="form-control mt-3">
                            @lang('main.sent fees')
                        </button>
                    </form>
                    @endif
                @else
                   <h4 class="alert"> @lang('main.The fees were distributed through') @lang('main.'.$order->transfer_price_by)</h4>
                @endif
                @endif
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <label class="card-header" style="border-radius:1rem 1rem 0 0;" > @lang('main.order summary')</label>
                    <div class="card-body">
                        <div class="d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3">
                            <span>@lang('main.payment_type') </span>
                            <span>{{__('main.'.$order->payment_type)}}</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between m-0 py-2">
                            <span>@lang('main.total_cart') </span>
                            <span id="productsPrice">{{$order->updated_total}} @lang('main.egp')</span>
                        </div>
                        <div class="sub d-flex gap-2 align-items-center justify-content-between m-0 pb-1">
                            <span>@lang('main.vendor_percentage') </span>
                            <span>{{$order->vendor_percentage}} @lang('main.egp')</span>
                        </div>
                        <div class="sub d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3">
                            <span>@lang('main.vendor_tax') </span>
                            <span> {{$order->vendor_tax}} @lang('main.egp')</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center justify-content-between m-0 
                        @if($order->delegate_from_out != 'out_resturant') 
                            border-bottom py-3 
                        @else 
                            py-2 
                        @endif">

                            <span>@lang('main.delivery_price')</span>
                            <div class="shipping" id="shipping"> {{$order->delivery_price}} @lang('main.egp')</div>
                        </div>
                        @if($order->delegate_from_out == 'out_resturant')
                        <div class="sub d-flex gap-2 align-items-center justify-content-between m-0 pb-1">
                            <span>@lang('main.delegate_percentage_tax') </span>
                            <span>{{$order->delegate_percentage}} @lang('main.egp')</span>
                        </div>
                        <div class="sub d-flex gap-2 align-items-center justify-content-between border-bottom m-0 pb-3">
                            <span>@lang('main.delegate_tax') </span>
                            <span> {{$order->delegate_to_app_percentage}} @lang('main.egp')</span>
                        </div>
                        @endif
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