<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
const page = usePage();

function deleteRole(id){
    if(confirm("Are you sure you want to delete this role?")){
        router.get(`/admin/role/${id}`);
    }
}

if(page.props.flash.status === true){
    toaster.success(page.props.flash.message);
} else if(page.props.flash.status === false){
    toaster.error(page.props.flash.message);
}
</script>

<template>
  <div class="container-fluid  min-vh-100">
    <!-- Heading -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
      <h2 class="h3 fw-bold text-dark mb-3 mb-sm-0">Role & Permissions</h2>
      <div >
        <Link v-if="page.props.user.can['create-role']"
          :href="`/admin/role-save-page?role_id=0`"
          class="btn btn-success btn-sm shadow"
        >
          Create
        </Link>
      </div>
    </div>

    <!-- Table -->
    <div class="table-responsive shadow rounded">
      <table class="table">
        <thead class="">
          <tr>
            <th scope="col">Role ID</th>
            <th scope="col">Role Name</th>
            <th scope="col">Permissions</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="role in page.props.roles" :key="role.id">
            <td class="fw-medium">{{ role.id }}</td>
            <td>{{ role.name }}</td>
            <td>
              <div class="d-flex flex-wrap gap-2">
                <span
                  v-for="perm in role.permissions"
                  :key="perm.id"
                  class="badge bg-primary"
                >
                  {{ perm.name }}
                </span>
              </div>
            </td>
            <td class="d-flex gap-2">
              <Link v-if="page.props.user.can['update-role']"

                :href="`/admin/role-save-page?role_id=${role.id}`"
                class="btn btn-primary btn-sm"
              >
                Edit
              </Link>
              <button v-if="page.props.user.can['delete-role']"

                @click="deleteRole(role.id)"
                class="btn btn-danger btn-sm"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
