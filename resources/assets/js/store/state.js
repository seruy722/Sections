export default {
    info: {
        timeout: 3000,
        show: false,
        text: null
    },

    imagesList: [],

    nav: [
        { path: "/controls", title: "Консоль", auth: true },
        { path: "/users", title: "Пользователи", auth: true },
        { path: "/news", title: "Новости", auth: true },
        { path: "/settings", title: "Настройки", auth: true },
        { path: "/browse_files", title: "Показать файлы", auth: true }
    ],

    authNav: [
        { path: "/register", title: "Регистрация", auth: false },
        { path: "/login", title: "Вход", auth: false }
    ],

    profileNav: [
        { path: "/profile", title: "Профиль", auth: true },
        { path: "/logout", title: "Выход", auth: true }
    ],

    Auth: {
        login: false,
        id: null,
        api_token: null,
        name: null,
        photo: null,
        role:null
    }
};
