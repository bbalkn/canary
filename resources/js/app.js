require('./bootstrap');

window.Vue = require('vue');

Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('timeline-component', require('./components/TimelineComponent.vue').default);

let app;
app = new Vue({
    el: '#app'
});