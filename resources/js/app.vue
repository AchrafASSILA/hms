<template>
    <router-view></router-view>
</template>
<style>
.btn-primary {
    background-color: #2196f3;
    border-color: #2196f3;
}
.btn-primary:hover {
    background-color: #176aad;
}
.bg-primary-blue {
    background-color: #2196f3;
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
.center-empty-img {
    height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.act {
    background-color: #3f51b5;
    border-radius: 50px;
}
.v-input--density-default {
    width: 200px;
    margin-left: auto;
}
</style>
