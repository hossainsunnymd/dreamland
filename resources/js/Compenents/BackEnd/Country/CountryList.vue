<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({});
const page = usePage();
console.log(page.props.countries);

// Table headers
const headers = [
    { text: "Image", value: "country_flag" },
    { text: "Name", value: "country_name" },
    { text: "Action", value: "action" },
];

// Users and search fields
const items = ref(page.props.countries || []);



const searchField = ref(["id", "name"]);
const searchItem = ref();

// Delete User
function deleteCountry(id) {
    if (confirm("Are you sure you want to delete this Country?")) {
        router.get(`/admin/country/${id}`);
    }
}

// Flash message toast
if (page.props.flash.status === false) {
    toaster.error(page.props.flash.message);
} else if (page.props.flash.status === true) {
    toaster.success(page.props.flash.message);
}
</script>

<template>
    <h3 class="fw-bold mb-4">Country List</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <input
            type="text"
            class="form-control w-25"
            v-model="searchItem"
            placeholder="Search here"
        />

        <!-- Add Button -->
        <Link v-if="page.props.user.can['country-save']"
            :href="`/admin/country-save-page?country_id=${0}`"
            class="btn btn-success"
        >
            Add Country
        </Link>
    </div>

    <!-- Data Table -->
    <EasyDataTable
        :headers="headers"
        :items="items"
        :search-field="searchField"
        :search-value="searchItem"
        alternating
        :rows-per-page="5"
        table-class="table table-striped table-bordered"
    >
        <template #item-country_flag="{ country_flag }">
            <img
                :src="`/storage/country/${country_flag}`"
                style="width: 50px; height: 50px"
            />
        </template>
        <!-- Action Column -->
        <template #item-action="{ id }">
            <div class="d-flex gap-2">
                <Link v-if="page.props.user.can['country-update']"
                    :href="`/admin/country-save-page?country_id=${id}`"
                    class="btn btn-sm btn-primary"
                >
                    Edit
                </Link>
                <button v-if="page.props.user.can['country-delete']"
                    @click="deleteCountry(id)"
                    class="btn btn-sm btn-danger"
                >
                    Delete
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<style scoped></style>
