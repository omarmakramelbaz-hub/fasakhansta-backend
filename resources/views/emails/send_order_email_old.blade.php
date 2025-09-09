<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
    <style>
      /* All the styling goes here */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%;
      }
      * {
        box-sizing: border-box;
        text-align: right;
      }
      body {
        background: #f3f3f3 !important;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 20px;
        text-align: right;
        direction: rtl;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      table {
        background: #fff !important;
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        min-width: 100%;
        margin: auto;
        text-align: right;
        direction: rtl;
      }

      table th {
        background-color: #ff9d4d;
        color: #fff;
        padding: 10px;
      }
      table tr .s_br {
        border-radius: 0 5px 5px 0;
      }
      table tr .e_br {
        border-radius: 5px 0 0 5px;
      }
      table td {
        font-family: sans-serif;
        font-size: 14px;
        vertical-align: middle;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        color: #000;
      }
      table td.title {
        font-weight: bold;
        color: #ff9d4d;
      }
      table tr.br_0 td {
        border-color: transparent;
      }

      table.Summary tr.total {
        background: #ff9d4d3b;
      }

      table td * {
        font-size: 14px;
        color: #020202;
      }
      table td {
          color: #000;
      }
      table td span {
          color: #000;
      }
      table h5 {
        /*color: #ff9d4d;*/
        margin: 0 0 6px 0;
      }
      p{
          margin-bottom: 5px;
      }
      table p {
        margin-bottom: 5px;
        color: #000;
      }
      table p:last-child {
        margin-bottom: 0;
      }

      /* Body & Container */
      .body {
        background-color: #fff !important;
        min-width: 100%;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 0 4px #ffffff60;
        clear: both;
      }

      .container {
        display: block;
        margin: 0 auto !important;
        max-width: 580px;
        padding: 10px;
        width: 580px;
      }

      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px;
      }

      /* Header, Footer, Main */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%;
      }

      .wrapper {
        box-sizing: border-box;
        padding: 20px;
      }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%;
      }
      .footer td,
      .footer p,
      .footer span,
      .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
      }
      .footer .body {
        padding: 0rem;
        margin-top: 0.5rem;
      }
      /*.center img , .center h3{*/
      /*    text-align: center*/
      /*}*/
      
      .head h3{
          float: right;
          color: #ff9d4d;
      }
      .h_logo{
         width: 100px; 
         /*margin-left: 8px;*/
         float: left;
         margin: 16px 0;
      }
      .footer img{
          width: 120px;
      }

      /* Typography */
      h1,
      h2,
      h3,
      h4 {
        color: #000;
        font-weight: bold;
        font-family: sans-serif;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px;
      }
      h3 {
        
        color: #000;
        margin: 16px 0;
        padding: 5px 0;
        /*border-bottom: 2px dashed #ff9d4d;*/
      }
      h3.brd-0{
          border: unset;
      }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize;
      }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px;
      }
      p li,
      ul li,
      ol li {
        list-style-position: inside;
        margin-right: 5px;
      }

      a {
        color: #3498db;
        text-decoration: underline;
      }

      /* Buttons */
      .btn {
        box-sizing: border-box;
        width: 100%;
      }
      .btn > tbody > tr > td {
        padding-bottom: 15px;
        color: #000;
      }
      .btn table {
        width: auto;
      }
      .btn table td {
        background-color: #ffffff;
        border-radius: 5px;
        text-align: center;
      }
      .btn a {
        background-color: #ffffff;
        border: solid 1px #3498db;
        border-radius: 5px;
        box-sizing: border-box;
        color: #3498db;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        padding: 12px 25px;
        text-decoration: none;
        text-transform: capitalize;
      }

      .btn-primary table td {
        background-color: #3498db;
      }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff;
      }

      /* Responsive and Mobile Friendly Styles */
      @media only screen and (max-width: 620px) {
        table.body h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important;
        }
        table.body p,
        table.body ul,
        table.body ol,
        table.body td,
        table.body span,
        table.body a {
          font-size: 16px !important;
        }
        table.body .wrapper,
        table.body .article {
          padding: 10px !important;
        }
        table.body .content {
          padding: 0 !important;
        }
        table.body .container {
          padding: 0 !important;
          width: 100% !important;
        }
        table.body .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important;
        }
        table.body .btn table {
          width: 100% !important;
        }
        table.body .btn a {
          width: 100% !important;
        }
        table.body .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important;
        }
      }

      /* Preserve these styles in the head */
      @media all {
        .ExternalClass {
          width: 100%;
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%;
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important;
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
        .btn-primary table td:hover {
          background-color: #34495e !important;
        }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important;
        }
      }
    </style>
  </head>
  <body>
    <!-- <span class="preheader">Your order has been confirmed</span> -->
    @php
        $settings = app(App\Models\GeneralSettings::class);
        $logoUrl = asset('storage'.$settings->logo);
        $siteName = $settings->site_name;
    @endphp
    
    <div class="head">
        <h3>
           طلب رقم
           #{{$cart->order_no}}
        </h3>
        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h_logo"/>
    </div>
    
    <div role="presentation" class="body" cellspacing="0" cellpadding="0">
        <!-- START MAIN CONTENT AREA -->
        <!--<h5 style="margin-bottom: 0">طلب رقم #{{$cart->order_no}}</h5>-->
        
        <p>
            مرحبًا {{($cart->user)? $cart->user?->name : $cart->user?->mobile}} 
        </p>
        
        @if($cart->status == 'pending')
        <p>
        تم ارسال طلبك الى مطعم  [{{$cart->resturant?->name}}] 
        </p>
        <h4> !شكرا لك على الشراء  </h4>
        @elseif($cart->status == 'accepted')
        <p> نحن نعمل على تجهيز طلبك من مطعم [{{$cart->resturant?->name}}]. سنقوم بإعلامك بمجرد شحنه إليك</p>
        @elseif($cart->status == 'shipped')
         <p>  طلبك في الطريق اليك الان</p>
        
         
        @elseif($cart->status == 'completed')
        <p> تم تسليم الطلب </p>
        <h4> !شكرا لك على الشراء  </h4>
        @endif 
        @if($cart->order_type == 'schedule'  && $cart->status != 'cancelled')
        <p> طلبك مجدول بتاريخ : {{$cart->schedule_date}}</p>
        @endif
        
        
        <h3 class="brd-0">@lang('main.status of order') : {{__('main.order-'.$cart->status)}}</h3>
        <table role="presentation" class="" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
              <th>المنتج</th>
              <th>الكمية</th>
              <th class="e_br">السعر</th>
              <!--<th>الاجمالي</th>-->
            </tr>
          </thead>
            <tbody>
            @foreach($cart->carts as $key => $value)
              <tr>
                <td>
                    <h5>
                        {{$value->resturant_product?->product_name}} 
                    </h5>
                    @if(! empty($value->product_feature) )
                    <p>
                        <span>
                            حجم الصنف : 
                        </span>
                        <span>
                         {{__('main.'.\App\Models\ProductFeature::where('id',$value->product_feature)->first()->name)}}
                        </span>
                    </p>
                    @endif
                    @if(! empty($value->product_clean) && ($value->product_clean=='extra_clean' || $value->product_clean=='extra_clear'||  $value->product_clean=='extra_vacuim'))
                    <p>
                        <span>الإضافات :</span>
                        <span>{{ __('main.'.$value->product_clean) }}</span>
                    </p>
                    @endif
                </td>

                <td>{{$value->qty}}</td>
                <td>{{$value->price * $value->qty}} @lang('main.egp')</td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    
    <h3>ملخص الطلب</h3>
    <table role="presentation" class="body" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>المجموع</td>
                <td>{{$cart->total}} @lang('main.egp')</td>
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
            <tr class="total br_0">
                <td class="s_br">الاجمالي </td>
                <td class="e_br">{{round($cart->grand_total,2)}} @lang('main.egp')</td>
            </tr>
        </tbody>
    </table>
    

    @php
        $settings = app(App\Models\GeneralSettings::class);
        $logoUrl = asset('storage'.$settings->logo);
        $siteName = $settings->site_name;
    @endphp
    
    <div class="footer">
        {{--<img src="{{ $logoUrl }}" alt="{{ $siteName }}" />--}}
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td class="content-block powered-by">
              Powered by <a href="{{ url('/') }}">{{$siteName}} Team</a>.
            </td>
          </tr>
        </table>
    </div>

  </body>
</html>
