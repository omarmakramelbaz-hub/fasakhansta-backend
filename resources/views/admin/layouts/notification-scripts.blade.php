@push('scripts')
<script>
// Check if service workers are supported
if ('serviceWorker' in navigator) {
    // Register the service worker
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('{{ asset('notify-sw.js') }}')
            .then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
                
                // Request notification permission
                if (Notification.permission !== 'granted') {
                    Notification.requestPermission().then(function(permission) {
                        if (permission === 'granted') {
                            console.log('Notification permission granted.');
                        }
                    });
                }
                
                // Listen for messages from the service worker
                navigator.serviceWorker.addEventListener('message', event => {
                    if (event.data && event.data.type === 'PLAY_SOUND') {
                        // Play notification sound
                        const audio = new Audio('{{ asset('sounds/notification.mp3') }}');
                        audio.play().catch(e => console.log('Audio playback failed:', e));
                    }
                });
                
                // Function to show a test notification
                window.showTestNotification = function() {
                    if (navigator.serviceWorker.controller) {
                        navigator.serviceWorker.controller.postMessage({
                            type: 'SHOW_TEST_NOTIFICATION'
                        });
                    }
                };
                
            }).catch(function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
    });
    
    // Function to request notification permission
    window.requestNotificationPermission = function() {
        return new Promise((resolve, reject) => {
            if (!('Notification' in window)) {
                reject('This browser does not support desktop notification');
            } else if (Notification.permission === 'granted') {
                resolve('granted');
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(permission => {
                    resolve(permission);
                });
            } else {
                reject('Notification permission denied');
            }
        });
    };
    
    // Function to show a custom notification
    window.showNotification = function(title, options = {}) {
        if (navigator.serviceWorker.controller) {
            navigator.serviceWorker.controller.postMessage({
                type: 'SHOW_NOTIFICATION',
                title: title,
                options: {
                    body: options.body || '',
                    icon: options.icon || '{{ asset('storage/app/logo.png') }}',
                    data: { 
                        click_action: options.url || '/',
                        ...options.data
                    },
                    ...options
                }
            });
        } else if (Notification.permission === 'granted') {
            // Fallback to regular notifications if service worker isn't ready
            const notification = new Notification(title, {
                icon: options.icon || '{{ asset('storage/app/logo.png') }}',
                body: options.body,
                data: { 
                    click_action: options.url || '/',
                    ...options.data
                },
                ...options
            });
            
            notification.onclick = function(event) {
                event.preventDefault();
                window.focus();
                if (options.url) {
                    window.open(options.url, '_blank');
                }
                notification.close();
            };
        }
    };
}
</script>
@endpush
