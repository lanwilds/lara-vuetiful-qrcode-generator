<template>
    <v-container grid-list-sm>
    <v-layout row wrap>
      <v-flex xs12 sm12>
        <v-card>

          <v-card-title primary-title>
            <div>
              <h3 class="headline text-md-center">QR Code Scanner and Generator</h3>
              <div class="">
                  The Quick Response (QR code) system which can be read by an imaging device such as a camera, and processed using Reed–Solomon error correction until the image can be appropriately interpreted.
                  <br>
                  This is a PHP's Standalone Package for generating QR Code and Scanning QR Code App developed by 
                  <strong>Loyal Developers.</strong>
              </div>
            </div>
          </v-card-title>

          <v-card-actions >
            <v-btn  block color="blue white--text" @click="$router.push({path:'/scan'})"><v-icon> fa-search</v-icon> Scan</v-btn>
            <v-btn  block color="aqua white--text" @click="$router.push({path:'/generator'})"><v-icon>fa-cog</v-icon> Generate</v-btn>
          </v-card-actions>
        </v-card>

      </v-flex>

    </v-layout>
    </v-container>
</template>

<script>
    export default {
        data(){
            return{
                cards:[
                    {
                        title:'Kangaroo Valley Safari',
                        text:'Located two hours south of Sydney in the Southern Highlands of New South Wales',
                        src:'https://cdn.vuetifyjs.com/images/cards/desert.jpg'
                    },
                    {
                        title:'Kangaroo Valley Safari',
                        text:'Located two hours south of Sydney in the Southern Highlands of New South Wales',
                        src:'https://cdn.vuetifyjs.com/images/cards/desert.jpg'
                    },
                    {
                        title:'Kangaroo Valley Safari',
                        text:'Located two hours south of Sydney in the Southern Highlands of New South Wales',
                        src:'https://cdn.vuetifyjs.com/images/cards/desert.jpg'
                    }
                ]
            }
        }
    }
</script>
       