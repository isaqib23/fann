<template>
    <v-dialog v-model="dialog" width="500">
        <template v-slot:activator="{ on }">
            <div v-on="on" style="overflow: hidden; display: inline">
                <slot></slot>
            </div>
        </template>
        <v-card>
            <v-card-title class="headline accent py-3">
                Confirm Action
            </v-card-title>
            <v-card-text class="mt-2">
                Are you sure you want to delete the {{entityName}} ?
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn outlined color="accent" @click="closeDialog" :width="70">No</v-btn>
                <v-btn depressed color="success" @click="deleteTarget" :width="70">Yes</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: 'deleteable',
        data() {
            return {
                dialog      : false,
                targetObj   : this.target,
                entityName  : this.name
            }
        },
        watch: {
            'dialog': function(){
                this.targetObj = this.target;
            }
        },
        props: {
            target  : Object,
            name    : String,
            trigger : Boolean
        },
        methods: {
            deleteTarget: function(){
                this.dialog = false;
                this.$emit('delete', this.targetObj);
            },
            closeDialog: function(){
                this.dialog = false;
                this.$emit('cancel', '');
            }
        },
        watch: {
            'trigger': function(val){
                this.dialog = val;
            }
        },
        mounted(){
        }
    }
</script>