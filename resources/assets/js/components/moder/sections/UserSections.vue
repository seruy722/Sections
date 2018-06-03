<template>
    <div class="wrapper">
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent>
                <template>
                    <div class="progress">
                        <v-progress-circular :size="70" indeterminate color="primary"></v-progress-circular>
                    </div>
                </template>
            </v-dialog>
        </v-layout>

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
                        <v-btn icon class="mx-0"
                               v-bind:to="{name:'EditSection',params:{item:props.item,categories:categories}}">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteSection(props.item)">
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
                dialog: false,
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {text: 'Название', value: 'section_name'},
                    {text: 'О нас', value: 'info'},
                    {text: 'Управление', sortable: false,}
                ],
                sections: [],
                categories: []
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
            deleteSection(item) {
                const index = this.sections.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить эту запись?');
                if (answer) {
                    axios.delete(`/deleteSection/` + item.id).then(response => {
                        this.dialog = true;
                        if (response.data.status) {
                            this.sections.splice(index, 1);
                            this.$store.commit("showInfo", response.data.message);
                            this.dialog = false;
                        }
                    });
                }
            },
            onAddSection() {
                this.$router.push({name: 'AddSection', params: {'categories': this.categories}});
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