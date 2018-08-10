import Home from './components/Home.vue';
import About from './components/About.vue';
import Scanner from './components/Scanner.vue';
import Generator from './components/Generator.vue';
export const routes = [
	{
		path:'/',
		component: Home,
	},
	{
		path:'/about',
		component: About,
	},
	{
		path:'/scan',
		component: Scanner,
	},
	{
		path:'/generator',
		component: Generator,
	}
];