<template>
    <div>
        <v-container>
            <v-layout row>
                <v-btn @click="onUpload">Загрузить изображение</v-btn>
            </v-layout>

            <v-layout row>
                <v-btn @click="onBrowse">Показать загруженные изображения</v-btn>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    export default {
        methods: {
            onUpload() {
                this.$router.push("/upload_file");
            },

            onBrowse() {
                this.$router.push("/browse_files");
            }
        }
    };
</script>
