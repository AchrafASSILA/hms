<template>
    <DefaultLayout>
        <div>
            <h3>Doctor Form</h3>
            <div>
                <div class="text-right">
                    <button
                        @click="toDoctors()"
                        class="btn act mr-1"
                        title="back to doctors"
                        style="color: white"
                    >
                        Back
                    </button>
                </div>
            </div>
            <div
                class="card mt-2 p-1 d-flex align-center gap-10 sections-wrap p-5"
            >
                <div class="form-group">
                    <label for="inputName">Name : </label>
                    <input
                        v-model="doctor.name"
                        type="email"
                        class="form-control"
                        id="inputName"
                        aria-describedby="TitleHelp"
                        placeholder="Enter name"
                    />
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email : </label>
                    <textarea
                        v-model="doctor.email"
                        class="form-control"
                        id="inputEmail"
                        placeholder="Enter Email"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="inputPhone">Phone : </label>
                    <textarea
                        v-model="doctor.phone"
                        class="form-control"
                        id="inputPhone"
                        aria-describedby="DescriptionHelp"
                        placeholder="Enter Phone"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="inputAdress">Adress : </label>
                    <textarea
                        v-model="doctor.adress"
                        class="form-control"
                        id="inputAdress"
                        aria-describedby="DescriptionHelp"
                        placeholder="Enter Adress"
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
                <Errors :errors="errors"></Errors>
                <div class="modal-footer">
                    <button
                        type="button"
                        @click="saveDoctor()"
                        class="btn btn-primary"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axiosClient from "../../../axios";
import Errors from "../../../components/ui/Errors.vue";
import DefaultLayout from "../../../layouts/admin/DefaultLayout.vue";
const router = useRouter();
let errors = ref(null);
let doctor = ref({
    name: "",
    email: "",
    phone: "",
    adress: "",
    file: "",
});
function onImageChange(e) {
    doctor.value.file = e.target.files[0];
}
async function saveDoctor() {
    const formData = new FormData();
    formData.append("name", doctor.value.name);
    formData.append("email", doctor.value.email);
    formData.append("phone", doctor.value.phone);
    formData.append("adress", doctor.value.adress);
    formData.append("file", doctor.value.file);
    const config = {
        headers: { "content-type": "multipart/form-data" },
    };
    axiosClient
        .post("/doctors", formData, config)
        .then((res) => {
            Swal.fire(
                "Success",
                `Doctor ${res.data.doctor.User} save with success`,
                ""
            );
            initialize();
            toDoctor(res.data.doctor.id);
        })
        .catch((err) => {
            errors.value = [];
            errors.value.push(err.response.data.msg);
        });
}
function toDoctors() {
    router.push({ name: "Doctors" });
}
function toDoctor(id) {
    router.push({ name: "DoctorProfile", params: { id: id } });
}
function initialize() {
    errors.value = [];
    doctor.value = {
        name: "",
        email: "",
        tel: "",
        adress: "",
        file: "",
    };
}
</script>

<style></style>
