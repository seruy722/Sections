<template>
    <div class="wrapper">
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click.native="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Просмотр новости</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click="activeItem(itemForView)">Активировать</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-flex xs12 sm6 offset-sm3>
                    <v-card>
                        <v-card-media
                                class="white--text"
                                height="200px"
                                src="/static/doc-images/cards/docks.jpg"
                        >
                            <v-container fill-height fluid>
                                <v-layout fill-height>
                                    <v-flex xs12 align-end flexbox>
                                        <span class="headline">{{itemForView.title}}</span>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-media>
                        <v-card-title>
                            <div>
                                <span class="grey--text">Number 10</span><br>
                                <span>Whitehaven Beach</span><br>
                                <span>Whitsunday Island, Whitsunday Islands</span>
                            </div>
                        </v-card-title>
                        <v-card-actions>
                            <v-btn flat color="orange">Share</v-btn>
                            <v-btn flat color="orange">Explore</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="">Отмена</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="">Сохранить</v-btn>
                </v-card-actions>
                <v-divider></v-divider>
            </v-card>
        </v-dialog>
        <v-card>
            <v-card-title>
                Новости
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
                    :items="news"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.created_at }}</td>
                    <td>{{ props.item.title }}</td>
                    <td>{{ props.item.user_name }}</td>
                    <td>
                        <v-btn icon class="mx-0" @click="viewItem(props.item)">
                            <v-icon color="teal">pageview</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="activeItem(props.item)">
                            <v-icon color="green">offline_pin</v-icon>
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
    export default {
        data() {
            return {
                search: '',
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {text: 'Заголовок', value: 'title'},
                    {text: 'Пользователь', value: 'user_name'},
                    {text: 'Управление', sortable: false,}
                ],
                news: [],
                url: "http://sections.loc/",
                dialog: false,
                itemForView:{}
            }
        },
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                Axios.get(`${this.$store.state.url}api/news`).then(response => {
                    this.news = response.data.data;
                });
            },
            activeItem(item) {
                const index = this.news.indexOf(item);
                item.active = true;
                Axios.patch(`${this.$store.state.url}api/news/` + item.id, item).then(response => {
                    if (response.data.status === 'success') {
                        this.news.splice(index, 1);
                    }
                });
                this.dialog = false;
            },
            viewItem(item) {
                this.itemForView = item;
                this.dialog = true;
            }
        }
    }
</script>