require('./bootstrap');

window.Vue = require('vue').default;
import Toasted from 'vue-toasted';
import dayjs from 'dayjs';

Vue.mixin({ methods: { route, dayjs }});
Vue.use(Toasted, {
    position: 'top-right',
    keepOnHover: true,
    duration: 3500,
    theme: 'statamic',
    action: {
        text: '×',
        onClick: (e, toastObject) => {
            toastObject.goAway(0);
        }
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin-api-index', require('./components/Admin/Api/Index.vue').default);
Vue.component('admin-generator-index', require('./components/Admin/Generator/Index.vue').default);
Vue.component('admin-license-index', require('./components/Admin/License/Index.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        darkMode: false
    },
    mounted() {
        // this.darkMode = (JSON.parse(localStorage.darkMode) == true || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) ? true : false;
    },
    watch: {
        darkMode(newValue) {
            localStorage.darkMode = newValue;
        }
    }
});
