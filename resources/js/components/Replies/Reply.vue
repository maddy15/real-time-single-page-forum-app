<template>
    <div>
        <div class="mt-2">
            <v-card>
                <v-card-title>
                    <div class="headline">{{item.user}}</div>
                    <div class="ml-2">Said {{item.updated_at}}</div>
                    <v-spacer></v-spacer>
                    <app-like :likes="item.likes"></app-like>
                </v-card-title>
                <v-divider></v-divider>
                <app-edit-reply v-if="editing" :reply="data" @cancel="editing = false" @editReply="pass($event)"></app-edit-reply>
                <div v-else>
                <v-card-text v-html="body"></v-card-text>
                <v-divider></v-divider>

                <v-card-actions v-if="own" >
                    <v-btn icon small>
                        <v-icon color="orange" @click="edit()" >edit</v-icon>
                    </v-btn>
                    <v-btn icon small @click="destroy()">
                        <v-icon color="red">delete</v-icon>
                    </v-btn>
                </v-card-actions>
                </div>
            </v-card>
        </div>
    </div>
</template>

<script>
    import EditReply from './EditReply'
    import Like from '../Likes/Like'
    export default {
        props:['data','index'],
        data() {
            return {
                editing: false,
                item: this.data
            }
            
        },
        methods: {
            destroy() {
                if(!confirm('Are you sure you want to delete this reply?'))  return
                EventBus.$emit('removeReply',this.index);
                
            },
            edit(){
                this.editing = true;
            },
            pass(e){
                this.editing = false;
                this.item = e;
            }
        },
        computed: {
            own() {
                return User.own(this.item.user_id)
            },
             body() {
                return md.parse(this.item.reply) || '';
            }
        },
        created(){
            // EventBus.$on('editReply',(e)=>{ 
            //     this.editing = false;
            //     })
            // EventBus.$on('cancel',()=>{ this.editing = false})
        },
        components:{
            'appEditReply':EditReply,
            'appLike' : Like
        }
    }
</script>

<style scoped>

</style>