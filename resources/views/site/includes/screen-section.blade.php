    <!-- ========== screens =========  -->
    <section @if(\Request::route()->getName() == 'home') class="screens" @endif>
      <div class="container">
        <div class="d-flex mt-5 align-items-center justify-content-center flex-column gap-1">
          <h4 class="sec-title text-center wow fadeInUp">@lang('site.screens')</h4>
          <p class="heading-title text-center">تطبيقك المفضل لطلب الأسماك المملحة الطازجة</p>
        </div>
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Subtraction 10.png" alt="">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Subtraction 11.png" alt="">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Subtraction 12.png" alt="">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Subtraction 9.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Register.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Register – 2.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Profile.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Wallet.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Menu.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Setting.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Personal Info.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Search.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Search – 2.png" alt="Subtraction 9">
            </div>
            <div class="swiper-slide">
              <img src="{{url('site')}}/images/Location.png" alt="Subtraction 9">
            </div>
            
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>

        </div>
      </div>
    </section>

