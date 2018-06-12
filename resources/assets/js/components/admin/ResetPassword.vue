<template>
    <div>
        <v-container>
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent>
                    <template>
                        <div class="progress">
                            <v-progress-circular :size="70" indeterminate color="primary"></v-progress-circular>
                        </div>
                    </template>
                </v-dialog>
            </v-layout>

            <v-layout>
                <v-flex sm6 offset-sm3>
                    <v-card>
                        <v-card-text>
                            <v-alert :value="success" type="success">
                                {{success}}
                            </v-alert>
                            <v-alert :value="error" type="error">
                                {{error}}
                            </v-alert>
                            <v-form v-model="valid" v-if="form">
                                <v-text-field
                                        v-model="email"
                                        :rules="emailRules"
                                        label="E-mail"
                                        required
                                ></v-text-field>
                                <v-btn @click="checkEmail">
                                    Отправить
                                </v-btn>
                            </v-form>

                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    export default {
        data: () => ({
            dialog: false,
            valid: false,
            email: '',
            emailRules: [
                v => !!v || 'E-mail обязательное поле.',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail не валидный.'
            ],
            success: null,
            error: null,
            form: true
        }),
        methods: {
            checkEmail() {
                this.dialog = true;
                if (this.valid) {
                    axios.post("/api/reset_password", {
                        'email': this.email,
                        'url': this.url()
                    })
                        .then(response => {
                            if (response.data.status) {
                                this.dialog = false;
                                this.success = response.data.message;
                                this.form = false;
                                this.error = null;
                                setTimeout(this.onLogin, 3000);
                            } else {
                                this.dialog = false;
                                this.error = response.data.message;
                            }

                        })
                }
            },
            url() {
                return window.location.origin;
            },
            onLogin() {
                this.$router.push("/login");
            }
        }
    }
</script>

<style>
    .progress {
        text-align: center;
    }

    .progress .progress-circular {
        margin: 1rem;
    }
</style>