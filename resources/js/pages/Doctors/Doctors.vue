<template>
    <DefaultLayout>
        <div v-if="loaded">
            <h3>
                Doctors / <span>{{ doctors.length }}</span>
            </h3>
            <div class="card p-4">
                <div class="text-right">
                    <button
                        class="btn btn-primary mr-1"
                        @click="initialize()"
                        type="button"
                        data-toggle="modal"
                        title="add section"
                        data-target="#addDoctor"
                        style="color: white"
                    >
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <div
                class="card mt-2 p-1 d-flex align-center gap-10 sections-wrap pt-2 pb-2"
                v-if="doctors.length == 0"
            >
                <h3>doctors</h3>
            </div>
        </div>
        <div v-else>
            <loader></loader>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "../../layouts/admin/DefaultLayout.vue";
import DoctorDataTable from "./DoctorDataTable.vue";
import { onMounted, ref } from "vue";
import store from "../../store";
import Loader from "../../components/ui/Loader.vue";
let doctors = ref([]);
let loaded = ref(false);

onMounted(async () => {
    await store
        .dispatch("getDoctors")
        .then(() => {
            // doctors.value = store.state.doctors;
            loaded.value = true;
        })
        .catch((err) => {
            console.log(err);
        });
});
function initialize() {}
</script>

<style></style>
