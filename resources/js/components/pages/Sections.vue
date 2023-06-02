<template>
    <DefaultLayout
        ><h3>Sections</h3>

        <div class="text-right">
            <button
                class="btn btn-primary"
                type="button"
                data-toggle="modal"
                data-target="#addSection"
                style="color: white"
            >
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        <div class="d-flex justify-space-evenly align-center gap-10">
            <div
                v-for="section in sections"
                :key="section.id"
                class="card col-lg-3 col-md-6 col-s-12 p-0"
            >
                <img
                    class="card-img-top"
                    :src="section.icon"
                    alt="Card image cap"
                    width="200px"
                />
                <div class="card-body">
                    <h5 class="card-title">{{ section.label }}</h5>
                    <p class="card-text">
                        {{ section.description }}
                    </p>
                </div>
                <div class="card-body border-top">
                    <a href="#" class="card-link btn btn-warning"
                        ><i class="fa-regular fa-pen-to-square"></i
                    ></a>
                    <a
                        @click.prevent="deleteSection(section.id)"
                        class="card-link btn btn-danger ml-2"
                        ><i class="fa-solid fa-trash"></i
                    ></a>
                </div>
            </div>
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
                        <h5 class="modal-title" id="addSectionLabel">
                            Add Section
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
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
                            <!-- <small id="emailHelp" class="form-text text-muted"
                                >We'll never share your email with anyone
                                else.</small
                            > -->
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
                        <div class="form-group">
                            <label for="inputImage">Section image</label>
                            <input
                                type="file"
                                class="form-control-file"
                                id="inputImage"
                                @change="onImageChange"
                            />
                        </div>

                        <div class="form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="activeSection"
                            />
                            <label class="form-check-label" for="activeSection"
                                >Active</label
                            >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
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
import axiosClient from "../../axios";
import store from "../../store";
import DefaultLayout from "../admin/DefaultLayout.vue";
let sections = ref([]);

let section = {
    label: null,
    description: null,
    active: null,
    file: null,
};

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
            getSections();
        })
        .catch((err) => {
            console.log(err);
        });
}
async function deleteSection(id) {
    await store
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
function onImageChange(e) {
    section.file = e.target.files[0];
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
</style>
