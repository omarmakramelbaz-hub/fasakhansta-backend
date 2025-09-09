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
      
     
      .invoice .invoice_header ,.wallet{
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
      .wallet{
        text-align: center;
        font-weight: bold;
        border-radius: 10px;
        width: 49%;
        padding: 14px;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
      }
      .wallet img{
          width: 250px;
          align-self: end;
      }
      .wallet h5{
            font-weight: bolder;
            color: #fd7201;
            font-size: 26px;
      }
      .summary{
        display: -webkit-box; /* wkhtmltopdf uses this one */
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: justify; /* wkhtmltopdf uses this one */
        -webkit-justify-content: space-between;
        justify-content: space-between;
        gap: 2%;
        margin: 0 14px;
      }
      /*.client_detail{*/
      /*   width: 80%;*/
      /*}*/
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
      .table tr * {
        text-align: center;
        padding: 10px;
        border: 0px solid transparent !important;
        padding-inline-end: 25px;
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
          /*width:38%;*/
          margin-right: auto;
      }
      .prices tbody tr,
      .invoice_num tbody tr,
      .client_detail tbody tr {
        background: transparent !important;
      }
      .prices tbody tr td {
        color: #fd7201);
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
    </style>
  </head>
  <body>
    <main class="invoice">
      <div class="container-lg">
        <div class="invoice_header">
          <div class="invoice_logo">
          </div>
          <div class="client_detail">
            <table class="table">
              <tbody>
                <tr>
                  <th>@lang('main.report date')</th>
                  <td>: {{date('d/m/Y')}}</td>
                </tr>
                <tr>
                  <th>@lang('main.delegate')</th>
                  <td>: {{$vendor->name}} </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>  
      <div class="container-lg">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
              <th>#</th>
              <th class="s_br">@lang('main.order_no')</th>
              <th>@lang('main.total')</th>
              <th>@lang('main.app_percentage')</th>
              <th>@lang('main.delegate_percentage')</th>
              </tr>
            </thead>
            <tbody>
            @foreach($orders as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->order_no}} </td>
                <td>{{$value->total}}</td>
                <td>{{$value->app_to_vendor_percentage}} @lang('main.egp')</td>
                <td>{{$value->delegate_percentage}} @lang('main.egp')</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          
        </div>
      </div>
      <div class="container-lg">
        <div class="summary">
            @if($vendor)
            <div class="wallet" style="padding-bottom: 0px">
                <div style="flex-grow: 1;font-size: larger;">
                    <p>@lang('main.balance')</p>
                    <h5>{{$vendor->balance}} @lang('main.egp')</h5>
                </div>
                <img src="https://backend.smartvision4p.com/faskhaNinja/public/site/images/wallet.svg">
            </div>
            @endif
            <!-- class -> prices -->
            <div class="wallet">
                <table role="presentation" class="table" cellspacing="0" cellpadding="0" style="margin:0">
                    <tbody>
                    <tr>
                        <td>@lang('main.orders_num')</td>
                        <td>{{$orders->count()}}</td>
                    </tr>
                    <tr>
                        <td>@lang('main.total')</td>
                        <td>{{$orders->sum('total')}} @lang('main.egp')</td>
                    </tr>
                    
                    <tr>
                        <td>@lang('main.app_percentage')</td>
                        <td>{{$orders->sum('app_to_vendor_percentage')}} @lang('main.egp')</td>
                    </tr>
                    <tr>
                        <td>@lang('main.vendor_percentage')</td>
                        <td>{{$orders->sum('delegate_percentage')}} @lang('main.egp')</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </main>

    <!-- jQuery script -->
  </body>
</html>


