<template>
  <v-layout row>
    <v-flex xs12 sm12>
      <v-card>
        <v-toolbar color="cyan" dark dense class="mt-2">
             <v-toolbar-title>Category</v-toolbar-title>
        </v-toolbar>

        <v-list>
          <v-list-tile  v-for="category in categories" :key="category.id">
              <v-list-tile-content>
                  <v-list-tile-title>{{category.name}}</v-list-tile-title>
                  <v-divider></v-divider>
              </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
    export default {
        data() {
            return {
                categories: {}
            }
        },
        created(){
            axios.get('/api/categories')
            .then(res => {
                this.categories = res.data.data;
            })
            .catch(err => console.log(err.response.data));
        }
    }
</script>

<style scoped>

</style>