
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging.js";
// For Firebase JS SDK v7.20.0 and later, measurementId is optional

// For Firebase JS SDK v7.20.0 and later, measurementId is optional

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

Notification.requestPermission().then(async (permission) => {
  if (permission === "granted") {
    const token = await getToken(messaging, {
      vapidKey: "BOsvF-qrgKBbCcc9XPWKeiRq6wUjwP55dU2JqoefuLBICbofvTdkltQceX6y6ASyteZ4tLC6tHdnLOx6NGF1oZA",
    });
    console.log("FCM Token wwww:", token);
    document.getElementById('token').innerText = token;
  } else {
    alert("Notifications permission denied");
  }
});

// Play sound for foreground messages
let alertAudio = null;

onMessage(messaging, (payload) => {
  console.log("Message received: ", payload);

  alertAudio = new Audio('/sounds/mixkit-correct-answer-reward-952.wav');
  alertAudio.loop = true;
  alertAudio.play().catch(err => console.log('Autoplay blocked', err));

  // Show a browser notification manually
  new Notification(payload.notification.title, {
    body: payload.notification.body,
    icon: '/icons/icon-192x192.png',
  });
});

document.getElementById('stop-sound').addEventListener('click', () => {
  if (alertAudio) {
    alertAudio.pause();
    alertAudio.currentTime = 0;
  }
});

