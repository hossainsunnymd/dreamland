<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({});
const page = usePage();

// Table headers
const headers = [
    { text: "Name", value: "name" },
    { text: "Title", value: "title" },
    { text: "Image", value: "image" },
    { text: "Description", value: "description" },
    { text: "Rating", value: "rating" },
    { text: "Action", value: "action" },
];

// Users and search fields
const items = ref(page.props.reviews || []);

const searchField = ref(["id", "name"]);
const searchItem = ref();

// Delete User
function deleteReview(id) {
    if (confirm("Are you sure you want to delete this Review?")) {
        router.get(`/admin/review/${id}`);
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
    <h3 class="fw-bold mb-4">Review List</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <input
            type="text"
            class="form-control w-25"
            v-model="searchItem"
            placeholder="Search here"
        />

        <!-- Add Button -->
        <Link v-if="page.props.user.can['review-save']"
            :href="`/admin/review-save-page?review_id=${0}`"
            class="btn btn-success"
        >
            Add Review
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
                :src="`/storage/review/${image}`"
                style="width: 50px; height: 50px"
            />
        </template>
        <!-- Action Column -->
        <template #item-action="{ id }">
            <div class="d-flex gap-2">
                <Link v-if="page.props.user.can['review-update']"
                    :href="`/admin/review-save-page?review_id=${id}`"
                    class="btn btn-sm btn-primary"
                >
                    Edit
                </Link>
                <button v-if="page.props.user.can['review-delete']"
                    @click="deleteReview(id)"
                    class="btn btn-sm btn-danger"
                >
                    Delete
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<style scoped></style>

