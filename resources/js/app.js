
require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios');

import AppComponent from './components/AppComponent';

window.TriggerEventBus = new Vue();

const app = new Vue({
    el: '#app',
    components: {AppComponent},
    template: `<AppComponent/>`
});
