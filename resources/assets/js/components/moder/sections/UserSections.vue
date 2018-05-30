<template>
    <div class="wrapper">
        <v-card>
            <v-card-title>
                <v-btn color="primary" @click="onAddSection">Добавить
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
                    :items="sections"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.created_at }}</td>
                    <td>{{ props.item.section_name }}</td>
                    <td>{{ props.item.info }}</td>
                    <td>
                        <v-btn icon class="mx-0" v-bind:to="{name:'EditNews',params:{item:props.item}}">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteItem(props.item)">
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
                    {text: 'Название', value: 'section_name'},
                    {text: 'Информация', value: 'info'},
                    {text: 'Управление', sortable: false,}
                ],
                sections: [],
                categories:[]
            }
        },
        created() {
            this.initialize();
        },
        methods: {
            initialize() {
                axios.post(`/userSections`, {id: this.$store.state.Auth.id}).then(response => {
                    this.sections = response.data.sections;
                    this.categories = response.data.categories;
                });
            },
            deleteItem(item) {
                const index = this.news.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить эту запись?');
                if (answer) {
                    axios.delete(`/api/news/` + item.id).then(response => {
                        if (response.data.status == 'success') {
                            this.news.splice(index, 1);
                            this.$store.commit(
                                "showInfo",
                                response.data.message
                            );
                        }
                    });
                }
            },
            onAddSection() {
                this.$router.push({name:'AddSection',params:{'categories':this.categories}});
            }

        }
    }
</script>