<template>
    <v-card-title>
        Doctors
        <v-spacer></v-spacer>
        <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
        ></v-text-field>
    </v-card-title>
    <v-data-table
        :headers="headers"
        :items="doctors"
        item-value="name"
        :search="search"
    >
        <template v-slot:item="{ item }">
            <tr>
                <td>{{ item.props.title.name }}</td>
                <td>
                    <span> {{ item.props.title.email }}</span>
                </td>
                <td>
                    <span> {{ item.props.title.phone }}</span>
                </td>
                <td>{{ item.props.title.role }}</td>
                <td>{{ item.props.title.adress }}</td>
                <td>
                    <router-link
                        :to="'/admin/doctor/' + item.props.title.id"
                        class="btn actions mr-1"
                        @click="viewDoctor(item.props.title)"
                    >
                        <i class="fa fa-eye"></i>
                    </router-link>
                    <button class="btn actions mr-1" @click="editItem(item)">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn actions" @click="deleteItem(item)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>
<script>
import { useRouter } from "vue-router";

export default {
    props: ["doctors"],
    data: () => ({
        search: "",

        router: useRouter(),
        headers: [
            {
                align: "start",
                key: "name",
                sortable: true,
                title: "Doctor",
            },
            { key: "email", title: "Email" },
            { key: "phone", title: "Phone" },
            { key: "role", title: "Role" },
            { key: "adress", title: "Adress" },
            { key: "actions", title: "actions" },
        ],
    }),

    computed: {},

    watch: {},

    methods: {
        viewDoctor(e, doctor) {
            e.preventDefault();

            console.log(doctor.id);
            router.push({
                name: "DoctorProfile",
                params: { id: doctor.id },
            });
        },
    },
};
</script>
<style scoped>
.actions {
    color: black;
}
</style>
