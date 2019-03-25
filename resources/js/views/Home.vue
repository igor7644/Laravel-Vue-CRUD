<template>
    <v-app>

        <v-toolbar>
            <v-toolbar-side-icon @click="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>CRUD</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
            <v-btn flat><router-link to="/home">Home</router-link></v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <v-navigation-drawer v-model="drawer">
            <p>test</p>
        </v-navigation-drawer>
        
    </v-app>
</template>

<script>
    export default {
        
        data(){
            return{
                drawer: false
            }
        }

    }
</script>
