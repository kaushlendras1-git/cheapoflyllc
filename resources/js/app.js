import './bootstrap';

import { requestFirebaseToken, onMessageListener } from '@/firebase';

// register service worker (so the SW file at /firebase-messaging-sw.js is active)
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/firebase-messaging-sw.js')
    .then((registration) => {
      console.log('SW registered:', registration.scope);
    })
    .catch((err) => console.error('SW registration failed:', err));
}

// Example: enable push with a button
document.getElementById('enable-push')?.addEventListener('click', async () => {
  try {
    const token = await requestFirebaseToken();
    console.log('FCM token:', token);

    // send token to your Laravel backend to store (include CSRF token)
    await fetch('/fcm/token', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({ token }),
    });
    alert('Push enabled');
  } catch (e) {
    console.error(e);
    alert('Could not enable push: ' + e.message);
  }
});

// Example: foreground handler — show toast / UI
onMessageListener((payload) => {
  // make a toast or custom UI — payload.notification has title/body
  console.log('Foreground message', payload);
  // e.g. dispatch to your app: window.dispatchEvent(new CustomEvent('fcm-message', {detail: payload}));
});