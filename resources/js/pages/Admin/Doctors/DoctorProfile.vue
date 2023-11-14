<template>
    <DefaultLayout>
        <div v-if="doctor">
            <div class="mb-2 d-flex justify-content-between">
                <h3>
                    Doctors Management / <span>{{ doctor?.name }}</span>
                </h3>
                <div class="text-right">
                    <div class="dropdown show">
                        <button
                            class="btn btn-primary dropdown-toggle"
                            href="#"
                            role="button"
                            id="dropdownMenuLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Actions
                        </button>

                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuLink"
                        >
                            <router-link
                                class="dropdown-item"
                                :to="{ name: 'Doctors' }"
                                >Back</router-link
                            >
                            <button
                                v-if="doctor.active"
                                class="dropdown-item"
                                @click="disactivateDoctor()"
                            >
                                Deactivate doctor
                            </button>
                            <button
                                v-else
                                class="dropdown-item"
                                @click="activateDoctor()"
                            >
                                Activate doctor
                            </button>
                            <button
                                class="dropdown-item"
                                type="button"
                                data-toggle="modal"
                                title="add password"
                                data-target="#addPassword"
                            >
                                Change password
                            </button>
                            <button
                                class="dropdown-item"
                                type="button"
                                data-toggle="modal"
                                title="add section"
                                data-target="#addSection"
                            >
                                Add section
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4 rounded">
                <div class="row justify-content-between">
                    <div class="col-3 hms-flex-center-column hr-right">
                        <div class="img p-3">
                            <div class="inner-img">
                                <img :src="doctor?.image" alt="" />
                            </div>
                        </div>
                        <h5 class="color-black border-bottom doc-name">
                            {{ doctor?.name }}
                        </h5>
                        <ul>
                            <li>
                                <i
                                    class="fa fa-envelope mr-1"
                                    aria-hidden="true"
                                ></i>
                                {{ doctor?.email }}
                            </li>
                            <li>
                                <i
                                    class="fa fa-phone mr-1"
                                    aria-hidden="true"
                                ></i>
                                {{ doctor?.phone }}
                            </li>
                            <li>
                                <i
                                    class="fa fa-location-arrow mr-1"
                                    aria-hidden="true"
                                ></i>

                                {{ doctor?.adress ? doctor?.adress : "---" }}
                            </li>
                        </ul>

                        <div
                            class="bubble"
                            :class="{ active: doctor.active }"
                        ></div>
                    </div>
                    <div class="col-3 hr-right">
                        <h6>Section affected :</h6>
                        <span class="badge badge-pill badge-info">{{
                            doctor.section.label
                        }}</span>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <!-- Modal password -->
            <div
                class="modal fade"
                id="addPassword"
                tabindex="-1"
                role="dialog"
                aria-labelledby="addSectionLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSectionLabel">
                                Change password
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
                                <label for="inputTitle">Password : </label>
                                <input
                                    v-model="password"
                                    type="password"
                                    class="form-control"
                                    id="inputTitle"
                                    aria-describedby="TitleHelp"
                                    placeholder="Enter password"
                                />
                            </div>
                            <div class="form-group">
                                <label for="inputTitle"
                                    >Password confirmation:
                                </label>
                                <input
                                    v-model="passwordConfirmation"
                                    type="password"
                                    class="form-control"
                                    id="inputTitle"
                                    aria-describedby="TitleHelp"
                                    placeholder="Enter password confirmation"
                                />
                            </div>
                        </div>
                        <div v-if="errors" class="p-1">
                            <Errors :errors="errors"></Errors>
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
                                type="button"
                                @click="savePassword()"
                                class="btn btn-primary"
                            >
                                Save password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sections password -->
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
                                Add section
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
                                <label for="inputTitle">Sections : </label>
                                <select
                                    v-model="doctor.section.id"
                                    class="form-control"
                                    placeholder="Sections"
                                >
                                    <option disabled value="">
                                        Please select one
                                    </option>
                                    <option
                                        v-for="(item, index) in sections"
                                        :key="index"
                                        :value="item.id"
                                    >
                                        {{ item.label }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div v-if="errors" class="p-1">
                            <Errors :errors="errors"></Errors>
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
        </div>
    </DefaultLayout>
</template>

<script setup>
import { onMounted, ref } from "vue";
import Errors from "../../../components/ui/Errors.vue";
import axiosClient from "../../../axios";
import DefaultLayout from "../../../layouts/admin/DefaultLayout.vue";
import { useRoute } from "vue-router";
import Swal from "sweetalert2";

let doctor = ref(null);
let errors = ref([]);
let sections = ref(null);
let password = ref(null);
let passwordConfirmation = ref(null);
let route = useRoute();
let closeBtn = ref("");
const doctorId = route.params.id;

onMounted(async () => {
    await axiosClient
        .get("doctors/" + doctorId)
        .then((res) => {
            doctor.value = res.data.doctor;
        })
        .catch((err) => {
            console.log(err);
        });
    await axiosClient
        .get("active-sections/")
        .then((res) => {
            sections.value = res.data.sections;
        })
        .catch((err) => {
            console.log(err);
        });
});
let activateDoctor = async () => {
    await axiosClient
        .put("/activate-user/" + doctor.value.user_id)
        .then((res) => {
            Swal.fire("Success", "Doctor activate with success", "");
            doctor.value.active = true;
            errors.value = [];
        })
        .catch((err) => {
            console.log(err);
        });
};

let saveSection = async () => {
    const formData = new FormData();
    formData.append("section", doctor.value.section.id);
    await axiosClient
        .post(`/add-section/${doctor.value.id}`, formData)
        .then((res) => {
            doctor.value.section = res.data.section;
            Swal.fire("Success", "Doctor add to section with success", "");
            closeBtn.value.click();
            errors.value = [];
        })
        .catch((err) => {
            errors.value = [];
            errors.value.push(err.response.data.msg);
        });
};
let disactivateDoctor = async () => {
    await axiosClient
        .put("/desactivate-user/" + doctor.value.user_id)
        .then((res) => {
            errors.value = [];
            Swal.fire("Success", "Doctor disactivated with success", "");
            doctor.value.active = false;
        })
        .catch((err) => {
            console.log(err);
        });
};
let savePassword = async () => {
    const formData = new FormData();
    formData.append("password", password.value);
    formData.append("password_confirmation", passwordConfirmation.value);
    await axiosClient
        .post(`/change-password/${doctor.value.user_id}`, formData)
        .then((res) => {
            closeBtn.value.click();
            errors.value = [];
            Swal.fire("Success", "Doctor password change with success", "");
        })
        .catch((err) => {
            errors.value = [];
            errors.value.push(err.response.data.msg);
        });
};
</script>

<style scoped>
.img {
    position: relative;
    width: 200px;
    height: 200px;
    overflow: hidden;
    border-radius: 50%;
    border: 2.5px solid #b8b8b8;
}
.img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.inner-img {
    border-radius: 50% !important;
    overflow: hidden;
}
.bubble {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    top: 5%;
    right: 22%;
    border: 2px solid white;
    background-color: red;
}
.active {
    background-color: #6ccb4b;
}
.hr-right {
    border-right: 1px solid #cecece;
}
.doc-name {
    width: 100%;
    text-align: center;
}
ul li {
    font-size: 13px;
}
</style>
