<template>
    <v-layout justify-center column v-if="role()">
        <v-subheader class="title">Активность</v-subheader>
        <v-expansion-panel popout>
            <v-expansion-panel-content
                    hide-actions
            >
                <v-layout slot="header" align-center row spacer>
                    <v-flex xs4 sm2 md1>
                        <v-avatar
                                slot="activator"
                                size="36px"
                        >
                            <v-icon color="red">people</v-icon>
                        </v-avatar>
                    </v-flex>
                    <v-flex sm5 md3 hidden-xs-only>
                        <router-link v-bind:to="{name:'AdminNews'}" class="black--text"><strong>Новости</strong>
                        </router-link>
                        <span class="grey--text">&nbsp;({{ countNews || 0 }})</span>
                    </v-flex>
                </v-layout>
            </v-expansion-panel-content>

            <v-expansion-panel-content
                    hide-actions
            >
                <v-layout slot="header" align-center row spacer>
                    <v-flex xs4 sm2 md1>
                        <v-avatar
                                slot="activator"
                                size="36px"
                        >
                            <v-icon color="blue">message</v-icon>
                        </v-avatar>
                    </v-flex>
                    <v-flex sm5 md3 hidden-xs-only>
                        <router-link v-bind:to="{name:'UserMessages'}" class="black--text"><strong>Сообщения</strong>
                        </router-link>
                        <span class="grey--text">&nbsp;({{ countMessages || 0 }})</span>
                    </v-flex>
                </v-layout>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </v-layout>
</template>

<script>
    export default {
        data: () => ({
            countNews: null,
            countMessages: null,
        }),
        created() {
            axios.get('/api/news').then(response => {
                this.countNews = response.data.data.length;
            });
            axios.post('/unreadMessage', {email: this.$store.state.Auth.email}).then(response => {
                this.countMessages = response.data.mails.length;
            });
        },
        methods: {
            role() {
                let role = this.$store.state.Auth.role;
                if (role === 'admin') {
                    return true;
                } else {
                    this.$router.push({name: 'UserSections'});
                }
            }
        }
    }
</script>