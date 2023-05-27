<template>
    <DefaultLayout>
        <h1>admin home</h1>
        <pre>
            {{ sections }}
        </pre>
    </DefaultLayout>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "../../axios";
import store from "../../store";
import DefaultLayout from "./DefaultLayout.vue";
const sections = ref([]);
onMounted(async () => {
    await store
        .dispatch("getSections")
        .then(() => {
            sections.value = store.state.sections;
        })
        .catch((err) => {
            console.log(err);
        });
});
function getSections() {}
</script>

<style></style>
