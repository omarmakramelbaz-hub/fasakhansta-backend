<div class="card">
    <div class="card-header border-0">
       {{-- <button class="link bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#order{{$order->id}}"></button>--}}
        
        <button class="openModalCart link bg-transparent border-0" data-bs-toggle="modal" data-id="{{$order->id}}"
              href="#product-details"
              role="button"></button>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <p class="mb-0 fw-bold fs-4">#{{$order->order_no}}</p>
                <p class="mb-1 fw-bold">{{$order->carts->count()}} @lang('main.item')</p>
                {{--@if(($order->order_type == 'schedule' || $order->order_type == 'another_zone') && $order->schedule_date != null && $order->status == 'pending')
                <div class="d-flex align-items-center gap-2 ">
                        
                        <div class="d-flex align-items-center gap-2 mb-2 px-3 fw-bold status schedule">
                         {{ __('main.schedule')}} 
                          
                        <!--{{__('main.schedule_date')}}-->
                        <!--{{$order->schedule_date}} -->
                        <p class="mb-0"><i class="fas fa-calendar-day"></i> 
                        {{ \Carbon\Carbon::parse($order->schedule_date)->format('d/m/Y') }}
                        </p>
                        <p class="mb-0"><i class="fas fa-clock"></i> 
                            {{ \Carbon\Carbon::parse($order->schedule_date)->format('h:i A') }}
                        </p>
                    </div>
                     </div>
                    @endif--}}
            </div>
            <div>
                <p class="mb-1"><i class="fas fa-calendar-day"></i> 
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                </p>
                <p class="mb-1"><i class="fas fa-clock"></i> 
                    {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                </p>
                
                {{--<p class="mb-0 fw-bold status">
                {{__('main.'.$order->status)}} 
                </p>--}}
            </div>
        </div>
    </div>
</div>
