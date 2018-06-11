<template>
    <div class="wrapper">
        <v-dialog v-model="dialog" width="100%">
            <v-btn slot="activator" color="primary" dark class="mb-2">Новый</v-btn>
            <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                    <v-spacer></v-spacer>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                        v-model="editedItem.name"
                                        label="Пользователь"
                                        required
                                        :error-messages="checkError('name')"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                        v-model="editedItem.email"
                                        label="Email"
                                        required
                                        :error-messages="checkError('email')"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-select
                                        :items="select"
                                        v-model="editedItem.role"
                                        label="Роль"
                                        required
                                        :error-messages="checkError('role')"
                                ></v-select>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                        v-model="editedItem.password"
                                        label="Пароль"
                                        required
                                        :error-messages="checkError('password')"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="close">Отмена</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="save">Сохранить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-card>
            <v-card-title>
                Пользователи
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
                    :headers="headers"
                    :items="users"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.created_at }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.email }}</td>
                    <td>{{ props.item.role }}</td>
                    <td>
                        <v-btn icon class="mx-0" @click="editUser(props.item)">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteUser(props.item)">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Ваш поиск по "{{ search }}" не дал результатов!.
                </v-alert>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
    import Auth from "../../helpers/Auth";
    export default {
        data() {
            return {
                search: '',
                select: ['moder', 'admin'],
                dialog: false,
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {
                        text: 'Пользователь',
                        sortable: false,
                        value: 'name'
                    },
                    {text: 'Email', value: 'email', sortable: false,},
                    {text: 'Роль', value: 'role', sortable: false,},
                    {text: 'Управление', sortable: false,}
                ],
                users: [],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    email: '',
                    role: '',
                    password: ''
                },
                defaultItem: {
                    name: '',
                    email: '',
                    role: '',
                    password: ''
                },
                errors: {}
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Новый' : 'Редактирование';
            }
        },

        watch: {
            dialog(val) {
                val || this.close();
            }
        },
        created() {
            Auth.check();
            this.initialize();
        },
        methods: {
            initialize() {
                axios.get(`/api/users`).then(response => {
                    this.users = response.data.data;
                });
            },

            editUser(item) {
                this.editedIndex = this.users.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },

            deleteUser(item) {
                const index = this.users.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить этого пользователя?');
                if (answer) {
                    axios.delete(`/api/users/` + item.id).then(response => {
                        if (response.data.status) {
                            this.users.splice(index, 1);
                            this.$store.commit("showInfo", response.data.message);
                        }
                    });
                }
            },

            close() {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300);
            },

            save() {
                this.errors = {};
                if (this.editedIndex > -1) {
                    axios.patch(`/api/users/` + this.users[this.editedIndex]['id'], Object.assign(this.users[this.editedIndex], this.editedItem)).then(response => {
                        if (response.data.status) {
                            this.$store.commit("showInfo", response.data.message);
                            this.close();
                        }
                    }).catch(error => {
                        this.errors = error.response.data.errors;
                    });
                } else {
                    let item = this.editedItem;
                    item.created_at = this.formatDate(new Date());

                    axios.post(`/api/users`, this.editedItem).then(response => {
                        if (response.data.status) {
                            this.users.push(item);
                            this.$store.commit("showInfo", response.data.message);
                            this.close();
                        }
                    }).catch(error => {
                        this.errors = error.response.data.errors;
                    });
                }

            },
            formatDate(date) {
                let dd = date.getDate();
                if (dd < 10) dd = '0' + dd;
                let mm = date.getMonth() + 1;
                if (mm < 10) mm = '0' + mm;
                let yy = date.getFullYear();
                if (yy < 10) yy = '0' + yy;
                return dd + '-' + mm + '-' + yy;
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            }
        }
    }
</script>

