<template>

    <div class="wrapper">
        <v-card>
            <v-card-title>
                <v-btn color="primary" v-bind:to="{name:'CreateMessage'}">
                    <v-icon dark left>mail_outline</v-icon>
                    Написать
                </v-btn>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Поиск"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    disable-initial-sort
                    :headers="headers"
                    :items="mails"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td v-bind:class="{'danger':props.item.read_it=='0'}">{{ props.item.created_at }}</td>
                    <td>{{ props.item.subject }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>
                        <v-btn icon class="mx-0" @click="readMessage(props.item)">
                            <v-icon color="teal">pageview</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
                </template>
                <template slot="no-data">
                    <v-alert :value="true" type="info">
                        Нет данных!
                    </v-alert>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Ваш поиск по "{{ search }}" не дал результатов!.
                </v-alert>
            </v-data-table>
        </v-card>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                search: '',
                headers: [
                    {text: 'Дата', value: 'created_at'},
                    {text: 'Заголовок', value: 'subject'},
                    {text: 'Пользователь', value: 'name'},
                    {text: 'Управление', sortable: false,}
                ],
                mails: [],
            }
        },
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                axios.post(`/mailsForUser`, {email: this.$store.state.Auth.email}).then(response => {
                    this.mails = response.data;
                    this.mails.forEach(item => {
                        if (item.name == this.$store.state.Auth.name) {
                            item.name = 'Я';
                        }
                        item.created_at = this.formatDate(new Date(item.created_at));
                    });
                });
            },
            deleteItem(item) {
                const index = this.mails.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить это сообщение?');
                if (answer) {
                    axios.delete(`/deleteMail/` + item.id).then(response => {
                        if (response.data.status) {
                            this.mails.splice(index, 1);
                            this.$store.commit(
                                "showInfo",
                                response.data.message
                            );
                        }
                    });
                }
            },
            readMessage(item) {
                axios.post(`/updateMail`, item).then(response => {
                    if (response.data.status) {
                        this.$router.push({name:'ViewMessage',params:{item:item}});
                    }
                });
            },
            formatDate(date) {
                let dd = date.getDate();
                if (dd < 10) dd = '0' + dd;

                let mm = date.getMonth() + 1;
                if (mm < 10) mm = '0' + mm;

                let yy = date.getFullYear();
                if (yy < 10) yy = '0' + yy;

                return dd + '-' + mm + '-' + yy;
            }

        }
    }
</script>

<style>
    .danger {
        color: red;
    }
</style>