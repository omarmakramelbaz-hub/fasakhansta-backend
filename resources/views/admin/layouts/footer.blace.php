            
<footer class="main-footer">
  <!--<button id="enable-sound">Enable Sound</button>-->
  <!--<button id="stop-sound" style="display:none;">Stop Alert</button>-->
  <style>
    .skew-shake-y {
        position: fixed;
        bottom: 2rem;
        border-radius: 8px;
        inset-inline-start: 25%;
        width: 50%;
        background: linear-gradient(41deg, var(--main) 0.31%, var(--main-light) 119.6%) !important;
        color: white !important;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: bold;
        direction: ltr;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: skew-y-shake 1.3s infinite;
    }
    @keyframes skew-y-shake {
      0% { transform: skewY(-4deg); }
      5% { transform: skewY(4deg); }
      10% { transform: skewY(-4deg); }
      15% { transform: skewY(4deg); }
      20% { transform: skewY(0deg); }
      100% { transform: skewY(0deg); }  
    }
  </style>
  <div id="notifications">
    <!--<h3>Notifications:</h3>-->
    <!--<ul id="notificationsList"></ul>-->
  </div>
  
    <strong class="text-center">Copyright &copy; {{ date('Y') }} . @lang('main.allrights')</strong>
    تم تصميم و تطوير المشروع من خلال شركة <a
        href="http://smartvision4p.com/">شركة سمارت فيجن</a> لتقنية المعلومات.
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
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

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
        let audioReady = true;
        
let audioInterval = null; // Store the interval ID
  // Flag to ensure audio playback is allowed
const audio = new Audio('{{url('/')}}/public/sounds/mixkit-correct-answer-reward-952.wav');



