<template>
	<v-container>
	<v-layout row wrap>
	  <v-flex xs12 sm12>
	    <v-card>
	      <v-card-title primary-title>
	        <div>
	          <h3 class="headline">QR Code Generator</h3>
	          <div>
	          	<v-select
	          	    :items="items"
	          	    label="Generate QR Code for"
	          	    v-model="item"
	          	>
	          	</v-select>
	          </div>
	        </div>
	      </v-card-title>
	      <v-container>
	      	<template v-if="item == 'Text'">
	      		<v-flex sm14>
	      			  <v-text-field
	      			    v-model="textField"
	      			    :rules="textRules"
	      			    :counter="100"
	      			    label="Enter Text"
	      			    required
	      			    v-if="switcher"
	      			    @keyup="generateQrCode"
	      			  ></v-text-field>
	      			  <v-text-field
	      			    v-model="textField"
	      			    :rules="textRules"
	      			    :counter="100"
	      			    label="Enter Text"
	      			    required
	      			    v-if="!switcher"
	      			  ></v-text-field>
	      			  <v-switch @change="clearImage" :label="synch" color="primary" v-model="switcher"></v-switch>
	      			  <v-btn color="red white--text" @click="clearAll">Reset</v-btn>
	      		</v-flex>
	      	</template>
	      	<template v-else-if="item == 'URL'">
	      		<v-flex sm14>
	      			  <v-text-field
	      			    v-model="url"
	      			    :rules="urlRules"
	      			    label="Enter URL"
	      			    required
	      			    v-if="switcher"
	      			    @keyup="generateQrCode"
	      			  ></v-text-field>
	      			  <v-text-field
	      			    v-model="url"
	      			    :rules="urlRules"
	      			    label="Enter URL"
	      			    required
	      			    v-if="!switcher"
	      			  ></v-text-field>
	      			  <v-btn color="red white--text" @click="clearAll">Reset</v-btn>
	      		</v-flex>
	      	</template>

	      	<v-card v-if="(imageLoaded) && (url || textField)">
	      		<template v-if="loading">
	      			<v-progress-circular
	      			  :size="50"
	      			  color="primary"
	      			  indeterminate
	      			  v-if="loading"
	      			  class="ma-2"
	      			></v-progress-circular>
	      		</template>
	      		<template v-else>
	      			<img :src="png" height="250px" width="250px">
	      		</template>

	      	  <v-card-title primary-title>
	      	    <div>
	      	      <h3 class="headline mb-0">QR Code Window</h3>
	      	    </div>
	      	  </v-card-title>
	      	</v-card>

	      </v-container>
	      <v-card-actions >
	        <v-btn  block color="blue white--text" @click="generateQrCode"><v-icon> fa-cogs</v-icon> Generate</v-btn>
	        <v-btn  block color="secondary white--text" @click="$router.push({path:'/'})"><v-icon> fa-arrow-left</v-icon> Back</v-btn>
	      </v-card-actions>
	    </v-card>

	  </v-flex>

	</v-layout>
	</v-container>
</template>
<script>
	export default{
		data(){
			return{
				synch:'Synch',
				valid: false,
				switcher:false,
				     textField: '',
				     textRules: [
				       v => !!v || 'Name is required'
				     ],
				     urlRules:[
				       v => !!v || 'URL field is required'
				     ],
				     item:'',
				     items:['Text','URL'],
				     url:'',
				     imageLoaded:false,
				     loading:false,
				     png:''
			}
		},
		methods:{
			clearAll(){
				this.item = '';
				this.url = '';
				this.imageLoaded = false;
				this.loading = false;
				this.textField = '';
				this.png = '';
			},
			clearImage(){
				this.png = '';
				this.imageLoaded = false;
			},
			generateQrCode(){
				//console.log(this.item+' '+this.url);
				if(this.item){
					if(this.item == 'Text' && this.textField ){
						this.loading = true;
						axios.post('/api/qr-code.png',{
							dataText:this.textField,
							option:this.item
						},{ responseType: 'arraybuffer' })
						.then((response)=>{
							let image = btoa(
							     new Uint8Array(response.data)
							       .reduce((data, byte) => data + String.fromCharCode(byte), '')
							   );

							   this.png = `data:image/png;base64,${image}`;
							   this.imageLoaded = true;
							   this.loading = false;
						})
					}
					else if(this.item == 'URL' && this.url)
					{
						this.loading = true;
						axios.post('/api/qr-code.png',{
							dataText:this.url,
							option:this.item
						},{ responseType: 'arraybuffer' })
						.then((response)=>{
							this.loading = false;
							let image = btoa(
							     new Uint8Array(response.data)
							       .reduce((data, byte) => data + String.fromCharCode(byte), '')
							   );
							   this.png = `data:image/png;base64,${image}`;
							   this.imageLoaded = true;
							   this.loading = false;
						})
					}
					else
					{
						console.log('Select anything')
					}
				}
				
			}
		}
	}
</script>