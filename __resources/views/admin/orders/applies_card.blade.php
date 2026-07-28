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
        /*.all_orders .status{*/
        /*    background: #fff;*/
        /*    border-radius: 28px;*/
        /*    padding: 4px;*/
        /*    font-size: 14px;*/
        /*    color: var(--main);*/
        /*    text-align: center;*/
        /*    width: 100%;*/
        /*}*/
        /*.all_orders .status.schedule{*/
        /*    background: #2a5db2;*/
        /*    color: #fff;*/
        /*}*/
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
        .product-quantity p{
            margin-bottom: 0;
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
        
        .toast-delivery .toast-container {
            position: fixed;
            bottom: 20px;
            inset-inline-end: 13px;
        }
        .toast-delivery .toast {
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
      
        .status {
            width: 100%;
            padding: .5rem 1rem;
            color: #fff !important;
            border-radius: 40px;
        }

        .status.accepted {
            background: #9595ce;
        }

        .status.completed {
            background: #4CAF50;
        }

        .status.pending {
            background: #F0A202;
        }

        .status.cancelled {
            background: #E74C3C;
        }

        .status.declined {
            background: #E74C3C;
        }

        .status.shipped {
            background: #3498DB;
        }

        .status.schedule {
            background: #2ECC71;
        }

        .status.new_order {
            background: #65b6b8;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('main.showAll') @lang('main.orders')  <small class="countModule">({{$orders->count()}}) </small></h1>
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
                    <div class="all_orders"> 
                         
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
                    </div>
                    
                </div>
                {{-- $orders->withQueryString()->links() --}}
            </div>
        </section>
    </div>
    
     <!-- Modal -->
    <div class="modal fade" id="product-details" data-id="{{isset($order) && $order?$order->id:''}}" data-status="{{isset($order) && $order?$order->status:''}}" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" id="div">
       
      </div>
    </div>


<div class="toast-delivery">
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
@lang('main.Your request has not been approved by any representative. Please resubmit.')          <div class="mt-2 pt-2 border-top">
          <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$key}}">@lang('main.choose delivery type')</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="toast">@lang('main.close')</button>
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
                ">@lang('main.Your request has not been approved by any representative. Please resubmit.')   </p>

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
</div>

 
@endsection


@push('custom-js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
       $(document).on('click', '.openModalCart', function () {
          var idproduct = $(this).attr('data-id');
          var modalData = $('#div');
          $(modalData).html('');
          $.ajax({
            url: "{{url('admin/fetch-product')}}",
            type: "GET",
            async: true,
            data: {
              product_id: idproduct,
            },
            dataType: 'json',
            success: function (data) {
              $(modalData).html(data.options);
            }
          });
        });
</script>

@if(request()->has('modal') && request()->modal !=null )
<script>

 
        
        
        
        
    var modalId = "{{request()->modal}}";

    // Alert the modal ID
    // alert(modalId);

    // Show the modal
    if (modalId) {
    $("#product-details").modal('show');
    $('#product-details').attr('data-id',modalId);
          var modalData = $('#div');
          $(modalData).html('');
          $.ajax({
            url: "{{url('admin/fetch-product')}}",
            type: "GET",
            async: true,
            data: {
              product_id: modalId,
            },
            dataType: 'json',
            success: function (data) {
              $(modalData).html(data.options);
            }
          });
    // var status=  $("#"+modalId).attr('data-status');
    // var id=  $("#"+modalId).attr('data-id');
    // if(status=='accepted'){
//         const url ="{{url('admin/download-pdf/?id=')}}"+id+"/type={{auth('admin')->user()->account_type}}"; // Get the href value
// // alert(url);
//             // Open the target page in a new hidden window
//             // const printWindow = window.open(url, '_blank');

//             // Wait for the new window to load before printing
//             printWindow.onload = function () {
//                 // printWindow.print(); // Trigger the print dialog
//                 // printWindow.close(); // Close the new window after printing
//             };
    // }
    
    }
    
    
</script>

@endif
<script>
$(document).on('click',".all_orders .modal .btn-close",function(e){
            e.preventDefault(); // Prevent any default behavior
    e.stopPropagation(); // Stop the event from propagating further

    // Hide the modal
    $(this).closest(".modal").modal('hide');
    })
    function submitAndPrint(id) {
        // const form = document.getElementById('delivey_type');

        const form = $("#delivey_type"+id).closest('form');
        // إرسال الفورم
        form.submit();

        // الانتظار لفترة بسيطة ثم تنفيذ الطباعة
        setTimeout(() => {
            printInvoice(id);
        }, 1000); // انتظر ثانية واحدة (يمكن تعديلها حسب سرعة التحميل)
    }
    function printInvoice(id) {
        // فتح نافذة صغيرة
        let printWindow = window.open(
            "{{url('admin/print-pdf/?id=')}}"+id+"&type=admin", 
            "_blank", 
            "width=800,height=600"
        );
    
        // تنفيذ الطباعة فور التحميل
        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }

    
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



