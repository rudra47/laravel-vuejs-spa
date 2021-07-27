require('./bootstrap');
import Vue from "vue";
import Routes from "./routes/index";
import CxltToastr from 'cxlt-vue2-toastr';
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css';
import store from './store';

// import { Form, HasError, AlertError } from 'vform'

// Vue.component(HasError.name, HasError)
// Vue.component(AlertError.name, AlertError)

//TOASTER CONFIGURATION START
var toastrConfigs = {
    position: 'top right',
    showDuration: 1000,
    timeOut: 5000,
    closeButton: true,
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
}
Vue.use(CxltToastr, toastrConfigs)
//END

Vue.component('app-header', require('./components/Header.vue').default);

let auth = localStorage.getItem("auth");
if(auth){
    store.dispatch('authUser').then(() => {
        new Vue({
            el: '#app',
            router: Routes,
            store,
        });
    });
}else {
    new Vue({
        el: '#app',
        router: Routes,
        store,
    });
}

