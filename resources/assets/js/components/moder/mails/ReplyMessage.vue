<template>
    <v-container fluid>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent>
                <template>
                    <div class="progress">
                        <v-progress-circular :size="70" indeterminate color="primary"></v-progress-circular>
                    </div>
                </template>
            </v-dialog>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Кому</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-1-3"
                        label="Email"
                        single-line
                        v-model="mail.email_from"
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
                        v-model="mail.message"
                        :error-messages="checkError('message')"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex xs4>

            </v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="sendMessage">Отправить
                    <v-icon dark right>send</v-icon>
                </v-btn>
                <v-btn color="red" dark @click="onUserMessages">Отмена
                    <v-icon dark right>block</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    export default {
        data() {
            return {
                dialog: false,
                mail: {},
                errors: {}
            }
        },
        created() {
            Auth.check();
            this.mail = this.$route.params.item;
            this.mail.message = null;
        },
        methods: {
            sendMessage() {
                this.errors = {};
                this.dialog = true;
                this.mail.email_to = [this.mail.email_from];
                this.mail.email_from = this.$store.state.Auth.email;
                this.mail.name = this.$store.state.Auth.name;
                this.mail.user_id = this.$store.state.Auth.id;

                axios.post(`/createMail`, this.mail).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        this.onUserMessages();
                    }
                }).catch(error => {
                    this.dialog = false;
                    this.errors = error.response.data.errors;
                });

            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },
            onUserMessages() {
                this.$router.push('/user_messages');
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