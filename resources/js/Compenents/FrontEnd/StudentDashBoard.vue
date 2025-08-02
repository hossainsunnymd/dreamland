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
    { text: "Abroad Phone", value: "abroad_mobile" },
    { text: "Preffered Country", value: "prefferred_country" },
    { text: "Last Education", value: "last_education" },
];

// Users and search fields
const items = ref(page.props.bookings || []);

const searchField = ref(["id", "name", "email"]);
const searchItem = ref();

// Flash message toast
if (page.props.flash.status === false) {
    toaster.error(page.props.flash.message);
} else if (page.props.flash.status === true) {
    toaster.success(page.props.flash.message);
}
</script>

<template>
     <div v-if="page.props.user.authUser.is_active == 'Disable' " class="overlay">
    <div class="overlay-content">
      <h4>Your ID is not active</h4>
      <p>Please contact admin for activation.</p>
    </div>
  </div>
    <h3 class="fw-bold mb-4">My Bookings</h3>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <input
            type="text"
            class="form-control w-25"
            v-model="searchItem"
            placeholder="Search here"
        />

        <!-- Add Button -->
        <Link href="/booking" class="btn btn-success">
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
    </EasyDataTable>
</template>

<style scoped>
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  text-align: center;
}

.overlay-content {
  background-color: #222;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 0 20px #000;
}
</style>
