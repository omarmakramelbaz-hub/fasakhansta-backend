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
                            <h4 class="title">اهلا بك يا {{$user}}</h4>
                            <p>
                                يسعدنا إبلاغك بقبول طلبك للانضمام إلى فريقنا.  
                                فيما يلي بيانات تسجيل الدخول الخاصة بك، بالإضافة إلى رابط تحميل التطبيق:
                            </p>
                            @for($i=0;$i<count($mobile);$i++)
                            @if($i==0)
                            <p>
                              @if($account_type=='vendor' || $account_type=='resturant_owner')
                              <h4 class="title"> مالك المطعم </h4>
                              @else
                              <h4 class="title"> 
                              معلومات الحساب
                              </h4>
                              @endif
                              رقم الموبايل: {{$mobile[$i]}}<br>
                              كلمة المرور:: {{$password[$i]}}
                            </p>
                            @else
                            <p>
                              <h4 class="title">  
                              الفرع رقم {{$i}}
                              </h4>
                              رقم الموبايل: {{$mobile[$i]}}<br>
                              كلمة المرور:: {{$password[$i]}}
                            </p>
                            @endif
                            @endfor
                            <p class="title">حمل التطبيق الآن:</p>
                            @php
                              $urlImg = url('dashboard/dist/img/play-store.png');
                            @endphp
                            @if($account_type=='vendor' || $account_type=='resturant_owner')
                             @if(app(App\Models\GeneralSettings::class)->vendor_applestore_link)
                                <a href="{{app(App\Models\GeneralSettings::class)->vendor_applestore_link}}" target="_blank">
                                  <img src="{{url('site')}}/images/app-store.png" alt="applestore_link" class="dwn-app">
                                </a>
                                 @endif
                                @if(app(App\Models\GeneralSettings::class)->vendor_googleplay_link)
                                <a href="{{app(App\Models\GeneralSettings::class)->vendor_googleplay_link}}" target="_blank">
                                  <img src="{{url('site')}}/images/google-play.png" alt="googleplay_link" class="dwn-app">
                                </a>
                                 @endif
                            @elseif($account_type=='delegate')
                             @if(app(App\Models\GeneralSettings::class)->delegate_applestore_link)
                                <a href="{{app(App\Models\GeneralSettings::class)->delegate_applestore_link}}" target="_blank">
                                  <img src="{{url('site')}}/images/app-store.png" alt="applestore_link" class="dwn-app">
                                </a>
                                 @endif
                                @if(app(App\Models\GeneralSettings::class)->delegate_googleplay_link)
                                <a href="{{app(App\Models\GeneralSettings::class)->delegate_googleplay_link}}" target="_blank">
                                  <img src="{{url('site')}}/images/google-play.png" alt="googleplay_link" class="dwn-app">
                                </a>
                                 @endif
                            @else
                                @if(app(App\Models\GeneralSettings::class)->applestore_link)
                                <a href="{{app(App\Models\GeneralSettings::class)->applestore_link}}" target="_blank">
                                  <img src="{{url('site')}}/images/app-store.png" alt="applestore_link" class="dwn-app">
                                </a>
                                @endif
                                @if(app(App\Models\GeneralSettings::class)->googleplay_link)
                                <a href="{{app(App\Models\GeneralSettings::class)->googleplay_link}}" target="_blank">
                                  <img src="{{url('site')}}/images/google-play.png" alt="googleplay_link" class="dwn-app">
                                </a>
                                @endif
                            @endif
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

