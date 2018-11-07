<template>
    <div v-if="question">
        <app-edit-question v-if="edit" :question="question"></app-edit-question>
        <div v-else>
            <app-show-question :question="question"></app-show-question>
            <v-container>

            <app-replies :question="question"></app-replies>
            <app-new-reply :slug="question.slug" v-if="loggedIn"></app-new-reply>
            </v-container>
        </div>
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';
import Replies from '../Replies/Replies';
import NewReply from '../Replies/NewReply';
    export default {
        data() {
            return {
                question: null,
                edit:false,

            }
        },
        computed: {
            loggedIn() {
                return User.loggedIn(); 
            }
        },
        methods: {
            listen() {
                EventBus.$on('startEditing',()=>{
                    this.edit = !this.edit;
                })
                EventBus.$on('refresh',()=>{
                    this.getQuestion();
                })
            },
            getQuestion(){
                    axios.get(`/api/questions/${this.$route.params.slug}`)
                .then(res =>{
                    this.question = res.data.data;
                })
                .catch(err => console.log(err.response.data));
            }
        },
        created(){
            this.listen();
            this.getQuestion();
            
        },
        components:{
            'appShowQuestion' : ShowQuestion,
            'appEditQuestion' : EditQuestion,
            'appReplies' : Replies,
            'appNewReply' : NewReply,
        }
    }
</script>

<style scoped>

</style>