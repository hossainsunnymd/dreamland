<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({});
const page = usePage();

// Table headers
const headers = [
    { text: "Id", value: "id" },
    { text: "Country Name", value: "country.name" },
    { text: "Image", value: "image" },
    { text: "Title", value: "title" },
    { text: "Key Points", value: "key_points" },
    { text: "Description", value: "description" },
    { text: "Action", value: "action" },
];

// Users and search fields
const items = ref(page.props.countryDetails || []);

const searchField = ref(["id", "name"]);
const searchItem = ref();

// Delete User
function deleteCountryDetail(id) {
    if (confirm("Are you sure you want to delete this Country Detail?")) {
        router.get(`/admin/country-detail/${id}`);
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
    <h3 class="fw-bold mb-4">Country Details List</h3>

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
            :href="`/admin/country-detail-save-page?country_detail_id=${0}`"
            class="btn btn-success"
        >
            Add Country Detail
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
        <template #item-image="{ image }">
            <img
                :src="`/storage/countryDetail/${image}`"
                style="width: 50px; height: 50px"
                :alt="image"
            />
        </template>
        <template #item-key_points="{ key_points }">
            <span v-html="key_points"></span>
        </template>

        <template #item-description="{ description }">
            <span v-html="description"></span>
        </template>
        <!-- Action Column -->
        <template #item-action="{ id }">
            <div class="d-flex gap-2">
                <Link v-if="page.props.user.can['country-detail-update']"
                    :href="`/admin/country-detail-save-page?country_detail_id=${id}`"
                    class="btn btn-sm btn-primary"
                >
                    Edit
                </Link>
                <button v-if="page.props.user.can['country-detail-delete']"
                    @click="deleteCountryDetail(id)"
                    class="btn btn-sm btn-danger"
                >
                    Delete
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<style scoped></style>
