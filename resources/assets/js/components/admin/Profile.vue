<template>
    <div>
        <v-container>
            <v-layout>
                <v-flex sm10 offset-sm1>
                    <v-layout>
                        <v-flex sm4 class="pr-3 text-sm-center">
                            <v-card class="pt-2">
                                <v-card-text>
                                    <img :src="profileImage" class="profile-image">
                                    <input type="file" ref="profileimage" @change="onUploadImage"
                                           class="profile-image-input">
                                </v-card-text>

                                <v-btn class="mt-1" color="primary" @click="onSelectImage">
                                    Обновить фото
                                </v-btn>
                            </v-card>
                        </v-flex>
                        <v-flex sm8>
                            <v-card>
                                <v-card-title>
                                    <h2>Обновить профайл</h2>
                                </v-card-title>

                                <v-card-text>
                                    <v-layout row>
                                        <v-text-field
                                                label="Имя"
                                                v-model="form.name"
                                                :error-messages="checkError('name')"
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row>
                                        <v-text-field
                                                label="Email"
                                                v-model="form.email"
                                                :error-messages="checkError('email')"
                                                disabled
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row v-if="!role()">
                                        <v-text-field
                                                label="Email для обратной связи"
                                                v-model="form.feedback_email"
                                                :error-messages="checkError('feedback_email')"
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row>
                                        <v-text-field
                                                label="Телефон (+380977451425)"
                                                v-model="form.phone"
                                                :error-messages="checkError('phone')"
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row>
                                        <v-flex xs12 class="text-xs-center">
                                            <v-btn @click="onUpdate('profile')">
                                                Обновить
                                            </v-btn>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                            </v-card>

                            <v-card class="mt-3">
                                <v-card-title>
                                    <h2>Обновить пароль</h2>
                                </v-card-title>

                                <v-card-text>

                                    <v-layout row>
                                        <v-text-field
                                                label="Старый пароль"
                                                v-model="form.old_password"
                                                :error-messages="checkError('old_password')"
                                                type="password"
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row>
                                        <v-text-field
                                                label="Новый пароль"
                                                v-model="form.password"
                                                :error-messages="checkError('password')"
                                                type="password"
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row>
                                        <v-text-field
                                                label="Повторите пароль"
                                                v-model="form.password_confirmation"
                                                type="password"
                                        ></v-text-field>
                                    </v-layout>

                                    <v-layout row>
                                        <v-flex xs12 class="text-xs-center">
                                            <v-btn @click="onUpdate('password')">
                                                Обновить
                                            </v-btn>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import Auth from "../../helpers/Auth";

    export default {
        computed: {
            profileImage() {
                if (this.$store.state.Auth.photo != 'null') {
                    return this.$store.state.Auth.photo;
                } else {
                    return '/users/nofoto.png';
                }
            }
        },

        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    feedback_email: null,
                    password: null,
                    phone: null,
                    password_confirmation: null,
                    action: null
                },

                errors: {}
            };
        },

        created() {
            Auth.check();
            this.edit_profile();
        },

        methods: {
            edit_profile() {
                axios.post("/api/edit_profile")
                    .then(response => {
                        if (response.data.success) {
                            this.form = response.data.user;
                            this.form.password = null;
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 401) {
                            Auth.logout();
                            this.$router.push("/login");
                        }
                    });
            },

            onUpdate(action) {
                this.errors = {};
                this.form.action = action;

                if (this.role()) {
                    delete this.form.feedback_email;
                }
                axios.post("/api/update_profile", this.form)
                    .then(response => {
                        if (response.data.success) {
                            Auth.login(response.data.user);
                            this.$store.commit("showInfo", "Ваш профиль обновлен!");
                        }
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            },

            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },

            onSelectImage() {
                this.$refs.profileimage.click();
            },

            onUploadImage(e) {
                if (e.target.files && e.target.files.length) {
                    let file = e.target.files[0];
                    let data = new FormData();
                    this.form.action = "photo";
                    for (let i in this.form) {
                        data.append(i, this.form[i]);
                    }
                    data.append("profilephoto", file);

                    axios.post("/api/update_profile", data).then(response => {
                        if (response.data.success) {
                            Auth.login(response.data.user);

                            this.$store.commit("showInfo", "Ваше фото обновлено.");
                        }
                    });
                }
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
    };
</script>

<style>
    .profile-image {
        width: 200px;
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, 0.5);
    }

    .profile-image-input {
        display: none;
    }
</style>
