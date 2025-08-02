<script setup>
import { router, usePage, useForm } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed } from "vue";

const page = usePage();
const errors = computed(() => page.props.flash.errors || {});
const toaster = createToaster({});

const roleId = new URLSearchParams(window.location.search).get("role_id");
const form = useForm({
    role_id: roleId,
    roleName: "",
    permissions: [],
});

let URL = "/admin/role";
if (roleId != 0 && page.props.role != null) {
    form.roleName = page.props.role.name;
    form.permissions = page.props.role.permissions.map((p) => p.id);
    URL = `/admin/role/${roleId}`;
}

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status === false) {
                toaster.error(page.props.flash.message);
            } else if (page.props.flash.status === true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/roles");
            }
        },
    });
}
</script>

<template>
    <div
        class="card shadow-lg p-4 mx-auto"
        style="max-width: 500px; border-radius: 1rem"
    >
        <!-- Role Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Role Name:</label>
            <input
                type="text"
                v-model="form.roleName"
                class="form-control"
                placeholder="Enter role name"
            />
            <div v-if="errors.roleName" class="text-danger small mt-1">
                {{ errors.roleName[0] }}
            </div>
        </div>

        <!-- Permissions -->
        <h2 class="h5 fw-semibold text-dark mt-3">Select Permissions</h2>
        <div class="row row-cols-2 g-3 mt-2">
            <div
                v-for="permission in page.props.permissions"
                :key="permission.id"
                class="col d-flex align-items-center"
            >
                <input
                    type="checkbox"
                    class="form-check-input me-2"
                    :id="'permission_' + permission.id"
                    :value="permission.id"
                    v-model="form.permissions"
                />
                <label
                    :for="'permission_' + permission.id"
                    class="form-check-label text-capitalize"
                >
                    {{ permission.name }}
                </label>
            </div>
        </div>

        <!-- Save Button -->
        <button
            @click="submitForm"
            type="button"
            class="btn btn-primary w-100 mt-4"
        >
            Save
        </button>
    </div>
</template>

<style scoped></style>
