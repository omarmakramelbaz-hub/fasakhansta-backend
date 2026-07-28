importScripts('https://www.gstatic.com/firebasejs/9.17.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging-compat.js');

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

// ❗ FIX HERE — initialize Firebase in the SW
firebase.initializeApp(firebaseConfig);

// Get messaging instance
const messaging = firebase.messaging();

// Background push handler
messaging.onBackgroundMessage(payload => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);

  const notificationTitle = payload.notification?.title || 'New Notification';
  const notificationOptions = {
    body: payload.notification?.body || '',
    icon: payload.notification?.image || '/icon.png',
    vibrate: [200, 100, 200],
    data: {
      click_action: payload.fcmOptions?.link || '/'
    }
  };

  self.registration.showNotification(notificationTitle, notificationOptions);

  // Send command to tabs to play sound
  self.playSound();
});

// Notification click handler
self.addEventListener('notificationclick', event => {
  event.notification.close();

  const clickAction = event.notification.data.click_action || '/';
  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(windowClients => {
      for (let client of windowClients) {
        if (client.url === clickAction && client.focus) {
          return client.focus();
        }
      }
      return clients.openWindow(clickAction);
    })
  );
});

// Send PLAY_SOUND message to all windows
self.playSound = function () {
  self.clients.matchAll({ includeUncontrolled: true, type: 'window' }).then(clients => {
    for (const client of clients) {
      client.postMessage({ type: 'PLAY_SOUND' });
    }
  });
};
