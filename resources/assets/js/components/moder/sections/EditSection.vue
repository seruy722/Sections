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

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Категория</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :items="sectionsCategory"
                        v-model="select"
                        label="Категория"
                        required
                        :error-messages="checkError('category_id')"
                ></v-select>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Название</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-1-3"
                        required
                        label="Название"
                        single-line
                        v-model="section.section_name"
                        :error-messages="checkError('section_name')"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Логотип</v-subheader>
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
                <v-subheader>О нас</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-2-3"
                        label="О нас"
                        single-line
                        textarea
                        required
                        v-model="section.info"
                        :error-messages="checkError('info')"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Адрес</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-2-3"
                        label="Адрес"
                        single-line
                        v-model="section.address"
                        readonly
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Новый адрес</v-subheader>
            </v-flex>
            <v-flex xs8>
                <div class="EventLocation__wrapper">
                    <div id="location">
                        <gmap-autocomplete></gmap-autocomplete>
                        <div class="loc_error">{{errors.address}}</div>
                    </div>
                    <input type="hidden" v-model="location.lat" name="lat">
                    <input type="hidden" v-model="location.lng" name="lng">
                </div>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
            </v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="updateSection">Обновить
                    <v-icon dark right>check_circle</v-icon>
                </v-btn>
                <v-btn color="red" dark @click="onUserSections">Отмена
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
                image: true,
                dialog: false,
                section: {},
                formData: {
                    displayFileName: null,
                    uploadFileData: null,
                    file: null
                },
                errors: {},
                select: null,
                sectionsCategory: [],
                categories: [],
                location: {
                    lat: 19.065236,
                    lng: 72.995742
                },
                markers: [{
                    position: {lat: 10.0, lng: 10.0}
                }],
            }
        },
        created() {
            this.section = this.$route.params.item;
            this.categories = this.$route.params.categories;
            this.sectionsCategory = this.categories.map(item => item.name);
            this.categories.forEach(item => {
                if (item.id === this.section.category_id) {
                    this.select = item.name;
                }
            });
        },
        computed: {
            readyToUpload() {
                return (
                    this.formData.displayFileName && this.formData.uploadFileData
                );
            }
        },
        methods: {
            onUserSections() {
                this.$router.push("/user_sections");
            },
            updateSection() {
                this.errors = {};
                const address = document.querySelector("#location>input[type=text]").value;
                this.categories.forEach(item => {
                    if (item.name === this.select) {
                        this.section.category_id = item.id
                    }
                });

                let data = new FormData();
                data.append("fupload", this.section.file);
                data.append('section_name', this.section.section_name);
                data.append('info', this.section.info);
                data.append('category_id', this.section.category_id);
                data.append('address', address);
                data.append('id', this.section.id);


                axios.post(`/updateSection`, data).then(response => {
                    this.dialog=true;
                    if (response.data.status) {
                        this.$store.commit(
                            "showInfo",
                            response.data.message
                        );
                        this.onUserSections();
                    }
                }).catch(error => {
                    this.dialog = false;
                    this.errors = error.response.data.errors;
                });

            },

            onFileSelected(event) {
                this.image = false;
                if (event.target.files && event.target.files.length) {
                    let file = event.target.files[0];
                    this.section.file = file;
                    this.section.img_logo = event.target.files[0].name;
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
                let path = "/images/" + this.section.img_logo;
                let res = path.indexOf('.');
                return (res != -1) ? path : this.image = false;
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            }
        }
    }
</script>

<style>
    #location input {
        display: block;
        width: 100%;
        height: 40px;
        padding: 10px 15px;
        border: 1px solid grey;
        outline: none;
    }

    #location input:focus {
        border: 2px solid #1976D2;
    }

    .loc_error {
        color: red;
        font-size: 12px;
        background-color: white !important;
    }

    .progress{
        text-align: center;
    }
    .progress .progress-circular{
        margin: 1rem;
    }


    .input-field-file {
        display: none;
    }
</style>