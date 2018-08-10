<template>
	<v-container grid-list-sm>
	<v-layout row wrap>
	  <v-flex xs12 sm12>
	    <v-card>
	    	<v-progress-circular
	    	   :rotate="360"
	    	   :size="100"
	    	   :width="15"
	    	   :value="fileProgress"
	    	   color="teal"
	    	   v-if="uploading"
	    	 >
	    	   {{ fileProgress }}
	    	 </v-progress-circular>
	    	 <v-alert
	    	   :value="message"
	    	   type="info"
	    	   v-if="message"
	    	 >
	    	   {{ message }}
	    	 </v-alert>
	      <v-card-title primary-title>
	        <div>
	          <h3 class="headline text-md-center">QR Code Scanner</h3>
	        </div>
	      </v-card-title>
	      <v-container>
	      		<v-flex sm14>
	      			<label><b>Upload QRCode</b></label><br>
	      			  <input
	      			  	type="file"
	      			  	ref="image"
	      			  	accept="image/*"
	      			  	id="image"
	      			  >
	      			  <v-btn color="red white--text" @click="clearAll">Reset</v-btn>
	      		</v-flex>
	      		<v-progress-circular
	      		  :size="50"
	      		  color="primary"
	      		  indeterminate
	      		  v-if="uploading"
	      		  class="ma-2"
	      		></v-progress-circular>
	      	<v-card v-if="textLoaded">
	      		<template v-if="uploading">
	      			<v-progress-circular
	      			  :size="50"
	      			  color="primary"
	      			  indeterminate
	      			  v-if="uploading"
	      			  class="ma-2"
	      			></v-progress-circular>
	      		</template>
	      		<template v-else>
	      			<v-textarea
	      			        name="input-7-1"
	      			        label="Text Inside QRCode"
	      			        v-model="Qrtext"
	      			        hint="QRCode text"
	      			      ></v-textarea>
	      		</template>

	      	  <v-card-title primary-title>
	      	    <div>
	      	      <h3 class="headline mb-0">QR Code Text Window</h3>
	      	    </div>
	      	  </v-card-title>
	      	</v-card>

	      </v-container>

	      <v-card-actions >
	        <v-btn  block color="blue white--text" @click="UploadAndScan"><v-icon> fa-search</v-icon> Scan</v-btn>
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
				uploading:false,
				file:'',
				filepath:'',
				fileProgress:0,
				message:'',
				textLoaded:false,
				Qrtext:''
			}
		},
		methods:{
			clearAll(){
				this.textLoaded = false;
				this.file = '';
			},
			UploadAndScan(){
				this.file = document.getElementById('image').files[0];
								if(!this.file)
								{
									this.message="Please Chooes a file to upload";

								}
								else
								{
									this.uploading = true;
									this.message="Creating connections...";
									var form = new FormData();
									form.append('image',this.file);
									axios.post('/api/decode/qr-code',form,{
										onUploadProgress:(e) => {
											if(e.lengthComputable)
											{
												this.message="Uploading...";
												this.updateProgress(e);
											}
										}
									}).then((response) => {
										setTimeout(()=>{
											this.message="Upload Finished";
										},2000)
										if(response.data.data){
											this.textLoaded = true;
											this.message = 'Text Decoded'
											this.Qrtext = response.data.data;
										}
										else
										{
											this.textLoaded = false;
											this.message = 'Invalid Image'
										}
										
										//this.filepath = response.data.filepath;
										this.file = [];
										setTimeout(()=>{
											this.message="";
										},3000)

									})
									this.uploading=false;
								}
			},
			updateProgress(e){
				e.percent = (e.loaded / e.total) * 100;
				this.fileProgress = Math.round(e.percent);
				if(Math.round(e.percent)>75)
				{
					this.message = 'Almost Done'
				}
			}
		}
	}
</script>