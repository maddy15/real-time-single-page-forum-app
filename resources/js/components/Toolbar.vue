<template>
    <div>
        <v-toolbar>
            <v-toolbar-side-icon></v-toolbar-side-icon>
            <v-toolbar-title>Forum App</v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="hidden-sm-and-down">
                <router-link to="/">
                    <v-btn flat>Forum</v-btn>
                </router-link>
                <v-btn flat>ASK QUESTION</v-btn>
                <v-btn flat>CATEGORY</v-btn>
                <router-link to="/login" v-if="!hasToken">
                    <v-btn flat>Login</v-btn>
                </router-link>
                <v-btn flat @click="logout()" v-else>LOGOUT</v-btn>
                {{hasToken}}
            </div>

            
        </v-toolbar>
    </div>
</template>

<script>
    export default {

        methods: {
            logout() {
                User.logout();
            }
        },
        computed: {
            hasToken() {
                return User.loggedIn(); 
            }
        },
    }
</script>

<style scoped>

</style>