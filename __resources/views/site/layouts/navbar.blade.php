 
    <nav class="navbar navbar-expand-lg ">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}">
        </a>
        <div class=" navbar-collapse mx-auto ">
          <div class=" justify-content-between align-items-center w-100 mb-5 for-mobile">
            <a class="navbar-brand" href="{{route('home')}}">
              <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}">
            </a>
            <button class="navbar-toggler" id="close">
              <i class="fas fa-close"></i>
            </button>
          </div>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ (Request::is('/') ? 'active' : '') }}" aria-current="page" href="{{route('home')}}">@lang('site.home')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (Request::is('about-us') ? 'active' : '') }}" href="{{route('aboutUs')}}">@lang('site.aboutUs')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (Request::is('features') ? 'active' : '') }}" href="{{route('features')}}">@lang('site.features')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (Request::is('screens') ? 'active' : '') }}" href="{{route('screens')}}">@lang('site.screens')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (Request::is('contactus') ? 'active' : '') }}" href="{{route('contactus')}}">@lang('site.contactus')</a>
            </li>
          </ul>
          <div class="items-center for-mobile mt-5 download-links gap-3">
              @if(app(App\Models\GeneralSettings::class)->applestore_link)
                <a href="{{app(App\Models\GeneralSettings::class)->applestore_link}}" target="_blank">
                  <img src="{{url('site')}}/images/app-store.svg" alt="applestore_link">
                </a>
              @endif
                @if(app(App\Models\GeneralSettings::class)->googleplay_link)
                <a href="{{app(App\Models\GeneralSettings::class)->googleplay_link}}" target="_blank">
                  <img src="{{url('site')}}/images/google-play.svg" alt="googleplay_link">
                </a>
                @endif
          </div>
        </div>
        <div class="d-flex align-items-center gap-md-3">
            <select onchange="changeLanguage(this.value)" class="lang-select">
                <option {{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'selected' : '') : '' }}
                    value="ar">العربية</option>
                <option {{ session()->has('lang_code') ? (session()->get('lang_code') == 'en' ? 'selected' : '') : '' }}
                    value="en">English</option>
            </select>
          <button class="navbar-toggler" id="nav-toggler">
            <i class="fas fa-bars"></i>
          </button>
        </div>
        <div class=" items-center for-pc  download-links gap-2">
           @if(app(App\Models\GeneralSettings::class)->applestore_link)
            <a href="{{app(App\Models\GeneralSettings::class)->applestore_link}}" target="_blank">
              <img src="{{url('site')}}/images/app-store.svg" alt="applestore_link">
            </a>
          @endif
            @if(app(App\Models\GeneralSettings::class)->googleplay_link)
            <a href="{{app(App\Models\GeneralSettings::class)->googleplay_link}}" target="_blank">
              <img src="{{url('site')}}/images/google-play.svg" alt="googleplay_link">
            </a>
            @endif
        </div>

      </div>
    </nav>
    @if(\Request::route()->getName() == 'home')
    <div class="container" id="hero">
      <div class="row gy-4 align-items-center justify-content-between position-relative z-3">
        <div class="col-md-7 wow fadeInDown">
          <div class="header-content">
            <h1 class="content-first">{{app(App\Models\GeneralSettings::class)->slider_title()}}</h1>
            <p class="content-seconed">
            {{app(App\Models\GeneralSettings::class)->slider_text()}}
            </p>
          </div>
        </div>
        <div class="col-md-5 wow fadeInDown">
          <div class="header-img img">
            <img src="{{url('site')}}/images/Phone-header.png" alt="">
          </div>
        </div>
      </div>
    </div>
    @else
          @include('site.includes.breadcrumb-section',['title' => trans('site.'. \Request::route()->getName())])

     
    @endif
