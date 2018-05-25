<template>
    <div>
        <v-container>
            <v-layout>
                <v-flex sm6 offset-sm3>
                    <v-card>
                        <v-card-text>

                            <v-form v-model="valid">
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
            valid: false,
            email: '',
            emailRules: [
                v => !!v || 'E-mail обязательное поле.',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail не валидный.'
            ]
        }),
        methods: {
            checkEmail() {
                if (this.valid) {
                    axios.post("/api/reset_password", {'email':this.email})
                        .then(response => {

                        })
                        .catch(error => {
                            this.errors = error.response.data.errors;
                        });
                }
            }
        }
    }
</script>