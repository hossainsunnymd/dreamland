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
    { text: "Role", value: "role" },
    { text: "Phone", value: "phone" },
    { text: "Action", value: "action" },
];

// Users and search fields
const items = ref(page.props.users);

const searchField = ref(["id", "name", "email"]);
const searchItem = ref();

// Delete User
function deleteUser(id) {
    if (confirm("Are you sure you want to delete this user?")) {
        router.get(`/admin/user/${id}`);
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
    <h3 class="fw-bold mb-4">User List</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <input
            type="text"
            class="form-control w-25"
            v-model="searchItem"
            placeholder="Search here"
        />

        <!-- Add Button -->
        <Link  v-if="page.props.user.can['create-user']" :href="`/admin/user-save-page?user_id=${0}`" class="btn btn-success">
            Add User
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
        <template #item-role="{ roles }">
            <span class="me-1" v-for="role in roles" :key="role.id"
                >{{ role.name }}
            </span>
        </template>
        <!-- Action Column -->
        <template #item-action="{ id }">
            <div class="d-flex gap-2">
                <Link v-if="page.props.user.can['update-user']"
                    :href="`/admin/user-save-page?user_id=${id}`"
                    class="btn btn-sm btn-primary"
                >
                    Edit
                </Link>
                <button v-if="page.props.user.can['delete-user']" @click="deleteUser(id)" class="btn btn-sm btn-danger">
                    Delete
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<style scoped></style>
