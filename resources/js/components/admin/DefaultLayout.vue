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
import store from "../../store";
import Sidebar from "../layout/Sidebar.vue";
import Footer from "../layout/Footer.vue";
import Navbar from "../layout/Navbar.vue";

const router = useRouter();
const user = store.state.user;
const token = store.state.token;

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
</script>

<style></style>
