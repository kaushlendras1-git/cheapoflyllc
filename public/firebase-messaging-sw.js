// public/firebase-messaging-sw.js
// use the compat bundle in the SW (no bundling needed)
importScripts('https://www.gstatic.com/firebasejs/12.1.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/12.1.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyDK2Sjg3wPaUY5fnqy8otPrqRLuoen9kqc",
  authDomain: "push-notifications-9df48.firebaseapp.com",
  projectId: "push-notifications-9df48",
  storageBucket: "push-notifications-9df48.firebasestorage.app",
  messagingSenderId: "651497784304",
  appId: "1:651497784304:web:41f1fe4a7fde06a3251335"
});

const messaging = firebase.messaging();

// optional: customize background notifications
messaging.onBackgroundMessage(function(payload) {
  const title = payload.notification?.title || 'Background notification';
  const options = {
    body: payload.notification?.body,
    icon: payload.notification?.icon || '/favicon.ico',
    data: payload.data || {}
  };
  self.registration.showNotification(title, options);
});
