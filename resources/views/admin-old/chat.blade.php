@extends('admin.index')
@push('custom-css')
<style>
      #chat { max-width: 600px; margin: 0 auto; padding: 10px; }
        #messages { border: 1px solid #ccc; height: 300px; overflow-y: scroll; padding: 10px; }
        #message-input { width: calc(100% - 60px); padding: 10px; }
        #send-btn { width: 50px; padding: 10px; }
</style>
@endpush
@section('content')

    <span class="top"></span>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row w-100 mb-2">
           <ul id="chatroom-list"></ul>
            <div id="chat">
                <ul id="messages"></ul>
                <input type="text" id="message-input" placeholder="Type a message">
                <button id="send-btn">Send</button>
            </div>
        </div>
     </div>
    </div>

</div>
 <!--<script src="{{ url('/chat') }}/jquery-3.4.1.min.js"></script>-->
 <!--   <script src="{{ url('/chat') }}/popper-1.14.7.min.js"></script>-->
 <!--   <script src="{{ url('/chat') }}/bootstrap-4.3.1.min.js"></script>-->
   
  <!--<script src="https://www.gstatic.com/firebasejs/7.9.3/firebase.js"></script>-->
  <!--  <script src="{{ url('/chat') }}/firebase-messaging.js"></script>-->
  <!--  <script src="{{ url('/chat') }}/firebase.init.js"></script>-->
  <!--  <script src="{{ url('/') }}/chat/chat.js"></script>-->
    
@endsection
@push('custom-js')

<script>
const FIREBASE_PROJECT_ID = 'faskhaninja';
const FIREBASE_BASE_URL = `https://firestore.googleapis.com/v1/projects/${FIREBASE_PROJECT_ID}/databases/(default)/documents`;
const CHATROOMS_URL = `${FIREBASE_BASE_URL}/DashboardChat`;

// Fetch existing chatrooms from Firestore
function getChatrooms() {
    console.log('Fetching chatrooms');
    fetch(CHATROOMS_URL)
        .then(response => {
            console.log('Response:', response); // Log the response
            return response.json(); // Parse JSON
        })
        .then(data => {
            console.log('Data:', data); // Log the data received

            const chatroomList = document.getElementById('chatroom-list');
            chatroomList.innerHTML = ''; // Clear current list

            if (data.documents) {
                data.documents.forEach(doc => {
                    const chatroomId = doc.name.split('/').pop(); // Extract room ID
                    const li = document.createElement('li');
                    li.textContent = chatroomId;
                    li.onclick = () => joinChatroom(chatroomId); // Click to join
                    chatroomList.appendChild(li);
                });
            } else {
                console.log('No documents found');
            }
        })
        .catch(error => console.error('Error fetching chatrooms:', error));
}


function joinChatroom(roomId) {
    console.log('Joining chatroom:', roomId);
    // Set room ID globally and start chatting
    window.CHATROOM_ID = roomId;
    // Call your chat functionality here (send/receive messages)
}




getChatrooms();

function generateRoomId(user1, user2) {
    const sortedUsers = [user1, user2].sort(); // Sort to ensure consistency
    console.log("generateRoomId"+sortedUsers)
    return `room_${sortedUsers.join('_')}`;
}

const userId = "14";
const user2 = "1";



        // Firestore paths
        const CHATROOM_ID = generateRoomId(userId, user2); // Replace with your chatroom ID
        const MESSAGES_URL = `${FIREBASE_BASE_URL}/DashboardChat/${CHATROOM_ID}/messages`;

        // User ID (just an example, you might want to implement authentication)

        // Function to send a message to Firestore using REST API
        function sendMessage(message,userId,user2) {
            const timestamp = new Date().toISOString();
            const messageData = {
                fields: {
                    message: { stringValue: message },
                    sender_id:{ stringValue: userId } ,
                    user_id:{ stringValue: user2 },
                     timestamp: { timestampValue: timestamp }
                }
            };

            // Make a POST request to Firestore
            fetch(MESSAGES_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(messageData)
            }).then(response => response.json())
            .then(data => console.log('Message sent:', data))
            .catch(error => console.error('Error sending message:', error));
        }

        // Function to get messages from Firestore using REST API
        function getMessages() {
            fetch(`${MESSAGES_URL}?orderBy=timestamp`)
                .then(response => response.json())
                .then(data => {
                    const messagesList = document.getElementById('messages');
                    messagesList.innerHTML = ''; // Clear the current messages

                    // If there are documents, display them
                    if (data.documents) {
                        data.documents.forEach(doc => {
                            const message = doc.fields.message.stringValue;
                            const user = doc.fields.sender_id.stringValue;
                            const li = document.createElement('li');
                            li.textContent = `${user}: ${message}`;
                            messagesList.appendChild(li);
                        });
                    }
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        // Poll for new messages every 2 seconds to simulate real-time
        setInterval(getMessages, 2000); // Adjust polling interval as necessary

        // Send message on button click
        document.getElementById('send-btn').addEventListener('click', function () {
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value;
            if (message) {
                sendMessage(message,userId,user2);
                messageInput.value = ''; // Clear the input
            }
        });

        // Initial call to load existing messages
        getMessages();
</script>



@endpush
