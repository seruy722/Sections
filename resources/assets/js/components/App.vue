<template>
    <v-app>
        <v-toolbar dark color="primary">
            <v-toolbar-title>Панель управления</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn
                    flat
                    v-for="item in nav"
                    :to="item.path"
                    :key="item.path"
                    v-if="item.role === role && item.auth === auth.login"
            >{{ item.title }}
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn
                    flat
                    v-for="item in authNav"
                    :to="item.path"
                    :key="item.path"
                    v-if="item.auth === auth.login"
            >{{ item.title }}
            </v-btn>
            <v-btn flat @click="mainPage">На Сайт</v-btn>
            <v-avatar size="55" v-if="auth.login">
                <img :src="profileImage">
            </v-avatar>

            <v-menu offset-y v-if="auth.login">
                <v-btn flat slot="activator">
                    {{ auth.name }}
                </v-btn>

                <v-list>
                    <v-list-tile
                            v-for="item in profileNav"
                            :key="item.path"
                            @click="onClick(item)"
                    >{{ item.title }}
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar>

        <v-content>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-content>

        <v-snackbar top
                    :timeout="info.timeout"
                    v-model="info.show"
                    color="success"
        >
            {{ info.text }}
            <v-btn dark flat @click.native="info.show = false">Закрыть</v-btn>
        </v-snackbar>

        <v-snackbar top
                    :timeout="error.timeout"
                    v-model="error.show"
                    color="error"
        >
            {{ error.text }}
            <v-btn dark flat @click.native="error.show = false">Закрыть</v-btn>
        </v-snackbar>

    </v-app>
</template>

<script>
    import {mapState} from "vuex";
    import Auth from "../helpers/Auth";

    export default {
        created() {
            Auth.init();
            Auth.check();
        },

        computed: {
            ...mapState(["info", "nav", "authNav", "profileNav", 'error']),
            auth() {
                return this.$store.state.Auth;
            },

            profileImage() {
                if (this.$store.state.Auth.photo != 'null') {
                    return this.$store.state.Auth.photo;
                } else {
                    return '/users/nofoto.png';
                }

            },
            role() {
                return this.$store.state.Auth.role;
            }
        },

        data() {
            return {
                active: null
            };
        },

        methods: {
            onClick(item) {
                if (item.path !== "/logout") {
                    this.$router.push(item.path);

                    return true;
                }

                axios.post("/api/logout").then(response => {
                    if (response.data.success) {
                        Auth.logout();
                        this.$router.push("/controls");
                    }
                });
            },
            mainPage() {
                window.location = window.location.origin + '#home';
            }
        }
    };
</script>
