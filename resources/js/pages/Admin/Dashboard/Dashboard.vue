<template>
    <DefaultLayout>
        <!-- Page Heading -->
        <div
            v-if="false"
            class="d-sm-flex align-items-center justify-content-between mb-4"
        >
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a
            >
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                >
                                    Doctors
                                </div>
                                <div
                                    v-if="doctorsCount"
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ doctorsCount }}
                                </div>
                                <div v-else>
                                    <Loadersvg></Loadersvg>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                >
                                    Active sections
                                </div>
                                <div
                                    v-if="activeSectionsCount"
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ activeSectionsCount }}
                                </div>
                                <div v-else>
                                    <Loadersvg></Loadersvg>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-bed fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-danger text-uppercase mb-1"
                                >
                                    Deactive sections
                                </div>
                                <div
                                    v-if="
                                        deactiveSectionsCount ||
                                        deactiveSectionsCount == 0
                                    "
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ deactiveSectionsCount }}
                                </div>
                                <div v-else>
                                    <Loadersvg></Loadersvg>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-bed fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                >
                                    Users
                                </div>
                                <div
                                    v-if="usersCount"
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ usersCount }}
                                </div>
                                <div v-else>
                                    <Loadersvg></Loadersvg>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "../../../layouts/admin/DefaultLayout.vue";
import { onMounted, ref } from "vue";
import axiosClient from "../../../axios";
import Loadersvg from "../../../components/ui/LoaderSvg.vue";
let doctorsCount = ref(null);
let usersCount = ref(null);
let activeSectionsCount = ref(null);
let deactiveSectionsCount = ref(null);
onMounted(() => {
    axiosClient
        .get("/get-doctors-count")
        .then((res) => {
            doctorsCount.value = res.data.doctors;
        })
        .catch((err) => {
            console.log(err);
        });
    axiosClient
        .get("/get-users-count")
        .then((res) => {
            usersCount.value = res.data.users;
        })
        .catch((err) => {
            console.log(err);
        });
    axiosClient
        .get("/get-active-sections-count")
        .then((res) => {
            activeSectionsCount.value = res.data.sections;
        })
        .catch((err) => {
            console.log(err);
        });
    axiosClient
        .get("/get-deactive-sections-count")
        .then((res) => {
            deactiveSectionsCount.value = res.data.sections;
        })
        .catch((err) => {
            console.log(err);
        });
});
</script>

<style></style>
