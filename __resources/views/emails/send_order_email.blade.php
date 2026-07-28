<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة الطلب</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *{
            direction: rtl;
            text-align: right;
            font-family: 'Tajawal', sans-serif;
        }
        
        body {
            margin: 0;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
        }
        .header {
            text-align: center;
            overflow: auto;
        }
        /*.header img {*/
        /*    width: 100%;*/
        /*}*/
        /*.header img {*/
        /*    max-width: 50%;*/
        /*    float: right;*/
        /*}*/
        .header .h_logo {
            max-width: 100px;
            margin: 10px 5px;
        }
        
        .clear{
            clear: both;
        }
        .m-1{
            margin: 4px 0;
        }
        .section {
            margin-bottom: 10px;
            padding: 10px 13px;
        }
 
        .footer img {
            width: 100%;
            margin-bottom: -6px;
            height: auto;
        }
        
        table {
        border-collapse: separate;
        width: 100%;
        text-align: right;
        direction: rtl;
      }
      
      table td {
        vertical-align: top;
        padding: 2px 0px;
        color: #000;
        padding-left: .5rem;
      }
      
      .title {
        font-weight: bold;
        color: #ff9d4d;
      }
    </style>
</head>
<body inmaintabuse="1" class="vsc-initialized">
     @php
        $settings = app(App\Models\GeneralSettings::class);
        $logoUrl = asset('storage'.$settings->logo);
        $siteName = $settings->site_name;
    @endphp
    <div class="email-container">
        <!--<div class="header" style="background:url({{url('/')}}/site/images/fatorah-bg.png);background-size: 100% 100%;">-->
        <!--    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h_logo"/>-->
        <!--</div>-->
        <div class="header">
            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h_logo"/>
        </div>
        <div class="clear"></div>
        <div class="section">
            <p class="m-1">
                @if($cart->status == 'pending')
                تم ارسال طلبك من فسخانينجا يا 
                @elseif($cart->status == 'accepted')
                تم تأكيد طلبك ونحن نعمل على تجهيزه يا
                @elseif($cart->status == 'shipped')
                تم ارسال طلبك مع المندوب وهو في الطريق اليك يا
                @elseif($cart->status == 'completed')
                تم تسليم الطلب يا
                @elseif($cart->status == 'declined')
                تم رفض طلبك يا
                @endif 
                
                @if($cart->order_type == 'schedule'  && $cart->status != 'cancelled')
                لقد تمت جدولة طلبك بتاريخ : {{$cart->schedule_date}}
                يا
                @endif
                <b>{{($cart->user)? $cart->user?->name : $cart->user?->mobile}} </b> 
                @if($cart->status  == 'pending')
                لمتجر
                @else
                من متجر
                @endif
                
                <b> {{$cart->resturant?->name}} </b>
                
                @if($cart->status == 'accepted')
                سنقوم بإعلامك بمجرد شحنه إليك
                @endif
            </p>
            <p class="m-1">
                 رقم الهاتف : 
                <b>0{{$cart->user?->mobile}} </b>
            </p>
            <p class="m-1">إليك ملخص الطلب رقم :<b> #{{$cart->order_no}} </b></p>
            <pclass="m-1">بتوقيت <b>  {{$cart->created_at}} </b></p>
            <p>التوصيل إلـي <b> @lang('main.area_name'): {{$cart->user_address?->area_name}},
                @lang('main.street_name'): {{$cart->user_address?->street_name}},
                @if($cart->user_address?->address_name) @lang('main.address'): {{$cart->user_address?->address_name}} @endif, 
                @lang('main.apartment_no'): {{$cart->user_address?->apartment_no}}, 
                @lang('main.floor_no'): {{$cart->user_address?->floor_no}}   </b>
            </p>
        </div>
        <div class="section">
            <div class="title">ملخص الدفع</div>
            <div style="padding: .5rem"></div>
            <table role="presentation" class="" cellspacing="0" cellpadding="0">
                    <tbody>
                    @foreach($cart->carts as $key => $value)
                      <tr>
                        <td>
                            {{$value->resturant_product?->product_name}} 
                            {{$value->qty}} قطع 
                            @if(! empty($value->product_feature) )
                             - حجم الصنف {{__('main.'.\App\Models\ProductFeature::where('id',$value->product_feature)->first()->name)}}
                            @endif
                            @if(! empty($value->product_clean) && ($value->product_clean=='extra_clean' || $value->product_clean=='extra_clear'||  $value->product_clean=='extra_vacuim'))
                             - {{ __('main.'.$value->product_clean) }}
                            @endif
                            {{--<p>
                                <span>
                                </span>
                                <span>
                                    {{__('main.'.\App\Models\ProductFeature::where('id',$value->product_feature)->first()->name)}}
                                </span>
                            </p>
                            <p>
                                <span>الإضافات :</span>
                                <span>
                                    {{ __('main.'.$value->product_clean) }}
                                </span>
                            </p>--}}
                        </td>
        
                        <td>{{$value->price * $value->qty}} @lang('main.egp')</td>
                      </tr>
                    @endforeach
                    
                    <tr>
                        <td colspan="2"> <div style="padding: .5rem"></div> </td>
                    </tr>
                    
                    <tr>
                        <td>التوصيل</td>
                        <td>{{round($cart->delivery_price,2)}} @lang('main.egp')</td>
                    </tr>
                    <tr>
                        <td>@lang('main.service_fees')</td>
                        <td>{{round($cart->service_fees,2)}} @lang('main.egp')</td>
                    </tr>
                    <tr>
                        <td>قيمة الضريبة</td>
                        <td>{{round($cart->user_tax,2)}} @lang('main.egp')</td>
                    </tr>
                    
                     <tr>
                        <td colspan="2"> <div style="padding: .5rem"></div> </td>
                    </tr>
                    
                    <tr>
                        <td class="title">إجمالي الطلب</td>
                        <td>{{round($cart->grand_total,2)}} @lang('main.egp')</td>
                    </tr>
                    <tr>
                        <td>طريقة الدفع</td>
                        <td>{{__('main.'.$cart->payment_type)}} </td>
                    </tr>
                </tbody>
        </table>
        
            {{--
            <div class="order-item">310 كيلو فسيخ نبروه ٣ قطع مخلي</div>
            <div class="order-item">150 كيلو رنجه بطارخ تدخين أشجار ليمون</div>
            <div class="order-item">50 ساندوتش سلطة سردين</div>
            <div class="order-item">رسوم التوصيل: 10</div>
            <div class="order-item">رسوم الخدمة: 20</div>
            <div class="order-item">رسوم القيمة المضافة: 10</div>
            <div class="total">إجمالي الطلب: 550</div>
            <p>طريقة الدفع: فيزا</p>
            --}}
            
        </div>
        <!--<div class="footer">-->
        <!--    <img src="{{url('/')}}/site/images/footer-attch.jpg" alt="footer pattern" class="f_pattern"/>-->
        <!--</div>-->
    </div>

<script src="chrome-extension://onepmapfbjohnegdmfhndpefjkppbjkm/sm.bundle.js" data-pname="supercopy-v3" data-asset-path="https://spc4.s3.ap-east-1.amazonaws.com"></script></body>
</html>