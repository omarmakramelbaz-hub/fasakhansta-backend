 <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-4 fw-bold" id="orderModalLabel">
                #{{$product->order_no}}
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
          </div>
            <div class="modal-body p-3">
                <div class="card shadow-none mb-0">
                    <div class="card-body pt-2 pb-0">
                        @if($product->status != 'pending')
                        <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2 pb-3">
                            <p class="mb-0">
                                <!--@lang('main.order') #{{$product->order_no}} -->
                                @if(($product->order_type == 'schedule' || $product->order_type == 'another_zone') && $product->schedule_date != null && $product->status == 'pending')
                                 <div class="d-flex align-items-center gap-2 px-3 status schedule"> 
                                    @lang('main.order-schedule') @lang('main.on date') 
                                    <div class="d-flex align-items-center gap-2">
                                        <p class="mb-0"><i class="fas fa-calendar-day"></i> 
                                            {{ \Carbon\Carbon::parse($product->schedule_date)->format('d/m/Y') }}
                                        </p>
                                        <p class="mb-0"><i class="fas fa-clock"></i> 
                                            {{ \Carbon\Carbon::parse($product->schedule_date)->format('h:i A') }}
                                        </p>
                                    </div>
                                 </div> 
                                @else
                                    <span class="status {{$product->status}}">
                                        {{__('main.order-'.$product->status)}}
                                    </span>
                                @endif
                            </p> 
                        </div>
                        @endif
                        <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2">
                            <i class="fs-3 fas fa-user" style="color: #a6a6a6;width: 48px;text-align: center;"></i>
                            <div class="">
                                <p>@lang('main.username') </p>
                                
                                
                                <span>@php use App\Scopes\AdminScope; $user = \App\Models\User::withoutGlobalScope(AdminScope::class)->where('id',$product->user_id)->first(); 
                            
                                @endphp
                                    {{$user->name}}        
                                </span>
                            </div>
                        </div>
                        @if($product->status != 'completed' && $product->status != 'cancelled')
                         <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2">
                            <i class="fs-3 fas fa-biking" style="color: #a6a6a6;width: 48px;text-align: center;"></i>
                            <div class="">
                                <p>@lang('main.mobile') </p>
                                <a href="tel:{{ $product->user_address?->mobile }}" class="icon">
                                            <span>{{ $product->user_address?->mobile }}</span>
                                        </a>
                            </div>
                                        
                        </div>
                        @endif
                         <div class="d-flex gap-2 align-items-center border-bottom m-0 py-2">
                                @if($product->user_address)
                                <i class="fs-3 fa-solid fa-location-dot" style="color: #a6a6a6;width: 48px;text-align: center;"></i>
                                <div class="">
                                    <p>@lang('main.Delivery location') </p>
                                    <span>@lang('main.area_name') : {{ $product->user_address?->area_name }},</span>
                                    <span>@lang('main.street_name') : {{ $product->user_address?->street_name }},</span>
                                    <span>@lang('main.floor_no') : {{ $product->user_address?->floor_no }}</span>
                                </div>
                                @else
                                    <h5>@lang('main.no user address yet')</h5>
                                @endif
                            </div>
                            @if($product->notes)
                                 <div class="d-flex gap-2 align-items-center border-bottom m-0 py-3">
                                    <i class="fs-2 fa-solid fa-circle-info" style="color: #a6a6a6;"></i>
                                    <div class="">
                                        <p>@lang('main.notes') </p>
                                        <span> {{ $product->notes }}</span>
                                    </div>
                                </div>
                          @endif
                            @if($product->delegate_from_out)
                            <p class="border-bottom w-100 m-0 py-3">@lang('main.delegate_from_out'): {{__('main.'.$product->delegate_from_out)}}</p>
                            @endif
                            @if($product->delegate_from_out == 'out_resturant' && ($product->delegate_id != null) && !($product->status =='completed' && $product->updated_at < \Carbon\Carbon::now()->subHours(6)))
                            <div class="d-flex align-items-center justify-content-between border-bottom m-0 py-2">
                                <p class="m-0">@lang('main.delegate_name'): {{$product->delegate?->name}}</p>
                                <div class="d-flex align-items-center justify-content-end mb-1 gap-1">
                                        <a href="{{url('/admin/chat/?user_id='.$product->delegate_id)}}" class="icon">
                                             <i class="far fa-comment-dots"></i>
                                        </a>
                                        <a href="tel:{{ $product->delegate?->mobile }}" class="icon"><i class="fas fa-phone"></i></a>
                                    </div>
                                <!--<a href="{{route('users.show',['account_type' => 'delegate',$product->delegate_id])}}" class="d_link">@lang('main.show delegate')</a>-->
                            </div>
                            @endif
                        @foreach($product->carts as $val)
                        <div class="cart-product-item  border-bottom base_product0">
                            <div class="row gy-2 position-relative pt-2 pb-2 align-items-center">
                                <div class="col-md-2 col-12">
                                    @if ($val->resturant_product?->getFirstMediaUrl('product_image','thumb'))
                                    <img class="img-cart mb-md-0 mb-3" src="{{ $val->resturant_product?->getFirstMediaUrl('product_image','thumb') }}">
                                    @else
                                    <img class="img-cart mb-md-0 mb-3" src="{{$val->resturant?->getFirstMediaUrl('logo','thumb')}}" style="object-fit:contain; width:100%">
                                    @endif
                                </div>
                                <div class="col-md-10 col-12">
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
                                                <p>@lang('main.qty')</p>
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
                                        @lang('main.The price has been modified from')
                                         {{$val->price*$val->qty}} @lang('main.egp') 
                                         @lang('main.to')
                                         {{$val->updated_total}} @lang('main.egp') 
                                         @lang('main.and the reason is') 
                                         {{$val->reason_update_total}}
                                       </p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            @php
                $scheduleDate = \Carbon\Carbon::parse($product->schedule_date);
            @endphp
            <div class="card-footer p-0 w-100" data-ord-id="{{$product->id}}">
                @if($product->schedule_date != null &&  $scheduleDate->toDateString() > now()->toDateString())
                     <button class="btn btn-secondary rounded-pill" disabled>@lang('main.schedule') </button>
                     @if($product->accepted_notify=='no' && $product->status=='pending')
                       <form  method="post" action="{{route('vendor.updateOrderStatus',[$product->id,'q' => request('q')])}}">
                        @csrf
                        
                        <input type="hidden" name="order_id" value="{{$product->id}}">
                        <input type="hidden" name="status" value="declined">
                        <input type="hidden" name="" value="{{request('q')}}">
                        <button type="submit" class="btn btn-outline-danger rounded-pill">@lang('main.order-declined')</button>
                      </form>
                      @endif
                      @if($product->accepted_notify=='no' && $product->status=='pending')
                       <form  method="post" action="{{route('vendor.acceptOrder',[$product->id,'q' => request('q')])}}">
                        @csrf
                        
                        <input type="hidden" name="order_id" value="{{$product->id}}">
                        <input type="hidden" name="" value="{{request('q')}}">
                        <button type="submit" class="btn btn-outline-primary rounded-pill">@lang('main.accept order')</button>
                      </form>
                      @endif
                @elseif($product->delegate_from_out == null && $product->status == 'pending' &&$product->schedule_date != null &&  $scheduleDate->toDateString() < now()->toDateString())
                     <button class="btn btn-secondary rounded-pill" disabled>@lang('main.archived') </button>
                @else
                    @if($product->delegate_from_out == 'out_resturant' && ($product->status == 'pending' || $product->status == 'another_delegate'))
                    <div class="wait d-flex gap-2">
                        
                    <button class="btn btn-secondary rounded-pill" disabled>@lang('main.search for delegate') .... </button>
                      <form  method="post" action="{{route('vendor.updateOrder',[$product->id,'q' => request('q')])}}">
                                @csrf
                             
                                
                                <input type="hidden" name="order_id" value="{{$product->id}}">
                
                                <input type="hidden" name="resturant_id" value="{{$product->resturant_id}}">
                                <input type="hidden" name="" value="{{request('q')}}">
                                <input type="hidden" name="type" value="in_resturant">
                           
                                <button type="submit" class="btn btn-success rounded-pill" >@lang('main.order-inresturant') </button>
                            </form>
                    </div>
                    
                    
                    
                    @elseif($product->status == 'pending' || $product->status == 'another_delegate')
                    <!-- old choose delivery modal-->
                    {{--<button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$product->id}}">@lang('main.choose delivery type')</button>--}}
                    <!-- end -->
                    <div class=" d-flex gap-2">
                        <form class="btn btn-success delivey_typee" id="delivey_type{{$product->id}}"  method="post" action="{{route('vendor.updateOrder',[$product->id,'q' => request('q')])}}">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$product->id}}">
                
                            <input type="hidden" name="resturant_id" value="{{$product->resturant_id}}">
                            <input type="hidden" name="" value="{{request('q')}}">
                            <select class="p-0 bg-transparent border-0 shadow-none" name="type" onchange="submitAndPrint({{$product->id}})">
                                <option value="" hidden>@lang('main.choose delivery type')</option>
                                <option value="in_resturant">@lang('main.order-inresturant')</option>
                                <option value="out_resturant">@lang('main.order-outresturant')</option>
                            </select>
                        </form>
                    
                        <form  method="post" action="{{route('vendor.updateOrderStatus',[$product->id,'q' => request('q')])}}">
                        @csrf
                        
                        <input type="hidden" name="order_id" value="{{$product->id}}">
                        <input type="hidden" name="status" value="declined">
                        <input type="hidden" name="" value="{{request('q')}}">
                        <button type="submit" class="btn btn-outline-danger rounded-pill">@lang('main.order-declined')</button>
                      </form>
                    </div>
                    @endif
                 
                    
                    @if($product->status == 'accepted' && $product->delegate_from_out == 'in_resturant')
                    <form  method="post" action="{{route('vendor.updateOrderStatus',[$product->id,'q' => request('q')])}}">
                        @csrf
                        
                        <input type="hidden" name="order_id" value="{{$product->id}}">
                        <input type="hidden" name="status" value="shipped">
                        <input type="hidden" name="" value="{{request('q')}}">
                        <button type="submit" class="btn btn-success">@lang('main.order-shipped')</button>
                    </form>
                    @endif
                    @if(($product->status == 'shipped' && $product->delegate_from_out == 'in_resturant')|| $product->status=='new_order')
                    <form  method="post" action="{{route('vendor.updateOrderStatus',[$product->id,'q' => request('q')])}}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{$product->id}}">
                        <input type="hidden" name="status" value="completed">
                        <input type="hidden" name="" value="{{request('q')}}">
                        <button type="submit" class="btn btn-success">@lang('main.order-completed')</button>
                    </form>
                    @endif
                    
                    @if( $product->delegate_from_out == 'out_resturant')
                        <!--<button class="btn btn-secondary rounded-pill" disabled>@lang('main.order-'.$product->status)</button>-->
                    @endif
                @endif
                   @if($product->status=='accepted')
                    <a onclick="submitAndPrint({{$product->id}})"  class="btn btn-primary"><i class="fa fa-print"></i>@lang('main.print fatoorah')</a>

                    @endif
                <a href="{{route('vendor.getSingleOrder', $product->id)}}">@lang('main.order details')</a>
            </div>
        </div>
        </div>