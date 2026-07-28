@extends('admin.index')
@push('custom-css')
<style>
      /*#chat { max-width: 600px; margin: 0 auto; padding: 10px; }*/
      /*  #messages { border: 1px solid #ccc; height: 300px; overflow-y: scroll; padding: 10px; }*/
      /*  #message-input { width: calc(100% - 60px); padding: 10px; }*/
      /*  #send-btn { width: 50px; padding: 10px; }*/
     
.notifi {
  /*background-color: #ddd;*/
  display: flex;
    margin: 10px;
    border-radius: 10px;
  position: relative;
  padding: .5rem;
  color: #404040 !important;
  transition: 0s !important;
}
.notifi p {
  transition: 0.01ms !important;
}
.notifi:hover {
  background-color: var(--main-light);
  color: #fff !important;
}
.notifi.active {
  background: linear-gradient(41deg, var(--main) 0.31%, var(--main-light) 119.6%) !important;
  color: #fff !important;
}
.notifi a {
  position: absolute;
  top: 0%;
  left: 0%;
  right: 0%;
  bottom: 0%;
}
.notifi img {
  width: 40px;
  height: 40px;
  padding: 5px;
  box-shadow: 0px 3px 12px 0px #ffffff38;
  border-radius: 50%;
  background-color: #f5d7bf;
}
/*.chat .notifi {*/
/*  margin: 0 1rem;*/
/*}*/
.users{
    background: #fff;
    height: 100%;
    border-radius: 20px;
}
.search-inp .btn-search {
  transform: rotateY(180deg);
  position: absolute;
  top: 6px;
  inset-inline-end: 0.3rem;
  color: #575757 !important;
  z-index: 4;
  box-shadow: none !important;
  background-color: #fff;
}
.chat-box {
  height: 80vh;
}
.chat-box .col {
  height: 100%;
  /*overflow-y: auto;*/
}
.chat-box .chat {
  height: calc(100% - 85px);
  overflow-y: auto;
}
.msg-header {
  padding: 0.75rem;
  background: linear-gradient(41deg, var(--main) 0.31%, var(--main-light) 119.6%) !important;
  border-radius: 20px 20px 0px 0px;
  color: #fff;
}
.chat-box .msgs {
    height: calc(100% - 125px);
    overflow: auto;
    padding: 1rem 1.2rem;
    margin-bottom: 0;
    background: #fff;
}
.msg-item {
  margin-bottom: 8px;
  display: flex;
  align-items: center;
    max-width: 75%;
    width: fit-content;
    min-width: 62px;
}
.msg-img {
    display: block;
    height: 36px;
    width: 36px;
    flex-grow: 1;
    aspect-ratio: 1 / 1;
    border-radius: 100%;
    max-width: 36px;
    padding: 4px;
    overflow: hidden;
    margin-inline-end: 15px;
    background: #fff;
}
.msg-data {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 10px;
    padding: .35rem 0.85rem;
    flex-grow: 1;
    color: #000;
    font-size: 15px;
    width: calc(100% - 50px) !important;
    background-color: #f1f1f1;
}
.msg-data p{
    margin: 0;
    min-height: 14px;
}
.msg-data span {
  position: absolute;
  top: calc(100% + 0.3rem);
  inset-inline-end: 0.5rem;
  font-size: 13px;
  color: #404040;
}
.msg-item.outer {
  flex-direction: row-reverse;
  margin-inline-start: auto;
}
.msg-item.outer .msg-data {
  background-color: var(--main-light);
  color: #fff;
}
.msg-item.outer .msg-img {
  margin-inline-end: 0px;
  margin-inline-start: 15px;
}
.send-msg {
    padding: 0.75rem;
    background: linear-gradient(41deg, var(--main) 0.31%, var(--main-light) 119.6%) !important;
    border-radius: 0px 0px 20px 20px;
    position: static;
}
.send-msg-btn {
    background-color: #fff !important;
    color: var(--main) !important;
    height: 100%;
    font-size: large;
}
sub {
    text-wrap: nowrap;
    direction: ltr;
    padding-inline-start: 7px;
}
.msg-item.outer sub{
    padding-inline-start: 7px;
    padding-inline-end: 0px;
}
.date-separator {
    position: relative;
    margin-bottom: 8px;
}
.date-separator::before {
    content: '';
    position: absolute;
    display: inline-flex;
    width: 100%;
    height: 1px;
    top: 50%;
    z-index: 0;
    transform: translateY(50%);
    background: #eaeaea;
}
.date {
    font-weight: bold;
    color: #7a7a7a;
    text-align: center;
    background: #fff;
    padding-inline: 15px;
    margin: auto;
    width: fit-content;
    position: relative;
    z-index: 1;
}
#send-form .form-control {
    height: calc(2.25rem + 5px);
    border: unset;
}
.form-control {
    border-radius: 12px;
    border: unset !important;
    box-shadow: unset !important;
}
.dropdown-divider {
    border-top: 1px solid #e9ecef;
}

