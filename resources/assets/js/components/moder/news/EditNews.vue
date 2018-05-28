<template>
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
                        v-model="news.title"
                        :error-messages="checkError('title')"
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
                    <v-text-field
                            v-model="formData.displayFileName"
                            :error-messages="checkError('fupload')"
                            readonly
                    ></v-text-field>

                    <input style="display:none" type="file" class="input-field-file" ref="fupload"
                           @change="onFileSelected">

                    <div v-if="readyToUpload">
                        <img :src="formData.uploadFileData" class="preview-image">
                    </div>
                    <div v-if="image">
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
                        v-model="news.description"
                        :error-messages="checkError('description')"
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
                        v-model="news.content"
                        :error-messages="checkError('content')"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
            </v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="updateItem">Обновить
                    <v-icon dark right>check_circle</v-icon>
                </v-btn>
                <v-btn color="red" dark @click="onUserNews">Отмена
                    <v-icon dark right>block</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                news: {},
                formData: {
                    displayFileName: null,
                    uploadFileData: null,
                    file: null
                },
                image: true,
                errors:{}
            }
        },
        created() {
            this.news = this.$route.params.item;
        },
        computed: {
            readyToUpload() {
                return (
                    this.formData.displayFileName && this.formData.uploadFileData
                );
            }
        },
        methods: {
            onUserNews() {
                this.$router.push("/user_news");
            },
            updateItem() {
                this.news.user_id = this.$store.state.Auth.id;
                let data = new FormData();
                data.append("fupload", this.news.file);
                data.append("id", this.news.id);
                data.append('title', this.news.title);
                data.append('description', this.news.description);
                data.append('content', this.news.content);
                data.append('user_id', this.news.user_id);

                axios.post(`/api/updateNews`, data).then(response => {
                    if (response.data.status === 'success') {
                        setTimeout(this.onUserNews, 3000);
                    }
                    this.$store.commit(
                        "showInfo",
                        response.data.message
                    );
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });

            },

            onFileSelected(event) {
                if (event.target.files && event.target.files.length) {
                    this.image = false;
                    let file = event.target.files[0];
                    this.news.file = file;
                    this.news.image_name = event.target.files[0].name;
                    this.formData.displayFileName =
                        event.target.files[0].name +
                        " (" +
                        this.calcSize(file.size) +
                        "Kb)";

                    let reader = new FileReader();
                    reader.onload = e => {
                        this.formData.uploadFileData = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            onButtonClick() {
                this.$refs.fupload.click();
            },

            calcSize(size) {
                return Math.round(size / 1024);
            },
            getPath() {
                let path = "/images/" + this.news.image_name;
                let res = path.indexOf('.');
                return (res != -1) ? path : this.image = false;
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            }
        }
    }
</script>