<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({});
const page = usePage();

// Table headers
const headers = [
    { text: "ID", value: "id" },
    { text: "Name", value: "name" },
    { text: "Email", value: "email" },
    { text: "BD Phone", value: "bd_mobile" },
    { text: "Preffered Country", value: "prefferred_country" },
    { text: "Last Education", value: "last_education" },
    { text: "PDF", value: "pdf" },
    { text: "Action", value: "action" },
];
console.log(page.props.bookings);
// Users and search fields
const items = ref(page.props.bookings);

const searchField = ref(["id", "name", "email"]);
const searchItem = ref();

// Delete User
function deleteBooking(id) {
    if (confirm("Are you sure you want to delete this Booking?")) {
        router.get(`/admin/booking/${id}`);
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
    <h3 class="fw-bold mb-4">Booking List</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <input
            type="text"
            class="form-control w-25"
            v-model="searchItem"
            placeholder="Search here"
        />

        <!-- Add Button -->
        <Link v-if="page.props.user.can['booking-save']" :href="`/admin/booking-save-page?booking_id=${0}`" class="btn btn-success">
            Add Booking
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
        <template #item-pdf="{ pdf }">
            <a :href="`/storage/booking/${pdf}`" target="_blank">View</a>
        </template>
        <!-- Action Column -->
        <template #item-action="{ id }">
            <div class="d-flex gap-2">
                <Link v-if="page.props.user.can['booking-update']"
                    :href="`/admin/booking-save-page?booking_id=${id}`"
                    class="btn btn-sm btn-primary"
                >
                    Edit
                </Link>
                <button v-if="page.props.user.can['booking-delete']" @click="deleteBooking(id)" class="btn btn-sm btn-danger">
                    Delete
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<style scoped></style>
