<template>
    <v-app>

        <v-container class="my-5">
            
            <div>
                <v-toolbar flat color="white">
                <v-toolbar-title>USERS</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-dialog persistent v-model="dialog" max-width="900px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark fab small class="mt-4" v-on="on">
                            <i class="material-icons">
                                add
                            </i>
                        </v-btn>
                    </template>
                    <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                        <v-layout>
                            <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedUser.name" :rules="[rules.required]" label="Name"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedUser.username" :rules="[rules.required, rules.counter]" label="Username"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedUser.email" :rules="[rules.required]" label="E-mail"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                            <v-text-field 
                                v-model="editedUser.password" 
                                :append-icon="show ? 'visibility' : 'visibility_off'" 
                                @click:append="show = !show" 
                                :type="show ? 'text' : 'password'" 
                                :rules="[rules.required, rules.counter_password]" 
                                label="Password">
                            </v-text-field>
                            </v-flex>
                        </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click="save" :loading="loading">Save</v-btn>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
                </v-toolbar>
                <v-data-table
                :headers="headers"
                :items="users"
                class="elevation-1"
                >
                <template v-slot:items="props">
                    <td class="text-left">{{ props.item.id }}</td>
                    <td class="text-left">{{ props.item.name }}</td>
                    <td class="text-left">{{ props.item.username }}</td>
                    <td class="text-left">{{ props.item.email }}</td>
                    <td class="text-left">{{ props.item.password }}</td>
                    <td class="text-left">{{ props.item.created_at }}</td>
                    <td class="text-left">{{ props.item.updated_at }}</td>
                    <td class="justify-center px-0">
                        <v-tooltip right>
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" small round dark @click="fillUser(props.item)" v-on="on">
                                    <v-icon size="20">
                                        edit    
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Edit User</span>
                        </v-tooltip>
                        <v-tooltip right>
                            <template v-slot:activator="{ on }">
                                <v-btn color="error" small round dark @click="deleteUser(props.item)" v-on="on">
                                    <v-icon size="20">
                                        delete
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Delete User</span>
                        </v-tooltip>
                    </td>
                </template>
                </v-data-table>
            </div>

            <snackbar></snackbar>

        </v-container>

    </v-app>
</template>

<script>

    import snackbar from './components/Snackbar'

    export default {
        
        data(){
            return{
                users: [],
                dialog: false,
                show: false,
                loading: false,
                rules: {
                    required: value => !!value || 'Required',
                    counter: value => value.length <= 15 || 'Maximum 15 characters',
                    counter_password: value => value.length >= 6 || 'Minimum 6 characters'
                },
                headers: [
                    { text: 'ID', value: 'id' },
                    { text: 'Name', value: 'name' },
                    { text: 'Username', value: 'username' },
                    { text: 'E-mail', value: 'email' },
                    { text: 'Password', value: 'password', sortable: false },
                    { text: 'Created at', value: 'createdAt' },
                    { text: 'Updated at', value: 'updatedAt' },
                    { text: 'Actions', value: 'name', sortable: false },
                ],
                editedIndex: -1,
                editedUser: {
                    name: '',
                    username: '',
                    email: '',
                    password: ''
                },
                defaultItem: {
                    name: '',
                    username: '',
                    email: '',
                    password: ''
                }
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
        },

        methods: {

            close(){
                this.dialog = false
                setTimeout(() => {
                this.editedUser = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                }, 300)
            },

            fillUser(item){
                this.dialog = true;
                this.editedIndex = this.users.indexOf(item);
                this.editedUser = Object.assign({}, item);
            },

            save(){
                const axios = require('axios');
                let self = this;
                
                if(self.editedUser.id == null){
                    self.dialog = true;
                }

                if(self.editedIndex > -1){
                    let id = self.editedUser.id;
                    self.loading = true;
                    axios.post('api/user/'+id+'/edit', {
                        user: self.editedUser
                    })

                    .then(function(response){
                        let message = response.data.message;
                        Object.assign(self.users[self.editedIndex], self.editedUser);
                        Event.$emit('user-edited', message);
                        self.loading = false;
                        self.close();
                    })
                    .catch(function(error){
                        setTimeout(function(){
                            self.loading = false;
                        }, 600);
                    });
                }
                else {

                    self.loading = true;
                    axios.post('api/user/create', {
                        user: self.editedUser
                    })

                    .then(function(response){
                        let message = response.data.message;
                        let user = response.data.user;
                        self.users.push(user);
                        Event.$emit('user-created', message);
                        self.loading = false;
                        self.close();
                    })
                    .catch(function(error){
                        setTimeout(function(){
                            self.loading = false;
                        }, 600);
                    });
                }
                
            },

            deleteUser(item){
                const axios = require('axios');
                let self = this;

                axios.post('api/user/'+item.id+'/destroy')

                .then(function(response){
                    let index = self.users.indexOf(item);
                    let message = response.data.message;
                    self.users.splice(index, 1);
                    Event.$emit('user-deleted', message);
                })
                .catch(function(error){

                });
            }

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New User' : 'Edit User'
            }
        },

        components: {
            snackbar
        }

    }
    
</script>