</style>
@endpush
@section('content')

    <span class="top"></span>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
        <div class="row gy-3 chat-box">
          @if(auth()->user()->roles->pluck("id")->first() == 11||auth()->user()->roles->pluck("id")->first() == 13)
              <div class="col col-12 col-lg-4">
                <div class="users">
                    <div class="msg-header">
                        <div class="position-relative search-inp">
                          <form action="" onsubmit="return false;">
                            <input type="search" id="userSearchInput" class="form-control" placeholder="ابحث ..." required>
                            <!--<button type="submit" class="btn btn-search">-->
                            <!--  <i class="bi bi-search"></i>-->
                            <!--</button>-->
                          </form>
                        </div>
                    </div>
                    <ul class="chat" id="userList">
                        
                  @foreach(\App\Models\User::where('account_type','!=','admin')->get() as $userr)

                  <li class="notifi user{{$userr->id}} {{isset($user) && $user->id==$userr->id?'active':''}} gap-2 align-items-center " onclick="joinChatroom('{{$userr->id}}','{{$userr->name?$userr->name:$userr->mobile}}')" data-user_id="{{$userr->id}}" data-username="{{$userr->name?$userr->name:$userr->mobile}}">
                    <img src="https://backend.smartvision4p.com/faskhaNinja/public/dashboard/dist/img/avatar_icon.png" alt="">
                    <div class="mb-0">
                          <h6 class="mb-0">
                            {{$userr->name?$userr->name:$userr->mobile}}
                          </h6>
                          <p class="mb-0">
                            {{$userr->account_type}}
                          </p>
                    </div>
                  </li>
                  @endforeach
                 
                </ul>
                </div>
              </div>
              
               @elseif(auth()->user()->roles->pluck("id")->first() == 2)
                    @php $userr=\App\Models\User::findOrFail(request()->user_id); @endphp
                  <li class="d-none notifi user{{$userr->id}} {{isset($user) && $user->id==$userr->id?'active':''}} gap-2 align-items-center " onclick="joinChatroom('{{$userr->id}}','{{$userr->name?$userr->name:$userr->mobile}}')" data-user_id="{{$userr->id}}" data-username="{{$userr->name?$userr->name:$userr->mobile}}">
                    <img src="https://backend.smartvision4p.com/faskhaNinja/public/dashboard/dist/img/avatar_icon.png" alt="">
                    <div class="mb-0">
                          <h6 class="mb-0">
                            {{$userr->name?$userr->name:$userr->mobile}}
                          </h6>
                          <p class="mb-0">
                            {{$userr->account_type}}
                          </p>
                    </div>
                  </li>
                  @endif
               <!--show msg -->
              <div class="col position-relative" id="chat">
                <div class="msg-header">
                  <div class="d-flex align-items-center">
                    <div class="msg-img">
                      <img class="w-100" src="https://backend.smartvision4p.com/faskhaNinja/public/dashboard/dist/img/avatar_icon.png" alt="">
                    </div>
                    <p class="fw-bold mb-0" id="user_name"></p>
                  </div>
                </div>
                <ul class="msgs" id="messages">
                  
                </ul>
                <form action="#" id="send-form">
                  <div class="send-msg d-flex gap-2">
                    <div style="flex-grow: 1;">
                      <input type="text" id="message-input" class="form-control" placeholder="@lang('main.enter your message here')" >
                    </div>
                    <button type="button"  id="send-btn" class="btn send-msg-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
     </div>
    </div>

