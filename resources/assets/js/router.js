import Console from "./components/Console";
import UploadFile from "./components/UploadFile";
import BrowseFiles from "./components/BrowseFiles";
import Register from "./components/Register";
import Login from "./components/Login";
import Profile from "./components/Profile";
import Users from "./components/admin/Users";
import News from "./components/admin/News";
import Settings from "./components/admin/Settings";

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
    {path: "/settings", component: Settings}
];

export default new VueRouter({
    routes,

    mode: "history"
});
