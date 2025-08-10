import './bootstrap';
import '../js/firebase.js';
// import { requestFirebaseToken, onMessageListener } from '@/firebase';
// if ('serviceWorker' in navigator) {
//   navigator.serviceWorker.register('/firebase-messaging-sw.js')
//     .then((registration) => {
//       console.log('SW registered:', registration.scope);
//     })
//     .catch((err) => console.error('SW registration failed:', err));
// }
// document.getElementById('enable-push')?.addEventListener('click', async () => {
//   try {
//     const token = await requestFirebaseToken();
//     console.log('FCM token:', token);
//     await fetch('/fcm/token', {
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json',
//         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//       },
//       body: JSON.stringify({ token }),
//     });
//     alert('Push enabled');
//   } catch (e) {
//     console.error(e);
//     alert('Could not enable push: ' + e.message);
//   }
// });
//
// onMessageListener((payload) => {
//   console.log('Foreground message', payload);
// });
