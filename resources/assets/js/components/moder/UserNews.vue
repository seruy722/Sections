<template>
    <div class="wrapper">
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                <v-toolbar color="primary" dark>
                    <v-btn icon dark @click.native="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Редактирование новости</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>

                    </v-toolbar-items>
                </v-toolbar>
                <v-flex xs12 sm6 offset-sm3>
                    <v-container fluid>
                        <v-layout row>
                            <v-flex xs4>
                                <v-subheader>Заголовок</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                        name="input-1-3"
                                        label="Заголовок"
                                        single-line
                                        v-model="itemForView.title"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row>
                            <v-flex xs4>
                                <v-subheader>Изображение</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <div>
                                    <v-btn @click="onButtonClick">
                                        <v-icon>attach_file</v-icon>
                                        Файл
                                    </v-btn>
                                    <input style="display:none" type="file" class="input-field-file" ref="fupload" @change="onFileSelected">
                                    <div>
                                        <img :src="getPath()" class="preview-image">
                                    </div>
                                </div>
                            </v-flex>
                        </v-layout>
                        <v-layout row>
                            <v-flex xs4>
                                <v-subheader>Описание</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                        name="input-2-3"
                                        label="Описание"
                                        single-line
                                        v-model="itemForView.description"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row>
                            <v-flex xs4>
                                <v-subheader>Контент</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                        name="input-4"
                                        label="Контент"
                                        textarea
                                        v-model="itemForView.content"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row>
                            <v-flex xs4>

                            </v-flex>
                            <v-flex xs8>
                                <v-btn color="primary" dark @click="updateItem">Сохранить
                                    <v-icon dark right>check_circle</v-icon>
                                </v-btn>
                                <v-btn color="red" dark @click="">Отмена
                                    <v-icon dark right>block</v-icon>
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
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
                            <v-icon color="teal">edit</v-icon>
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
                axios.post(`/api/userNews`, {id: this.$store.state.Auth.id}).then(response => {
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
            onFileSelected(event) {
                if (event.target.files && event.target.files.length) {
                    let file = event.target.files[0];
                    this.itemForView.file = file;

                    let reader = new FileReader();
                    reader.onload = e => {
                        this.itemForView.img_filename = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            viewItem(item) {
                this.itemForView = item;
                this.dialog = true;
            },
            updateItem(){

            },
            getPath() {
                return "/images/" + this.itemForView.img_filename;
            },
            onAddNews() {
                this.$router.push("/add_news");
            },
            onButtonClick() {
                this.$refs.fupload.click();
            },
        }
    }
</script>