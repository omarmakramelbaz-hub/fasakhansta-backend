<html>
    <head>
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
            body{
                background: #fd720112;
            }
            .content {
                height: 100vh;
                display: flex;
                flex-direction: column;
                gap: 4rem;
                align-items: center;
                justify-content: center;
            }

            .content img {
                width: 40%;
            }
            
        </style>
    </head>
    <body>
        <div class="content">
            <h1>@lang('main.Payment completed successfully')</h1>
            <img src="https://backend.smartvision4p.com/faskhaNinja/public/site/images/Check.svg">
            <div class="row">
                <a class="btn btn-outline-success" href="{{url('admin/dashboard')}}">@lang('main.back to index') </a>
                <a class="btn btn-success" href="{{url('admin/get/charging/wallet')}}">@lang('main.back to wallet') </a>
            </div>
        </div>
    </body>
</html>