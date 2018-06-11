<template>
    <v-container fluid v-if="sections.length > 0">
        <v-layout class="justify-center">
            <v-subheader class="title">Загрузка изображений</v-subheader>
        </v-layout>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent>
                <template>
                    <div class="progress">
                        <v-progress-circular :size="70" indeterminate color="primary"></v-progress-circular>
                    </div>
                </template>
            </v-dialog>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs4>
                <v-subheader>Секция</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :error-messages="checkError('section_id')"
                        :items="sectionsNames"
                        v-model="select"
                        label="Секция"
                        single-line
                        required
                ></v-select>
            </v-flex>
        </v-layout>

        <div>
            <v-subheader>Одно изображение не должно превышать размер 5мб.</v-subheader>
            <v-btn @click="onButtonClick">
                <v-icon>attach_file</v-icon>
                Изображения
            </v-btn>

            <v-text-field
                    :error-messages="checkError('item_0')"
                    name="item_0"
                    label="Изображения"
                    single-line
                    readonly
            ></v-text-field>

            <input type="file" class="input-field-file" ref="fupload" @change="onFileChange" multiple>

            <v-btn @click="uploadImage">
                <v-icon left>cloud_upload</v-icon>
                Загрузить изображения
            </v-btn>
        </div>
    </v-container>
    <v-container v-else>
        <v-btn color="red" v-bind:to="{name:'UserSections'}">Добавить секцию</v-btn>
    </v-container>
</template>

<script>
    import Auth from "../../../helpers/Auth";

    export default {
        data() {
            return {
                dialog: false,
                sections: [],
                select: '',
                errors: {},
                sectionsNames: [],
                formData: {
                    files: null,
                    section_id: null
                }
            }
        },
        created() {
            Auth.check();
            axios.post(`/userSections`, {id: this.$store.state.Auth.id}).then(response => {
                this.sections = response.data.sections;
                this.sectionsNames = this.sections.map(item => item.section_name);
            });
        },
        methods: {
            onFileChange(event) {
                if (event.target.files && event.target.files.length) {
                    this.formData.files = event.target.files;
                }
            },
            onButtonClick() {
                this.$refs.fupload.click();
            },
            uploadImage() {
                this.dialog = true;
                let files = this.formData.files;
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        this.formData.section_id = item.id;
                    }
                });

                let data = new FormData();
                if (files) {
                    for (let i = 0; i < files.length; i++) {
                        data.append(`item_${i}`, files[i]);
                    }
                } else {
                    data.append('item_0', '');
                }

                data.append('section_id', this.formData.section_id);

                axios.post("/addImage", data).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        this.formData.files = null;
                        data = new FormData();
                        this.errors = {};
                        this.dialog = false;
                    } else {
                        this.dialog = false;
                        this.$store.commit("showError", response.data.message);
                    }

                }).catch(error => {
                    this.dialog = false;
                    this.errors = error.response.data.errors;
                });
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            }
        }
    };
</script>

<style>
    .input-field-file {
        display: none;
    }

    .progress {
        text-align: center;
    }

    .progress .progress-circular {
        margin: 1rem;
    }
</style>