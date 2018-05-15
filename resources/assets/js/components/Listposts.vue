<template id="post-list">
    <div class="row">
        <div>
            <div class="row">
                <div class="col-md-4">
                    <span class="glyphicon glyphicon-calendar"></span>
                    <input type="date" @change="fetchSearch" v-model="search.dateStart">
                    <input type="date" @change="fetchSearch" v-model="search.dateLast">
                </div>
                <div class="col-md-3">
                    <span class="glyphicon glyphicon-user"></span>
                    <input list="client" v-model="search.client" @change="$event.target.select();fetchSearch()"
                           @click="$event.target.select()">
                    <datalist id="client">
                        <option value="Все">0</option>
                        <option v-for="(client,index) in allClients" :key="index" v-bind:value="client.name">
                            {{client.id}}
                        </option>
                    </datalist>
                </div>
                <div class="col-md-2">
                    <span class="glyphicon glyphicon-th-list"></span>
                    <select class="list-group" @change="changeTable">
                        <option value="cargos">КАРГО</option>
                        <option value="debts" v-bind:selected="table==='debts'">ДОЛГИ</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <span class="glyphicon glyphicon-th-list"></span>
                    <select class="list-group" v-model="search.typeTable" @change="fetchSearch">
                        <option v-bind:value="null">Все</option>
                        <option value="Оплата">ОПЛАТА</option>
                        <option value="Долг">ДОЛГ</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <download-excel
                            class="btn btn-success"
                            :data='excel.excelData'
                            :fields="excel.jsonFields"
                            :meta="excel.jsonMeta"
                            :name="search.client">
                        Excel
                    </download-excel>
                    <br><br>
                </div>
            </div>
        </div>
        <div>{{notification}}</div>
        <button @click="change">Click</button>
        <div>
            <div class="row">
                <div class="col-xs-2">
                    <button type="button" @click="addNewPost" class="btn btn-block btn-success">
                        <span class="glyphicon glyphicon-plus"></span>
                        Добавить
                    </button>
                </div>
            </div>
            <div v-for="(post,index) in posty">
                <div class="row">
                    <div class="col-xs-2">
                        <button type="button" @click="removePost(index)" class="btn btn-block btn-danger">
                            <span class="glyphicon glyphicon-minus"></span>
                            Удалить
                        </button>
                    </div>
                    <div class="form-group col-xs-5">
                        <label>Price (HUF)</label>
                        <input v-model="post.price" type="number" class="form-control" placeholder="Price">
                    </div>
                    <div class="form-group col-xs-5">
                        <label>Rooms (PCS)</label>
                        <input v-model="post.kg" type="number" class="form-control" placeholder="Rooms">
                    </div>
                </div>
            </div>
            <div v-if="post" class="row">
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-block btn-primary">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
        <div>
            <v-dialog v-model="dialog" max-width="500px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-data-table
                    :headers="headers"
                    :items="desserts"
                    hide-actions
                    class="elevation-1"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.name }}</td>
                    <td class="text-xs-right">{{ props.item.calories }}</td>
                    <td class="text-xs-right">{{ props.item.fat }}</td>
                    <td class="text-xs-right">{{ props.item.carbs }}</td>
                    <td class="text-xs-right">{{ props.item.protein }}</td>
                    <td class="justify-center layout px-0">
                        <v-btn icon class="mx-0" @click="editItem(props.item)">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
                </template>
                <template slot="no-data">
                    <v-btn color="primary" @click="initialize">Reset</v-btn>
                </template>
            </v-data-table>
        </div>
    </div>
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