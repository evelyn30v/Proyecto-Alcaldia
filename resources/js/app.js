

require('./bootstrap');

window.Vue = require('vue');


Vue.component('app', require('./components/AppComponent.vue').default);
Vue.component("Bienvenido", require("./pages/login/Bienvenido.vue").default);
Vue.component("panel_a", require("./pages/panel_a/Menu.vue").default);
Vue.component("panel_c", require("./pages/panel_c/MenuC.vue").default);
Vue.component("admin", require("./pages/Admin/MenuAdmin.vue").default);

import router from "./routes"   

import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

const app = new Vue({
    el: '#app',
    router
});
