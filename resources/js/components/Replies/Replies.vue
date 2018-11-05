<template>
    <div>

        <app-reply v-for="(reply,index) in question.replies" :key="reply.id" :index="index" :data="reply"></app-reply>
    </div>
    
</template>

<script>
import Reply from '../Replies/Reply';
    export default {
        props:['question'],
        components:{
            'appReply' : Reply
        },
        created(){

            EventBus.$on('newReply',(e)=>{
                this.question.replies.unshift(e);
            });
            EventBus.$on('removeReply',(e)=>{
                axios.delete(`/api/questions/${this.question.slug}/replies/${this.question.replies[e].id}`)
                .then(res => {
                    this.question.replies.splice(e,1);
                })
                .catch(err => console.log(err.response.data));
            });
        }
    }
</script>

<style scoped>

</style>