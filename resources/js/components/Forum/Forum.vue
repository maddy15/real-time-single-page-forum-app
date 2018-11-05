<template>
    <div>
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex xs8>
                    <transition enter-active-class="animated lightSpeedIn" leave-active-class="animated lightSpeedOut" mode="out-in" appear>
                        <div :key="category_id">
                            <app-question v-for="question of filteredQuestion" :key="question.path" :question="question"></app-question>
                        </div>
                    </transition>
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
             questions: {},
             category_id:0,
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
    computed: {
        filteredQuestion() {
            return this.category_id != 0 ? this.questions.filter((element) => element.category_id == this.category_id) : this.questions;
        }
    },
    created(){
        EventBus.$on('filterquestion',(e)=>{
            this.category_id = e;
        })
        if( User.loggedIn()) this.redirect();
        axios.get('/api/questions')
        .then(res => this.questions = res.data.data)
        .catch(err => console.log(err.response.data));
        }
}
</script>

<style scoped>
.lightSpeedIn,.lightSpeedOut,.slideInUp,.slideInDown {
  -webkit-animation-duration: 400ms;
}
</style>