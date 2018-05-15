<template id="post-edit">
    <div class="row">
        <h3>Редактирование записи</h3>
        <div> {{notification}}</div>
        <form v-on:submit.prevent="updatePost">
            <div class="form-row">
                <div class="col-md-3 form-group">
                    <label>Дата</label>
                    <input type="date" class="form-control" v-model="posts.created_at">
                </div>
                <div class="col-md-3 form-group">
                    <label class="col-form-label">Тип</label>
                    <select class="form-control" v-model="posts.type">
                        <option>Все</option>
                        <option value="Оплата">ОПЛАТА</option>
                        <option value="Долг">ДОЛГ</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Таблица</label>
                    <select class="form-control" @change="CHANGE_TABLE">
                        <option value="cargos">КАРГО</option>
                        <option value="debts" v-bind:selected="table==='debts'">ДОЛГИ</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Сумма</label>
                    <input type="text" v-model="posts.price" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 form-group">
                    <label for="">Клиент</label>
                    <input list="client" v-model="posts.client_name" @change="$event.target.select()"
                           @click="$event.target.select()" class="form-control">
                    <datalist id="client">
                        <option value="Все" selected>0</option>
                        <option v-for="(client,index) in allClients" :key="index" v-bind:value="client.name">
                            {{client.id}}
                        </option>
                    </datalist>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Мест</label>
                    <input type="text" v-model="posts.count_place" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Вес</label>
                    <input type="text" v-model="posts.kg" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Факс</label>
                    <input type="text" v-model="posts.fax_name" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <label for="">Примечания</label>
                    <input type="text" v-model="posts.notation" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
            <router-link class="btn btn-warning" v-bind:to="{name:'Listposts'}">Отмена</router-link>
        </form>
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations, mapState} from 'vuex';

    export default {
        created() {
            Axios.get(this.$store.state.url + "api/" + this.table + "/" + this.$route.params.id).then(response => response.data).then(response => {
                let data = response.data;
                data.created_at = data.created_at.split("-").reverse().join("-");
                this.ADD_POSTS(data);
            });
        },
        computed: {
            ...mapState([
                'table',
                'posts',
                'notification'
            ]),
            ...mapGetters([
                'allClients'
            ])
        },
        methods: {
            ...mapMutations([
                'ADD_POSTS',
                'CHANGE_TABLE'
            ]),
            ...mapActions([
                'update'
            ]),
            updatePost() {
                this.update(this.$route.params.id);
                this.$router.push({name: "Listposts"});
            }
        }
    };
</script>