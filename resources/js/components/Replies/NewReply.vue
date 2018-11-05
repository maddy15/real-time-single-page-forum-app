<template>
    <div>
        <div class="mt-4">
            <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
            <v-btn dark color="green" @click="submit()">
                Reply   <v-icon>done</v-icon>
            </v-btn>
        </div>
    </div>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor'
    export default {
        props:['slug'],
        data() {
            return {
                form: {
                    body:null
                }
            }
        },
        methods: {
            submit() {
                axios.post(`/api/questions/${this.slug}/replies`,this.form)
                .then(res => {
                    EventBus.$emit('newReply',res.data);
                    this.$emit('repCount');
                    this.form.body = '';
                    window.scrollTo(0,0);
                })
                .catch(err => console.log(err.response.data));
            }
        },
         components:{
            markdownEditor
        }
    }
</script>

<style scoped>

</style>