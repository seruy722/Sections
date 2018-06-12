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
        <v-layout>
            <v-subheader class="title">Новое сообщение</v-subheader>
        </v-layout>
        <v-layout row wrap>
            <v-flex xs4>
                <v-subheader>Кому</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :error-messages="checkError('email_to.0')"
                        :items="emails"
                        v-model="selectEmails"
                        label="Кому"
                        chips
                        tags
                        solo
                        clearable
                        prepend-icon="filter_list"
                        append-icon=""
                        max-height="auto"
                        autocomplete
                        required
                >
                    <template slot="selection" slot-scope="data">
                        <v-chip
                                :selected="data.selected"
                                close
                                @input="data.parent.selectItem(data.item)"
                        >
                            {{ data.item}}
                        </v-chip>
                    </template>
                    <template slot="item" slot-scope="data">
                        <template v-if="typeof data.item !== 'object'">
                            <v-list-tile-content v-text="data.item"></v-list-tile-content>
                        </template>
                        <template v-else>
                            <v-list-tile-content>
                                <v-list-tile-title v-html="data.item.email"></v-list-tile-title>
                            </v-list-tile-content>
                        </template>
                    </template>
                </v-select>
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
                    <v-icon dark left>send</v-icon>
                    Отправить
                </v-btn>
                <v-btn color="red" dark @click="onUserMessages">Отмена
                    <v-icon dark right>cancel</v-icon>
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
                mail: {
                    email_to: null,
                    email_from: null,
                    subject: null,
                    msg: null,
                    name: null,
                    user_id: null
                },
                errors: {},
                emails: [],
                selectEmails: []
            }
        },
        created() {
            Auth.check();
            axios.get('/getEmails/' + this.$store.state.Auth.id).then(response => {
                this.emails = response.data.emails;
            });
            if (Object.keys(this.$route.params).length !== 0) {
                this.mail.subject = this.$route.params.subject;
                this.selectEmails.push(this.$route.params.email);
                this.mail.msg = this.$route.params.category;
            }
        },
        methods: {
            sendMessage() {
                this.errors = {};
                this.dialog = true;
                this.mail.email_to = this.selectEmails;
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