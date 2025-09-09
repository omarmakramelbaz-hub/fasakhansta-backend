@extends('site.index')
@section('title', trans('site.contactus'))
@section('content')
      </header>
  <main>
    <section class="contact mt-5">
      <div class="container">
          <form id="contactUsForm" class="form">
            {{ csrf_field() }}
            
          <div class="d-flex mt-5 align-items-center justify-content-center flex-column gap-1">
            <h4 class="sec-title text-center wow fadeInUp">{{trans('site.contactus')}}</h4>
            <p class="heading-title width text-center">{{ app(App\Models\GeneralSettings::class)->contact_text()}}</p>
          </div>
          <div class="alert alert-danger print-contacterror-msg" style="display:none">
                <ul></ul>
            </div>
          <div class="row gy-4 mt-5">
            <div class="col-md-6">
              <input type="text" name="name" value="{{old('name')}}" id="name" placeholder="@lang('site.name')" class="form-control">
            </div>
            <div class="col-md-6">
              <input type="email" name="email" value="{{old('email')}}" id="email" placeholder="@lang('site.email')" class="form-control">
            </div>
            <div class="col-md-12">
              <textarea name="message" id="message" placeholder="@lang('site.message')" class="form-control{{old('message')}}"></textarea>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
              <button class="btn main-btn mx-auto send-contact">@lang('site.sendform')</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
@endsection
@push('custom-js')
<script type="text/javascript">  
    $(document).ready(function() {
          $(".send-contact").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            var message = $("textarea[name='message']").val();
            $.ajax({
                url: "{{ route('storeContact') }}",
                type:'POST',
                data: {_token:_token, first_name:first_name,email:email,last_name:last_name, message:message},
                success: function(data) {
                    if ((data.errors)) {
                        printContactErrorMsg(data.errors);
                    }
                    if (data == 1) {
                        $("input[name='last_name']").val('');
                        $("input[name='first_name']").val('');
                        $("input[name='email']").val('');
                        $("textarea[name='message']").val('');
                        $(".print-contacterror-msg").css('display','none');
                          toastr.success('   @lang('site.message-sent')');

                     //     setTimeout(function() {
                     // window.location.href = ('{{url('/')}}');

                     //        }, 2000); // 2 second
                    }          
                },
                error: function (data) {
                  toastr.error("@lang('site.error')");                

                }
            });
       
        }); 
        function printContactErrorMsg (msg) {
            $(".print-contacterror-msg").find("ul").html('');
            $(".print-contacterror-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-contacterror-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });

</script>
@endpush