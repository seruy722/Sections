<template>
    <v-container>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent>
                <template>
                    <div class="progress">
                        <v-progress-circular :size="70" indeterminate color="primary"></v-progress-circular>
                    </div>
                </template>
            </v-dialog>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs4>
                <v-subheader>Секция</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :error-messages="checkError('section_id')"
                        :items="sections"
                        v-model="section"
                        label="Секция"
                        single-line
                        :hint="`${section.name}`"
                        item-text="name"
                        item-value="id"
                        return-object
                        persistent-hint
                        required
                ></v-select>
            </v-flex>
        </v-layout>

        <v-layout row>
            <v-flex xs4>
                <v-subheader>Событие</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-text-field
                        :error-messages="checkError('event_name')"
                        label="Событие"
                        single-line
                        v-model="event"
                        required
                ></v-text-field>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs4>
                <v-subheader>День недели</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :error-messages="checkError('day_of_week')"
                        :items="dayOfWeek"
                        v-model="dayName"
                        label="День недели"
                        single-line
                        :hint="`${dayName.day}`"
                        item-text="day"
                        item-value="en"
                        return-object
                        persistent-hint
                        required
                ></v-select>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs12 color="blue">
                <v-subheader class="justify-center">Время проведения:</v-subheader>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs11 sm5>
                <v-menu
                        ref="menu"
                        :close-on-content-click="false"
                        v-model="piker1"
                        :nudge-right="40"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                >
                    <v-text-field
                            slot="activator"
                            v-model="time1"
                            label="Начало"
                            prepend-icon="access_time"
                            readonly
                            required
                            :error-messages="checkError('event_start')"
                    ></v-text-field>
                    <v-time-picker v-model="time1" format="24hr" @change="$refs.menu.save(time1)"></v-time-picker>
                </v-menu>
            </v-flex>
            <v-spacer></v-spacer>
            <v-flex xs11 sm5>
                <v-menu
                        ref="menu"
                        :close-on-content-click="false"
                        v-model="piker2"
                        :nudge-right="40"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                >
                    <v-text-field
                            :error-messages="checkError('event_end')"
                            slot="activator"
                            v-model="time2"
                            label="Конец"
                            prepend-icon="access_time"
                            readonly
                            required
                    ></v-text-field>
                    <v-time-picker v-model="time2" format="24hr" @change="$refs.menu.save(time2)"></v-time-picker>
                </v-menu>
            </v-flex>
        </v-layout>
        <v-spacer></v-spacer>
        <v-layout row class="top">
            <v-flex xs8>
                <v-btn color="primary" dark @click="editSchedule">Обновить
                    <v-icon dark right>check_circle</v-icon>
                </v-btn>
                <v-btn color="red" dark @click="onUserSchedules">Отмена
                    <v-icon dark right>block</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                dialog: false,
                time1: null,
                time2: null,
                piker1: false,
                piker2: false,
                sectionsNames: [],
                section: {id: '', name: ''},
                event: '',
                errors: {},
                sections: [],
                dayOfWeek: [
                    {day: 'Понедельник', en: 'Monday'},
                    {day: 'Вторник', en: 'Tuesday'},
                    {day: 'Среда', en: 'Wednesday'},
                    {day: 'Четверг', en: 'Thursday'},
                    {day: 'Пятница', en: 'Friday'},
                    {day: 'Суббота', en: 'Saturday'}
                ],
                dayName: {day: '', en: ''},
                schedule: null
            }
        },
        created() {
            this.sections = this.$route.params.sections;
            this.schedule = this.$route.params.item;
            this.section.id = this.schedule.section_id;
            this.section.name = this.schedule.section_name;
            this.event = this.schedule.event_name;
            this.dayName.en = this.schedule.day_of_week;
            this.time1 = this.schedule.event_start;
            this.time2 = this.schedule.event_end;
            this.dayOfWeek.forEach(item => {
                if (item.en === this.schedule.day_of_week) {
                    this.dayName.day = item.day;
                }
            });
        },
        methods: {
            editSchedule() {
                this.errors = {};

                let data = new FormData();
                data.append('id', this.schedule.id);
                data.append('section_id', this.section.id);
                data.append('day_of_week', this.dayName.en);
                data.append('event_start', this.time1 || '');
                data.append('event_end', this.time2 || '');
                data.append('event_name', this.event);

                axios.post('/editSchedule', data).then(response => {
                    this.dialog = true;
                    if (response.data.status) {
                        this.$store.commit(
                            "showInfo",
                            response.data.message
                        );
                        data = new FormData();
                        this.onUserSchedules();
                    }
                }).catch(error => {
                    this.dialog = false;
                    this.errors = error.response.data.errors;
                });
            },
            onUserSchedules() {
                this.$router.push("/schedule");
            },
            checkError(field) {
                return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
            },
        }
    }
</script>

<style>
    .top {
        margin-top: 30px;
    }

    .progress {
        text-align: center;
    }

    .progress .progress-circular {
        margin: 1rem;
    }
</style>