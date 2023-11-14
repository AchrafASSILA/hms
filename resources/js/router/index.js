import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Admin/Home/Home.vue";
import Sections from "../pages/Admin/Sections/Sections.vue";
import Doctors from "../pages/Admin/Doctors/Doctors.vue";
import DoctorForm from "../pages/Admin/Doctors/DoctorForm.vue";
import DoctorProfile from "../pages/Admin/Doctors/DoctorProfile.vue";
import ArchivedSections from "../pages/Admin/Sections/ArchivedSections.vue";
import Dashboard from "../pages/Admin/Dashboard/Dashboard.vue";
import Layout from "../layouts/admin/Layout.vue";
import Login from "../pages/Auth/Login.vue";
import Register from "../pages/Auth/Register.vue";
import Notfound from "../components/ui/Notfound.vue";

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
                path: "/admin/doctors-form",
                name: "DoctorsForm",
                component: DoctorForm,
            },
            {
                path: "/admin/doctor/:id",
                name: "DoctorProfile",
                component: DoctorProfile,
            },
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
    if (to.meta.requiresAuth && !localStorage.getItem("TOKEN")) {
        next({ name: "Login" });
    } else if (
        localStorage.getItem("TOKEN") &&
        (to.name == "Login" || to.name == "Register")
    ) {
        next({ name: "Dashboard" });
    } else {
        next();
    }
});

export default router;
