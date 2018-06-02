export default {
    info: {
        timeout: 3000,
        show: false,
        text: null
    },

    imagesList: [],

    nav: [
        {path: "/controls", title: "Консоль", auth: true, role: 'admin'},
        {path: "/user_messages", title: "Сообщения", auth: true, role: 'admin'},
        {path: "/users", title: "Пользователи", auth: true, role: 'admin'},
        {path: "/news", title: "Новости", auth: true, role: 'admin'},
        {path: "/sections_categories", title: "Категории", auth: true, role: 'admin'},
        {path: "/settings", title: "Настройки", auth: true, role: 'admin'},

        {path: "/user_sections", title: "Секции", auth: true, role: 'moder'},
        {path: "/schedule", title: "Расписание", auth: true, role: 'moder'},
        {path: "/user_news", title: "Новости", auth: true, role: 'moder'},
        {path: "/user_gallery", title: "Галерея", auth: true, role: 'moder'},
        {path: "/images_gallery", title: "Изображения", auth: true, role: 'moder'},
        {path: "/user_messages", title: "Сообщения", auth: true, role: 'moder'},
    ],

    authNav: [
        {path: "/register", title: "Регистрация", auth: false},
        {path: "/login", title: "Вход", auth: false}
    ],

    profileNav: [
        {path: "/profile", title: "Профиль", auth: true},
        {path: "/logout", title: "Выход", auth: true}
    ],

    Auth: {
        login: false,
        id: null,
        api_token: null,
        name: null,
        photo: null,
        role: null,
        email:null
    }
};
