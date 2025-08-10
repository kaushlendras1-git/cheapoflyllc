// Import Firebase scripts needed for messaging
importScripts('https://www.gstatic.com/firebasejs/11.9.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/11.9.1/firebase-messaging-compat.js');

// Your Firebase config - use same config as in firebase.js
firebase.initializeApp({
    apiKey: "AIzaSyD3KlenxZlDJ-XTLma2XeqknFQ5YitZACM",
    authDomain: "upboardresult-2021.firebaseapp.com",
    projectId: "upboardresult-2021",
    storageBucket: "upboardresult-2021.firebasestorage.app",
    messagingSenderId: "664248065943",
    appId: "1:664248065943:web:91bdfc3ae5c90322cd2ed2",
    measurementId: "G-2PV84M8LZZ"
});

const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/your-icon.png' // customize this to your app's icon
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
