@extends('admin.index')

@section('content')
    <style>
        .all_orders .avatar {
            border: 1px solid #fff;
            border-radius: 50%;
            padding: 5px;
            height: 3.5rem !important;
            width: 3.5rem !important;
            object-fit: cover;
            background: #fff;
        }
        .all_orders .status{
            background: #fff;
            border-radius: 28px;
            padding: 4px;
            font-size: 14px;
            color: var(--main);
            text-align: center;
            width: 100%;
        }
        .all_orders p{
            width: max-content;
            margin: 0px;
        }
        .cart-product-item .img-cart {
            width: 100%;
            border-radius: 18px;
            height: 170px;
            object-fit: cover;
            background: var(--white);
            border: 1px solid #CECECE;
            border-radius: 15px;
        }
        .qty{
            background: #fd720140;
            padding: 4px 12px;
;
            border-radius: 4px;
            min-width: 40px;
            text-align: center;
            font-size: 14px;
        }
        .cart-product-item:last-child{
            border: none !important;
        }
    </style>
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
                    <ul class="nav nav-pills my-3 pb-3 border-bottom user-pills">
                      <li class="nav-item">
                        <a class="nav-link @if(request('q') == 'pending') active @endif" href="{{url('admin/applies-orders?q=pending')}}">@lang('main.pending orders')</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link @if(request('q') == 'accepted') active @endif" href="{{url('admin/applies-orders?q=accepted')}}">@lang('main.currently orders')</a>
                      </li>
                      <!-- status=cancelled&q=accepted&status=completed -->
                      <li class="nav-item">
                        <a class="nav-link @if(request('q') == 'completed') active @endif" href="{{url('admin/applies-orders?q=completed')}}">@lang('main.last orders')</a>
                      </li>
                    </ul>
                    
                    <form method="get" action="{{route('orders.applies',['q' => request('q') , 'order_no' => request('order_no')])}}">
                        <input type="hidden" name="q" value="{{request('q')}}">
                        <input type="number" class="form-control" name="order_no" value="{{request('order_no')}}" placeholder="@lang('main.search by order no')">
                    </form>
                    <!--<li><a href="{{url('admin/applies-orders?q=accepted')}}">@lang('main.currently orders')</a></li>-->
                    <!--<li><a href="{{url('admin/applies-orders?q=completed')}}">@lang('main.last orders')</a></li>-->
                     @if(request('q') == 'accepted')
                        <form  method="get" action="{{route('orders.applies',['q' => request('q') ,'delegate_from_out' => request('delegate_from_out'), 'date' => request('date'),'status' => request('status')])}}">
                            <input type="hidden" name="delegate_from_out" value="{{request('delegate_from_out')}}">
                            <input type="hidden" name="status" value="{{request('status')}}">
                            <input type="hidden" name="date" value="{{request('date')}}">
                            <input type="hidden" name="q" value="{{request('q')}}">
                            <select class="form-select col-md-12" name="status" onchange="this.form.submit()">
                                <option value="">@lang('main.choose')</option>
                                <option value="accepted" @if(request('status') == 'accepted') selected @endif>@lang('main.order-accepted')</option>
                                <option value="shipped" @if(request('status') == 'shipped') selected @endif>@lang('main.order-shipped')</option>
                            </select>
                        </form>
                        
                        <form  method="get" action="{{route('orders.applies',['q' => request('q') ,'delegate_from_out' => request('delegate_from_out'), 'date' => request('date'),'status' => request('status')])}}">
                            <input type="hidden" name="delegate_from_out" value="{{request('delegate_from_out')}}">
                            <input type="hidden" name="status" value="{{request('status')}}">
                            <input type="hidden" name="date" value="{{request('date')}}">
                            <input type="hidden" name="q" value="{{request('q')}}">
                            <select class="form-select col-md-12" name="delegate_from_out" onchange="this.form.submit()">
                                <option value="">@lang('main.choose')</option>
                                <option value="in_resturant" @if(request('delegate_from_out') == 'in_resturant') selected @endif>@lang('main.order-inresturant')</option>
                                <option value="out_resturant" @if(request('delegate_from_out') == 'out_resturant') selected @endif>@lang('main.order-outresturant')</option>
                            </select>
                        </form>
                        
                        <form  method="get" action="{{route('orders.applies',['q' => request('q') ,'delegate_from_out' => request('delegate_from_out'), 'date' => request('date'),'status' => request('status')])}}">
                            <input type="hidden" name="delegate_from_out" value="{{request('delegate_from_out')}}">
                            <input type="hidden" name="status" value="{{request('status')}}">
                            <input type="hidden" name="date" value="{{request('date')}}">
                            <input type="hidden" name="q" value="{{request('q')}}">
                            <input type="date" class="form-control col-md-12" name="date" onchange="this.form.submit()">
                        </form>
                    @endif
                    <div class="all_orders mt-3">
                        @forelse($orders as $order)
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
                                                <p class="mb-2 fw-bold">{{$order->user?->name}}</p>
                                                <p class="mb-0 fw-bold">#{{$order->order_no}}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="mb-2 fw-bold"><i class="fas fa-calendar-day"></i> {{$order->created_at}}</p>
                                            <p class="mb-0 fw-bold status">{{__('main.'.$order->status)}}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                @if($order->status == 'pending' || $order->status == 'another_delegate')
                                    <label >@lang('main.choose delivery type')</label>
                                <form  method="post" action="{{route('vendor.updateOrder',[$order->id,'q' => request('q')])}}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">

                                    <input type="hidden" name="resturant_id" value="{{$order->resturant_id}}">
                                    <input type="hidden" name="" value="{{request('q')}}">
                                    <select class="form-select col-md-12" name="type" onchange="this.form.submit()">
                                        <option value="">@lang('main.choose')</option>
                                        <option value="in_resturant">@lang('main.order-inresturant')</option>
                                        <option value="out_resturant">@lang('main.order-outresturant')</option>
                                    </select>
                                </form>
                                @endif
                                
                                @if($order->status == 'accepted' && $order->delegate_from_out == 'in_resturant')
                                <form  method="post" action="{{route('vendor.updateOrderStatus',[$order->id,'q' => request('q')])}}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <input type="hidden" name="status" value="shipped">
                                    <input type="hidden" name="" value="{{request('q')}}">
                                    <button type="submit" class="btn btn-success">@lang('main.order-shipped')</button>
                                </form>
                                @endif
                                 @if($order->status == 'shipped' && $order->delegate_from_out == 'in_resturant')
                                <form  method="post" action="{{route('vendor.updateOrderStatus',[$order->id,'q' => request('q')])}}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <input type="hidden" name="status" value="completed">
                                    <input type="hidden" name="" value="{{request('q')}}">
                                    <button type="submit" class="btn btn-success">@lang('main.order-completed')</button>
                                </form>
                                @endif
                                
                                <div class="card-body pt-2">
                                    @foreach($order->carts as $val)
                                    {{-- <div class="row  align-items-center item mb-3">
                                        <div class="col-sm-7">
                                            <h6 class="fw-bold">{{$val->resturant_product?->product_name}}</h6>
                                            <p>{{$val->price}} @lang('main.egp') /  @lang('main.per unit') : {{$val->qty}}</p>
                                            <p>{{$val->resturant_product?->product?->category?->name}} / {{$val->resturant_product?->product?->subcategory?->name}} / {{$val->resturant_product?->product?->name}}</p>
                                            @if(! empty($val->product_feature) ) 
                                            <p>@lang('main.product_feature') {{__('main.'.\App\Models\ProductFeature::where('id',$val->product_feature)->first()?->name)}}</p>@endif
                                             @if(! empty($value->product_clean) )
                                            <p>
                                                <span>@lang('main.product_add_on') :</span>
                                                <span>{{ __('main.'.$value->product_clean) }}</span>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="mb-1">{{$val->price}} @lang('main.egp')</p>
                                            <p>@lang('main.subtotal') {{$val->price * $val->qty}} @lang('main.egp')</p>
                                        </div>
                                    </div> --}}
                                    
                                    <div class="cart-product-item row pt-3 pb-3 align-items-center border-bottom base_product0">
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
                                                <h5 class="mt-2">
                                                   {{$val->resturant_product?->product_name}}
                                                </h5>
                                            </div>
                                            <p class="fs-5 pb-2">{{$val->price}} @lang('main.egp')</p>
                                            <div class="product-quantity d-flex flex-wrap gap-3 align-items-center justify-content-between">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <h5>@lang('main.product_feature_val')</h5>
                                                        @if(! empty($val->product_feature) ) 
                                                        <p class="mb-0 qty"> {{__('main.'.\App\Models\ProductFeature::where('id',$val->product_feature)->first()?->name)}}
                                                        </p>
                                                        @endif
                                                         @if(! empty($value->product_clean) )
                                                        <p class="mb-0">
                                                            <span>@lang('main.product_add_on') :</span>
                                                            <span>{{ __('main.'.$value->product_clean) }}</span>
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <p>الكمية</p>
                                                        <p class="qty">{{$val->qty}}</p>
                                                    </div>
                                                </div>
                                                <div class="product-full-price mint fw-bold">
                                                    <h6 class="d-inline-block fw-bold">@lang('main.subtotal')</h6>
                                                    <span class="fs-6 px-1 px-md-1 total_price_0">{{$val->price * $val->qty}} @lang('main.egp')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($order->delegate_from_out)
                                    <p class="border-bottom w-100 m-0 py-3">@lang('main.delegate_from_out'): {{__('main.'.$order->delegate_from_out)}}</p>
                                    @endif
                                    @if($order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null))
                                    <div class="d-flex justify-content-between pt-3">
                                        <p class="m-0">@lang('main.delegate_name'): {{$order->delegate?->name}}</p>
                                        <a href="{{route('users.show',['account_type' => 'delegate',$order->delegate_id])}}" class="d_link">@lang('main.show delegate')</a>
                                    </div>
                                    @endif
                                </div>
                                
                                
                                <div class="">
                                    <a href="{{route('vendor.getSingleOrder', $order->id)}}">@lang('main.order details')</a>
                                </div>
                                
                            </div>
                        @empty
                            <div class="card">
                                <h3>@lang('main.empty data')</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
                {{ $orders->withQueryString()->links() }}
            </div>
        </section>
    </div>
<div class="modal" id="delegateAnotherModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@if(!empty(Session::get('success_code')))
@push('custom-js')
<script>
const audio = new Audio("https://backend.smartvision4p.com/faskhaNinja/public/notification-sound.wav");
      audio.play();
    var translations = @json(trans('main'));

    $('#delegateAnotherModal').css('display','block');
    @if(Session::get('success_code') == 5)
    $('.modal-body').html('<p>' + translations.now_accepted + '</p>');
    @elseif(Session::get('success_code') == 'shipped')
    $('.modal-body').html('<p>' + translations.now_shipped + '</p>');
    @elseif(Session::get('success_code') == 'completed')
    $('.modal-body').html('<p>' + translations.now_competed + '</p>');
    
    @endif

</script>
@endpush
@endif


@endsection
