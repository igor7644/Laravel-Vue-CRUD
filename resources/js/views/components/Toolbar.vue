<template>
    <v-app>
        
        <v-toolbar class="grey lighten-2" fixed app>
            <v-toolbar-side-icon @click="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>
                <span class="font-weight-light">LARAVEL + VUE &nbsp </span>
                <span>CRUD</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>

        <v-navigation-drawer v-model="drawer" class="primary" app>
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

        <v-footer class="pa-3" app color="#E0E0E0" height="20">
            <v-layout justify-center>
                <div>&copy; {{ new Date().getFullYear() }} - Igor Milosavljević</div>
            </v-layout>
        </v-footer>

    </v-app>
</template>

<script>

    export default {
        
        data(){
            return{
                drawer: false,
                links: [
                    {icon: 'dashboard', text: 'Dashboard', route: '/dashboard'},
                    {icon: 'person', text: 'Users', route: '/users'},
                    {icon: 'list', text: 'Posts', route: '/posts'}
                ]
            }
        }

    }
</script>
