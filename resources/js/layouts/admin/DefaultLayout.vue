<template>
    <div id="wrapper" v-if="loadedSidebar">
        <!-- start side bar  -->
        <sidebar></sidebar>
        <!-- end side bar  -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column content-wr">
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
import Loadersvg from "../../components/ui/LoaderSvg.vue";
import store from "../../store";
import Sidebar from "./Sidebar.vue";
import Footer from "./Footer.vue";
import Navbar from "./Navbar.vue";
import Loader from "../../components/ui/Loader.vue";
const router = useRouter();
let user = null;
const token = store.state.token;
let loaded = ref(false);
let loadedComps = ref(false);
let loadedSidebar = localStorage.getItem("isEnter");

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
    setTimeout(() => {
        loadedComps.value = true;
    }, 10000);
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
.content-wr {
    height: 100vh;
    padding-bottom: 15px;
}
</style>
