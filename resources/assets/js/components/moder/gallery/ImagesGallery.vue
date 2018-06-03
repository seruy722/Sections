<template>
    <div>
        <v-container>
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
                            :items="sections"
                            v-model="section"
                            label="Секция"
                            single-line
                            :hint="`${section.section_name}`"
                            item-text="section_name"
                            item-value="section_name"
                            return-object
                            persistent-hint
                            required

                            @change="getImages"
                    ></v-select>
                </v-flex>
            </v-layout>
            <template>
                <v-alert v-if="images==false" :value="true" type="info">
                    Нет данных!
                </v-alert>
            </template>
            <v-layout row wrap>
                <v-flex xs12 sm6 md4
                        v-for="file in files"
                        :key="file.id"
                >
                    <v-card class="mr-3 mb-3">
                        <v-card-media :src="getPath(file)" height="250px" contain
                                      style="cursor: pointer">
                        </v-card-media>
                        <v-card-actions class="justify-center">
                            <v-btn flat @click="onDelete(file)">
                                <v-icon color="pink">delete</v-icon>
                                Удалить
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>

</template>

<script>
    import Auth from "../../../helpers/Auth";

    export default {
        data() {
            return {
                dialog: false,
                sections: [],
                section: {section_name: ''},
                images: []
            };
        },
        created() {
            Auth.check();
            this.getSections();
        },
        computed: {
            files() {
                return this.images;
            }
        },
        methods: {
            getPath(file) {
                return "/images/" + file.name;
            },
            getImages(event) {
                this.dialog = true;
                axios.post(`/imagesGallery`, {section_id: event.id}).then(response => {
                    if (response.data.status) {
                        this.images = response.data.images;
                        this.dialog = false;
                    }
                });
            },
            getSections() {
                axios.post(`/userSections`, {id: this.$store.state.Auth.id}).then(response => {
                    this.sections = response.data.sections;
                });
            },
            onDelete(file) {
                axios.delete("/deleteImage/" + file.id).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        let id = this.images.findIndex(item => {
                            return item.id === file.id;
                        });
                        if (id > -1) {
                            this.images.splice(id, 1);
                        }
                    }
                }).catch(error => {
                    if (error.response.status === 404) {
                        this.$store.commit("showError", 'Произошла ошибка при удалении. (Запись не существует.)');
                    }
                });
            }
        }
    };
</script>

<style>
    .progress {
        text-align: center;
    }

    .progress .progress-circular {
        margin: 1rem;
    }
</style>
