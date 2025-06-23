<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyD3KlenxZlDJ-XTLma2XeqknFQ5YitZACM",
    authDomain: "upboardresult-2021.firebaseapp.com",
    projectId: "upboardresult-2021",
    storageBucket: "upboardresult-2021.firebasestorage.app",
    messagingSenderId: "664248065943",
    appId: "1:664248065943:web:91bdfc3ae5c90322cd2ed2",
    measurementId: "G-2PV84M8LZZ"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  async function requestPermission() {
  try {
    await Notification.requestPermission();
    const token = await getToken(messaging, { vapidKey: "BCnieCjmnIlO-rKUW4-TqDE4X76wh6bbT80riWliU_axQW8fTXc1EsB-oCegYH4-l1Tl1x3X56j_VtmfZ1kKgpM" });
    console.log("FCM Token:", token);

    // Send the token to your server
    await fetch('/update-device-token', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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

</script>