// Listen for messages from the service worker
navigator.serviceWorker.addEventListener('message', (event) => {
                const clickAction = event.data.click_action;
            console.log(document.visibilityState);
           // Check if the page is in the background
            if (document.visibilityState === 'hidden' && clickAction) {
                const newWindow = window.open(clickAction, '_blank');
                if (newWindow) {
                    console.log('Window opened in background:', newWindow);
                } else {
                    console.error('Failed to open window. It may be blocked by the browser.');
                }
            } else {
                console.log('User is active on the page. Window not opened.');
            } 
            
    if (event.data && event.data.type === 'play-audio-loop' ) {
      
console.log(clickAction);
                
        if (audioReady) {
            // Start the audio loop
            if (!audioInterval) {
              
                audioInterval = setInterval(() => {
                    audio.play().catch((error) => {
                        console.error('Audio playback failed:', error);
                    });
                }, audio.duration * 1000 || 3000); // Use audio duration or default to 3 seconds
            }
        } else {
            console.warn('Audio not ready. Waiting for user interaction.');
        }

        // Stop the audio loop when the window is focused
        window.addEventListener('focus', () => {
            if (audioInterval) {
                clearInterval(audioInterval);
                audioInterval = null;
                console.log('Audio loop stopped. Window is in focus.');
            }
        });

        // Open the window if the user clicks the notification
        navigator.serviceWorker.addEventListener('message', (event) => {
            if (event.data && event.data.type === 'stop-audio') {
                if (audioInterval) {
                    clearInterval(audioInterval);
                    audioInterval = null;
                }
            }
          
        });
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
    messaging.getToken({ vapidKey: 'BOsvF-qrgKBbCcc9XPWKeiRq6wUjwP55dU2JqoefuLBICbofvTdkltQceX6y6ASyteZ4tLC6tHdnLOx6NGF1oZA	' }).then((currentToken) => {
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
messaging.onMessage((payload) => {
    console.log('Message received in foreground:', payload);
  // Only play sound once per push notification
    const audio = new Audio('{{url('/')}}/public/sounds/mixkit-correct-answer-reward-952.wav');
    audio.play();
const title = payload.notification.title || 'Default Title'; // Fallback title
    const body = payload.notification.body;
    const icon = payload.data.icon || '{{url("/storage/".app(App\Models\GeneralSettings::class)->logo)}}';
    const clickAction = payload.data.click_action || '{{url('/')}}';

    const options = {
        body: body,
        icon: icon,
        vibrate: [1000, 200, 1000, 200, 1000], // Long vibration pattern
          silent: false,
        data: {
            click_action: clickAction // Store click action in data
        }
    };
    // Show notification
    // return self.registration.showNotification(title, options);

    // Display the notification if the user has granted permission
    if (Notification.permission === 'granted') {
        new Notification(title, options);
    }
});









  
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
        $(this).find('i').toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
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


  <script>

    
    // Enable Pusher logging - disable in production
    Pusher.logToConsole = true;
    $('#alertBanner').hide();
    
    const userId = "{{auth('admin')->user()->id}}";
    console.log('channel_id: ' + userId);
    
    // Initialize Pusher
    const pusher = new Pusher('e70600021fefe99d92c0', {
        cluster: 'mt1'
    });
    
    // Subscribe to a channel
    const channel = pusher.subscribe('orders');
    
    // تحديد العناصر
    const toggleSoundButton = document.getElementById("toggle-sound");
    const soundIcon = document.getElementById("sound-icon");
    
    // تعريف الصوت
    const notificationSound = new Audio("{{url('/')}}/notification_sound.mp3");
    notificationSound.loop = true; // لجعل الصوت يعمل باستمرار
    
    // متغير لتتبع حالة الصوت
    let isSoundEnabled = false;
    
    // متغير لتتبع إذن الصوت
    let isAudioPermissionGranted = false;
    
    // التحقق من إذن الصوت باستخدام AudioContext
    let audioContext;
    try {
        audioContext = new (window.AudioContext || window.webkitAudioContext)();
    } catch (e) {
        console.error("المتصفح لا يدعم AudioContext.");
    }
    
    // التحقق من إذن الصوت
    function checkAudioPermission() {
        if (!isAudioPermissionGranted) {
            // إذا لم يتم منح إذن الصوت بعد، نطلب الإذن عند أول تفاعل
            if (audioContext && audioContext.state === "suspended") {
                audioContext.resume(); // استئناف الصوت إذا كان موقوفًا
            }
            isAudioPermissionGranted = true; // منح الإذن بعد التفاعل
        }
    }
    
    // وظيفة تشغيل الصوت
    function playSound() {
        if (isSoundEnabled) {
            notificationSound.play().catch(error => console.error("خطأ أثناء تشغيل الصوت:", error));
        }
    }
    
    // وظيفة إيقاف الصوت
    function stopSound() {
        notificationSound.pause();
    }
    
    // التحكم في الصوت عند الضغط على الزر
    toggleSoundButton.addEventListener("click", () => {
        if (isSoundEnabled) {
            // إيقاف الصوت عند الضغط إذا كان مفعلًا
            stopSound();
            isSoundEnabled = false;
            soundIcon.classList.replace("fa-volume-up", "fa-volume-mute");
            localStorage.setItem('soundEnabled', 'false'); // تخزين الحالة في localStorage
        } else {
            // منح إذن الصوت إذا لم يكن قد تم منحه
            checkAudioPermission();
            isSoundEnabled = true;
            soundIcon.classList.replace("fa-volume-mute", "fa-volume-up");
            localStorage.setItem('soundEnabled', 'true'); // تخزين الحالة في localStorage
        }
    });
    
    // إعداد الأيقونة الافتراضية
    soundIcon.classList.add("fa-volume-mute");
    
    // استرجاع حالة الصوت من localStorage عند تحميل الصفحة
    const savedSoundState = localStorage.getItem('soundEnabled');
    if (savedSoundState === 'true') {
        isSoundEnabled = true;
        soundIcon.classList.replace("fa-volume-mute", "fa-volume-up");
    } else if (savedSoundState === 'false') {
        isSoundEnabled = false;
        soundIcon.classList.replace("fa-volume-up", "fa-volume-mute");
    }
    
    // Listen for Pusher events
    channel.bind('order.updated', function(data) {
        console.log('Notification received:', data);
    
        // Extract data
        const orderId = data.orders?.id || 'Unknown ID';
        console.log('order:', orderId);
    
        const orderDetails = data.orders?.details || 'No details provided';
        const orderCount = data.orderCount || 1;  // The new order count from the broadcast
    
        // Add notification to the list
        $('#notifications').html(`<a href="{{url('admin/applies-orders?modal=order${orderId}')}}" data-order-id="${orderId}"  class="skew-shake-y" id="alertBanner">
            <span> 
                <i class="fa-regular fa-bell"></i>
                <span><span class="mx-2">${orderCount}</span> New Orders Received! </span>
            </span>
            <span> view </span>
        </a>`);
    
        // تشغيل الصوت عند وصول إشعار من Pusher إذا كان الصوت مفعلًا
        playSound();
    });


    
    
    
    
    
    
    
    
    
    
    
          
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        // ⚠️ New Notification Received! ⚠️  - ${orderCount} 
      
    
      // Show alert banner
      $('#alertBanner').show();
    //   $('#stop-sound').show();

      // Play sound if enabled
    //   if (isSoundEnabled) {
    //     notificationSound.play().catch((error) => {
    //       console.error('Sound playback error:', error);
    //     });
    //   }
    // });
  </script>

</body>

</html>