</div>

    
@endsection
@push('custom-js')

<script>
$(document).ready(function(){
    var reciever=$("li.active").attr('data-user_id');
    var username=$("li.active").attr('data-username');
    joinChatroom(reciever,username)
     $(".msgs").animate({ scrollTop: $('.msgs').prop("scrollHeight")}, 1000);
});

// Initialize Firestore
const db = firebase.firestore();

  
const FIREBASE_PROJECT_ID = 'faskhaninja';
const FIREBASE_BASE_URL = `https://firestore.googleapis.com/v1/projects/${FIREBASE_PROJECT_ID}/databases/(default)/documents`;
const CHATROOMS_URL = `${FIREBASE_BASE_URL}/DashboardChat`;




// $(".userSelect").on('change',function(){
//     joinChatroom();
// });



// Fetch existing chatrooms from Firestore
function getChatrooms() {
    console.log('Fetching chatrooms');
    fetch(CHATROOMS_URL)
        .then(response => response.json())
        .then(data => {
            console.log('Data:', data);

            const chatroomList = document.getElementById('chatroom-list');
            chatroomList.innerHTML = ''; // Clear current list

            if (data.documents) {
                data.documents.forEach(doc => {
                    const fields = doc.fields;
                    if (fields && fields.roomId) {
                        const chatroomId = fields.roomId.stringValue; // Get roomId from the fields
                        const li = document.createElement('li');
                        li.textContent = chatroomId;
                        li.onclick = () => joinChatroomm(chatroomId);
                        chatroomList.appendChild(li);
                    } else {
                        console.error('Invalid document structure:', doc);
                    }
                });
            } else {
                console.log('No documents found');
            }
        })
        .catch(error => console.error('Error fetching chatrooms:', error));
}

let userIdd = "{{auth('admin')->user()->id}}";
let sender_name = "{{auth('admin')->user()->name}}";
let user2 = "{{isset($user)?$user->id:''}}";
let old_user = "";
let receiver_name = "{{isset($user)?$user->name:''}}";

// Firestore paths
let CHATROOM_ID = generateRoomId(userIdd, user2); // Replace with your chatroom ID
let MESSAGES_URL = `${FIREBASE_BASE_URL}/DashboardChat/${window.CHATROOM_ID}/messages`;

if(window.user2==''){
    console.log("user2");

$("#chat").css('display','none');
}


// Real-time listener to update messages instantly
function listenForMessages(chatroomId) {
    console.log('listen');
    const messagesRef = db.collection('DashboardChat').doc(chatroomId).collection('messages').orderBy('timestamp');

    messagesRef.onSnapshot(snapshot => {
        const messagesList = document.getElementById('messages');
        messagesList.innerHTML = ''; // Clear old messages before appending new ones

        snapshot.forEach(doc => {
            const messageData = doc.data();
            console.log(messageData);
            const message = messageData.message;
            const senderName = messageData.sender_name;
            const sender_id = messageData.sender_id;
            const reciever_id = messageData.user_id;
            const li = document.createElement('li');
            li.classList.add('msg-item');
            if (sender_id != "{{auth('admin')->user()->id}}" && reciever_id == "{{auth('admin')->user()->id}}") {
                li.classList.add('outer');
            }

            const dateObj = messageData.timestamp ? messageData.timestamp.toDate() : new Date();
            const hour = dateObj.getHours() % 12 || 12;
            const minutes = dateObj.getMinutes().toString().padStart(2, '0');
            const ampm = dateObj.getHours() >= 12 ? 'PM' : 'AM';
                const sortedUsers = [sender_id, reciever_id].sort(); // Sort to ensure consistency
                const roomId = `room_${sortedUsers.join('_')}`;
            console.log("message-room"+roomId)
                   if(roomId==window.CHATROOM_ID ){
            li.innerHTML = `
                <div class="msg-data">
                    <sub>${hour}:${minutes} ${ampm}</sub>
                    <p>${message}</p>
                </div>`;
            messagesList.appendChild(li);
           }
        });

        // Auto-scroll to the latest message
        $(".msgs").animate({ scrollTop: $('.msgs').prop("scrollHeight") }, 1000);
    });
}

