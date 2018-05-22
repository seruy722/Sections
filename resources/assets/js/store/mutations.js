export default {
    showInfo(state, message) {
        state.info.text = message;
        state.info.show = true;
    },

    setImagesList(state, payload) {
        state.imagesList = payload;
    },

    Login(state) {
        state.Auth.id = localStorage.getItem("id");
        state.Auth.api_token = localStorage.getItem("api_token");
        state.Auth.name = localStorage.getItem("name");
        state.Auth.photo = localStorage.getItem("photo");
        state.Auth.role = localStorage.getItem("role");
        state.Auth.login =
            state.Auth.id !== null &&
            state.Auth.api_token !== null &&
            state.Auth.name !== null;
    }
};
