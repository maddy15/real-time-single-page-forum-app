<template>
    <div>
        <v-container>
            <v-form @submit.prevent="signup()">
                
                <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                required
                ></v-text-field>

                <v-alert v-if="errors.name"
                :value="true"
                type="error"
                >
                {{errors.name[0]}}
                </v-alert>

                <v-text-field
                v-model="form.email"
                label="E-mail"
                type="email"
                required
                ></v-text-field>


                <v-alert v-if="errors.email"
                :value="true"
                type="error"
                >
                {{errors.email[0]}}
                </v-alert>

                <v-text-field
                v-model="form.password"
                label="Password"
                type="password"
                required
                ></v-text-field>


                <v-alert v-if="errors.password"
                :value="true"
                type="error"
                >
                {{errors.password[0]}}
                </v-alert>

                <v-text-field
                v-model="form.password_confirmation"
                label="Confirm Password"
                type="password"
                required
                ></v-text-field>

                <v-btn color="green" type="submit">Sign Up</v-btn>

                <router-link to="/login">
                    <v-btn color="blue">Login</v-btn>
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
                    name: null,
                    email:null,
                    password:null,
                    password_confirmation:null
                },
                errors: {}
            }
        },
        methods: {
            signup() {
                axios.post('/api/auth/signup',this.form)
                .then(res =>{
                     User.responseAfterLogin(res)
                     this.errors = {};
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
            }
        },
    }
</script>

<style scoped>

</style>