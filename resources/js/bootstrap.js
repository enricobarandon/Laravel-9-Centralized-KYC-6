window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.swal = require('sweetalert')

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

// window.io = require('socket.io-client');
window.io = require('./socket.io');
console.log(window.io);

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.echohost + ":" + window.echoport,
    transports: ['websocket']
});