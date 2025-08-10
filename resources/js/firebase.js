import { initializeApp } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-analytics.js";
import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-messaging.js";

const firebaseConfig = {
    apiKey: "AIzaSyD3KlenxZlDJ-XTLma2XeqknFQ5YitZACM",
    authDomain: "upboardresult-2021.firebaseapp.com",
    projectId: "upboardresult-2021",
    storageBucket: "upboardresult-2021.firebasestorage.app",
    messagingSenderId: "664248065943",
    appId: "1:664248065943:web:91bdfc3ae5c90322cd2ed2",
    measurementId: "G-2PV84M8LZZ"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);

async function requestPermission() {
    try {
        const permission = await Notification.requestPermission();
        if (permission !== 'granted') {
            console.warn('Notification permission not granted.');
            return;
        }

        const token = await getToken(messaging, {
            vapidKey: "BCnieCjmnIlO-rKUW4-TqDE4X76wh6bbT80riWliU_axQW8fTXc1EsB-oCegYH4-l1Tl1x3X56j_VtmfZ1kKgpM"
        });
        console.log("FCM Token:", token);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        await fetch('/update-device-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ device_token: token })
        });

    } catch (error) {
        console.error("Error while fetching token:", error);
    }
}

requestPermission();

onMessage(messaging, (payload) => {
    console.log("Message received:", payload);
    alert(`Notification: ${payload.notification.title}\n${payload.notification.body}`);
});
