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
                ></v-select>
            </v-flex>
        </v-layout>
        <div>
            <v-btn @click="onButtonClick">
                <v-icon>attach_file</v-icon>
                Select File
            </v-btn>

            <v-text-field
                    v-model="formData.displayFileName"
                    readonly
            ></v-text-field>

            <input type="file" class="input-field-file" ref="fupload" @change="onFileChange">

            <div v-if="readyToUpload">
                <img :src="formData.uploadFileData" class="preview-image">
            </div>

            <v-btn v-if="readyToUpload" @click="uploadImage">
                <v-icon left>cloud_upload</v-icon>
                Upload File
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
                select: null,
                sectionsNames: null,
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
            uploadImage() {
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        this.formData.section_id = item.id;
                    }
                });
                let data = new FormData();
                data.append("fupload", this.formData.file);
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
            },
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