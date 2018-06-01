<template>
    <v-container>
        <v-layout row wrap>
            <v-flex xs4>
                <v-subheader>Секция</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
                        :items="sectionsNames"
                        v-model="select"
                        label="Секция"
                        single-line
                        required
                        :error-messages="checkError('section_id')"
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
                <v-btn color="primary" dark @click="addSchedule">Сохранить
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
                time1: null,
                time2: null,
                piker1: false,
                piker2: false,
                sectionsNames: [],
                select: null,
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
            }
        },
        created() {
            axios.post(`/userSections`, {id: this.$store.state.Auth.id}).then(response => {
                this.sections = response.data.sections;
                this.sectionsNames = this.sections.map(item => item.section_name);
            });
        },
        methods: {
            addSchedule() {
                this.errors = {};

                let sectionId = null;
                this.sections.forEach(item => {
                    if (item.section_name === this.select) {
                        sectionId = item.id

                    }
                });

                let data = new FormData();
                data.append('section_id', sectionId);
                data.append('day_of_week', this.dayName.en);
                data.append('event_start', this.time1||'');
                data.append('event_end', this.time2||'');
                data.append('event_name', this.event);

                axios.post('/addSchedule', data).then(response => {
                    if (response.data.status) {
                        this.$store.commit(
                            "showInfo",
                            response.data.message
                        );
                        data = new FormData();
                        this.onUserSchedules();
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
            onUserSchedules() {

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
</style>