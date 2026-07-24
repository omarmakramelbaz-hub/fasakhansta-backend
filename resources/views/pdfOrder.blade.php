<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{app(App\Models\GeneralSettings::class)->site_name}}</title> 
    @if (App::getLocale() == 'ar')
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/bootstrap.rtl.min.css">
    @endif
    @if (App::getLocale() == 'en')
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/bootstrap.min.css">
    @endif

    <style>
    
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;700;800;900&display=swap');
    
    * {
       font-family: 'Tajawal', sans-serif;
       margin: 0;
       padding: 0;
       box-sizing: border-box;
       outline: none;
       border: none;
       text-decoration: none;
    }
      body {
        background :#fff !important;
      }
      .table {
        border: 0 !important;
        width: 100%;
      }
      .invoice {
        padding: 2rem 0;
        background :#fff;
      }
      
     
      .invoice .invoice_header{
        display: -webkit-box; /* wkhtmltopdf uses this one */
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: justify; /* wkhtmltopdf uses this one */
        -webkit-justify-content: space-between;
        justify-content: space-between;
        -webkit-align-items: center;
        align-items: center;
        gap: 30px;
      }
      .client_detail{
         width: 80%;
      }
      .invoice_logo img {
        width: 100px;
      }
      .invoice_header .table tr * {
        text-align: start;
        color: #888888 !important;
      }
      .table-responsive {
        padding: 2rem 0;
        margin: 2rem 0;
        border-top: 28px solid #ffd7b6;
        border-bottom: 28px solid #ffd7b6;
      }
      .table thead tr th {
        background: #e9e9e9;
      }
      .table tr th, .table tr td {
        text-align: center;
        padding: 10px;
        border: 0px solid transparent !important;
        padding-inline-end: 25px;
      }
      .table tr td p{
          margin: 0;
      }
      .table tr td:first-child,
      .table tr th:first-child {
        border-radius: 0 8px 8px 0;
      }
      .table tr td:last-child,
      .table tr th:last-child {
        border-radius: 8px 0 0 8px;
        color: #fd7201;
      }
      .table-responsive .table tbody tr:nth-child(even) td {
        background: #f5f5f5;
      }
      .prices{
        width:55%;
        margin: 0 14px;
        border-radius: 10px;
        padding: 14px;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
      }
      .prices tbody tr,
      .invoice_num tbody tr,
      .client_detail tbody tr {
        background: transparent !important;
      }
      .prices tbody tr td {
        text-align: justify;
        color: #fd7201;
        font-weight: bold;
      }
      .prices tbody tr:last-of-type td {
        background-color: #fd7201;
        color: #fff !important;
        font-weight: bold;
      }
      @media (max-width: 600px) {
        .invoice_logo img {
          width: 85px;
        }
      }
      @media print {
            /* Hide the print button during printing */
            .printButton {
                display: none;
            }
            .invoice_logo{
                 display: none;
            }
               @page {
                size: 80mm auto; /* Thermal printer paper size */
                margin: 0; /* No margins for thermal receipt */
            }

            body {
                margin: 0;
                padding: 0;
            }

            .receipt {
                border: none;
                box-shadow: none;
            }
        }
    </style>
  </head>
  <body>
    <main class="invoice">
        
      <div class="container-lg">
        <div class="invoice_header">
            <div class="invoice_logo">
            @if(auth()->user()->roles->pluck("id")->first() == 11)
                <img src="{{public_path().'/storage/'.app(App\Models\GeneralSettings::class)->favicon}}" alt="Logo" />
                
            @else
                @if($invoice->resturant?->getFirstMediaUrl('logo','thumb'))
                <img src="{{$invoice->resturant?->getFirstMediaUrl('logo','thumb')}}"
                    alt="{{$invoice->resturant?->name}}">
                @endif
            @endif
            </div>
          <div class="client_detail">
            <table class="table">
              <tbody>
                <tr>
                  <th>@lang('main.username')</th>
                  @if($invoice->user_id)
                  <td>: {{$invoice->user?->name}} </td>
                  @endif
                  <th>@lang('main.order_no')</th>
                  <td>: #{{$invoice->order_no}}</td>
                </tr>
                <tr>
                  <th>@lang('main.mobile') </th>
                  @if( ($invoice->user_id))
                  <!--<td>: {{$invoice->user?->mobile}} </td>-->
                  <td>: {{$invoice->user_address?->mobile}} </td>
                  @endif
                  <th>@lang('main.date')</th>
                  <td>: {{$invoice->created_at}}</td>
                </tr>
                <tr>
                  <th>@lang('main.address')</th>
                  <td colspan="3">: @lang('main.country_name'): {{$invoice->user_address?->country_name}} , @lang('main.city_name'): {{$invoice->user_address?->city_name}}
                    @lang('main.street_name'): {{$invoice->user_address?->street_name}}, @lang('main.address'): {{$invoice->user_address?->address}}, @lang('main.apartment_no'): {{$invoice->user_address?->apartment_no}}, @lang('main.floor_no'): {{$invoice->user_address?->floor_no}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <div class="container-lg">
          <table class="table">
            <thead>
              <tr>
              <th class="s_br">@lang('main.resturant_name')</th>
              <th>@lang('main.product_name')</th>
              <th>@lang('main.qty')</th>
              <th>@lang('main.product_price')</th>
              <th>@lang('main.total')</th>
              </tr>
            </thead>
            <tbody>
            @foreach($invoice->carts as $key => $value)
              <tr>
                  <td>{{$value->resturant?->name}} </td>
                <td>
                    {{$value->resturant_product?->product_name}} 
                    @if(! empty($value->product_feature) )
                    <p>
                         @lang('main.product_feature_val') : 
                         {{__('main.'.\App\Models\ProductFeature::where('id',$value->product_feature)->first()->name)}}
                    </p>
                    @endif
                    @if(! empty($value->product_clean) )
                    <p>
                        <span>@lang('main.product_add_on') :</span>
                        <span>{{ __('main.'.$value->product_clean) }}</span>
                    </p>
                    @endif
                </td>

                <td>{{$value->qty}}</td>
                <td>{{$value->price}} @lang('main.egp')</td>
                <td>{{$value->price * $value->qty}} @lang('main.egp')</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="container-lg">
        <div class="prices col-sm-5 col-md-6 ms-auto">
          <table role="presentation" class="table" cellspacing="0" cellpadding="0">
        <tbody>
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
                <td> @lang('main.tax')</td>
                <td>{{$invoice->user_tax}} @lang('main.egp')</td>
            </tr>
            <tr class="total br_0">
                <td class="s_br">@lang('main.grand_total') </td>
                <td class="e_br">{{$invoice->grand_total}} @lang('main.egp')</td>
            </tr>
        </tbody>
    </table>
        </div>
      </div>
    </main>

    <!-- jQuery script -->
  </body>
</html>


