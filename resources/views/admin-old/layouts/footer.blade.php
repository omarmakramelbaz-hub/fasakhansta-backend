<footer class="main-footer">
    <strong class="text-center">Copyright &copy; {{ date('Y') }} . @lang('main.allrights')</strong>
    <!--تم تصميم و تطوير المشروع من خلال شركة <a-->
    <!--    href="http://smartvision4p.com/">شركة سمارت فيجن</a> لتقنية المعلومات.-->
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('/dashboard') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/dashboard') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
<!-- Summernote -->
<script src="{{ url('/dashboard') }}/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="{{ url('/dashboard') }}/dist/js/bootstrap-tagsinput.js"></script>



<script>
$(document).ready(function() {
    // if ($("#show-case").next().length > 0) {
    //     $("#show-case").next().hide();

    //     $("input[name='choose_user']").change(()=> {
    //         const checkedInput = $("input[name='choose_user']:checked").val();
            
    //         if(Number(checkedInput) === 1){
    //             $("#show-case").next().show();
    //         }else{
    //             $("#show-case").next().hide();
    //         }
            

    //     });
    // }
    
    
    const showInputCase = (selectId , inputName)=> {
        
        const select = selectId;
        const input = inputName;
        
        if (select == '#user-choose'){
            if ($(select).length > 0) {
        $(select).hide();
        $(".zone").show();

        $(`input[name=${input}]`).change(()=> {
            const checkedInput = $(`input[name=${input}]:checked`).val();
            
            if(Number(checkedInput) === 1){
                $(select).show(200);
                
            }else{
                $(select).hide(200);
                
            }
            
            if(Number(checkedInput) === 0){
                $(".zone").show(200);
            }else{
                $(".zone").hide(200);
            }
            


        });
    }
        }else{
        
        if ($(select).next().length > 0) {
        $(select).next().hide();

        $(`input[name=${input}]`).change(()=> {
            const checkedInput = $(`input[name=${input}]:checked`).val();
            
            if(Number(checkedInput) === 1){
                $(select).next().show(200);
            }else{
                $(select).next().hide(200);
            }
            

        });
    }
    
        }
        
    }
    
    showInputCase("#show-case" , 'choose_user' )
    showInputCase("#user-choose" , 'send_by' )
    
});


</script>

<script type="text/javascript">




  
    $(document).ready(function() {
    CKEDITOR.replace( 'ckeditor',{
        height: 1000 // Set height in pixels
    });
    
            // Wait for the CKEditor script to initialize
        setTimeout(function() {
            $('.cke_notification_warning').addClass('d-none');
            // Hide the CKEditor alert message
            $('div.cke-editor__top').each(function() {
                if ($(this).text().includes('This CKEditor 4.14.0 version is not secure. Consider upgrading to the latest one, 4.24.0-lts')) {
                    $(this).hide();
                }
            });
        }, 1000); // Adjust the delay if necessary
});
    </script>
<!-- overlayScrollbars -->
<script src="{{ url('/dashboard') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
@stack('custom-js')
<!-- AdminLTE App -->
<script src="{{ url('/dashboard') }}/dist/js/selectize.min.js"></script>
<script src="{{ url('/dashboard') }}/dist/js/select2.min.js"></script>
<script src="{{ url('/dashboard') }}/dist/js/flatpickr.min.js"></script>
<script src="{{ url('/dashboard') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('/dashboard') }}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/dashboard') }}/dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<script>
// Ensure Service Worker is supported
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('{{url("firebase-messaging-sw.js")}}')
        .then((registration) => {
            console.log('Service Worker registered with scope:', registration.scope);
            // Now, initialize Firebase Messaging with the registered service worker
            messaging.useServiceWorker(registration);
            requestNotificationPermission();
        })
        .catch((error) => {
            console.error('Service Worker registration failed:', error);
        });
     navigator.serviceWorker.addEventListener('message', function(event) {
        if (event.data && event.data.message === 'play_sound') {
            // Play audio when the message is received
            const audio = new Audio('https://backend.smartvision4p.com/faskhaNinja/public/notification-sound.wav');
            audio.play();
        }
    });
    navigator.serviceWorker.addEventListener('notificationclick', function(event) {
    event.notification.close(); // Close the notification

    // Play sound after notification click
    const audio = new Audio("https://backend.smartvision4p.com/faskhaNinja/public/notification-sound.wav");
    audio.play();

    // Open the link from the notification
    if (event.notification.data && event.notification.data.click_action) {
        event.waitUntil(clients.openWindow(event.notification.data.click_action));
    }
});
}


// Initialize Firebase Messaging
const messaging = firebase.messaging();

// Request notification permission and get the token
function requestNotificationPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            // Get the token and send it to the server
            getToken();
        } else {
            console.log('Unable to get permission to notify.');
        }
    });
}

