<template>
    <v-card>
        <v-container fluid>
            <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                    {{question.title}}
                </h3>
                <div class="grey--text">{{question.user}} said {{question.created_at}}</div>
            </div>
            <v-spacer></v-spacer>
            <v-btn color="teal" dark>{{question.replies.length}} Replies</v-btn>
            </v-card-title>
            <v-card-text v-html="body"></v-card-text>
            <v-card-actions v-if="own">
                <v-btn icon @click="edit()">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon @click="destroy()">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>

    export default {
        data() {
            return {
                own: User.own(this.question.user_id),
            }
        },
        methods: {
            destroy() {
                if(!confirm('Are you sure you want to delete?')) return;
                axios.delete('/api/questions/'+this.question.slug)
                .then(res => this.$router.push('/forum'))
                .catch(err => console.log(err.response.data));
            },
            edit(){
                EventBus.$emit('startEditing');
            }
        },
        computed: {
            body() {
                return md.parse(this.question.body) || '';
            }
        },
        props:['question'],
        created(){
              Echo.channel('replyCountChannel')
            .listen('ReplyCountEvent', (e) => {
                this.question.replies.unshift(e.reply);
                console.log(e);
            });
        }
    }
</script>

<style scoped>

</style>