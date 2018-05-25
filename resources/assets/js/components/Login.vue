<template>
    <div>
        <v-container>
            <v-layout>
                <v-flex sm4 offset-sm4>
                    <v-card>
                        <v-card-title>
                            <h2>Добро пожаловать</h2>
                        </v-card-title>

                        <v-card-text>
                            <v-layout row>
                                <v-text-field
                                        label="Email"
                                        v-model="form.email"
                                        :error-messages="checkError('email')"
                                ></v-text-field>
                            </v-layout>

                            <v-layout row>
                                <v-text-field
                                        label="Пароль"
                                        v-model="form.password"
                                        :error-messages="checkError('password')"
                                        type="password"
                                        @keyup="onKeyup"
                                ></v-text-field>
                            </v-layout>

                            <v-layout row>
                                <v-flex xs12 class="text-xs-center">
                                    <v-btn @click="onLogin">
                                        Вход
                                    </v-btn>
                                </v-flex>
                                <v-flex xs12 class="text-xs-right">
                                    <v-btn color="blue" flat v-bind:to="{name:'ResetPassword'}">
                                        Забыли пароль?
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import Auth from "../helpers/Auth";

    export default {
        data() {
            return {
                form: {
                    email: null,
                    password: null
                },

                errors: {}
            };
        },

        methods: {
            onLogin() {
                this.errors = {};

                axios.post("/api/login", this.form)
                    .then(response => {
                        if (response.data.success) {
                            console.log(response.data.user.id);
                            Auth.login(response.data.user);
                            this.$router.push("/controls");
                        }
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            },

            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },

            onKeyup(e) {
                if (e.code === "Enter") {
                    this.onLogin();
                }
            }
        }
    };
</script>
