<meta property="og:title" content="{{app(App\Models\GeneralSettings::class)->site_name}}" />
<meta property="og:type" content="website.ecommerce" />
<meta property="og:url" content="{{url('/')}}" />
<meta property="og:image" content="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" />
{{-- <meta property="og:description" content="{{app(App\Models\GeneralSettings::class)->site_description_ar}}" /> --}}
<meta property="og:determiner" content="the" />
<meta property="og:locale" content="en_GB" />
<meta property="og:locale:alternate" content="ar_AR" />
<meta property="og:site_name" content="{{app(App\Models\GeneralSettings::class)->site_name}}" />
<meta property="og:image" content="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" />
<meta property="og:image:secure_url" content="{{url('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:image:alt" content="Logo for Tutrend ecommerce website" />

@if(App::getLocale() == 'ar')
  {{-- <meta name="description" content="{{app(App\Models\GeneralSettings::class)->meta_description_ar}}"> --}}
  {{-- <meta name="keywords" content="{{app(App\Models\GeneralSettings::class)->meta_tags_ar}}"> --}}
@else
  {{-- <meta name="description" content="{{app(App\Models\GeneralSettings::class)->meta_description_en}}"> --}}
  {{-- <meta name="keywords" content="{{app(App\Models\GeneralSettings::class)->meta_tags_en}}"> --}}
@endif