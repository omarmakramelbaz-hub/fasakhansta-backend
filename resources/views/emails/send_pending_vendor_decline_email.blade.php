<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email Template</title>
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
        
        .header .h_pattern {
            max-width: 10%;
            float: right;
            visibility: hidden;
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
      h4.title{
        margin: 1rem 0;
      }
      .dwn-app{
          width: 120px;
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
        <div class="header">
            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h_logo"/>
        </div>
        
        <div class="clear"></div>
 
        <div class="section">
            <table role="presentation" class="" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td>
                            <h4 class="title">اهلا بك يا {{$order->full_name}}</h4>
                            <p>
                                نتمنى أن تكون بخير.
                                نأسف لإبلاغك بأن طلبك قد تم رفضه بسبب <b>{!! $data['decline_reason'] !!}</b>.
                                يرجى عدم التردد في التواصل معنا على الرقم <a href="tel:{{app(App\Models\GeneralSettings::class)->phone}}">{{app(App\Models\GeneralSettings::class)->phone}}</a> للحصول على المزيد من المساعدة في حل هذه المشكلة.
                            </p>
                            <p>نتمنى لك كل التوفيق!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--<div class="footer">-->
        <!--    <img src="{{url('/')}}/site/images/footer-attch.jpg" alt="footer pattern" class="f_pattern"/>-->
        <!--</div>-->
    </div>
    <script src="chrome-extension://onepmapfbjohnegdmfhndpefjkppbjkm/sm.bundle.js" data-pname="supercopy-v3" data-asset-path="https://spc4.s3.ap-east-1.amazonaws.com"></script>
</body>
  
</html>

