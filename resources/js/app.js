
require('./bootstrap');
import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import VuePlyr from 'vue-plyr';
import 'vue-plyr/dist/vue-plyr.css';

Vue.use(Vuetify);
Vue.use(VuePlyr, {
    plyr: {}
})
import Swal from 'sweetalert2';

import Axios from 'axios';
var $ = window.jQuery;
const files = require.context('./components/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


// require('alpinejs');


const app = new Vue({
    el: '#chat',
});

