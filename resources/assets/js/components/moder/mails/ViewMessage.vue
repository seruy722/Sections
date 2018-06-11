<template>
    <v-container fluid>
        <v-layout row>
            <v-flex xs4>
                <v-subheader>От кого</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-1-3"
                        label="От кого"
                        single-line
                        v-model="mail.email_from"
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
                        label="Тема"
                        single-line
                        v-model="mail.subject"
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
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
            </v-flex>
            <v-flex xs8>
                <v-btn color="red" dark @click="onUserMessages">
                    <v-icon dark left>block</v-icon>
                    Отмена
                </v-btn>
                <v-btn color="primary" dark @click="onReplyMessages">Ответить
                    <v-icon dark right>check_circle</v-icon>
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
                mail: {},
                errors: {}
            }
        },
        created() {
            Auth.check();
            this.mail = this.$route.params.item;
        },
        methods: {
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },
            onReplyMessages() {
                this.$router.push({name: 'ReplyMessage', params: {item: this.mail}});
            },
            onUserMessages() {
                this.$router.push('/user_messages');
            }
        }
    }
</script>