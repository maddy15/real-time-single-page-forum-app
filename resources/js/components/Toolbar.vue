<template>
    <div>
        <v-toolbar>
            <v-toolbar-side-icon></v-toolbar-side-icon>
            <v-toolbar-title>Forum App</v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="hidden-sm-and-down">
                <span v-for="item in items">
                <router-link  :to="item.to" v-if="item.show" :key="item.title">
                    <v-btn flat>{{item.title}}</v-btn>
                </router-link>
               
                </span>
            </div>

            
        </v-toolbar>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items : [
                    {title:'Forum',to:'/forum',show:true},
                    {title:'Ask Question',to:'/create',show:User.loggedIn()},
                    {title:'Category',to:'/category',show:true},
                    {title:'Login',to:'/login',show:!User.loggedIn()},
                    {title:'Logout',to:'/logout',show:User.loggedIn()},
                ]
            }
        },
         created(){
            EventBus.$on('logout',()=>{
                User.logout();
            });
        }
    }
</script>

<style scoped>

</style>