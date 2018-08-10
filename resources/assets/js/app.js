require('./bootstrap');

window.Vue = require('vue');
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import { routes } from './routes'
import App from './components/App.vue'

Vue.use(VueRouter)
Vue.use(Vuetify,{	
	theme: {
	  aqua: '#1adda4',
	  secondary: '#b0bec5',
	  accent: '#8c9eff',
	  error: '#b71c1c'
	}
})

const router = new VueRouter({
	routes,
	mode:'history'
});


const app = new Vue({
	router,
    el: '#app',
    components:{
    	App
    }
});
