<!DOCTYPE html>
<html lang="en">
<head>
    <title>404 {{ app(App\Models\GeneralSettings::class)->site_name }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="icon" type="image/x-icon"
        href="{{ url('/storage/' . app(App\Models\GeneralSettings::class)->favicon) }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/adminrtl.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/dashboard') }}/dist/css/my-custom.css">
    <style type="text/css">
        body{
          background-color: #fff;
          height: 100vh;
        }
        .error-main{
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
        }
        .error-main h1{
          font-weight: bold;
          color: #444444;
          font-size: 150px;
          text-shadow: 2px 4px 5px #6E6E6E;
        }
        .error-main h6{
          color: #42494F;
          font-size: 20px;
        }
        .error-main p{
          color: #9897A0;
          font-size: 15px; 
        }
        @media( max-width: 786px){
          .error-main img{
              width: 80%;
          }  
        }
    </style>
</head>
<body>
  
    <div class="container h-100">
        <div class="error-main h-100">
            <img src="{{url('/dashboard/dist/img/page-404.svg')}}" width="60%">
            <a href="{{url('/admin/dashboard')}}" class="btn btn-success mt-5">@lang('main.back')</a>
        </div>
    </div>
      
</body>
</html>