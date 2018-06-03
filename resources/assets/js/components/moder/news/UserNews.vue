<template>
    <div class="wrapper">
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent>
                <template>
                    <div class="progress">
                        <v-progress-circular :size="70" indeterminate color="primary"></v-progress-circular>
                    </div>
                </template>
            </v-dialog>
        </v-layout>

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
                    disable-initial-sort
                    :headers="headers"
                    :items="news"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.created_at }}</td>
                    <td>{{ props.item.title }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>
                        <v-btn icon class="mx-0" v-bind:to="{name:'EditNews',params:{item:props.item}}">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteNews(props.item)">
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
                dialog: false,
                search: '',
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {text: 'Заголовок', value: 'title'},
                    {text: 'Секция', value: 'name'},
                    {text: 'Управление', sortable: false,}
                ],
                news: [],
                sections: []
            }
        },
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                axios.post(`/api/userNews`, {id: this.$store.state.Auth.id}).then(response => {
                    let news = response.data.news;
                    this.sections = response.data.sections;
                    news.forEach((elem, index) => {
                        this.sections.forEach((item, index) => {
                            if (elem.section_id === item.id) {
                                elem.name = item.section_name;
                            }
                        });
                    });
                    this.news = news;
                });
            },
            deleteNews(item) {
                this.dialog = true;
                const index = this.news.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить эту запись?');
                if (answer) {
                    axios.delete(`/api/news/` + item.id).then(response => {
                        if (response.data.status) {
                            this.news.splice(index, 1);
                            this.$store.commit("showInfo", response.data.message);
                            this.dialog = false;
                        }
                    }).catch(error => {
                        if (error.response.status === 404) {
                            this.$store.commit("showError", 'Произошла ошибка при удалении. (Запись не существует.)');
                        }
                        this.dialog = false;
                    });
                }
            },
            onAddNews() {
                this.$router.push({name: 'AddNews', params: {sections: this.sections}});
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