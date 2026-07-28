    <!-- ========== features section ========= -->
    <section class="features">
      <div class="container">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-5 wow fadeInDown">
            <div class="content">
              <h4 class="sec-title">@lang('site.features')</h4>
              <p class="heading-title">@lang('site.feature section')</p>
              <div class="features-items mt-4">
                @foreach($features as $key => $value)
                <div class="feature">
                  <div class="img">
                    <img src="{{url('site')}}/images/feature.svg" alt="feature">
                  </div>
                  <div class="content">
                    <h5 class="title">{{$value->title}}</h5>
                    <p class="desc">{{$value->text}}</p>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-7 flex-center justify-content-between wow fadeInDown">
            <div class="img img-sec position-relative  ">
              <img src="{{url('site')}}/images/features.png" alt="features">
            </div>
          </div>
        </div>
      </div>
    </section>
