<template>
    <div>
        <v-btn icon small @click="likeIt()">
            <v-icon :color="color">favorite</v-icon> {{count}}
        </v-btn>
    </div>
</template>

<script>
    export default {
        props:['likes'],
        data() {
            return {
                liked: this.likes.liked,
                count:this.likes.like_count,
            }
        },
        computed: {
            color() {
                return  this.liked ? 'red' : 'red lighten-4'
            }
        },
        created(){
            Echo.channel('likeChannel')
            .listen('LikeEvent', (e) => {
                console.log(e);
                if(this.likes.reply_id == e.id){
                    e.type == 1 ? this.count++ : this.count--
                }
            });
        },
        methods: {
            likeIt() {
                if(User.loggedIn())
                {
                    this.liked ? this.decr() : this.incr();
                    this.liked = !this.liked;
                }
            },
            incr(){
                axios.post(`/api/like/${this.likes.reply_id}`)
                .then( res=> this.count++);
                
            },
            decr(){
                axios.delete(`/api/like/${this.likes.reply_id}`)
                .then( res=> this.count--);
                
            }
        },
    }
</script>

<style scoped>

</style>