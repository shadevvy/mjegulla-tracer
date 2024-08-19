import axios from 'axios';
import Echo from 'laravel-echo'; // Add missing import statement
import io from 'socket.io-client';

window.io = io;
console.log('Echo:', Echo); // Check if Echo is loaded correctly
console.log('Socket.io:', window.io); // Check if Socket.io is loaded
window.io = io;

function initializeEcho() {
    console.log("Initializing Echo...");
    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: window.location.hostname + ':6001',
        forceTLS: false,
        disableStats: true,
        transports: ['websocket'],
    });

    console.log('Echo initialized:', window.Echo);  // Echo should be defined now
}

// Check if Vite is already connected
window.addEventListener('vite:connected', () => {
    console.log("[vite] connected. Initializing Echo...");
    initializeEcho();
});

// Check if Vite has already connected
if (window.__vite_ping) {
    console.log("[vite] already connected. Initializing Echo...");
    initializeEcho();
} else {
    console.log("Echo not initialized yet");
}
// Initialize Echo with Socket.io
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001',  // Adjust the port if necessary
//     forceTLS: false,
//     disableStats: true,
//     client: io,
//     transports: ['websocket'],
//     extraHeaders: {
//         'Access-Control-Allow-Origin': '*'
//     }
// });
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */


console.log('Echo ####:', Echo); // Check if Echo is loaded correctly
console.log('Socket.io:', window.io); // Check if Socket.io is loaded
