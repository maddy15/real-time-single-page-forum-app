<template>
    <div>
        <v-container>
            <v-form @submit.prevent="login()">
                
                <v-text-field
                v-model="form.email"
                label="E-mail"
                type="email"
                required
                ></v-text-field>

                <v-text-field
                v-model="form.password"
                label="Password"
                type="password"
                required
                ></v-text-field>

                <v-btn color="green" type="submit">Login</v-btn>
                <router-link to="/signup">
                    <v-btn color="blue">Signup</v-btn>
                </router-link>
            </v-form>
        </v-container>
    </div>
    
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
            }
        },
        methods: {
            login() {
                User.login(this.form);
            }
        },
       
    }
</script>

<style scoped>

</style>