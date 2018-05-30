<template>
    <v-container fluid>
        <v-layout row>
            <v-flex xs4>
                <v-subheader>Кому</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-1-3"
                        label="Email"
                        single-line
                        v-model="mail.email_to"
                        :error-messages="checkError('email_to')"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex xs4>
                <v-subheader>Тема</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-2-3"
                        label="Заголовок"
                        single-line
                        v-model="mail.subject"
                        :error-messages="checkError('subject')"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex xs4>
                <v-subheader>Сообщение</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-4"
                        label="Сообщение"
                        textarea
                        v-model="mail.msg"
                        :error-messages="checkError('msg')"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex xs4>

            </v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="sendMessage">
                    <v-icon dark left>send</v-icon>Отправить
                </v-btn>
                <v-btn color="red" dark @click="onUserMessages">Отмена
                    <v-icon dark right>cancel</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                mail: {
                    email_to: null,
                    email_from:null,
                    subject: null,
                    msg: null,
                    name:null,
                    user_id:null
                },
                errors: {}
            }
        },
        methods: {
            sendMessage() {
                this.errors = {};
                this.mail.email_from = this.$store.state.Auth.email;
                this.mail.name = this.$store.state.Auth.name;
                this.mail.user_id = this.$store.state.Auth.id;
                axios.post(`/createMail`, this.mail).then(response => {
                    if (response.data.status) {
                        this.$store.commit(
                            "showInfo",
                            response.data.message
                        );
                        this.onUserMessages();
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });

            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },
            onUserMessages(){
                this.$router.push('/user_messages');
            }
        }
    }
</script>