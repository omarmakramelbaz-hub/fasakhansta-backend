@extends('admin.index')

@section('content')
    <style>
        .all_orders .avatar {
            border: 1px solid #fff;
            border-radius: 50%;
            padding: 0px;
            height: 3rem !important;
            width: 3rem !important;
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
        .all_orders .status.schedule{
            background: #2a5db2;
            color: #fff;
        }
        .all_orders p{
            width: max-content;
            margin: 0px;
        }
        .cart-product-item .img-cart {
            width: 100%;
            border-radius: 18px;
            height: 60px;
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
        /*.cart-product-item:last-child{*/
        /*    border: none !important;*/
        /*}*/
        
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
        .select2-container {
            width: 100% !important;
        }
        
        .toast-container {
            position: fixed;
            bottom: 20px;
            inset-inline-end: 13px;
        }
        .toast {
            background-color: rgba(255, 255, 255, 0.85) !important;
        }
        .card-footer .btn{
            width: 210px;
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
                    
                    <!--<li><a href="{{url('admin/applies-orders?q=accepted')}}">@lang('main.currently orders')</a></li>-->
                    <!--<li><a href="{{url('admin/applies-orders?q=completed')}}">@lang('main.last orders')</a></li>-->
                     <div class="row">
                        @if(request('q') != 'accepted')
                        <div class="col">
                            <form class="d-flex gap-3" method="get" action="{{route('orders.applies',['q' => request('q') , 'order_no' => request('order_no')])}}">
                                <input type="hidden" name="q" value="{{request('q')}}">
                                <input type="text" class="form-control" name="order_no" value="{{request('order_no')}}" placeholder="@lang('main.search by order no')">
                                <button type="submit" class="btn btn-primary">@lang('main.search')</button>
                            </form>
                        </div>
                        @else
                         <div class="col">
                            <form  method="get" action="{{route('orders.applies',['q' => request('q') ,'delegate_from_out' => request('delegate_from_out'), 'date' => request('date'),'status' => request('status')])}}">
                            <input type="text" class="form-control mb-2" name="order_no" onchange="this.form.submit()" value="{{request('order_no')}}" placeholder="@lang('main.search by order no')">

                            <input type="hidden" name="delegate_from_out" value="{{request('delegate_from_out')}}">
                            <input type="hidden" name="status" value="{{request('status')}}">
                            <input type="hidden" name="date" value="{{request('date')}}">
                            <input type="hidden" name="q" value="{{request('q')}}">
                            <select class="form-select col-md-12" name="status" onchange="this.form.submit()">
                                <option value="">@lang('main.choose') @lang('main.status')</option>
                                <option value="accepted" @if(request('status') == 'accepted') selected @endif>@lang('main.order-accepted')</option>
                                <option value="shipped" @if(request('status') == 'shipped') selected @endif>@lang('main.order-shipped')</option>
                                <option value="new_order" @if(request('status') == 'new_order') selected @endif>@lang('main.new_order')</option>
                            </select>
                        </form>
                         </div>
                         <div class="col">
                            <form  method="get" action="{{route('orders.applies',['q' => request('q') ,'delegate_from_out' => request('delegate_from_out'), 'date' => request('date'),'status' => request('status')])}}">
                            <input type="hidden" name="delegate_from_out" value="{{request('delegate_from_out')}}">
                            <input type="hidden" name="status" value="{{request('status')}}">
                            <input type="hidden" name="date" value="{{request('date')}}">
                            <input type="hidden" name="q" value="{{request('q')}}">
                            <select class="form-select col-md-12" name="delegate_from_out" onchange="this.form.submit()">
                                <option value="">@lang('main.choose') @lang('main.delegate_from_out')</option>
                                <option value="in_resturant" @if(request('delegate_from_out') == 'in_resturant') selected @endif>@lang('main.order-inresturant')</option>
                                <option value="out_resturant" @if(request('delegate_from_out') == 'out_resturant') selected @endif>@lang('main.order-outresturant')</option>
                            </select>
                        </form>
                         </div>
                         <div class="col">
                            <form  method="get" action="{{route('orders.applies',['q' => request('q') ,'delegate_from_out' => request('delegate_from_out'), 'date' => request('date'),'status' => request('status')])}}">
                            <input type="hidden" name="delegate_from_out" value="{{request('delegate_from_out')}}">
                            <input type="hidden" name="status" value="{{request('status')}}">
                            <!--<input type="hidden" name="date" value="{{request('date')}}">-->
                            <input type="hidden" name="q" value="{{request('q')}}">
                            <input type="date" class="form-control col-md-12" placeholder="@lang('main.searchByDate')" value="{{old('date',request('date'))}}" name="date" onchange="this.form.submit()">
                        </form>
                         </div>
                        @endif
                     </div>
                        
                        
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
                                                <div class="d-flex align-items-center gap-2 ">
                                                    <p class="mb-1 fw-bold">{{$order->user?->name}}</p>
                                                        @if(($order->order_type == 'schedule' || $order->order_type == 'another_zone') && $order->schedule_date != null && $order->status == 'pending')
                                                <div class="d-flex align-items-center gap-2 mb-2 px-3 fw-bold status schedule">
                                             {{ __('main.schedule')}} 
                                             بتاريخ 
                                            <!--{{__('main.schedule_date')}}-->
                                            <!--{{$order->schedule_date}} -->
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="mb-0"><i class="fas fa-calendar-day"></i> 
                                                {{ \Carbon\Carbon::parse($order->schedule_date)->format('d/m/Y') }}
                                            </p>
                                            <p class="mb-0"><i class="fas fa-clock"></i> 
                                                {{ \Carbon\Carbon::parse($order->schedule_date)->format('h:i A') }}
                                            </p>
                                            </div>
                                            
                                            </div>
                                            @endif
                                                    
                                                </div>
                                                <p class="mb-0 fw-bold">#{{$order->order_no}}</p>
                                                <!--<p class="mb-0 fw-bold">@lang('main.created_at'):{{$order->created_at->format('Y-m-d')}}</p>-->
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="mb-1"><i class="fas fa-calendar-day"></i> 
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                            </p>
                                            <p class="mb-1"><i class="fas fa-clock"></i> 
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}
                                            </p>
                                            </div>
                                            <!--<p class="mb-2 fw-bold"><i class="fas fa-calendar-day"></i> -->
                                            <!--{{$order->created_at}}</p>-->
                                            <p class="mb-0 fw-bold status">
                                            {{__('main.'.$order->status)}} 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body pt-2 pb-0">
                                    
                                    
                                    @foreach($order->carts as $val)
                                    <div class="cart-product-item  border-bottom base_product0">
                            <div class="row gy-2 position-relative pt-2 pb-2 align-items-center">
                                <div class="col-md-1 col-12">
                                    @if ($val->resturant_product?->getFirstMediaUrl('product_image','thumb'))
                                    <img class="img-cart mb-md-0 mb-3" src="{{ $val->resturant_product?->getFirstMediaUrl('product_image','thumb') }}">
                                    @else
                                    <img class="img-cart mb-md-0 mb-3" src="{{$val->resturant?->getFirstMediaUrl('logo','thumb')}}" style="object-fit:contain; width:100%">
                                    @endif
                                </div>
                                <div class="col-md-11 col-12">
                                    <div class="cart-product-name">
                                        <!--<p>{{$val->resturant_product?->product?->category?->name}} / {{$val->resturant_product?->product?->subcategory?->name}} / {{$val->resturant_product?->product?->name}}</p>-->
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
                                @if($val->updated_total)
                                <div class="col-12">
                                    <p class="note m-0">
                                     تم تعديل السعر من {{$val->price}} @lang('main.egp') الى {{$val->updated_total}} @lang('main.egp') 
                                     والسبب 
                                     {{$val->reason_update_total}}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                                    @endforeach
                                    @if($order->delegate_from_out)
                                    <p class="border-bottom w-100 m-0 py-3">@lang('main.delegate_from_out'): {{__('main.'.$order->delegate_from_out)}}</p>
                                    @endif
                                    @if($order->delegate_from_out == 'out_resturant' && ($order->delegate_id != null))
                                    <div class="d-flex border-bottom justify-content-between py-3">
                                        <p class="m-0">@lang('main.delegate_name'): {{$order->delegate?->name}}</p>
                                    </div>
                                    @endif
                                    
                                </div>
                                @php
    $scheduleDate = \Carbon\Carbon::parse($order->schedule_date);
@endphp
                                <div class="card-footer" data-ord-id="{{$order->id}}">
                                    @if($order->schedule_date != null &&  $scheduleDate->toDateString() > now()->toDateString())
                                         <button class="btn btn-secondary rounded-pill" disabled>@lang('main.schedule') </button>
                                    @elseif($order->delegate_from_out == null && $order->status == 'pending' &&$order->schedule_date != null &&  $scheduleDate->toDateString() < now()->toDateString())
                                         <button class="btn btn-secondary rounded-pill" disabled>@lang('main.archived') </button>
                                    @else
                                        @if($order->delegate_from_out == 'out_resturant' && ($order->status == 'pending' || $order->status == 'another_delegate'))
                                        <div class="wait">
                                            
                                        <button class="btn btn-secondary rounded-pill" disabled>@lang('main.search for delegate') .... </button>
                                        </div>
                                        @elseif($order->status == 'pending' || $order->status == 'another_delegate')
                                        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$order->id}}">@lang('main.choose delivery type')</button>
                                        @endif
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">#{{$order->order_no}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body p-5">
                                                <form  method="post" action="{{route('vendor.updateOrder',[$order->id,'q' => request('q')])}}">
                                                    @csrf
                                                    @if($order->delegate_from_out!=null)
                                                     <p class="w-100 fs-6 fw-bold mb-4 px-3" style="
                                                        border-inline-start: 6px solid var(--min-color);
                                                        background: #FFF0E4;
                                                        padding-block: 12px;
                                                    ">لم يتم الموافقة على طلبك من قبل اي مندوب برجاء اعادة اختيار طريقة التوصيل </p>
                                                      @endif
                                                    <label class="mb-2">@lang('main.choose delivery type')</label>
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                
                                                    <input type="hidden" name="resturant_id" value="{{$order->resturant_id}}">
                                                    <input type="hidden" name="" value="{{request('q')}}">
                                                    <select class="form-select" name="type" onchange="this.form.submit()">
                                                        <option value="">@lang('main.choose')</option>
                                                        <option value="in_resturant">@lang('main.order-inresturant')</option>
                                                        <option value="out_resturant">@lang('main.order-outresturant')</option>
                                                    </select>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        @if($order->status == 'accepted' && $order->delegate_from_out == 'in_resturant')
                                        <form  method="post" action="{{route('vendor.updateOrderStatus',[$order->id,'q' => request('q')])}}">
                                            @csrf
                                            
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <input type="hidden" name="status" value="shipped">
                                            <input type="hidden" name="" value="{{request('q')}}">
                                            <button type="submit" class="btn btn-success">@lang('main.order-shipped')</button>
                                        </form>
                                        @endif
                                        @if(($order->status == 'shipped' && $order->delegate_from_out == 'in_resturant')|| $order->status=='new_order')
                                        <form  method="post" action="{{route('vendor.updateOrderStatus',[$order->id,'q' => request('q')])}}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <input type="hidden" name="status" value="completed">
                                            <input type="hidden" name="" value="{{request('q')}}">
                                            <button type="submit" class="btn btn-success">@lang('main.order-completed')</button>
                                        </form>
                                        @endif
                                        
                                        @if( $order->delegate_from_out == 'out_resturant')
                                            <!--<button class="btn btn-secondary rounded-pill" disabled>@lang('main.order-'.$order->status)</button>-->
                                        @endif
                                    @endif
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
{{--<div class="modal" id="delegateAnotherModal" tabindex="-1">
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
</div>--}}
<div class="toast-container position-fixed">

    @foreach($orders->where('delegate_from_out','out_resturant')->whereIn('status',['pending','another_delegate']) as $key=> $val)
    <div class="toast" data-id="{{$val->id}}" @if(Session::has('details')) @if(array_key_exists($key , Session::get('details'))) data-order-time="{{Session::get('details')[$key]['time']}}"  @endif @else  data-order-time="{{now()->timestamp * 1000}}"  @endif data-status="{{$val->status}}" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <!--<img src="..." class="rounded me-2" alt="vendor logo">-->
          <strong class="me-auto">#{{$val->order_no}}</strong>
          <small class="text-body-secondary">{{$val->created_at}}</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            لم يتم قبول طلبك من قبل اي مندوب برجاء اعادة اختيار طريقة التوصيل
          <div class="mt-2 pt-2 border-top">
          <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$key}}">@lang('main.choose delivery type')</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="toast">اغلاق</button>
        </div>
        
        </div>
    </div>
    <div class="modal fade" id="exampleModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">#{{$val->order_no}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-5">
            <form  method="post" action="{{route('vendor.updateOrder',[$val->id,'q' => request('q')])}}">
                @csrf
                <p class="w-100 fs-6 fw-bold mb-4 px-3" style="
                    border-inline-start: 6px solid var(--min-color);
                    background: #FFF0E4;
                    padding-block: 12px;
                ">لم يتم الموافقة على طلبك من قبل اي مندوب برجاء اعادة اختيار طريقة التوصيل </p>

                <label class="mb-2">@lang('main.choose delivery type')</label>
                <input type="hidden" name="order_id" value="{{$val->id}}">

                <input type="hidden" name="resturant_id" value="{{$val->resturant_id}}">
                <input type="hidden" name="" value="{{request('q')}}">
                <select class="form-select" name="type" onchange="this.form.submit()">
                    <option value="">@lang('main.choose')</option>
                    <option value="in_resturant">@lang('main.order-inresturant')</option>
                    <option value="out_resturant">@lang('main.order-outresturant')</option>
                </select>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  
   <div class="toast toast-orders" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <!--<img src="..." class="rounded me-2" alt="vendor logo">-->
      <strong class="me-auto">حالة الطلب</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      See? Just like this.
    </div>
  </div>
