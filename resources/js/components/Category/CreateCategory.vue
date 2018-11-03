<template>
    <v-container>
        <v-form @submit.prevent="submit()" class="mb-2">
            <v-text-field
                v-model="form.name"
                label="Category"
                type="text"
                required
            ></v-text-field>

            <v-btn color="teal" type="submit">{{editSlug ?'Edit' : 'Create'}}</v-btn>
        </v-form>

        <v-card>
             <v-toolbar color="indigo" dark dense>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>
                <v-list>
                    <div v-for="(category,index) in categories" :key="category.id">
                        <v-list-tile>
                            <v-list-tile-action>
                                <v-btn icon small @click="edit(category.slug,index)">
                                    <v-icon color="orange">edit</v-icon>
                                </v-btn>
                                
                            </v-list-tile-action>

                            <v-list-tile-content>
                                <v-list-tile-title>{{category.name}}</v-list-tile-title>
                            </v-list-tile-content>

                            <v-list-tile-action>
                                <v-btn icon small @click="remove(category.slug,index)">
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider v-if="(index+1) != categories.length"></v-divider>
                    </div>
                </v-list>
            
        </v-card>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name:null
                },
                categories:{},
                editSlug:null
            }
        },
        methods: {
            submit() {
                this.editSlug ? this.update() : this.create();
            },
            create(){
                axios.post('/api/categories',this.form)
                .then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                    })
                .catch(err => console.log(err.response.data));
            },
            update(){
                axios.put('/api/categories/' + this.editSlug,this.form)
                    .then(res => {
                        this.form.name = null;
                        this.editSlug = null;
                        const record = this.categories.find((element)=> element.id == res.data.id);
                        record.name = res.data.name;
                        record.slug = res.data.slug;
                    });
            },
            remove(slug,index){
                if(confirm('Are you sure you want to delete this category?'))
                {
                    axios.delete('/api/categories/'+ slug)
                    .then(res => this.categories.splice(index,1))
                    .catch(err => console.log(err.response.data));
                }
            },
            edit(slug,index){
                this.form.name = this.categories[index].name;
                this.editSlug = this.categories[index].slug;
               
            },
            getCategories()
            {
                axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data.data;
                })
                .catch(err => console.log(err.response.data));
            }
        },
         created(){
            if(!User.admin()) this.$router.push('/forum');
            this.getCategories();
        }
    }
</script>

<style scoped>

</style>