<template>
    <div class="wrapper">
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                <v-toolbar color="primary" dark>
                    <v-btn icon dark @click.native="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Просмотр новости</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>

                    </v-toolbar-items>
                </v-toolbar>
                <v-flex xs12 sm6 offset-sm3>
                    <v-card>
                        <v-card-media
                                class="white--text"
                                height="200px"
                                :src="getPath()"
                        >
                            <v-container fill-height fluid>
                                <v-layout fill-height>
                                    <v-flex xs12 align-end flexbox>
                                        <h3 class="headline">{{itemForView.title}}</h3>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-media>
                        <v-card-text>
                            <div>
                                <h2 class="grey--text">{{itemForView.description}}</h2><br>
                            </div>
                        </v-card-text>
                        <v-card-text>
                            <div>
                                <span class="grey--text">{{itemForView.content}}</span><br>
                            </div>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="orange darken-2" @click.native="dialog = false">
                                <v-icon dark left>arrow_back</v-icon>
                                Назад
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
                <v-divider></v-divider>
            </v-card>
        </v-dialog>
        <v-card>
            <v-card-title>
                <v-btn color="primary" @click="onAddNews">Добавить
                    <v-icon>add</v-icon>
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
                        <v-btn icon class="mx-0" @click="deleteItem(props.item)">
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
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {text: 'Заголовок', value: 'title'},
                    {text: 'Пользователь', value: 'user_name'},
                    {text: 'Управление', sortable: false,}
                ],
                news: [],
                url: "http://sections.loc/",
                dialog: false,
                itemForView: {}
            }
        },
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                axios.post(`/api/userNews`,{id:24}).then(response => {
                    this.news = response.data.data;
                });
            },
            deleteItem(item) {
                const index = this.news.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить эту запись?');
                if (answer) {
                    axios.delete(`/api/news/` + item.id).then(response => {
                        if (response.data.status == 'success') {
                            this.news.splice(index, 1);
                            this.$store.commit(
                                "showInfo",
                                response.data.message
                            );
                        }
                    });
                }
            },
            viewItem(item) {
                this.itemForView = item;
                this.dialog = true;
            },
            getPath() {
                return "/images/" + this.itemForView.img_filename;
            },
            onAddNews(){
                this.$router.push("/add_news");
            }
        }
    }
</script>