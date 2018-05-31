<template>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs6>
                <v-subheader>Секция</v-subheader>
            </v-flex>
            <v-flex xs6>
                <v-select
                        :items="sectionsNames"
                        v-model="select"
                        label="Секция"
                        single-line
                        required
                ></v-select>
            </v-flex>
        </v-layout>
        <div>
            <v-btn @click="onButtonClick">
                <v-icon>attach_file</v-icon>
                Изображения
            </v-btn>

            <v-text-field
                    v-model="formData.displayFileName"
                    readonly
            ></v-text-field>

            <input type="file" class="input-field-file" ref="fupload" @change="onFileChange" multiple>

            <div v-if="readyToUpload">
                <img :src="formData.uploadFileData" class="preview-image">
            </div>

            <v-btn @click="uploadImage">
                <v-icon left>cloud_upload</v-icon>
                Загрузить изображения
            </v-btn>
        </div>
    </v-container>
</template>

<script>
    import Auth from "../../../helpers/Auth";

    export default {
        data() {
            return {
                sections: [],
                select: '',
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
                let files = this.formData.file;
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        this.formData.section_id = item.id;
                    }
                });
                let data = new FormData();
                for (let i = 0; i < files.length; i++) {
                    data.append(i, files[i]);
                }
                data.append('section_id', this.formData.section_id);
                axios.post("/add_image", data).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        this.formData = {
                            files: null,
                            section_id: null
                        };
                    }

                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    };
</script>

<style>
    .input-field-file {
        display: none;
    }

</style>