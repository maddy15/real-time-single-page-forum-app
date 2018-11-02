<template>
    <div>
        <v-card  style="padding:20px">
            <v-form @submit.prevent="save()">
                <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
                ></v-text-field>

                <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>

                <v-card-actions>
                    <v-btn icon type="submit">
                        <v-icon color="teal">save</v-icon>
                    </v-btn>

                    <v-btn icon @click="cancel()">
                        <v-icon color="black">cancel</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title:this.question.title,
                    body:this.question.body
                }
            }
        },
        props:['question'],
        methods: {
            save() {
                axios.put('/api/questions/' + this.question.slug,this.form)
                .then(res=> {
                    EventBus.$emit('refresh');
                    this.cancel();
                })
                .catch(error => console.log(error.response.data));
                
            },
            cancel()
            {
                EventBus.$emit('startEditing');
            }
        },
    }
</script>

<style scoped>

</style>