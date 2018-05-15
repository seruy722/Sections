<template>
    <v-app id="inspire" dark>
        <v-navigation-drawer
                v-model="drawer"
                clipped
                fixed
                app>
            <v-list dense>
                <v-list-tile v-bind:to="{name:'Editpost'}">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Dashboard</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>settings</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Настройки</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app fixed clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Админ панель</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout >
                    <transition name="fade">
                        <router-view></router-view>
                    </transition>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app fixed>
            <span>&copy; 2018</span>
        </v-footer>
    </v-app>
</template>

<script>
    import {mapActions, mapGetters, mapMutations, mapState} from 'vuex';

    export default {
        data: () => ({
            drawer: true
        }),
        props: {
            source: String
        }
    };
</script>