<template>
    <v-app>
        <v-snackbar
            v-model="snackbar"
            color="primary"
            :bottom="y === 'bottom'"
            :left="x === 'left'"
            :multi-line="mode === 'multi-line'"
            :right="x === 'right'"
            :timeout="timeout"
            :top="y === 'top'"
            :vertical="mode === 'vertical'"
        >
      {{ text }}
      <v-btn
            color="black"
            flat
            @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>
    </v-app>
</template>

<script>
  
    export default {

        data () {
            return {
                snackbar: false,
                y: 'bottom',
                x: null,
                mode: '',
                timeout: 4000,
                text: ''
            }
        },

        mounted(){
            let self = this;

            Event.$on('user-deleted', function(message){
                self.text = message;
                self.snackbar = true;
            });
        }

    }


</script>


