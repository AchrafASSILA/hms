import "./bootstrap";
import { createApp } from "vue";
import app from "./components/app.vue";
import router from "./router";
import store from "./store";
import vuetify from "./vuetify";

createApp(app).use(vuetify).use(router).use(store).use(vuetify).mount("#app");
