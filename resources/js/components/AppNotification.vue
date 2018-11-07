<template>
    <div>
        <div class="text-xs-center">
                <v-menu offset-y>
                    <v-btn icon  slot="activator">
                        <v-icon :color="color">add_alert</v-icon> {{ unreadCount }}
                    </v-btn>
                <v-list>
                    <v-list-tile v-for="(item,index) in unread" :key="index">
                        <router-link :to="item.path" >
                            <v-list-tile-title @click="markRead(item)">{{ item.question }}</v-list-tile-title>
                        </router-link>
                        
                    </v-list-tile>
                    <v-divider></v-divider>
                    <v-list-tile v-for="item in read" :key="item.id">
                        <v-list-tile-title>{{ item.question }}</v-list-tile-title>
                    </v-list-tile>
                </v-list>
                </v-menu>
            </div>
        
    </div>
</template>

<script>

    export default {
        data() {
            return {
                read:{},
                unread:{},
                unreadCount:0
            }
        },
        methods: {
            getNotifications() {
                axios.post('/api/notifications')
                .then(res => {
                    // console.log(res);
                    this.read = res.data.read;
                    this.unread = res.data.unread;
                    this.unreadCount = res.data.unread.length;
                })
                .catch(error => {
                    Exception.handle(error);
                });
            },
            markRead(notification)
            {
                axios.post('/api/markAsRead',{id:notification.id})
                .then(res=>{
                    console.log(notification.path);
                    this.unread.splice(notification,1);
                    this.read.splice(this.read.length-1,1);
                    this.read.unshift(notification);
                    this.unreadCount--;
                });
            }
        },
        computed: {
            color() {
                return this.unreadCount > 0 ? 'red' : 'red lighten-4'
            }
        },
        created(){
            if(User.loggedIn){
                this.getNotifications();
            }

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    console.log('not',notification);
                    this.unread.unshift(notification);
                    this.unreadCount++;
                });
        }
    }
</script>

<style scoped>

</style>