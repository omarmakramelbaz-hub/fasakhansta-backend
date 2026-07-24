<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>{{__('main.fatoorah')}} - PDF</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&display=swap" rel="stylesheet">
     <style type="text/css">
        body {
            font-family: 'Almarai', sans-serif;
            text-transform: capitalize;
        }
        
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }
        
        .table > tbody > tr > .no-line {
            border-top: none;
        }
        
        .table > thead > tr > .no-line {
            border-bottom: none;
        }
        
        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
        th,tr, td{
            text-align: right;
        }
        ul{
            list-style: none;
            padding: 0;
        }
        li{
             display: flex;
             gap : 20px
        }
        li p:first-child{
            width:10%;
            font-weight:bold;
        }
        .title{
            font-weight: bold;
            font-size : 20px;
        }
        .data{
            display: flex;
            margin-top: 8rem;
        }
        .data li{
            width: 300px;
        }
        .data li p:first-child {
    width: 33%;
            
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
    <div style="text-align:-webkit-center; margin:30px 0">
                  <a style="width:100%; height :155px" href="{{route('home')}}">
                   <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
                  </a> 
    </div>
    <div>
    <p class="title">يرجى التكرم بالاطلاع على الفاتورة المرفقة.</p>
    <p class="title">
        
    وشكراً
    </p>
     <ul>
        <li>
        <p></p>
        </li>
    </ul>  
    <p class="title" style="margin-top:25px; font-size : 18px;">تفاصيل الفاتورة	</p>
    <ul>
        <li>
        <p></p>
        </li>
        <li>
            <p>العميل </p> <span>{{$request->user?->name}}</span>
        </li>
        <li><p>رقم الفاتورة </p> <span>{{$request->cart_no}}</span></li>
        <li>
            <p>التاريخ </p> <span>{{$request->created_at->format('m/d/Y')}}</span>
        </li>
    </ul>    

    </div>

    <div>
        <table class="table">
            <thead>
                <th>الخدمة</th>
                 <th>رقم الطلب</th>
                  <th>المبلغ</th>
            </thead>
            <tbody>
                @foreach($request->orders as $key => $value)
                <tr>
                    <td>{{$value->category?->name}}</td>
                     <td>{{$value->order_no}}</td>
                      <td>{{$value->total_price}} ريال</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul>
            <li>
            <p>المجموع </p><span>{{$request->price}} ريال </span>
            <p></p>
            </li>
            <li>
               <p>حالة الفاتورة  </p><span>مسدد </span>
            </li>
        </ul>   
    </div>
    <ul class="data">
        
            <li>
            <p>السجل التجارى </p> <span>{{app(App\Models\GeneralSettings::class)->commercial_register}}</span>
        </li>
        <li><p> الرقم الضريبى </p> <span>{{app(App\Models\GeneralSettings::class)->tax_number}}</span></li>
    </ul>

    <div class="signature-div" style="float: left;">
                <img style="width: 200px;" src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->signature)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}" />
            </div>
</div>
</div>
</body>
</html>
