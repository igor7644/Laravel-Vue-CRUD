<template>
    <v-app>

        <v-container class="my-5">
            <h1 class="blue--text">USERS</h1> 
        </v-container>

    </v-app>
</template>

<script>

    export default {
        
        data(){
            return{
                users: []
            }
        },

        created(){
            const axios = require('axios');
            let self = this;

            axios.get('api/users')

            .then(function(response){
                self.users = response.data;
            })
            .catch(function(error){

            });

        }

    }
    
</script>