</div>

 
@endsection


@push('custom-js')
<script>
function checkToasts() {
    var threeMinutes = 3 * 60 * 1000;
    $('.toast').each(function() {
        var orderId = $(this).data('id'); 
        var orderTime = $(this).data('order-time'); 
        var orderStatus = $(this).data('status');
        var currentTime = new Date().getTime();
        console.log( parseFloat((currentTime - orderTime) / 30 / 1000 .toFixed(2)))
        if (currentTime - orderTime >= threeMinutes) {
            $('.card-footer[data-ord-id="'+orderId+'"] div.wait').html(`
                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal${orderId}">@lang('main.choose delivery type')</button>
                                   
            `)
            if (orderStatus === 'pending' || orderStatus === 'another_delegate') {
                // $(this).addClass('show');
                // const audio = new Audio("https://backend.smartvision4p.com/faskhaNinja/public/notification-sound.wav");
                // audio.play();
                
                if (!$(this).hasClass('show')) {
                    // إضافة الفئة 'show'
                    $(this).addClass('show');
                    const audio = new Audio("https://backend.smartvision4p.com/faskhaNinja/public/sounds/mixkit-correct-answer-reward-952.wav");
                    audio.play();
                }

            }
        }
    }); // Added closing parenthesis here
    
}
checkToasts()
setInterval(checkToasts, 15000);
 </script>
@endpush 
    
@if(!empty(Session::get('success_code')))
@push('custom-js')
<script>



const audio = new Audio("https://backend.smartvision4p.com/faskhaNinja/public/notification-sound.mp3");
      audio.play();
    var translations = @json(trans('main'));
    
 $('.toast-orders').addClass('show');
 @if(Session::get('success_code') == 5)
    $('.toast-orders .toast-body').html('<p>' + translations.now_accepted + '</p>');
    @elseif(Session::get('success_code') == 'shipped')
    $('.toast-orders .toast-body').html('<p>' + translations.now_shipped + '</p>');
    @elseif(Session::get('success_code') == 'completed')
    $('.toast-orders .toast-body').html('<p>' + translations.now_competed + '</p>'); 
   @endif
setTimeout($('.toast-orders').hide(), 5000)
</script>
@endpush
@endif


