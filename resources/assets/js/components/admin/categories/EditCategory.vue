<template>
    <v-container fluid>
        <v-layout row>
            <v-flex xs4>
                <v-subheader>Название</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        :error-messages="checkError('name')"
                        label="Название"
                        v-model="category.name"
                        single-line
                        required
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
                        Изображение
                    </v-btn>

                    <v-text-field
                            :error-messages="checkError('image')"
                            v-model="formData.displayFileName"
                            readonly
                            required
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

            </v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="editCategory">Обновить
                    <v-icon dark right>check_circle</v-icon>
                </v-btn>
                <v-btn color="red" dark @click="onUserCategories">Отмена
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
                category: {
                    name: '',
                    image: null
                },
                formData: {
                    displayFileName: null,
                    uploadFileData: null
                },
                errors: {},
                image: true
            }
        },
        created() {
            this.category = this.$route.params.item;
        },
        computed: {
            readyToUpload() {
                return (
                    this.formData.displayFileName && this.formData.uploadFileData
                );
            }
        },
        methods: {
            editCategory() {
                this.errors = {};

                let data = new FormData();
                data.append("image", this.category.image);
                data.append('name', this.category.name);
                data.append('id', this.category.id);

                axios.post('/editCategory', data).then(response => {
                    if (response.data.status) {
                        this.$store.commit(
                            "showInfo",
                            response.data.message
                        );
                        data = new FormData();
                        this.onUserCategories();
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    this.$store.commit(
                        "showInfo",
                        this.errors.message
                    );
                });

            },
            onFileSelected(event) {
                delete this.errors.image;
                if (event.target.files && event.target.files.length) {
                    let file = event.target.files[0];
                    this.category.image = file;
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
            onUserCategories() {
                this.$router.push("/sections_categories");
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },
            getPath() {
                let path = "/images/" + this.category.image;
                let res = path.indexOf('.');
                return (res != -1) ? path : this.image = false;
            },
        }
    }
</script>

<style>
    .input-field-file {
        display: none;
    }

    .preview-image {
        width: 250px;
        padding: 15px;
        border: 1px solid #999;
        border-radius: 5px;
    }
</style>