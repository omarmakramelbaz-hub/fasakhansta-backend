importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-messaging.js');

const firebaseConfig = {
    apiKey: "AIzaSyB0KKM-Dm-7wOk-S3zLkBAjMn8Z4JL9snA",
    authDomain: "faskhaninja.firebaseapp.com",
    projectId: "faskhaninja",
    storageBucket: "faskhaninja.appspot.com",
    messagingSenderId: "547950781924",
    appId: "1:547950781924:web:7511c8e2cc79e2cc28d3f1",
    measurementId: "G-2BN39RQZDR"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
self.addEventListener('push', function (event) {
    const payload = event.data ? event.data.json() : {};

    const options = {
        body: payload.notification.body,
        icon: payload.data.icon || '{{url("/storage/".app(App\Models\GeneralSettings::class)->logo)}}',
        vibrate: [1000, 200, 1000, 200, 1000],
        silent: false,
        data: {
            click_action: payload.data.click_action || '{{url("/")}}',
        },
    };

   
    // event.waitUntil(
    //     self.registration.showNotification(payload.notification.title, options).then(() => {
    //         return self.clients.matchAll({ type: 'window', includeUncontrolled: true }).then((clients) => {
    //             if (clients.length > 0) {
    //                 // If a client exists, post the message to play audio and handle the click action
    //                 const client = clients[0];

    //                 // Send a message to the client to play audio and handle the click action
    //                 client.postMessage({
    //                     type: 'play-audio-loop',
    //                     click_action: options.data.click_action,
    //                 });

    //                 // Attempt to focus the client
    //                 try {
    //                     client.focus();  // Focus the existing window
    //                     return client.navigate(options.data.click_action); // Navigate if needed
    //                 } catch (err) {
    //                     console.error('Focus failed:', err);
    //                 }
    //             } else {
    //                 // No client exists, open a new window
    //                 const newWindow = self.clients.openWindow(options.data.click_action);
    //                 if (newWindow) {
    //                     // Focus the new window
    //                     newWindow.then((window) => {
    //                         if (window) {
    //                             window.focus();  // Focus the newly opened window
    //                             console.log('New window focused.');

    //                             // Play audio in the new window
    //                             const audioElement = window.document.createElement('audio');
    //                             audioElement.src = options.data.audio_url || 'default_audio_url'; // Provide your audio URL
    //                             audioElement.autoplay = true; // Automatically play the audio
    //                             window.document.body.appendChild(audioElement); // Append audio to the body
    //                             console.log('Audio is playing in the new window.');
    //                         }
    //                     });
    //                 }
    //             }
    //         });
    //     }).catch((err) => {
    //         console.error('Error handling push event:', err);
    //     })
    // );
    //   event.waitUntil(
    //   //     // Show the notification
    //     self.registration.showNotification(payload.notification.title, options).then(() => {
    //         return self.clients.matchAll({ type: 'window', includeUncontrolled: true }).then((clients) => {
    //             if (clients.length > 0) {
    //                 // If a client exists, focus it and optionally navigate
    //                 const client = clients[0];
    //                  // Send a message to the main thread
    //                 client.postMessage({
    //                     type: 'play-audio-loop',
    //                     click_action: options.data.click_action,
    //                 });
                     
    //                 return client.focus().then(() => {
    //                     return client.navigate(options.data.click_action);
    //                 });
    //             } else {
    //                 // No client exists, attempt to open a new window
    //                 return self.clients.openWindow(options.data.click_action);
    //             }
    //         });
    //     }).catch((err) => {
    //         console.error('Error handling push event:', err);
    //     })
    // );

event.waitUntil(
        self.registration.showNotification(payload.notification.title, options)
    );

});

self.addEventListener('notificationclick', function (event) {
    console.log('Notification clicked:', event.notification.data);
    event.notification.close();

    const clickAction = event.notification.data.click_action || '/';
    event.waitUntil(
        clients.openWindow(clickAction)
    );
});

