import "../../node_modules/@shoelace-style/shoelace/dist/components/icon/icon.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/button/button.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/input/input.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/progress-bar/progress-bar.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/select/select.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/option/option.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/spinner/spinner.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/icon-button/icon-button.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/copy-button/copy-button.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/alert/alert.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/dialog/dialog.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/qr-code/qr-code.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/switch/switch.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/details/details.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/badge/badge.js";
import "../../node_modules/@shoelace-style/shoelace/dist/components/skeleton/skeleton.js";

import { setBasePath } from "../../node_modules/@shoelace-style/shoelace/dist/utilities/base-path.js";
setBasePath("/");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
