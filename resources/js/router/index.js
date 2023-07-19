import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/admin/Home.vue";
import Sections from "../components/pages/Sections/Sections.vue";
import Doctors from "../components/pages/Doctors/Doctors.vue";
import ArchivedSections from "../components/pages/Sections/ArchivedSections.vue";
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
                path: "/admin/archived-sections",
                name: "ArchivedSections",
                component: ArchivedSections,
            },
            { path: "/admin/doctors", name: "Doctors", component: Doctors },
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
router.beforeEach((to, from, next) => {
    // if (to.meta.requiresAuth && !sessionStorage.getItem("TOKEN")) {
    if (to.meta.requiresAuth && !store.state.token) {
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
