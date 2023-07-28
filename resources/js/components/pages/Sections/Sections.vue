<template>
    <DefaultLayout>
        <div v-if="loaded">
            <h3>
                Sections / <span>{{ sections.length }}</span>
            </h3>
            <div class="card p-4">
                <div class="text-right">
                    <button
                        class="btn btn-primary mr-1"
                        @click="initialize()"
                        type="button"
                        data-toggle="modal"
                        title="add section"
                        data-target="#addSection"
                        style="color: white"
                    >
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <a
                        class="btn btn-success p-0"
                        type="button"
                        href="/api/generate-excel-sections"
                        title="export excel"
                        style="color: white"
                    >
                        <img
                            style="width: 36px"
                            src="http://127.0.0.1:8000/assets/img/icons/worksheet.png"
                        />
                    </a>
                    <router-link
                        :to="{ name: 'ArchivedSections' }"
                        class="btn btn-danger ml-1"
                        type="button"
                        style="color: white"
                        title="archived sections"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </router-link>
                </div>
            </div>

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
                            @click.prevent="setSection(section)"
                            data-toggle="modal"
                            data-target="#addSection"
                            class="card-link btn btn-warning"
                        >
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <a
                            @click.prevent="deleteSection(section.id)"
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
        <!-- Modal -->
        <div
            class="modal fade"
            id="addSection"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addSectionLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            v-if="isEdit"
                            class="modal-title"
                            id="addSectionLabel"
                        >
                            Edit Section
                        </h5>
                        <h5 v-else class="modal-title" id="addSectionLabel">
                            Add Section
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="initialize()"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputTitle">Title</label>
                            <input
                                v-model="section.label"
                                type="email"
                                class="form-control"
                                id="inputTitle"
                                aria-describedby="TitleHelp"
                                placeholder="Enter title"
                            />
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <textarea
                                v-model="section.description"
                                class="form-control"
                                id="inputDescription"
                                aria-describedby="DescriptionHelp"
                                placeholder="Enter Description"
                            ></textarea>
                        </div>
                        <div class="form-group" v-show="false">
                            <label for="inputImage">Section image</label>
                            <div
                                class="image-input image-input-empty image-input-outline"
                                id="kt_section"
                                style="
                                    background-position: center;
                                    background-size: contain;
                                "
                            >
                                <div class="image-input-wrapper"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change"
                                    data-toggle="tooltip"
                                    title
                                    data-original-title="Change avatar"
                                >
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input
                                        type="file"
                                        name="image"
                                        @change="onImageChange"
                                        accept=".png, .jpg, .jpeg, .svg"
                                    />
                                    <input
                                        type="hidden"
                                        name="profile_avatar_remove"
                                    />
                                </label>
                                <span
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel"
                                    data-toggle="tooltip"
                                    title="Cancel avatar"
                                >
                                    <i
                                        class="ki ki-bold-close icon-xs text-muted"
                                    ></i>
                                </span>
                                <span
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove"
                                    data-toggle="tooltip"
                                    title="Remove avatar"
                                >
                                    <i
                                        class="ki ki-bold-close icon-xs text-muted"
                                    ></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputImage">Section image</label>
                            <input
                                type="file"
                                class="form-control-file"
                                id="inputImage"
                                @change="onImageChange"
                            />
                        </div>

                        <div class="form-check p-0">
                            <v-switch
                                inset
                                color="success"
                                label="Active"
                                v-model="section.active"
                            ></v-switch>
                        </div>
                    </div>
                    <div v-if="errors" class="p-1">
                        <div
                            v-for="(error, index) in errors"
                            v-bind:key="index"
                            class="alert alert-danger alert-dismissible fade show"
                            role="alert"
                            style="border-radius: 5px"
                        >
                            <div>
                                <div
                                    v-for="(err, index) in error"
                                    v-bind:key="index"
                                >
                                    {{ err }}
                                </div>
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-label="Close"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            ref="closeBtn"
                        >
                            Close
                        </button>
                        <button
                            v-if="isEdit"
                            type="button"
                            @click="updateSection()"
                            class="btn btn-primary"
                        >
                            Update section
                        </button>
                        <button
                            v-else
                            type="button"
                            @click="saveSection()"
                            class="btn btn-primary"
                        >
                            Save section
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "../../../axios";
import store from "../../../store";
import DefaultLayout from "../../admin/DefaultLayout.vue";
import Loader from "../../ui/Loader.vue";
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
        .dispatch("getSections")
        .then(() => {
            sections.value = store.state.sections;
            loaded.value = true;
        })
        .catch((err) => {
            console.log(err);
        });
});
async function getSections() {
    await store
        .dispatch("getSections")
        .then(() => {
            sections.value = store.state.sections;
        })
        .catch((err) => {
            console.log(err);
        });
}
async function saveSection() {
    await store
        .dispatch("saveSection", this.section)
        .then(() => {
            Swal.fire("Success", "Section save with success", "");
            closeBtn.value.click();
            section.value.id = "";
            section.value.label = "";
            section.value.description = "";
            section.value.active = false;
            section.value.file = null;
            errors.value = [];
            getSections();
        })
        .catch((err) => {
            errors.value = [];
            errors.value.push(err.response.data.msg);
        });
}
// update section
async function updateSection() {
    await store
        .dispatch("updateSection", this.section)
        .then(() => {
            Swal.fire("Success", "Section update with success", "");
            closeBtn.value.click();
            section.value.label = "";
            section.value.description = "";
            section.value.active = false;
            section.value.file = null;
            errors.value = [];
            getSections();
        })
        .catch((err) => {
            errors.value = [];
            errors.value.push(err.response.data.msg);
        });
}
async function deleteSection(id) {
    await Swal.fire({
        title: "Do you want to delete this section?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            store
                .dispatch("deleteSection", id)
                .then(() => {
                    swal.fire("success", "section delete with succes");
                    store
                        .dispatch("getSections")
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
function onImageChange(e) {
    section.value.file = e.target.files[0];
}
async function generateExcel() {
    await store
        .dispatch("generateExcelSections")
        .then(() => {
            Swal.fire("Success", "Excel generate with success", "");
        })
        .catch((err) => {});
}
function setSection(sec) {
    section.value = sec;
    section.value.active = sec.active ? true : false;
    isEdit.value = true;
}

function initialize() {
    errors.value = [];
    section.value = {
        label: "",
        description: "",
        active: false,
        file: null,
    };
    isEdit.value = false;
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
