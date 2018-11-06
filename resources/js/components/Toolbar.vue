<template>
    <div>
        <v-toolbar>
            <v-toolbar-side-icon></v-toolbar-side-icon>
            <v-toolbar-title>Forum App</v-toolbar-title>
            <v-spacer></v-spacer>
            
            <app-notification v-if="loggedIn"></app-notification>
            <div class="hidden-sm-and-down">
                <router-link  v-for="item in items" :to="item.to" v-if="item.show" :key="item.title">
                    <v-btn flat>{{item.title}}</v-btn>
                </router-link>
               
            
            </div>

            
        </v-toolbar>
    </div>
</template>

<script>
    import Notification from './AppNotification'
    export default {
        data() {
            return {
                loggedIn:User.loggedIn(),
                items : [
                    {title:'Forum',to:'/forum',show:true},
                    {title:'Ask Question',to:'/create',show:User.loggedIn()},
                    {title:'Category',to:'/category',show:User.admin()},
                    {title:'Login',to:'/login',show:!User.loggedIn()},
                    {title:'Logout',to:'/logout',show:User.loggedIn()},
                ]
            }
        },
         created(){
            EventBus.$on('logout',()=>{
                User.logout();
            });
        },
        components:{
            'appNotification' : Notification
        }
    }
</script>

<style scoped>

</style>