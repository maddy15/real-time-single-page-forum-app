<template>
    <div>
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex xs8>
                    <app-question v-for="question of questions" :key="question.path" :question="question"></app-question>
                </v-flex>
                <v-flex xs4>
                    <app-sidebar></app-sidebar>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import Question from './Question';
import Sidebar from './AppSidebar';
export default {
    components:{
        'appQuestion' : Question,
        'appSidebar' : Sidebar,
    },
    data() {
        return {
             questions: {}
        }
    },
    methods: {
        redirect() {
            const path = localStorage.getItem('path');
            if(path){ 
            localStorage.removeItem('path');
            this.$router.push(path);
            }
        }
    },
    created(){
       
        this.redirect();
        axios.get('/api/questions')
        .then(res => this.questions = res.data.data)
        .catch(err => console.log(err.response.data));
        }
}
</script>

<style scoped>

</style>