<template>
    <div>
         <markdown-editor v-model="reply.reply" ref="markdownEditor" :configs="configs"></markdown-editor>
            <v-btn icon @click="edit()">
                <v-icon color="green" >save</v-icon>
            </v-btn>
            <v-btn icon @click="cancel()">
                 <v-icon color="black">cancel</v-icon>
            </v-btn>
    </div>
</template>

<script>
  import markdownEditor from 'vue-simplemde/src/markdown-editor'
    export default {
        props:['reply'],
        data() {
            return {
                configs:{
                    autofocus:true,
                    shortcuts: {
                        'toggleHeadingSmaller':'Cmd-H'
                    }
                }
            }
        },
        methods: {
            edit() {
                axios.put(`/api/questions/${this.reply.question_slug}/replies/${this.reply.id}`,{body:this.reply.reply})
                .then(res => {
                    // EventBus.$emit('editReply',res.data);
                    this.$emit('editReply',res.data);
                })
                .catch(err => console.log(err.response.data));
               
            },
            cancel() {
                // EventBus.$emit('cancel');
                this.$emit('cancel');
            },
        },
        components:{
            markdownEditor
        }
    }
</script>

<style scoped>
</style>