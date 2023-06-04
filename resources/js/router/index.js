import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/admin/Home.vue";
import Sections from "../components/pages/Sections.vue";
import Dashboard from "../components/admin/Dashboard.vue";
import Layout from "../components/admin/Layout.vue";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import Notfound from "../components/Notfound.vue";
import store from "../store";

const routes = [
    // admin
    {
        path: "/admin",
        redirect: "/dashboard",
        meta: { requiresAuth: true },
        component: Layout,
        children: [
            { path: "/admin/home", name: "Home", component: Home },
            { path: "/admin/sections", name: "Sections", component: Sections },
            {
                path: "/admin/dashboard",
                name: "Dashboard",
                component: Dashboard,
            },
        ],
    },
    // auth
    {
        path: "/",
        component: Login,
        name: "Login",
    },
    {
        path: "/register",
        component: Register,
        name: "Register",
    },
    // not found
    {
        path: "/:pathMatch(.*)*",
        component: Notfound,
    },
];

const router = createRouter({
    base: "/app",
    history: createWebHistory(),
    routes,
});
// if (to.meta.requiresAuth && !store.state.token) {
router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !sessionStorage.getItem("TOKEN")) {
        next({ name: "Login" });
    } else if (
        store.state.token &&
        (to.name == "Login" || to.name == "Register")
    ) {
        next({ name: "Dashboard" });
    } else {
        next();
    }
});
export default router;
