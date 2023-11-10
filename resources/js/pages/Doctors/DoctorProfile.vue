<template>
    <DefaultLayout>
        <div class="mb-2 d-flex justify-content-between">
            <h3>
                Doctors Management / <span>{{ doctor?.name }}</span>
            </h3>
            <div class="text-right">
                <div class="dropdown show">
                    <a
                        class="btn btn-secondary dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        Actions
                    </a>

                    <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuLink"
                    >
                        <router-link
                            class="dropdown-item"
                            :to="{ name: 'Doctors' }"
                            >Back</router-link
                        >
                        <a class="dropdown-item" href="#">Another action</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-4 rounded">
            <div class="row">
                <div class="col-3">
                    <h2>{{ doctor.name }}</h2>
                </div>
                <div class="col-3"></div>
                <div class="col-3"></div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import axiosClient from "../../axios";
import DefaultLayout from "../../layouts/admin/DefaultLayout.vue";
import { useRoute } from "vue-router";
let doctor = ref(null);
let route = useRoute();
const doctorId = route.params.id;

onMounted(() => {
    console.log(doctorId);
    axiosClient
        .get("doctors/" + doctorId)
        .then((res) => {
            doctor.value = res.data.doctor;
        })
        .catch((err) => {
            console.log(err);
        });
});
</script>

<style></style>
