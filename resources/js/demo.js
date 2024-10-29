
require('./bootstrap');

window.Vue = require('vue').default;

const oxygenstyles = [
	'oxygen-css',
	'oxygen-universal-styles-css'
].forEach(element => {
	var sheet = document.getElementById(element);
	sheet.disabled = true;
	sheet.parentNode.removeChild(sheet);
});

Vue.component('asura-demo', require('./components/User/Demo.vue').default);

const app = new Vue({
	el: '#app',
});