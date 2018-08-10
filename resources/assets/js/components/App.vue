<template>
	<v-app>
		<Navbar/>
		<router-view></router-view>
<v-footer class="pa-3"> <div>
Coded with Love In Loyal Developers by <v-icon>fa-user-secret</v-icon>LanwilDS
</div> </v-footer>
	</v-app>
</template>
<script>
import Navbar from './Navbar.vue';
export default{
	name:'App',
	components:{
		Navbar
	}
}
</script>