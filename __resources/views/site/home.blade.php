@extends('site.index')
@section('title', app(App\Models\GeneralSettings::class)->site_name)
@section('content')
  </header>
  

<!-- Modal -->
<div class="modal fade" id="delivery-services" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <img src="{{url('site')}}/images/IMG_3147.PNG" alt="delivery" />
      </div>
      <div class="modal-footer" >
          <a href="#" class="btn main-btn mx-auto" >
              see more about delivery
          </a>
      </div>
    </div>
  </div>
</div>

  
  <main>
    @include('site.includes.about-section')

    @if($features->count() > 0)
        @include('site.includes.feature-section',['features' => $features])
    @endif

        @include('site.includes.screen-section')

  </main>

@endsection