
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when 
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('just-message-component', require('./components/JustMessageComponent.vue'));
Vue.component('vbind-component', require('./components/VbindComponent.vue'));
Vue.component('vif-component', require('./components/VifComponent.vue'));
Vue.component('vfor-component', require('./components/VforComponent.vue'));
Vue.component('von-component', require('./components/VonComponent.vue'));
Vue.component('vmodel-component', require('./components/VmodelComponent.vue'));
Vue.component('spinner-component', require('./components/SpinnerComponent.vue'));


//const app = new Vue({
//    el: '#app'
//});

var mesg = new Vue ({
    el: '#mesg'
});

var vbind = new Vue({
    el: '#vbind'
});

var vif = new Vue({
    el: '#vif'
});

var vfor = new Vue({
    el: '#vfor'
});

var von = new Vue({
    el: '#von'
});

var vmodel = new Vue({
    el: '#vmodel'
});

var vspinner = new Vue({
    el: '#vspinner'
});

