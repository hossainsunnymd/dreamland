<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({});
const page = usePage();

// Table headers
const headers = [
    { text: "Id", value: "id" },
    { text: "Image", value: "service_image" },
    { text: "Service Category", value: "service_category.service_name" },
    { text: "Service Description", value: "service_description" },
    { text: "Rank", value: "rank" },
    { text: "Action", value: "action" },
];

// Users and search fields
const items = ref(page.props.services || []);

const searchField = ref(["id", "name"]);
const searchItem = ref();

// Delete User
function deleteService(id) {
    if (confirm("Are you sure you want to delete this Service?")) {
        router.get(`/admin/service/${id}`);
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
    <h3 class="fw-bold mb-4">Service List</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <input
            type="text"
            class="form-control w-25"
            v-model="searchItem"
            placeholder="Search here"
        />

        <!-- Add Button -->
        <Link v-if="page.props.user.can['save-service']"
            :href="`/admin/service-save-page?service_id=${0}`"
            class="btn btn-success"
        >
            Add Service
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
        <template #item-service_image="{ service_image }">
            <img
                :src="`/storage/service/${service_image}`"
                style="width: 50px; height: 50px"
            />
        </template>

          <template #item-service_description="{ service_description }">
            <span v-html="service_description"></span>
        </template>
        <!-- Action Column -->
        <template #item-action="{ id }">
            <div class="d-flex gap-2">
                <Link v-if="page.props.user.can['update-service']"
                    :href="`/admin/service-save-page?service_id=${id}`"
                    class="btn btn-sm btn-primary"
                >
                    Edit
                </Link>
                <button v-if="page.props.user.can['delete-service']"
                    @click="deleteService(id)"
                    class="btn btn-sm btn-danger"
                >
                    Delete
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<style scoped></style>
