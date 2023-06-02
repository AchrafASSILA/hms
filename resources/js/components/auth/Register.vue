<template>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-lg-6 d-none d-lg-block bg-login-image"
                            ></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Welcome Back!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="register()"
                                    >
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control form-control-user"
                                                id="exampleInputEmail"
                                                v-model="user.username"
                                                placeholder="Enter Username..."
                                            />
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control form-control-user"
                                                id="exampleInputEmail"
                                                v-model="user.email"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."
                                            />
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control form-control-user"
                                                id="exampleInputPassword"
                                                placeholder="Password"
                                                v-model="user.password"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control form-control-user"
                                                id="exampleInputPassword"
                                                placeholder="Password confirmation"
                                                v-model="
                                                    user.password_comfirmation
                                                "
                                            />
                                        </div>
                                        <div v-if="errors">
                                            <div
                                                v-for="(error, index) in errors"
                                                v-bind:key="index"
                                                class="alert alert-danger alert-dismissible fade show"
                                                role="alert"
                                            >
                                                <strong>{{ error }}</strong>

                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="alert"
                                                    aria-label="Close"
                                                >
                                                    <span aria-hidden="true"
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox small"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="customCheck"
                                                />
                                                <label
                                                    class="custom-control-label"
                                                    for="customCheck"
                                                    >Remember Me</label
                                                >
                                            </div>
                                        </div>
                                        <button
                                            class="btn btn-primary btn-user btn-block"
                                        >
                                            Register
                                        </button>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <router-link
                                            class="small"
                                            :to="{ name: 'Login' }"
                                            >Already have an
                                            Account!</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import store from "../../store";
import { useRouter } from "vue-router";

const router = useRouter();
const user = {
    username: null,
    email: null,
    password: null,
    password_comfirmation: null,
};
const errors = store.state.errors;
const tokenUser = store.state.token;
function register() {
    store
        .dispatch("register", this.user)
        .then(() => {
            router.push({ name: "Dashboard" });
        })
        .catch((err) => {
            console.log(err);
        });
}
</script>

<style></style>
