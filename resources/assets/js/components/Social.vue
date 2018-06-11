<template>
    <v-container fluid>
        <v-layout>
            <v-subheader class="title">Добавление ссылок на соцсети</v-subheader>
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

        <v-layout row wrap v-if="role()">
            <v-flex xs4>
                <v-subheader>Секция</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :error-messages="checkError('section_id')"
                        :items="sectionNames"
                        v-model="select"
                        label="Секция"
                        single-line
                        required
                        @change="getSocials"
                ></v-select
                >
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Facebook</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        label="Facebook"
                        v-model="social.fb"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Twitter</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-3"
                        label="Twitter"
                        v-model="social.tw"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Instagram</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-3"
                        label="Instagram"
                        v-model="social.inst"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Vkontakte</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        name="input-3"
                        label="Vkontakte"
                        v-model="social.vk"
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>

            </v-flex>
            <v-flex xs8>
                <v-btn color="primary" dark @click="addSocialLinks">Сохранить
                    <v-icon dark right>check_circle</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Auth from "../helpers/Auth";

    export default {
        data() {
            return {
                dialog: false,
                social: {
                    fb: null,
                    inst: null,
                    tw: null,
                    vk: null,
                    section_id: null || 0
                },
                sectionsName: [],
                sections: [],
                errors: {},
                select: null,
                sectionNames: []
            }
        },
        created() {
            Auth.check();
            axios.post('/userSections', {id: this.$store.state.Auth.id}).then(response => {
                this.sections = response.data.sections;
                this.sectionNames = this.sections.map(item => item.section_name);
            });
            if(!this.role()){
                this.getSocials();
            }
        },
        methods: {
            addSocialLinks() {
                this.errors = {};
                this.dialog = true;
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        this.social.section_id = item.id

                    }
                });

                axios.post('/addSocialsLinks', this.social).then(response => {
                    if (response.data.status) {
                        this.$store.commit("showInfo", response.data.message);
                        this.dialog = false;
                    }
                }).catch(error => {
                    this.dialog = false;
                    this.errors = error.response.data.errors;
                });

            },
            getSocials(event) {
                this.sections.forEach(item => {
                    if (item.section_name === event) {
                        this.social.section_id = item.id

                    }
                });

                axios.post('/getSocialsLinks', {'id': this.social.section_id}).then(response => {
                    this.social = response.data.socials[0];
                });
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },
            role() {
                let role = this.$store.state.Auth.role;
                if (role === 'admin') {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
</script>

<style>
    .progress {
        text-align: center;
    }

    .progress .progress-circular {
        margin: 1rem;
    }
</style>