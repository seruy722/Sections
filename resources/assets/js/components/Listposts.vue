<template>
    <v-app id="inspire" dark>
        <v-navigation-drawer
                v-model="drawer"
                clipped
                fixed
                app
        >
            <v-list dense>
                <v-list-tile @click="">
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
                <v-layout justify-center align-center>
                    <v-flex shrink>
                        <v-tooltip right>
                            <v-btn
                                    slot="activator"
                                    :href="source"
                                    icon
                                    large
                                    target="_blank"
                            >
                                <v-icon large>code</v-icon>
                            </v-btn>
                            <span>Source</span>
                        </v-tooltip>
                        <v-tooltip right>
                            <v-btn slot="activator" icon large href="https://codepen.io/johnjleider/pen/qxQWda"
                                   target="_blank">
                                <v-icon large>mdi-codepen</v-icon>
                            </v-btn>
                            <span>Codepen</span>
                        </v-tooltip>
                    </v-flex>
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
        data() {
            return {
                post: {
                    created_at: '',
                    type: '',
                    price: '',
                    client_id: '',
                    count_place: '',
                    kg: '',
                    fax: '',
                    notation: ''
                },
                posty: [],
                dialog: false,
                headers: [
                    {
                        text: 'Dessert (100g serving)',
                        align: 'left',
                        sortable: false,
                        value: 'name'
                    },
                    {text: 'Calories', value: 'calories'},
                    {text: 'Fat (g)', value: 'fat'},
                    {text: 'Carbs (g)', value: 'carbs'},
                    {text: 'Protein (g)', value: 'protein'},
                    {text: 'Actions', value: 'name', sortable: false}
                ],
                desserts: [],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                    protein: 0
                },
                defaultItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                    protein: 0
                }
            }
        },
        created() {
            this.initialize();
            this.fetchSearch();
            Axios.get(`${this.$store.state.url}api/clients`).then(response => response.data).then(response => {
                this.ADD_CLIENTS(response.data);
            });
        },
        computed: {
            ...mapState([
                'table',
                'posts',
                'search',
                'excel',
                'notification'
            ]),
            ...mapGetters([
                'totalPrice',
                'totalPlace',
                'totalKg',
                'totalCommission',
                'allClients'
            ]),
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            }
        },
        watch: {
            dialog(val) {
                val || this.close()
            }
        },
        methods: {
            ...mapMutations([
                'ADD_CLIENTS',
                'CHANGE_TABLE'
            ]),
            ...mapActions([
                'fetch',
                'destroy'
            ]),
            changeTable() {
                this.CHANGE_TABLE();
                this.fetchSearch();
            },
            fetchSearch() {
                this.fetch();
            },
            desroyEntry(id) {
                this.destroy(id);
                this.fetchSearch();
            },
            addNewPost() {
                this.posty.push(Vue.util.extend({}, this.post));
            },
            removePost(index) {
                this.posty.splice(index, 1);
            },
            initialize() {
                this.desserts = [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                        fat: 6.0,
                        carbs: 24,
                        protein: 4.0
                    },
                    {
                        name: 'Ice cream sandwich',
                        calories: 237,
                        fat: 9.0,
                        carbs: 37,
                        protein: 4.3
                    },
                    {
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        carbs: 23,
                        protein: 6.0
                    },
                    {
                        name: 'Cupcake',
                        calories: 305,
                        fat: 3.7,
                        carbs: 67,
                        protein: 4.3
                    },
                    {
                        name: 'Gingerbread',
                        calories: 356,
                        fat: 16.0,
                        carbs: 49,
                        protein: 3.9
                    },
                    {
                        name: 'Jelly bean',
                        calories: 375,
                        fat: 0.0,
                        carbs: 94,
                        protein: 0.0
                    },
                    {
                        name: 'Lollipop',
                        calories: 392,
                        fat: 0.2,
                        carbs: 98,
                        protein: 0
                    },
                    {
                        name: 'Honeycomb',
                        calories: 408,
                        fat: 3.2,
                        carbs: 87,
                        protein: 6.5
                    },
                    {
                        name: 'Donut',
                        calories: 452,
                        fat: 25.0,
                        carbs: 51,
                        protein: 4.9
                    },
                    {
                        name: 'KitKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7
                    }
                ]
            },
            editItem(item) {
                this.editedIndex = this.desserts.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },

            deleteItem(item) {
                const index = this.desserts.indexOf(item);
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1);
            },

            close() {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },

            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.desserts[this.editedIndex], this.editedItem);
                } else {
                    this.desserts.push(this.editedItem);
                }
                this.close()
            },
            change() {
                console.log(this.posty);
            }
        }
    };
</script>