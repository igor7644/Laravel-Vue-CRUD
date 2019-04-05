<template>
    <v-app>

        <v-container class="my-5">

            <v-layout pa-2>
                <h1>Welcome to CRUD SPA!</h1>
            </v-layout>
            <v-layout pa-2>
                <h2>Choose bellow:</h2>
            </v-layout>
            
            <v-layout row>
                <v-flex class="text-center ma-5">
                    <v-card class="primary" hover>
                        <v-layout justify-center>
                        <v-card-title primary-title>
                        <div>
                            <div class="headline">Users</div>
                            <span>Explore all users</span>
                        </div>
                        </v-card-title>
                        </v-layout>
                        <v-card-actions>
                            <v-btn color="white" to="/users"> 
                                Explore 
                                <i class="material-icons">
                                keyboard_arrow_right
                                </i>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>

                <v-flex class="text-center ma-5">
                    <v-card class="primary" hover>
                        <v-layout justify-center>
                        <v-card-title primary-title>
                        <div>
                            <div class="headline">Posts</div>
                            <span>Explore all posts</span>
                        </div>
                        </v-card-title>
                        </v-layout>
                        <v-card-actions>
                            <v-btn color="white" to="/posts"> 
                                Explore 
                                <i class="material-icons">
                                keyboard_arrow_right
                                </i>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
            
        </v-container>   

    </v-app>
</template>

<script>

    export default {
        
        data(){
            return{
                
            }
        }

    }
    
</script>
