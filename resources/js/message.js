import Echo from "laravel-echo";
// import config from "laravel-mix/src/config";
// import '../bootstrap';

window.Pusher = require('pusher-js');

const client = new Pusher(window?.config?.pusher || '2ef15825b3bbbcc151d7', {
  enabledTransports: ['ws'],
  wsHost: window.location.hostname,
  useTLS: false,
  forceTLS: false,
  wsPort: 6001,
  disableStats: true,
  authEndpoint: config.authEndpoint,
});
window.echo = new Echo({
  broadcaster: 'pusher',
  client,
});
