<template>
    <v-app>
        <v-container>
            <div class="container">
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </div>
        </v-container>
    </v-app>
</template>


<script>
    export default {
        mounted() {
            console.log('app.vue');
        }
    }
</script>