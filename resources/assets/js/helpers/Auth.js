export default {
    init() {
        store.commit("Login");
        if (store.state.Auth.api_token) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + store.state.Auth.api_token;
        }
    },

    login(data) {
        localStorage.setItem("id", data.id);
        localStorage.setItem("api_token", data.api_token);
        localStorage.setItem("name", data.name);
        localStorage.setItem("photo", data.photo);
        localStorage.setItem("role", data.role);
        localStorage.setItem("email", data.email);

        this.init();
    },

    logout() {
        localStorage.removeItem("id");
        localStorage.removeItem("api_token");
        localStorage.removeItem("name");
        localStorage.removeItem("photo");
        localStorage.removeItem("role");
        localStorage.removeItem("email");


        this.init();
    },

    check() {
        if (!store.state.Auth.login) {
            router.push("/login");
        }
    }
};
