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
            padding: 13px;
            border-radius: 23px;
        }        
        .completed{
            background: #3fdb13;
        }
        .pending{
            background: #dbc513;
        }
        .cancelled{
            background: #db2613;
            color: #fff;
        }
        .shipped{
            background: #db8413;
            color: #fff;
        }
        .schedule{
            background: #cbf23e;
        }
        .d_link{
            text-decoration: underline !important;
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
                    <h1 class="m-0 text-dark">@lang('main.show') @lang('main.order') </h1>
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
    <section class="content">
        <div class="container-fluid">
        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4">
            <div class="">
                <p class="mb-0">@lang('main.order') #{{$order->order_no}} 
                @if($order->order_type == 'default')
<span class="status {{$order->status}}">{{__('main.order-'.$order->status)}}</span>
@elseif($order->order_type == 'schedule')
                 <span class="status schedule">   @lang('main.order-schedule') </span>  @lang('main.order will sent in') {{$order->schedule_date}}
                                                @endif
                 </p> 
            </div>
            <div class="">
                <a href="{{ route('download-pdf',['id' =>$order->id,'type' => 'admin' ,'download'=>'pdf']) }}" class="btn btn-primary">@lang('main.download fatoorah')</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header" style="border-radius:1rem 1rem 0 0;">
                        <div class="detail">
                            @lang('main.order items') ({{count($order->carts)}})                                                 
                            <p style="float: left;">{{ $order->order_date ?? $order->created_at }}</p>

                        </div>
                    </div>
                    @php $sum_total=0; @endphp
                    <div class="card-body">
                        @foreach($order->carts as $val)
                        <div class="row align-items-center item mb-3">
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
                               @if(! empty($val->product_feature) ) <p class="mb-1">@lang('main.product_feature_val') {{__('main.'.\App\Models\ProductFeature::where('id',$val->product_feature)->first()?->name)}}</p>@endif
                                 @if(! empty($value->product_clean) )
                                <p class="mb-0">
                                    <span>@lang('main.product_add_on') :</span>
                                    <span>{{ __('main.'.$value->product_clean) }}</span>
                                </p>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <p class="mb-1">{{$val->price}} @lang('main.egp')</p>
                                <p>@lang('main.subtotal') {{$val->price * $val->qty}} @lang('main.egp')</p>
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
                
                @if($order->status != 'pending')
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
                                    <a href="{{route('users.show',['account_type' => 'delegate',$order->delegate_id])}}" class="d_link">@lang('main.show delegate')</a>
                                </div>
                                @endif
                            </div>
                            
                            <div>
                                {{--<p class="border-bottom m-0 py-3">@lang('main.delegate_percentage'): {{$order->delivery_price}} @lang('main.egp')</p>
                                <p class="border-bottom m-0 py-3">@lang('main.vendor_percentage'): {{$order->vendor_percentage}} @lang('main.egp')</p>
                                <p class="m-0 pt-3">@lang('main.app_percentage'): {{$order->app_percentage}} @lang('main.egp')</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
                <div class="card">
                    <div class="card-body">
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
                        @if($order->transfer_price_by==null)
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
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <label class="card-header" style="border-radius:1rem 1rem 0 0;" > @lang('main.order summary')</label>
                    <div class="card-body">
                        <table class="table">
                            <!--<tr>-->
                            <!--    <td>-->
                            <!--        <span>الكمية</span>-->
                            <!--    </td>-->
                            <!--    <td>-->
                            <!--        <span id="qnt">1</span>-->
                            <!--    </td>-->
                            <!--</tr>-->
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
                            {{--<tr>
                                <td>
                                    <span>@lang('main.discount')</span>
                                </td>
                                <td>
                                    <span id='discount'>@if($order->coupon_id) {{($order->total_price) - ($order->price_after_discount) }}  @else 0 @endif @lang('main.egp')</span>
                                    <input type="hidden" name="old_price" id="old_price">
                                </td>
                            </tr>--}}
                            <tr>
                                <td>
                                    <span> @lang('main.grand_price')</span>
                                </td>
                                <td>
                                    <span id="finalPrice"> {{$order->grand_total}} @lang('main.egp')</span>
                                
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
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