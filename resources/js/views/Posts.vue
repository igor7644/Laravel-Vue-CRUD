<template>
    <v-app>

        <v-container class="my-5">
            
            <div>
                <v-toolbar flat color="white">
                <v-toolbar-title>POSTS</v-toolbar-title>
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
                            <v-text-field v-model="editedPost.title" :rules="[rules.required, rules.counter]" label="Title"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedPost.description" :rules="[rules.required]" label="Description"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedPost.Creator" :rules="[rules.required]" label="Creator"></v-text-field>
                            </v-flex>
                        </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
                </v-toolbar>
                <v-data-table
                :headers="headers"
                :items="posts"
                class="elevation-1"
                >
                <template v-slot:items="props">
                    <td class="text-left">{{ props.item.id }}</td>
                    <td class="text-left">{{ props.item.title }}</td>
                    <td class="text-left">{{ props.item.description }}</td>
                    <td class="text-left">{{ props.item.user.username }}</td>
                    <td class="text-left">{{ props.item.created_at }}</td>
                    <td class="text-left">{{ props.item.updated_at }}</td>
                    <td class="justify-center px-0">
                        <v-tooltip right>
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" small round dark @click="fillPost(props.item)" v-on="on">
                                    <v-icon size="20">
                                        edit    
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Edit Post</span>
                        </v-tooltip>
                        <v-tooltip right>
                            <template v-slot:activator="{ on }">
                                <v-btn color="error" small round dark @click="deletePost(props.item)" v-on="on">
                                    <v-icon size="20">
                                        delete
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Delete Post</span>
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
                posts: [],
                dialog: false,
                show: false,
                rules: {
                    required: value => !!value || 'Required',
                    counter: value => value.length <= 15 || 'Maximum 15 characters'
                },
                headers: [
                    { text: 'ID', value: 'id' },
                    { text: 'Title', value: 'title' },
                    { text: 'Description', value: 'description' },
                    { text: 'Created by', value: 'createdBy' },
                    { text: 'Created at', value: 'createdAt' },
                    { text: 'Updated at', value: 'updatedAt' },
                    { text: 'Actions', value: 'name', sortable: false },
                ],
                editedIndex: -1,
                editedPost: {
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

            axios.get('api/posts')

            .then(function(response){
                self.posts = response.data;
            })
            .catch(function(error){

            });
        },

        methods: {

            close(){
                this.dialog = false
                setTimeout(() => {
                this.editedPost = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                }, 300)
            },

            fillPost(item){
                this.dialog = true;
                this.editedIndex = this.users.indexOf(item);
                this.editedPost = Object.assign({}, item);
            }

            

        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Post' : 'Edit Post'
            }
        },

        components: {
            snackbar
        }

    }
    
</script>
