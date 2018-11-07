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
        methods: {
            pushNotification() {
                Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    console.log(notification);
                    this.question.replies.unshift(notification.reply);
                });
            },
            deleteReplies(){
                 Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent', (e) => {
                   const rec = this.question.replies.find(element => element.id == e.id)
                   const index = this.question.replies.indexOf(rec);
                   this.question.replies.splice(index,1);
                });
            }
        },
        created(){
            this.deleteReplies();
            this.pushNotification();
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