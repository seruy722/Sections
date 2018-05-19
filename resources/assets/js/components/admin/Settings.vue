<template>
    <div class="wrapper">
        <v-toolbar color="cyan" dark tabs>
            <v-toolbar-title>Общие настройки</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-tabs
                    slot="extension"
                    v-model="currentItem"
                    fixed-tabs
                    color="transparent"
                    slider-color="yellow"
            >
                <v-tab
                        v-for="item in items"
                        :key="item"
                        :href="'#tab-' + item"
                >
                    {{ item }}
                </v-tab>
                <v-menu v-if="more.length" left bottom class="tabs__div">
                    <a slot="activator" class="tabs__item">
                        more
                        <v-icon>arrow_drop_down</v-icon>
                    </a>
                    <v-list class="grey lighten-3">
                        <v-list-tile
                                v-for="item in more"
                                :key="item"
                                @click="addItem(item)"
                        >
                            {{ item }}
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-tabs>
        </v-toolbar>

        <v-tabs-items v-model="currentItem">
            <v-tab-item
                    v-for="item in items.concat(more)"
                    :key="item"
                    :id="'tab-' + item"
            >
                <v-card flat>
                    <v-card-text v-if="item=='Изображения'">
                        <h2>{{ item }}</h2>
                        <v-container fluid>
                            <form v-on:submit.prevent="">
                                <v-layout row>
                                    <v-flex xs4>
                                        <v-subheader>Главная картинка</v-subheader>
                                    </v-flex>
                                    <v-flex xs8>
                                        <input type="file">
                                    </v-flex>
                                </v-layout>
                                <v-layout row>
                                    <v-flex xs4>
                                        <v-subheader>Логотип</v-subheader>
                                    </v-flex>
                                    <v-flex xs8>
                                        <input type="file">
                                    </v-flex>
                                </v-layout>
                            </form>
                        </v-container>
                    </v-card-text>
                    <v-card-text v-if="item=='Меню'">
                        <h2>{{ item }}</h2>
                        <v-container fluid>
                            <div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <button type="button" @click="addNewPost" class="btn btn-block btn-success">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Добавить
                                        </button>
                                    </div>
                                </div>
                                <div v-for="(more,index) in posty">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <button type="button" @click="removePost(index)" class="btn btn-block btn-danger">
                                                <span class="glyphicon glyphicon-minus"></span>
                                                Удалить
                                            </button>
                                        </div>
                                        <div class="form-group col-xs-5">
                                            <label>Price (HUF)</label>
                                            <input v-model="more.price" type="number" class="form-control" placeholder="Price">
                                        </div>
                                        <div class="form-group col-xs-5">
                                            <label>Rooms (PCS)</label>
                                            <input v-model="more.kg" type="number" class="form-control" placeholder="Rooms">
                                        </div>
                                    </div>
                                </div>
                                <div v-if="post" class="row">
                                    <div class="col-xs-2">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            Сохранить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs-items>
    </div>
</template>

<script>
    export default {
        data: () => ({
            currentItem: 'tab-Изображения',
            items: [
                'Изображения', 'Меню', 'Заголовок', 'Images'
            ],
            more: [
                'News', 'Maps', 'Books', 'Flights', 'Apps'
            ],
            posty:[]
        }),

        methods: {
            addItem(item) {
                const removed = this.items.splice(0, 1);
                this.items.push(
                    ...this.more.splice(this.more.indexOf(item), 1)
                );
                this.more.push(...removed);
                this.$nextTick(() => {
                    this.currentItem = 'tab-' + item
                });
            },
            addNewPost() {
                this.posty.push(Vue.util.extend({}, this.post));
            },
            removePost(index) {
                this.posty.splice(index, 1);
            },
        }
    }
</script>