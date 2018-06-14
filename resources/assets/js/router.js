import AdminConsole from "./components/admin/AdminConsole";
import Register from "./components/admin/Register";
import Login from "./components/admin/Login";
import Profile from "./components/admin/Profile";
import Users from "./components/admin/Users";
import News from "./components/admin/News";
import UserNews from "./components/moder/news/UserNews";
import AddNews from "./components/moder/news/AddNews";
import EditNews from "./components/moder/news/EditNews";
import ResetPassword from "./components/admin/ResetPassword";
import CreateMessage from "./components/moder/mails/CreateMessage";
import UserMessages from "./components/moder/mails/UserMessages";
import ViewMessage from "./components/moder/mails/ViewMessage";
import ReplyMessage from "./components/moder/mails/ReplyMessage";
import UserSections from "./components/moder/sections/UserSections";
import AddSection from "./components/moder/sections/AddSection";
import EditSection from "./components/moder/sections/EditSection";
import UserGallery from "./components/moder/gallery/UserGallery";
import ImagesGallery from "./components/moder/gallery/ImagesGallery";
import Schedule from "./components/moder/schedule/Schedule";
import AddSchedule from "./components/moder/schedule/AddSchedule";
import EditSchedule from "./components/moder/schedule/EditSchedule";
import Categories from "./components/admin/categories/Categories";
import AddCategory from "./components/admin/categories/AddCategory";
import EditCategory from "./components/admin/categories/EditCategory";
import Social from "./components/Social";

import VueRouter from "vue-router";

const routes = [
    {path: "/controls", component: AdminConsole},
    {path: "/register", component: Register},
    {path: "/login", component: Login},
    {path: "/profile", component: Profile},
    {path: "/users", component: Users},
    {name: 'AdminNews',path: "/news", component: News},

    {path: "/user_news", component: UserNews},
    {path: "/social", component: Social},
    {name: 'AddNews', path: "/add_news", component: AddNews},
    {name: 'EditNews', path: "/edit_news", component: EditNews},
    {name: 'ResetPassword', path: "/reset_password", component: ResetPassword},
    {name: 'UserMessages', path: "/user_messages", component: UserMessages},
    {name: 'CreateMessage', path: "/create_message", component: CreateMessage},
    {name: 'ViewMessage', path: "/view_message", component: ViewMessage},
    {name: 'ReplyMessage', path: "/reply_message", component: ReplyMessage},
    {name: 'UserSections', path: "/user_sections", component: UserSections},
    {name: 'AddSection', path: "/add_section", component: AddSection},
    {name: 'EditSection', path: "/edit_section", component: EditSection},
    {name: 'UserGallery', path: "/user_gallery", component: UserGallery},
    {name: 'ImagesGallery', path: "/images_gallery", component: ImagesGallery},
    {name: 'Schedule', path: "/schedule", component: Schedule},
    {name: 'AddSchedule', path: "/add_schedule", component: AddSchedule},
    {name: 'EditSchedule', path: "/edit_schedule", component: EditSchedule},
    {name: 'Categories', path: "/sections_categories", component: Categories},
    {name: 'AddCategory', path: "/add_category", component: AddCategory},
    {name: 'EditCategory', path: "/edit_category", component: EditCategory},
];

const router =  new VueRouter({
    routes,
    mode: "history"
});


export default router;
