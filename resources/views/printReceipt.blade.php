<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{app(App\Models\GeneralSettings::class)->site_name}}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap'); * {
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }

        body {
            background-color: #f4f4f4;
            padding: 20px;
        }

        /* Receipt Container */
        .invoice {
            width: 80mm;
            /* Matches receipt printer width */
            margin: 0 auto;
            padding: 10px;
            background: #fff;
            border: 1px dashed #000;
            font-size: 12px;
            line-height: 1.6;
            /* Center all text */
            text-align: right;
        }

        .invoice_header {
            text-align: center;
            margin-bottom: 10px;
        }

        .invoice_logo img {
            max-width: 70px;
            margin: 0 auto;
        }

        .client_detail, .prices {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            /* Center text in all cells */
            padding: 4px 5px;
            vertical-align: baseline;
            /*border-bottom: 1px dashed #2d2d2d;*/
            text-align: justify;
            width: max-content;
            text-align: right !important;
        }
        .order-data th,
        .order-data td{
            border-bottom: 1px dashed #2d2d2d;
        }
        .order-data th{
            border-top: 1px dashed #2d2d2d;
        }
        th {
            font-weight: bold;
            min-width: 85px;
        }

        /* Footer for "Thank you" */
        .thank-you {
            text-align: center;
            margin: 10px 0;
            font-size: 12px;
            font-weight: bold;
        }

        /* Print Styles */
        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }

            /*body {*/
            /*    margin: 0;*/
            /*    padding: 0;*/
            /*    background: none;*/
            /*}*/

            .invoice {
                border: none;
                width: 80mm;
                margin: 0;
            }

            /*body * {*/
            /*    visibility: hidden;*/
            /*}*/

            /*.invoice, .invoice * {*/
            /*    visibility: visible;*/
            /*}*/

            /*.invoice {*/
            /*    margin: 0 auto;*/
            /*}*/

            /*.invoice_header, .client_detail, .prices, .thank-you {*/
            /*    font-size: 10px;*/
            /*}*/

            /*th, td {*/
            /*    font-size: 10px;*/
            /*    padding: 3px;*/
            /*}*/
        }
    </style>

  </head>
  <body onload="window.print()">
    <main class="invoice" id="receipt">
      <div class="invoice_header">
        <div class="invoice_logo">
          @if(auth()->user()->roles->pluck('id')->first() == 11)
          <img src="{{ public_path().'/storage/'.app(App\Models\GeneralSettings::class)->favicon }}" alt="Logo" />
          @else
          @if($invoice->resturant?->getFirstMediaUrl('logo','thumb'))
          <img src="{{$invoice->resturant?->getFirstMediaUrl('logo','thumb')}}" alt="{{$invoice->resturant?->name}}" />
          @endif
          @endif
        </div>
        <h3>{{ $invoice->resturant?->name }}</h3>
      </div>

      <div class="client_detail">
        <table>
          <tr>
            <th>@lang('main.username')</th>
            <td>{{$invoice->user?->name}}</td>
          </tr>
          <tr>
            <th>@lang('main.mobile')</th>
            <td>0{{$invoice->user?->mobile}}</td>
          </tr>
          <tr>
            <th>@lang('main.Delivery location')</th>
            <td>{{$invoice->user_address?->area_name}},
                                @lang('main.street_name'): {{$invoice->user_address?->street_name}},
                                @if($invoice->user_address?->address_name) @lang('main.address'): {{$invoice->user_address?->address_name}} @endif, 
                                @lang('main.apartment_no'): {{$invoice->user_address?->apartment_no}}, 
                                @lang('main.floor_no'): {{$invoice->user_address?->floor_no}}</td>
          </tr>
          <tr>
            <th>@lang('main.order_no')</th>
            <td>#{{$invoice->order_no}}</td>
          </tr>
          <tr>
            <th>@lang('main.payment_type')</th>
            <td>{{__('main.'.$invoice->payment_type)}}</td>
          </tr>
          <tr>
            <th>@lang('main.date')</th>
            <td>{{$invoice->created_at}}</td>
          </tr>
        </table>
      </div>

      <div class="table-responsive">
        <table class="order-data">
          <thead>
            <tr>
              <th>@lang('main.product_name')</th>
              <th>@lang('main.qty')</th>
              <th>@lang('main.total')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoice->carts as $value)
            <tr>
              <td>{{$value->resturant_product?->product_name}}</td>
              <td>
                    {{$value->resturant_product?->product_name}} 
                    {{$value->qty}} قطع 
                    @if(! empty($value->product_feature) )
                     - حجم الصنف {{__('main.'.\App\Models\ProductFeature::where('id',$value->product_feature)->first()->name)}}
                    @endif
                    @if(! empty($value->product_clean) && ($value->product_clean=='extra_clean' || $value->product_clean=='extra_clear'||  $value->product_clean=='extra_vacuim'))
                     - {{ __('main.'.$value->product_clean) }}
                    @endif
                </td>
                <td>{{$value->price * $value->qty}} @lang('main.egp')</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="prices">
        <table>
          <tr>
            <td>@lang('main.total')</td>
            <td>{{$invoice->total}} @lang('main.egp')</td>
          </tr>
          <tr>
            <td>@lang('main.deliver_price')</td>
            <td>{{$invoice->delivery_price}} @lang('main.egp')</td>
          </tr>
          <tr>
            <td>@lang('main.service_fees')</td>
            <td>{{$invoice->service_fees}} @lang('main.egp')</td>
          </tr>
          <tr>
            <td>@lang('main.tax')</td>
            <td>{{$invoice->user_tax}} @lang('main.egp')</td>
          </tr>
          <tr>
            <th>@lang('main.grand_total')</th>
            <th>{{$invoice->grand_total}} @lang('main.egp')</th>
          </tr>
        </table>
      </div>

      {{--
          <div class="thank-you">
            <p>@lang('main.thank_you')</p>
          </div>
      --}}
    </main>
  </body>
</html>
