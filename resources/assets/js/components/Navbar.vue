<template>
	<div>
		<v-toolbar dark color="blue">
		    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

		    <v-toolbar-title class="white--text">QR code Generator v1.0.1</v-toolbar-title>

		    <v-spacer></v-spacer>
		    <v-toolbar-items class="hidden-sm-and-down">
		      <v-btn flat @click="$router.push({path:'/'})"><v-icon>fa-home </v-icon>&nbsp; Home</v-btn>
		      <v-btn flat @click="gotoGit"><v-icon>fa-github </v-icon>&nbsp; GitHub</v-btn>
		      <v-btn flat @click="$router.push({path:'/about'})"><v-icon>fa-user-secret</v-icon> Who we are?</v-btn>
		      
		    </v-toolbar-items>
		</v-toolbar>
		<v-navigation-drawer
		      v-model="drawer"
		      absolute
		      temporary
		    >
		      <v-list class="pa-1">
		        <v-list-tile avatar>
		          <v-list-tile-avatar>
		            <img src="https://www.unitag.io/images/generator/templates/classic.png">
		          </v-list-tile-avatar>

		          <v-list-tile-content>
		            <v-list-tile-title>QR Generator</v-list-tile-title>
		          </v-list-tile-content>
		        </v-list-tile>
		      </v-list>

		      <v-list class="pt-0" dense>
		        <v-divider></v-divider>

		        <v-list-tile
		          v-for="item in items"
		          :key="item.title"
		          @click="$router.push({path:item.link})"
		        >
		          <v-list-tile-action>
		            <v-icon>{{ item.icon }}</v-icon>
		          </v-list-tile-action>

		          <v-list-tile-content>
		            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
		          </v-list-tile-content>
		        </v-list-tile>
		        <v-list-tile
		          @click="gotoGit"
		        >
		          <v-list-tile-action>
		            <v-icon>fa-github</v-icon>
		          </v-list-tile-action>

		          <v-list-tile-content>
		            <v-list-tile-title>Github</v-list-tile-title>
		          </v-list-tile-content>
		        </v-list-tile>
		      </v-list>
		    </v-navigation-drawer>
	</div>
</template>
<script>
	export default {
		name:'Navbar',
		data () {
		  return {
		    drawer: null,
		    items: [
		      { title: 'Home', icon: 'fa-home',link:'/' },
		      { title: 'Who we are?', icon: 'fa-user-secret',link:'/about' }
		    ]
		  }
		},
		methods:{
			gotoGit(){
				window.open('http://www.github.com/lanwilds', '_blank');
			}
		}
	}
</script>