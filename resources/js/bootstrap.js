import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
if (import.meta.env.VITE_BROADCAST_DRIVER !== 'pusher') {
    window.Echo = new Echo({
        broadcaster: import.meta.env.VITE_BROADCAST_DRIVER,
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        wsHost: window.location.hostname,
        wsPort: 6001,
        wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
        disableStats: false,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    });
}
else{
    window.Echo = new Echo({
        broadcaster: import.meta.env.VITE_BROADCAST_DRIVER,
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        forceTLS: true,
        encrypted: true,
    });
}

console.log('bootstrap.js loaded');
