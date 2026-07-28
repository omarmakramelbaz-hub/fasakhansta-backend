<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Simple Transactional Email</title>
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
                float: left;
                max-width: 165px;
                margin: 10px;
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
    
            .main-btn {
                padding: 0.5rem .85rem;
                border-radius: 6px;
                background: #FD7201;
                box-shadow: 0px 5px 10px #91919121;
                color: #fff;
                display: inline-block;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
             @php
                $settings = app(App\Models\GeneralSettings::class);
                $logoUrl = asset('storage'.$settings->logo);
                $siteName = $settings->site_name;
            @endphp
            <div class="header">
                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h_logo"/>
            </div>
        
            <div class="clear"></div>
 
            <div class="section">
            <table role="presentation" class="" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td>
                            <h4 class="">
                                 تقرير سنه #  {{now()->year}}
                            </h4>
                            <p>هذا هو تقريرك السنوي يتضمن تفاصيل الطلبات والمعلومات المهمة لمساعدتك في متابعة أعمالك بسهولة.</p>
                             <?php  
                                    $user = \App\Models\User::where('id',$vendor->id)->first();
                              $orders =\App\Models\Order::where('resturant_id', $user?->base_resturant->id)->whereNotNull('resturant_id')->where('type','!=','wallet')->where('status','completed')->whereYear('created_at', now()->year)->get();
                            ?>
                            @if($orders->count()>0)
                            <a href="{{ route('download-daily-report-pdf',['orders' =>$orders,'vendor' => $vendor->id, 'download'=>'pdf','year'=>'year']) }}" class="main-btn">تحميل التقرير السنوي</a>
                            @else
                            
                              <h3 class="note">لا يوجد طلبات لهذة السنه</h3>
                            @endif
                            <p>إذا كان لديك أي استفسار أو تحتاج إلى مساعدة، لا تتردد في التواصل معنا. نتمنى لك يومًا موفقًا وناجحًا!</p>
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
