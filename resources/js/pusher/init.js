import Echo from "laravel-echo";

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '80884cb5a946a09d4957',
    cluster: 'us2'/*,
    forceTLS: true*/
});
