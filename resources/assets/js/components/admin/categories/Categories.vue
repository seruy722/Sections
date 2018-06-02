<template>
    <div class="wrapper">
        <v-card>
            <v-card-title>
                <v-btn color="primary" @click="onAddCategory">Добавить
                    <v-icon>add</v-icon>
                </v-btn>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Поиск"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    disable-initial-sort
                    :headers="headers"
                    :items="categories"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.created_at }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>
                        <v-btn icon class="mx-0" v-bind:to="{name:'EditCategory',params:{item:props.item}}">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteCategory(props.item)">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
                </template>
                <template slot="no-data">
                    <v-alert :value="true" type="info">
                        Нет данных!
                    </v-alert>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Ваш поиск по "{{ search }}" не дал результатов!.
                </v-alert>
            </v-data-table>
        </v-card>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                search: '',
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {text: 'Название', value: 'name'},
                    {text: 'Управление', sortable: false,}
                ],
                categories: []
            }
        },
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                axios.get(`/categories`).then(response => {
                    this.categories = response.data.categories;
                });
            },
            deleteCategory(item) {
                const index = this.categories.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить эту запись?');
                if (answer) {
                    axios.delete('/deleteCategories/' + item.id).then(response => {
                        if (response.data.status) {
                            this.categories.splice(index, 1);
                            this.$store.commit(
                                "showInfo",
                                response.data.message
                            );
                        }
                    });
                }
            },
            onAddCategory() {
                this.$router.push({name:'AddCategory'});
            }
        }
    }
</script>