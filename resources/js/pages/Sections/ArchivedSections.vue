<template>
    <DefaultLayout
        ><h3>
            Archived Sections / <span>{{ sections.length }}</span>
        </h3>
        <div class="card p-4">
            <div class="text-right">
                <a
                    v-if="false"
                    class="btn btn-success p-0"
                    type="button"
                    href="/api/generate-excel-sections"
                    style="color: white"
                >
                    <img
                        style="width: 36px"
                        src="http://127.0.0.1:8000/assets/img/icons/worksheet.png"
                    />
                </a>
                <router-link
                    :to="{ name: 'Sections' }"
                    class="btn btn-success ml-1"
                    type="button"
                    title="sections"
                    style="color: white"
                >
                    sections
                </router-link>
            </div>
        </div>
        <div v-if="loaded">
            <div
                class="d-flex align-center gap-10 sections-wrap pt-2 pb-2"
                v-if="sections.length > 0"
            >
                <div
                    v-for="section in sections"
                    :key="section.id"
                    :style="
                        section.active == 1
                            ? 'border: 2px solid #4CAF50;'
                            : 'border: 2px solid #ff5722;'
                    "
                    class="card p-0 section-col mt-2"
                >
                    <div class="img">
                        <img
                            class="card-img-top"
                            :src="section.icon"
                            alt="Card image cap"
                            width="200px"
                        />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ section.label }}</h5>
                        <p class="card-text">
                            {{ section.description }}
                        </p>
                    </div>
                    <div class="card-body border-top">
                        <button
                            @click.prevent="returnToSections(section)"
                            class="card-link btn btn-success rot-180"
                        >
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </button>
                        <a
                            @click.prevent="
                                deleteFromTrachedSection(section.id)
                            "
                            title="remove definitely"
                            class="card-link btn btn-danger ml-2"
                            ><i class="fa-solid fa-trash"></i
                        ></a>
                    </div>
                </div>
            </div>
            <div class="center-empty-img" v-else>
                <img
                    class="empty-img"
                    src="http://127.0.0.1:8000/assets/img/icons/box.png"
                />
            </div>
        </div>
        <div v-else>
            <loader></loader>
        </div>
    </DefaultLayout>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "../../axios";
import store from "../../store";
import DefaultLayout from "../../layouts/admin/DefaultLayout.vue";
import Loader from "../../components/ui/Loader.vue";
import router from "../../router";
import { extractIdentifiers } from "vue/compiler-sfc";
let sections = ref([]);
let loaded = ref(false);

let section = ref({
    id: "",
    label: "",
    description: "",
    active: false,
    file: null,
});

let isEdit = ref(false);

const closeBtn = ref(null);

let errors = ref([]);
onMounted(async () => {
    await store
        .dispatch("getTrachedSections")
        .then(() => {
            sections.value = store.state.sections;
            loaded.value = true;
        })
        .catch((err) => {
            console.log(err);
        });
});
async function getTrachedSections() {
    await store
        .dispatch("getTrachedSections")
        .then(() => {
            sections.value = store.state.sections;
        })
        .catch((err) => {
            console.log(err);
        });
}
async function returnToSections(sec) {
    await store
        .dispatch("restaure", sec.id)
        .then(() => {
            router.push({ name: "Sections" });
        })
        .catch((err) => {});
}

async function deleteFromTrachedSection(id) {
    await Swal.fire({
        title: "Do you want to delete this section defenitly?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            store
                .dispatch("deleteSectionDefinitely", id)
                .then(() => {
                    swal.fire("success", "section delete with succes");
                    store
                        .dispatch("getTrachedSections")
                        .then(() => {
                            sections.value = store.state.sections;
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
}
</script>

<style scoped>
.hms-flex {
    display: flex;
}
.border-top {
    border-top: 1px solid #80808040;
    text-align: right;
}
.btn {
    color: white;
}
.empty-img {
    object-fit: cover;
    width: 30%;
}
.center-empty-img {
    height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.section-col {
    width: 250px;
    margin-right: 25px;
}
.sections-wrap {
    flex-wrap: wrap;
    margin-top: 3%;
}
.rot-180 {
    transform: rotate(180deg);
}
.center-svg {
    height: 78vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.center-svg svg {
    width: 45%;
}
.img img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
</style>