function joinChatroom(reciever,username) {
    // alert("gf");
    var sender="{{auth('admin')->user()->id}}";
    // var reciever=$(this).data('user_id');
    // var username=$(this).data('username');
    console.log(username,sender,reciever)
    // Set room ID globally and start chatting
    $("#user_name").text(username);
    $(".notifi").removeClass("active");
    $(".user"+reciever).addClass("active");
    
    const url = new URL(window.location.href);
url.searchParams.set('user_id',reciever);
 window.history.replaceState(null, null, url);
window.receiver_name=username;
  generateRoomId(sender,reciever)

 listenForMessages(window.CHATROOM_ID); 

  
    // Call your chat functionality here (send/receive messages)
}
// getChatrooms();
function generateRoomId(user1, user2) {
    const sortedUsers = [user1, user2].sort(); // Sort to ensure consistency
    console.log("generateRoomId", sortedUsers);
    const roomId = `room_${sortedUsers.join('_')}`;
   console.log("roomId "+roomId);
      window.CHATROOM_ID = roomId;
    console.log("CHATROOM_ID"+window.CHATROOM_ID);
  window.old_user=window.user2;
    window.user2=user2;
    // Check if the room already exists
    fetch(`${FIREBASE_BASE_URL}/DashboardChat/${roomId}`)
        .then(response => {
            if (response.status === 404) {
                // Room doesn't exist, create it
                const roomData = {
                    fields: {
                        roomId: { stringValue: roomId },
                        users: { arrayValue: { values: [{ stringValue: user1 }, { stringValue: user2 }] } },
                        createdAt: { timestampValue: new Date().toISOString() }
                    }
                };
                console.log('createroom'+roomId)
                getMessages();
                return  fetch(`${FIREBASE_BASE_URL}/DashboardChat?documentId=${roomId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(roomData)
                });
            } else if (response.status === 200) {
                // Room already exists, log and return the roomId
                console.log('Room already exists:', roomId);
                 getMessages();
                return Promise.resolve(roomId); // Resolve with the existing roomId
            } else {
                throw new Error('Unexpected response status: ' + response.status);
            }
        })
        .then(createResponse => {
            if (createResponse && createResponse.json) {
                return createResponse.json();
            }
            return createResponse; // return the existing roomId
        })
        .then(data => {
            if (data) {
                
                console.log('Room created:', data);
            }
            // Call to get messages after room creation
        })
        .catch(error => console.error('Error creating room:', error));
        
        //  getMessages();
    return roomId; // Return roomId at the end
}

// Function to send a message to Firestore using REST API
function sendMessage(message,userIdd,user2) {
    const timestamp = new Date().toISOString();
    const sender=sender_name;
    const receiver=window.receiver_name;
    const messageData = {
        fields: {
            message: { stringValue: message },
            sender_id:{ stringValue: userIdd } ,
            user_id:{ stringValue: user2.toString() },
            sender_name:{ stringValue: sender } ,
            receiver_name:{ stringValue: receiver },
             timestamp: { timestampValue: timestamp },
        }
    };
    console.log(messageData);
   const MESSAGES_URL1=`${FIREBASE_BASE_URL}/DashboardChat/${window.CHATROOM_ID}/messages`;

    // Make a POST request to Firestore
    fetch(MESSAGES_URL1, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(messageData)
    }).then(response => response.json())
    .then(data => {console.log('Message sent:', data);
    
            sendNotificationToReceiver(user2, sender, message);
            db.collection("DashboardChat").doc(window.CHATROOM_ID).set({
                lastMessageTimestamp: firebase.firestore.FieldValue.serverTimestamp()
            }, { merge: true });
            getMessages();
            $(".msgs").animate({ scrollTop: $('.msgs').prop("scrollHeight")}, 1000);
                   const msgSound = new Audio("https://backend.smartvision4p.com/faskhaNinja/public/sounds/mixkit-long-pop-2358.wav");
                    msgSound.play();
        
  }  )
    .catch(error => console.error('Error sending message:', error));
      sortUsersByLastMessage();
}

// Function to get messages from Firestore using REST API
function getMessages() {
    if(window.user2 !== ''){
        $("#chat").show();
        // console.log("MESSAGES_URL" + MESSAGES_URL);
        const MESSAGES_URL1 = `${FIREBASE_BASE_URL}/DashboardChat/${window.CHATROOM_ID}/messages`;
        // console.log(MESSAGES_URL1);
        // console.log()
        fetch(`${MESSAGES_URL1}?orderBy=timestamp`)
            .then(response => response.json())
            .then(data => {
                const messagesList = document.getElementById('messages');
                const msgCount = document.querySelectorAll('#messages li.msg-item');
                // مسح الرسائل الحالية
                let previousDate = null; // لتخزين التاريخ السابق
                // && (data.documents.length > msgCount.length )كانت هناك وثائق، قم بعرضها
            //   console.log(data.documents,data.documents.length,msgCount.length)
               if (data.documents ) {
                   if( (data.documents.length > msgCount.length ) || window.user2 != window.old_user){
                    messagesList.innerHTML = '';
                    data.documents.forEach(doc => {
                        const message = doc.fields.message.stringValue;
                        const user = doc.fields.sender_name.stringValue;
                        const user_id = doc.fields.sender_id.stringValue;
                        const dateObj = new Date(doc.fields.timestamp.timestampValue);
                        const day = dateObj.getDate();
                        const month = dateObj.getMonth() + 1;
                        const year = dateObj.getFullYear();
                        const minutes = dateObj.getMinutes();

                        let hour = dateObj.getHours();
                        const ampm = hour >= 12 ? 'PM' : 'AM';
                        hour = hour % 12;
                        hour = hour ? hour : 12; 

                        const currentDate = `${day}/${month}/${year}`; // تحديد التاريخ الحالي
                        const li = document.createElement('li');
                        
                        // إذا كان التاريخ الحالي مختلفًا عن التاريخ السابق، أضف التاريخ
                        if (currentDate !== previousDate) {
                            const dateLi = document.createElement('li');
                            dateLi.classList.add('date-separator');
                            dateLi.innerHTML = `<div class="date">${currentDate}</div>`;
                            messagesList.appendChild(dateLi);
                            previousDate = currentDate; // تحديث التاريخ السابق
                        }
                        
                        const authuserIdd = "{{auth('admin')->user()->id}}";
                        if (user_id == authuserIdd) {
                            li.classList.add('msg-item'); 
                        } else {
                            li.classList.add('msg-item', 'outer'); 
                        }
                        
                        li.innerHTML = `
                        <div class="msg-data">
                            <sub>${hour}:${minutes < 10 ? '0' + minutes : minutes} ${ampm}</sub>
                            <p>${message}</p>
                        </div>`;
                        messagesList.appendChild(li);
                    });
                   
                    
                    console.log('has chat');
                   }
                }
                else{
                  messagesList.innerHTML = ''; 
                  console.log('empty')
                }
            })
            .catch(error => console.error('Error fetching messages:', error));
    }
    // console.log('test 2 sec')
}

// Poll for new messages every 2 seconds to simulate real-time
// setInterval(getMessages, 2000);
// setInterval(getMessages, 60000);
// Adjust polling interval as necessary


// Send message on button click
document.getElementById('send-btn').addEventListener('click', function () {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;
    if (message) {
        sendMessage(message,userIdd,window.user2);
        messageInput.value = ''; // Clear the input
    }
});

document.getElementById('send-form').addEventListener('submit', function (e) {
   event.preventDefault()

    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;
    if (message) {
        sendMessage(message,userIdd,window.user2);
        messageInput.value = ''; // Clear the input
    }
});

// Initial call to load existing messages
// getMessages();


// Step 2: Send notification using FCM REST API
function sendNotificationToReceiver(user2, senderName, message) {
    // console.log(receiverToken);
    axios.post("{{url('/admin/send_chat_notification')}}",{
       user2,message,senderName
    }).then(res=>{
      console.log("success:"+res);
    }).catch(ress=>{
      console.log("cash"+ress);
    })
   
}


// تنفيذ عملية البحث
document.getElementById('userSearchInput').addEventListener('input', function(){
    console.log('search');
    const searchTerm = this.value.toLowerCase(); // النص المدخل وتحويله إلى أحرف صغيرة
    const userListItems = document.querySelectorAll('#userList li'); // جميع عناصر الـ li

    userListItems.forEach(function(item) {
      const username = item.querySelector('h6').innerText.toLowerCase(); // جلب اسم المستخدم من الـ h6 داخل الـ li
      const accountType = item.querySelector('p').innerText.toLowerCase(); // جلب نوع الحساب من الـ p

      // إظهار أو إخفاء العنصر بناءً على التطابق مع النص المدخل
      if (username.includes(searchTerm) || accountType.includes(searchTerm)) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });
});

</script>
<script>
const currentUserId = "{{ auth('admin')->id() }}"; // Replace with actual current user ID

    function sortUsersByLastMessage() {
        console.log("Fetching messages from Firestore...");

        db.collection("DashboardChat")
            .orderBy("lastMessageTimestamp", "desc") // Get latest messages first
            .get()
            .then((querySnapshot) => {
                let userLastMessage = {};

                console.log("Query Snapshot:", querySnapshot);

                querySnapshot.forEach((doc) => {
                    
                    let data = doc.data();
                    console.log("data"+data.users);
                    let sender = data.users[0];
                    let receiver = data.users[1];
                    let timestamp = data.lastMessageTimestamp ? data.lastMessageTimestamp.toDate().getTime() : 0;

                    // console.log(`Message: ${sender} -> ${receiver} at ${timestamp}`);

                    // Store latest message timestamp for each user
                    if (sender !== currentUserId) {
                        userLastMessage[sender] = Math.max(userLastMessage[sender] || 0, timestamp);
                    }
                    if (receiver !== currentUserId) {
                        userLastMessage[receiver] = Math.max(userLastMessage[receiver] || 0, timestamp);
                    }
                });

                console.log("User last message timestamps:", userLastMessage);

                // Sort user list in the DOM
                sortUserList(userLastMessage);
            })
            .catch((error) => console.error("Error fetching messages:", error));
    }
       function sortUserList(userLastMessage) {
        let userList = document.querySelectorAll(".notifi"); // Get all users
        let usersArray = Array.from(userList);

        usersArray.sort((a, b) => {
            let userIdA = a.getAttribute("data-user_id");
            let userIdB = b.getAttribute("data-user_id");

            let lastMessageA = userLastMessage[userIdA] || 0;
            let lastMessageB = userLastMessage[userIdB] || 0;

            // console.log(`Sorting: ${userIdA} (${lastMessageA}) vs ${userIdB} (${lastMessageB})`);

            return lastMessageB - lastMessageA; // Sort descending (latest first)
        });

        let userListContainer = document.getElementById("userList");

        if (userListContainer) {
            userListContainer.innerHTML = ""; // Clear the existing list
            usersArray.forEach(user => userListContainer.appendChild(user)); // Append sorted elements properly
        }

        console.log("✅ User list sorted!");
    }
document.addEventListener("DOMContentLoaded", function () {
    

 

    sortUsersByLastMessage();
});
</script>




@endpush
