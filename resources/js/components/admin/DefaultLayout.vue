<template>
    <!-- <router-link to="/admin/home">home</router-link><br />
    <router-link to="/admin/dashboard">dahboard</router-link>
    <button @click="changeRoute()">dahboard btn</button>
    <p>{{ user }}</p>
    <p>{{ token }}</p>
    <button @click.prevent="logout()">logout</button> -->
    <div id="wrapper">
        <!-- start side bar  -->
        <sidebar></sidebar>
        <!-- end side bar  -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- start nav bar  -->
                <navbar></navbar>
                <!-- end nav bar  -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <slot />
                </div>
                <div v-show="false">
                    <loader></loader>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- start Footer  -->
            <footer></footer>
            <!-- end Footer  -->
        </div>
    </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { ref, onMounted } from "vue";
import store from "../../store";
import Sidebar from "../layout/Sidebar.vue";
import Footer from "../layout/Footer.vue";
import Navbar from "../layout/Navbar.vue";
import Loader from "../ui/Loader.vue";
const router = useRouter();
let user = null;
const token = store.state.token;
let loaded = ref(false);

function logout() {
    this.store
        .dispatch("logout")
        .then(() => {
            router.push({ name: "Login" });
        })
        .catch((err) => {
            console.log(err);
        });
}
async function getUser() {
    await store
        .dispatch("getUser")
        .then(() => {
            user = store.state.user;
        })
        .catch((err) => {
            console.log(err);
        });
    loaded.value = true;
}
onMounted(() => {
    getUser();
});
</script>

<style scoped>
svg {
    width: 45%;
}
.center-svg {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
