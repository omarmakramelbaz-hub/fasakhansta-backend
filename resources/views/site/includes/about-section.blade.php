<!-- ========== about section ========= -->
    <section class="about">
      <div class="container">
        <div class="row gy-4 align-items-center">
          <div class="col-md-5 flex-center justify-content-between wow fadeInDown">
            <div class="img position-relative mobile-img ">
              <img src="{{url('site')}}/images/about.png" alt="about">
            </div>
          </div>
          <div class="col-md-7 wow fadeInDown">
            <div class="content">
              <h4 class="sec-title">@lang('site.aboutUs')؟</h4>
              <p class="heading-title">تطبيقك المفضل لطلب الأسماك المملحة الطازجة</p>
              <div class="my-3 desc white-space  @if(\Request::route()->getName() == 'home') custom-lines @endif">
                {!! app(App\Models\GeneralSettings::class)->about() !!}
              </div>
              @if(\Request::route()->getName() == 'home')
              <a href="{{route('aboutUs')}}" class="link-btn">@lang('site.more')</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>