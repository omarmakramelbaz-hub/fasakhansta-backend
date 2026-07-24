
  <footer>

    <div class="container">
      <a href="{{route('home')}}" class="footer-logo wow fadeInUp">
        <img src="{{url('/storage/'.app(App\Models\GeneralSettings::class)->favicon)}}" alt="{{app(App\Models\GeneralSettings::class)->site_name}}">
      </a>
      <ul class="navbar-nav d-flex  align-items-center justify-content-evenly flex-wrap flex-row gap-4 mb-2 mb-lg-0">
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
          <a class="nav-link {{ (Request::is('contact-us') ? 'active' : '') }}" href="{{route('contactus')}}">@lang('site.contactus')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (Request::is('admin/dashboard') ? 'active' : '') }}" href="{{route('admin_dash')}}">@lang('site.admin_dash')</a>
        </li>
      </ul>
      <div class="position-relative d-flex align-items-center my-3 pb-4">
        <!-- style image -->
        <svg class="style mx-auto " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          width="50%" height="2" viewBox="0 0 1170 2">
          <defs>
            <linearGradient id="linear-gradient" x1="1" x2="-0.062" gradientUnits="objectBoundingBox">
              <stop offset="0" stop-color="#fd7201" stop-opacity="0" />
              <stop offset="0.146" stop-color="#fc0" stop-opacity="0.31" />
              <stop offset="0.46" stop-color="#fd7201" />
              <stop offset="0.761" stop-color="#fc0" stop-opacity="0.38" />
              <stop offset="1" stop-color="#fd7201" stop-opacity="0" />
            </linearGradient>
          </defs>
          <rect id="Rectangle_1900" data-name="Rectangle 1900" width="1170" height="2" fill="url(#linear-gradient)"
            style="mix-blend-mode: multiply;isolation: isolate" />
        </svg>
      </div>
      <div class="d-flex items-center justify-content-center mt-4 download-links gap-3">
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


    <div class="rights">
      <div class="container">
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 wow fadeInDown">
          <a class="smartV-link" href="https://smartvision4p.com/" target="_blank">
            <span>@lang('site.rights')</span>
            <img src="{{url('site')}}/images/smart-logo.svg" alt="smart-logo">
          </a>
        </div>
      </div>
    </div>
  </footer>
  <!-- jQuery script -->
  <script src="{{url('site')}}/js/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    @stack('custom-js')

  <!-- bootstrap script -->
  <!-- jQuery script -->
  <!-- bootstrap script -->
  <script src="{{url('site')}}/js/bootstrap.bundle.min.js"></script>
  <!-- wow script -->
  <script src="{{url('site')}}/js/wow.min.js"></script>
  <!-- nice select  -->
  <script src="{{url('site')}}/js/jquery.nice-select.min.js"></script>
  <!-- swiper script -->
  <script src="{{url('site')}}/js/swiper-bundle.min.js"></script>
  <!-- custom js file link  -->
  <script src="{{url('site')}}/js/script.js"></script>
  <script>
   function changeLanguage(lang) {
    window.location = '{{ url('/change-language') }}/' + lang;
  }
    
    
       $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
            });
        $(".send-subscribtion").click(function(e){
          e.preventDefault();

          var _token = $("input[name='_token']").val();
          var email = $("input[name='email']").val();
          $.ajax({
            url: "{{ route('subscriber.store') }}",
            type:'POST',
            data: {_token:_token, email:email},
            success: function(data) {
                console.log(data);
              if ((data.errors)) {
                printSubscriberErrorMsg(data.errors);
              }
              if (data == 1) {
                $("input[name='email']").val('');
                $(".print-subscribererror-msg").css('display','none');
                toastr.success('   @lang('site.subscribe-done')');

                     //     setTimeout(function() {
                     // window.location.href = ('{{url('/')}}');

                     //        }, 2000); // 2 second
              }          
            },
            error: function (data) {
             console.log(data);
              toastr.error("@lang('site.error')");                

            }
          });

        }); 

        function printSubscriberErrorMsg (msg) {
          $(".print-subscribererror-msg").find("ul").html('');
          $(".print-subscribererror-msg").css('display','block');
          $.each( msg, function( key, value ) {
            $(".print-subscribererror-msg").find("ul").append('<li>'+value+'</li>');
          });
        }       
  </script>
</body>

</html>