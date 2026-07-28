import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging.js";
const firebaseConfig = {
    apiKey: "AIzaSyCXd5OLKdIutyA4qsidhBwQCRJt3SsFHEE",

  authDomain: "fasakhaninjatest.firebaseapp.com",

  projectId: "fasakhaninjatest",

  storageBucket: "fasakhaninjatest.firebasestorage.app",

  messagingSenderId: "224648167390",

  appId: "1:224648167390:web:13c997f338325b4b56274f",

  measurementId: "G-ECZ1880953"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Ask for permission
export function requestNotificationPermission() {
    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            getToken(messaging, { vapidKey: 'BCQ4Essgps5zSojP4_gZVOYxiujNYCClxiFZ9wjI7qAnXMg1JWYcNcTi6h3OIP5DWgNZVz69gjT-datbauWD7PU' }).then(token => {
                if (token) {
                    // Send token to Laravel backend
                    axios.post('/admin/save-token', {
                        token,
                        user_id: "{{ auth('admin')->id() }}"
                    });
                }
            });
        }
    });
}

// Foreground messages (when tab is open)
onMessage(messaging, payload => {
    console.log('Foreground message:', payload);

    const notification = payload.notification;
    const audio = new Audio('{{ url("/") }}/sounds/mixkit-correct-answer-reward-952.wav');
    audio.loop = true;
    audio.play();

    new Notification(notification.title, {
        body: notification.body,
        icon: notification.image,
        data: { click_action: payload.fcmOptions?.link }
    });
});
