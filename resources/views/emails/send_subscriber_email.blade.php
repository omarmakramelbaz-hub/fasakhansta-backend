Hi, {{ $email }}


@lang('site.our latest news here') : {!! $data !!}

@lang('site.team')  {{app(App\Models\GeneralSettings::class)->site_name}} 
