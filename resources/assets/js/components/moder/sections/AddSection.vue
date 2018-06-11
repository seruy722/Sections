<template>
    <v-container fluid>
        <v-layout><v-subheader class="title">Добавление секции</v-subheader></v-layout>
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
                        @change="enotherCategory"
                ></v-select>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Название</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        label="Название"
                        single-line
                        v-model="section.section_name"
                        required
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
                            :error-messages="checkError('img_logo')"
                            readonly
                    ></v-text-field>

                    <input style="display:none" type="file" class="input-field-file" ref="fupload"
                           @change="onFileSelected">

                    <div v-if="readyToUpload">
                        <img :src="formData.uploadFileData" class="preview-image">
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
                        name="input-4"
                        label="Описание"
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
        <v-spacer></v-spacer>
        <v-layout row>
            <v-flex xs4></v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="addSection">Сохранить
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
    import Auth from "../../../helpers/Auth";
    export default {
        data() {
            return {
                dialog: false,
                section: {
                    section_name: '',
                    info: '',
                    img_logo: null,
                    user_id: null,
                    category_id: null
                },
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
            Auth.check();
            this.categories = this.$route.params.categories;
            this.sectionsCategory = this.categories.map(item => item.name);
            this.sectionsCategory.push('Другая');
        },
        computed: {
            readyToUpload() {
                return (
                    this.formData.displayFileName && this.formData.uploadFileData
                );
            },
        },
        methods: {
            addSection() {
                this.errors = {};
                this.dialog = true;
                const address = document.querySelector("#location>input[type=text]").value;
                this.section.user_id = this.$store.state.Auth.id;
                this.categories.forEach(item => {
                    if (item.name === this.select) {
                        this.section.category_id = item.id
                    }
                });

                let data = new FormData();
                data.append("fupload", this.section.img_logo);
                data.append('section_name', this.section.section_name);
                data.append('info', this.section.info);
                data.append('category_id', this.section.category_id);
                data.append('user_id', this.section.user_id);
                data.append('address', address);

                axios.post(`/addSections`, data).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        this.onUserSections();
                    }
                }).catch(error => {
                    this.dialog = false;
                    this.errors = error.response.data.errors;
                });

            },
            onFileSelected(event) {
                if (event.target.files && event.target.files.length) {
                    let file = event.target.files[0];
                    this.section.img_logo = file;
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
            enotherCategory(event) {
                if(event === 'Другая'){
                    let adminEmail = null;
                    axios.post('/adminEmail', 1).then(response => {
                        this.$router.push({name:'CreateMessage',params:{subject:'Добавление новой категории',email:response.data.email,category:'ВАША КАТЕГОРИЯ'}});
                    });
                }
            },
            onButtonClick() {
                this.$refs.fupload.click();
            },

            calcSize(size) {
                return Math.round(size / 1024);
            },
            onUserSections() {
                this.$router.push("/user_sections");
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

    .progress {
        text-align: center;
    }

    .progress .progress-circular {
        margin: 1rem;
    }

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