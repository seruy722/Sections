import Console from "./components/Console";
import UploadFile from "./components/UploadFile";
import BrowseFiles from "./components/BrowseFiles";
import Register from "./components/Register";
import Login from "./components/Login";
import Profile from "./components/Profile";
import Users from "./components/admin/Users";
import News from "./components/admin/News";
import UserNews from "./components/moder/news/UserNews";
import AddNews from "./components/moder/news/AddNews";
import EditNews from "./components/moder/news/EditNews";
import ResetPassword from "./components/ResetPassword";
import CreateMessage from "./components/moder/mails/CreateMessage";
import UserMessages from "./components/moder/mails/UserMessages";
import ViewMessage from "./components/moder/mails/ViewMessage";
import ReplyMessage from "./components/moder/mails/ReplyMessage";
import UserSections from "./components/moder/sections/UserSections";
import AddSection from "./components/moder/sections/AddSection";
import EditSection from "./components/moder/sections/EditSection";
import UserGallery from "./components/moder/gallery/UserGallery";

import VueRouter from "vue-router";

const routes = [
    {path: "/controls", component: Console},
    {path: "/settings", component: UploadFile},
    {path: "/browse_files", component: BrowseFiles},
    {path: "/register", component: Register},
    {path: "/login", component: Login},
    {path: "/profile", component: Profile},
    {path: "/users", component: Users},
    {path: "/news", component: News},

    {path: "/user_news", component: UserNews},
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
];

export default new VueRouter({
    routes,

    mode: "history"
});
