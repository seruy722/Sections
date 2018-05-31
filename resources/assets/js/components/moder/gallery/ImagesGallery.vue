<template>
    <div>
        <v-container>
            <v-layout row wrap>
                <v-flex xs4>
                    <v-subheader>Секция</v-subheader>
                </v-flex>
                <v-flex xs8>
                    <v-select
                            :items="sectionsNames"
                            v-model="select"
                            label="Секция"
                            single-line
                            required
                            @change="getImages"
                    ></v-select>
                </v-flex>
            </v-layout>
            <v-layout row wrap>
                <v-flex xs12 sm6 md4
                        v-for="file in files"
                        :key="file.id"
                >
                    <v-card class="mr-3 mb-3">
                        <v-card-media :src="getPath(file)" height="250px" contain
                                      style="cursor: pointer">
                        </v-card-media>
                        <v-card-actions>
                            <v-btn flat @click="onDelete(file)">
                                <v-icon>delete</v-icon>
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
                sectionsNames: [],
                sections: [],
                select: 'Выбор секции...',
                sectionId: null,
                images: [],
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
            getImages() {
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        this.sectionId = item.id;
                    }
                });
                axios.post(`/imagesGallery`, {section_id: this.sectionId}).then(response => {
                    if (response.data.status) {
                        this.images = response.data.images;
                    }
                });
            },
            getSections() {
                axios.post(`/userSections`, {id: this.$store.state.Auth.id}).then(response => {
                    this.sections = response.data.sections;
                    this.sectionsNames = this.sections.map(item => item.section_name);
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
                });
            }
        }
    };
</script>
