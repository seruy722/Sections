import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
    table: "cargos",
    beforeChangedTable:"cargos",
    posts: [],
    clients: [],
    url: "http://cargo.site/",
    notification: '',
    search: {
        typeTable: null,
        client: null,
        clientID: null,
        dateStart: null,
        dateLast: null
    },
    excel: {
        jsonFields: {},
        excelData: [],
        jsonMeta: [
            [
                {
                    key: "charset",
                    value: "utf-8"
                }
            ]
        ]
    }
};
const getters = {
    totalPrice: state => {
        if (Array.isArray(state.posts)) {
            let price = state.posts.reduce((result, element) => result + element.price, 0);
            return price ? price : 0;
        }
    },
    totalPlace: state => {
        if (Array.isArray(state.posts)) {
            let countPlace = state.posts.reduce((result, element) => result + element.count_place, 0);
            return countPlace ? countPlace : 0;
        }
    },
    totalKg: state => {
        if (Array.isArray(state.posts)) {
            let kg = state.posts.reduce((result, element) => result + element.kg, 0);
            return kg ? kg : 0;
        }
    },
    totalCommission: state => {
        if (Array.isArray(state.posts)) {
            let commission = state.posts.reduce((result, element) => result + element.commission, 0);
            return commission ? commission : 0;
        }
    },
    allClients: state => {
        return state.clients;
    }
};
const mutations = {
    ADD_POSTS: (state, posts) => {
        state.posts = posts;
    },
    ADD_CLIENTS: (state, clients) => {
        state.clients = clients;
    },
    CHANGE_TABLE: state => {
        state.beforeChangedTable = state.table;
        state.table === 'cargos' ? state.table = 'debts' : state.table = 'cargos';
    },
    CHANGE_CLIENT_NAME_TO_ID: (state) => {
        state.clients.forEach(element => {
            if (state.search.client == 'Все') {
                state.search.clientID = null;
            }
            if (element.name == state.search.client) {
                state.search.clientID = element.id;
            }
        });
    },
    CHANGE_NOTIFICATION: (state, message) => {
        state.notification = message;
    },
    PREPARE_DATA_TO_EXCEL: (state) => {
        if (state.table === "cargos") {
            state.excel.jsonFields = {
                Дата: "created_at",
                Тип: "type",
                Сумма: "price",
                Пользователь: "client_name",
                Мест: "count_place",
                Вес: "kg",
                Факс: "fax_name",
                Примечания: "notation"
            };
        } else {
            state.excel.jsonFields = {
                Дата: "created_at",
                Тип: "type",
                Сумма: "price",
                Пользователь: "client_name",
                Комиссия: "commission",
                Примечания: "notation"
            };
        }
        state.excel.excelData = state.posts;
    }
};

const actions = {
    fetch: context => {
        context.commit('CHANGE_CLIENT_NAME_TO_ID');
        Axios.post(`${state.url}api/search/${state.table}`, {
            keyword: state.search.clientID,
            dateStart: state.search.dateStart,
            dateLast: state.search.dateLast,
            table: state.table,
            typeTable: state.search.typeTable
        }).then(response => response.data).then(response => {
            context.commit('ADD_POSTS', response.data);
            context.commit('PREPARE_DATA_TO_EXCEL');
        });

    },
    destroy: (context, id) => {
        if (confirm('Удалить запись?')) {
            Axios.delete(`${state.url}api/${state.table}/${id}`).then(response => {
                context.commit('CHANGE_NOTIFICATION', response.data.msg);
            });
        }
    },
    update: (context, id) => {
        Axios.patch(`${state.url}api/${state.table}/${id}`, state.posts).then(response => {
            context.commit('CHANGE_NOTIFICATION', response.data.msg);
        });
    }
};
export const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions
});