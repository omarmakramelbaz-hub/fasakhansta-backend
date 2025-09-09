<!DOCTYPE html>
<html lang="en" @if(App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title') </title> 
  <link rel="shortcut icon" type="image/x-icon" href="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" sizes="65x65" />
    @include('site.includes.meta-section')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- font awesome link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  <!-- Bootstrap link  -->
  <link rel="stylesheet" href="{{url('site')}}/styles/plugin/bootstrap.min.css">
  <!-- animate link  -->
  <link rel="stylesheet" href="{{url('site')}}/styles/plugin/animate.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="{{url('site')}}/styles/plugin/nice-select.css">
  <!-- swiper link -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="{{url('site')}}/styles/plugin/swiper.min.css">
  <!-- custom css file link  -->
  <link rel="stylesheet" href="{{url('site')}}/styles/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body>

  <header class="@if(\Request::route()->getName() == 'home') header-home @endif">