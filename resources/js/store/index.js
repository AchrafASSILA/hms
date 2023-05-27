import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: null,
        token: sessionStorage.getItem("TOKEN"),
        sections: [],
    },
    getters: {},
    actions: {
        async register({ dispatch }, user) {
            const formData = new FormData();
            formData.append("name", user.username);
            formData.append("email", user.email);
            formData.append("password", user.password);
            formData.append(
                "password_confirmation",
                user.password_comfirmation
            );
            await axiosClient
                .post("/register", formData)
                .then((res) => {
                    console.log("work", res);
                    this.commit("setUser", res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async login({ dispatch }, user) {
            const formData = new FormData();
            formData.append("email", user.email);
            formData.append("password", user.password);
            await axiosClient
                .post("/login", formData)
                .then((res) => {
                    this.commit("setUser", res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async logout({ dispatch }) {
            await axiosClient
                .post("/logout")
                .then((res) => {
                    this.commit("removeUser", res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        async getUser() {
            await axiosClient("/user")
                .then((res) => {
                    this.commit("setCurrentUser", res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async getSections() {
            await axiosClient("/sections")
                .then((res) => {
                    this.commit("setSections", res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async deleteSection({ dispatch }, id) {
            await axiosClient
                .delete("/sections/" + id)
                .then((res) => {
                    this.commit("setSections", res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    mutations: {
        setUser: (state, userData) => {
            state.user = userData.data.user;
            state.token = userData.data.token;
            sessionStorage.setItem("TOKEN", state.token);
        },
        setCurrentUser: (state, userData) => {
            state.user = userData.data;
        },
        setSections: (state, res) => {
            state.sections = res.data.sections;
        },
        removeUser: (state) => {
            state.user = null;
            state.token = null;
            sessionStorage.removeItem("TOKEN");
        },
    },
    modules: {},
});

export default store;
