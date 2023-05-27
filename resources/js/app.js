import "./bootstrap";
import { createApp } from "vue";
import app from "./components/app.vue";
import router from "./router";
import store from "./store";
// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { VDataTable } from "vuetify/labs/VDataTable";
const vuetify = createVuetify({
    components,
    // components: {
    //     VDataTable,
    // },
    directives,
});
createApp(app).use(router).use(store).use(vuetify).mount("#app");
