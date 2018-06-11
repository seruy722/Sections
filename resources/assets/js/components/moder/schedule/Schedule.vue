<template>
    <div class="wrapper">
        <v-layout class="justify-center"><v-subheader class="title">Расписание</v-subheader></v-layout>
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
                <v-btn color="primary" v-if="sections.length>0" @click="onAddSchedule">Добавить
                    <v-icon>add</v-icon>
                </v-btn>
                <v-btn v-else color="red" v-bind:to="{name:'UserSections'}">Добавить секцию</v-btn>
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
                    :items="schedules"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.created_at }}</td>
                    <td>{{ props.item.day_of_week}}</td>
                    <td>{{ props.item.event_name }}</td>
                    <td>{{ props.item.event_start}}</td>
                    <td>{{ props.item.event_end }}</td>
                    <td>{{ props.item.section_name }}</td>
                    <td>
                        <v-btn icon class="mx-0"
                               v-bind:to="{name:'EditSchedule',params:{item:props.item,sections:sections}}">
                            <v-icon color="teal">edit</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteSchedule(props.item)">
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
    import Auth from "../../../helpers/Auth";
    export default {
        data() {
            return {
                dialog: false,
                search: '',
                headers: [
                    {text: 'Дата создания', value: 'created_at'},
                    {text: 'День недели', value: 'day_of_week'},
                    {text: 'Событие', value: 'event_name'},
                    {text: 'Начало', value: 'event_start'},
                    {text: 'Конец', value: 'event_end'},
                    {text: 'Секция', value: 'section_name'},
                    {text: 'Управление', sortable: false,}
                ],
                sections: [],
                categories: [],
                schedules: []
            }
        },
        created() {
            Auth.check();
            this.initialize();
        },
        methods: {
            initialize() {
                axios.post('/schedules', {id: this.$store.state.Auth.id}).then(response => {
                    this.sections = response.data.sections;
                    this.schedules = response.data.schedules;
                    this.schedules.forEach(item => {
                        item.created_at = this.formatDate(item.created_at);
                        this.sections.forEach(elem => {
                            if (item.section_id === elem.id) {
                                item.section_name = elem.name;
                            }
                        });
                    });
                });
            },
            deleteSchedule(item) {
                this.dialog = true;
                const index = this.schedules.indexOf(item);
                let answer = confirm('Вы действительно хотите удалить эту запись?');
                if (answer) {
                    axios.delete('/deleteSchedule/' + item.id).then(response => {
                        if (response.data.status) {
                            this.schedules.splice(index, 1);
                            this.$store.commit("showInfo", response.data.message);
                            this.dialog = false;
                        }
                    }).catch(error => {
                        if (error.response.status === 404) {
                            this.$store.commit("showError", 'Произошла ошибка при удалении. (Запись не существует.)');
                        }
                        this.dialog = false;
                    });
                }
            },
            onAddSchedule() {
                this.$router.push({name: 'AddSchedule', params: {'sections': this.sections}});
            },
            formatDate(date) {
                let data = new Date(date);
                let dd = data.getDate();
                if (dd < 10) dd = '0' + dd;
                let mm = data.getMonth() + 1;
                if (mm < 10) mm = '0' + mm;
                let yy = data.getFullYear();
                if (yy < 10) yy = '0' + yy;

                return dd + '.' + mm + '.' + yy;
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