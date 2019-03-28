<template>
    <v-app>
        
        <v-toolbar class="grey lighten-2" flat app>
            <v-toolbar-side-icon @click="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>
                <span class="font-weight-light">LARAVEL + VUE &nbsp </span>
                <span>CRUD</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>

        <v-navigation-drawer v-model="drawer" class="blue darken-2" app>
            <v-list>
                <v-list-tile v-for="link in links" :key="link.text" router :to="link.route">
                    <v-list-tile-action>
                        <v-icon class="black--text"> {{ link.icon }} </v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title class="black--text"> {{ link.text }} </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>

        <v-content>
            <router-view></router-view>
        </v-content>

    </v-app>
</template>

<script>

    export default {
        
        data(){
            return{
                drawer: false,
                links: [
                    {icon: 'dashboard', text: 'Dashboard', route: '/home'},
                    {icon: 'person', text: 'Users', route: '/users'},
                    {icon: 'list', text: 'Posts', route: '/posts'}
                ]
            }
        }

    }
</script>
