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
                ></v-select>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs4>
                <v-subheader>День недели</v-subheader>
            </v-flex>
            <v-flex xs8>
                <v-select
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
                dayOfWeek: [
                    {day: 'Понедельник', en: 'Monday'},
                    {day: 'Вторник', en: 'Tuesday'},
                    {day: 'Среда', en: 'Wednesday'},
                    {day: 'Четверг', en: 'Thursday'},
                    {day: 'Пятница', en: 'Friday'},
                    {day: 'Суббота', en: 'Saturday'},
                    {day: 'Воскресенье', en: 'Sunday'}
                ],
                dayName: {day: 'Понедельник', en: 'Monday'},
            }
        },
        created() {
            axios.post(`/userSections`, {id: this.$store.state.Auth.id}).then(response => {
                this.sections = response.data.sections;
                this.sectionsNames = this.sections.map(item => item.section_name);
            });
        }
    }
</script>