// $(document).ready(function(){
//     getToken();
// })
// Retrieve token and handle FCM messages
function getToken() {
    messaging.getToken({ vapidKey: 'BNSJqlpd_fuu796_b2tEy6ijfURy_nXw_U-hL_mmPmIIECdTzSGy7HZOtSvDTjyNgLUYrBLSOBL7JZQRzn_a7N4' }).then((currentToken) => {
        if (currentToken) {
            console.log('FCM Token:', currentToken);
            // Send the token to your server
            sendTokenToServer(currentToken);
        } else {
            console.log('No registration token available.');
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token: ', err);
    });
}




// Handle foreground messages
// messaging.onMessage((payload) => {
//     console.log('Message received in foreground:', payload);

// const title = payload.notification.title || 'Default Title'; // Fallback title
//     const body = payload.notification.body;
//     const icon = payload.data.icon || '{{url("/storage/".app(App\Models\GeneralSettings::class)->logo)}}';
//     const clickAction = payload.data.click_action || '{{url('/')}}';

//     const options = {
//         body: body,
//         icon: icon,
//         vibrate: [1000, 200, 1000, 200, 1000], // Long vibration pattern
//         data: {
//             click_action: clickAction // Store click action in data
//         }
//     };
//     // Show notification
//     // return self.registration.showNotification(title, options);

//     // Display the notification if the user has granted permission
//     if (Notification.permission === 'granted') {
//         new Notification(title, options);
//     }
// });









  
function sendTokenToServer(token){
    console.log("token"+token);
    const user_id="{{auth('admin')->user()->id}}";
    axios.post("{{url('/admin/save-token')}}",{
    token,user_id
    }).then(res=>{
      console.log("success:"+res);
    }).catch(ress=>{
      console.log("cash"+ress);
    })
 }

</script>
<!-- Page JS -->
<script>
    $(document).ready(function() {
$('.selectize').selectize()
// $('select').select2();
        
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
        @if (Session::has('info'))
            toastr.success('{{ Session::get('info') }}');
        @endif
        @if (count($errors))
              @foreach ($errors->all() as $error)
                  toastr.error('{{ $error}}');
              @endforeach
       @endif

    
});
function changeLanguage(lang) {
        window.location = '{{ url('/change-language') }}/' + lang;
    }
    $(function () {
 
  $(".rateYo").rateYo({
    starWidth: "13px",readOnly: true
  });
 
});
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
    $('#gallery-photo-add2').on('change', function() {
        imagesPreview(this, 'div.gallery2');
    });
});
$(document).ready(function(){
     $(".show-pass").click(function () {
        $(this).find('i').addClass("fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            $(this).find('i').removeClass("fa-eye-slash");
            $(this).find('i').addClass("fa-eye");
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        $(this).toggleClass('active');
    });

        $(".card-body").css("opacity", 1);
         $('select[name="other_products[]"]').select2();
    });
    
    $('.show_confirm').click(function(event) {

        var form = $(this).closest("form");

        var name = $(this).data("name");

        event.preventDefault();

        swal({
                title: `هل انت متاكد من حذف هذا العنصر ؟`,
                text: "أذا قمت بحذف هذا العنصر لن تتمكن من استرجاعه مره اخرى !",
                icon: "warning",
                buttons: ['لا', 'نعم'],
                dangerMode: true,
            })

            .then((willDelete) => {

                if (willDelete) {
                    form.submit();
                }
            });
    });

$(function() {
    $(window).on("load", function() {
        $('.card-body').css('opacity',1);
    });
    $( "form" ).submit(function() {
        $(this).find("button[type='submit']").html('<i class="fa fa-spinner fa-spin"></i>@lang('main.under click')');
    });
});
$(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.send_email_all').on('click', function(e) {


            var allMails = [];  
            $(".sub_chk:checked").each(function() {  
                allMails.push($(this).attr('data-id'));
            });  


            if(allMails.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  
                if(check == true){  

                    var join_selected_values = allMails.join(","); 
                    $.ajax({
                        url: $(this).prop('action'),
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    // $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }  
            }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                                window.location.reload();
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                      
                  });
                //   $('tbody').html(' <tr><td colspan="4"><h4>@lang('main.no data to show')</h4><td></tr>');
                }  
            }  
        });
    });

// image upload multipl
 $(document).ready(function() {
  var fileArr = [];
   $("#images").change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];
     
        $('#image_preview').html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
            $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('images').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
});
</script>

<script>
     $('.select-component').select2();
      $('#jstree').jstree();
</script>

<!--<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>-->
<!--</script>-->
  <!--<script-->
  <!--  type="text/javascript"-->
  <!--  src="//translate.google.com/translate_a/element.js?cb=googleTranslateInit"-->
  <!--</script>-->
  <!--<script type="text/javascript">-->
  <!--  function googleTranslateInit() {-->
  <!--    new google.translate.TranslateElement(-->
  <!--      { pageLanguage: 'en' },-->
  <!--      'google_translate_button'-->
  <!--    );-->
  <!--  }-->
  <!--</script>-->


</body>

</html>
