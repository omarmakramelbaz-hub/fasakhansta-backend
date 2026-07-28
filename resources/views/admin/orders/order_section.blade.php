@if($orders->count()>0)
                        <div class="row">
                                <div class="col-lg-4 col-md-4  col-sm-12">
                                    <div class="card h-100 py-3 pending">
                                        <h2 class="fs-6 fw-bold px-3 py-2">
                                            <a href="{{url('admin/applies-orders?q=pending')}}">
                                             @lang('main.pending orders')
                                            </a>
                                        </h2>
                                        <div class="card-status px-3" id="new_orders">
                                            @foreach($orders->whereIn('status',['pending','another_delegate']) as $order)
                                                @include('admin.orders.order_card',['order'=>$order])
                                            @endforeach  
                                            @if($orders->whereIn('status',['pending','another_delegate'])->count() == 20)
                                                <button href="{{url('admin/applies-orders?q=pending')}}" class="btn btn-primary">@lang('main.show more')</button>
                                            @endif
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-lg-4 col-md-4  col-sm-12">
                                    <div class="card h-100 py-3 accepted">
                                        <h2 class="fs-6 fw-bold px-3 py-2">
                                            <a href="{{url('admin/applies-orders?q=accepted')}}">
                                              @lang('main.currently orders')
                                            </a>
                                        </h2>
                                        <div class="card-status px-3">
                                            @foreach($orders->whereIn('status',['accepted','shipped','new_order']) as $order)
                                                @include('admin.orders.order_card',['order'=>$order])
                                            @endforeach  
                                            @if($orders->whereIn('status',['accepted','shipped','new_order'])->count() == 20)
                                                <button href="{{url('admin/applies-orders?q=accepted')}}" class="btn btn-primary">@lang('main.show more')</button>
                                            @endif
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-lg-4 col-md-4  col-sm-12">
                                    <div class="card h-100 py-3 completed">
                                        <h2 class="fs-6 fw-bold px-3 py-2">
                                            <a href="{{url('admin/applies-orders?q=completed')}}">
                                             @lang('main.last orders')
                                            </a>
                                        </h2>
                                        <div class="card-status px-3">
                                           @foreach ($orders->filter(fn($order) => 
                                                in_array($order->status, ['completed', 'cancelled', 'declined']) || is_null($order->status)
                                            ) as $order)
                                                @include('admin.orders.order_card', ['order' => $order])
                                            @endforeach
                                            @if($orders->filter(fn($order) => 
                                                in_array($order->status, ['completed', 'cancelled', 'declined']) || is_null($order->status)
                                            )->count() == 20)
                                                <button href="{{url('admin/applies-orders?q=completed')}}" class="btn btn-primary">@lang('main.show more')</button>
                                            @endif
                                            </div>
                                    </div>
                                 </div>
                                <style>
                                    .card-status{
                                        max-height: 66vh;
                                        overflow-y: auto;
                                    }
                                    .pending .card-header{
                                        background: var(--main-light) !important;
                                    }
                                    .accepted .card-header{
                                        background: #ffb172 !important;
                                    }
                                    .completed .card-header{
                                        background: #fffaf7 !important;
                                        color: var(--main-light) !important;
                                    }
                                </style>     
                            </div>
                            
                            
                        @else
                            <div class="card">
                                <h3>@lang('main.empty data')</h3>
                            </div>
                        @endif