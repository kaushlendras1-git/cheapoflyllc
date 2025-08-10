import { initializeApp } from 'firebase/app';
import { getMessaging, getToken, onMessage } from 'firebase/messaging';

// Build config from Vite envs
const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
  projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
  storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
  messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
  appId: import.meta.env.VITE_FIREBASE_APP_ID,
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Request permission + get token (returns token string)
export async function requestFirebaseToken() {
  if (!('Notification' in window)) {
    throw new Error('This browser does not support notifications.');
  }

  const permission = await Notification.requestPermission();
  if (permission !== 'granted') {
    throw new Error('Notification permission not granted.');
  }

  const vapidKey = import.meta.env.VITE_FIREBASE_VAPID_KEY;
  // getToken will auto-register / use / expect /firebase-messaging-sw.js at root
  const token = await getToken(messaging, { vapidKey });
  return token;
}

// foreground message handler helper
export function onMessageListener(callback) {
  onMessage(messaging, (payload) => callback(payload));
}

export default app;
