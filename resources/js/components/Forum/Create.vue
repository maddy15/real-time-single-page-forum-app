<template>
    <div>
        <h1>Create</h1>
        <v-container>
            
            <v-form @submit.prevent="create()">
                <v-autocomplete
                  :items="categories"
                  item-text="name"
                  item-value="id"
                  loading="error"
                  v-model="form.category_id"
                  label="Category"
                  append-icon="$vuetify.icons.close"
                  :autofocus="true"
                  :dense="true"
                  :dont-fill-mask-blanks="true"
                  counter="5"
                  >
                   </v-autocomplete>

                <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
                ></v-text-field>

                <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>

                <v-btn color="green" type="submit">Create</v-btn>
                
            </v-form>
        </v-container>
    </div>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor'
    export default {
        data() {
            return {
                form: {
                    title:null,
                    body:null,
                    category_id:null
                },
                categories: {},
            }
        },
        methods: {
            create() {
                axios.post('/api/questions',this.form)
                .then(res => {
                    this.$router.push(res.data.path);
                    console.log(res.data);
                })
                .catch(error => console.log(error));
            }
        },

        created(){
            axios.get('/api/categories')
            .then(res => {
                this.categories = res.data.data;
            })
            .catch(err => console.log(err.response.data));
        },
        components:{
            markdownEditor
        }
    }
</script>

<style scoped>

</style>