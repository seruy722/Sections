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
                    displayFileName: null,
                    uploadFileData: null,
                    file: null,
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
        computed: {
            readyToUpload() {
                return (
                    this.formData.displayFileName && this.formData.uploadFileData
                );
            }
        },
        methods: {
            onFileChange(event) {
                console.log('dsfsdf');
                if (event.target.files && event.target.files.length) {
                    let file = event.target.files;
                    this.formData.file = file;
                    // this.formData.displayFileName =
                    //     event.target.files[0].name +
                    //     " (" +
                    //     this.calcSize(file.size) +
                    //     "Kb)";
                    // let reader = new FileReader();
                    // reader.onload = e => {
                    //     this.formData.uploadFileData = e.target.result;
                    // };
                    // reader.readAsDataURL(file);
                }
            },
            onButtonClick() {
                this.$refs.fupload.click();
            },
            calcSize(size) {
                return Math.round(size / 1024);
            },
            uploadImage() {
                let files = this.formData.file;
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        this.formData.section_id = item.id;
                    }
                });
                let data = new FormData();
                for (var i = 0; i < files.length; i++) {
                    data.append(i, files[i]);
                }
                data.append('section_id', this.formData.section_id);
                axios.post("/add_image", data).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        this.formData = {
                            displayFileName: null,
                            uploadFileData: null,
                            file: null,
                            section_id: null
                        };
                    }

                });
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