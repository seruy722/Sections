<template>
    <v-stepper v-model="e1">
        <v-stepper-header>
            <v-stepper-step :complete="e1 > 1" step="1">Логотип сайта</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 2" step="2">Главная картинка сайта</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step step="3">Заголовок сайта</v-stepper-step>
        </v-stepper-header>
        <v-stepper-items>
            <v-stepper-content step="1">
                <v-card color="grey lighten-1" class="mb-5">
                    <div>
                        <v-btn @click="onButtonClick">
                            <v-icon>attach_file</v-icon>
                            Логотип
                        </v-btn>

                        <v-text-field
                                v-model="formData.displayFileName"
                                readonly
                        ></v-text-field>

                        <input type="file" class="input-field-file" ref="fupload" @change="onFileChange">

                        <div v-if="readyToUpload">
                            <img :src="formData.uploadFileData" class="preview-image">
                        </div>

                        <v-btn v-if="readyToUpload" @click="uploadImage('logo')">
                            <v-icon left>cloud_upload</v-icon>
                            Загрузить файл
                        </v-btn>
                    </div>
                </v-card>
                <v-btn color="primary" @click.native="e1 = 2">Вперед
                    <v-icon dark right>arrow_forward</v-icon>
                </v-btn>
            </v-stepper-content>
            <v-stepper-content step="2">
                <v-card color="grey lighten-1" class="mb-5">
                    <div>
                        <v-btn @click="onButtonClick">
                            <v-icon>attach_file</v-icon>
                            Главная картинка
                        </v-btn>

                        <v-text-field
                                v-model="formData.displayFileName"
                                readonly
                        ></v-text-field>

                        <input type="file" class="input-field-file" ref="fupload" @change="onFileChange">

                        <div v-if="readyToUpload">
                            <img :src="formData.uploadFileData" class="preview-image">
                        </div>

                        <v-btn v-if="readyToUpload" @click="uploadImage('mainImg')">
                            <v-icon left>cloud_upload</v-icon>
                            Загрузить файл
                        </v-btn>
                    </div>
                </v-card>
                <v-btn color="primary" dark @click.native="e1 = 1">
                    <v-icon dark left>arrow_back</v-icon>
                    Назад
                </v-btn>
                <v-btn color="primary" @click.native="e1 = 3">Вперед
                    <v-icon dark right>arrow_forward</v-icon>
                </v-btn>
            </v-stepper-content>
            <v-stepper-content step="3">
                <v-card color="grey lighten-1" class="mb-5">
                    <v-container fluid>
                        <v-layout row>
                            <v-flex xs4>
                                <v-subheader>Заголовок сайта</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                        name="input-1"
                                        label="Заголовок"
                                        v-model="headers.headerText"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row>
                            <v-flex xs4>
                                <v-subheader>Copyright</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                        name="input-2"
                                        label="Сopyright"
                                        v-model="headers.copyright"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row>
                            <v-flex xs4>
                                <v-btn color="primary" dark @click="saveHeaders">Accept
                                    <v-icon dark right>check_circle</v-icon>
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
                <v-btn color="primary" @click.native="e1 = 1">Вперед
                    <v-icon dark right>arrow_forward</v-icon>
                </v-btn>
            </v-stepper-content>
        </v-stepper-items>
    </v-stepper>


</template>

<script>
    import Auth from "../../helpers/Auth";

    export default {
        created() {
            Auth.check();
        },

        computed: {
            readyToUpload() {
                return (
                    this.formData.displayFileName && this.formData.uploadFileData
                );
            }
        },

        data() {
            return {
                formData: {
                    displayFileName: null,
                    uploadFileData: null,
                    file: null
                },
                e1: 0,
                headers: {
                    headerText: null,
                    copyright: null
                }

            };
        },

        methods: {
            onFileChange(event) {
                if (event.target.files && event.target.files.length) {
                    let file = event.target.files[0];
                    this.formData.file = file;
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

            uploadImage(name) {
                let data = new FormData();
                data.append("fupload", this.formData.file);
                data.append("name", name);

                axios.post("/api/upload_file", data).then(response => {
                    this.showInfo("Файл успешно загружен!");
                    this.formData = {
                        displayFileName: null,
                        uploadFileData: null,
                        file: null
                    };
                });
            },
            saveHeaders() {
                axios.post("/api/save_headers", this.headers).then(response => {
                    if (response.data.status == 'success') {
                        this.showInfo(response.data.message);
                        this.headers = {
                            headerText: null,
                            copyright: null
                        };
                    }
                });
            },
            showInfo(message) {
                this.$store.commit("showInfo", message);
            }
        }
    };
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
