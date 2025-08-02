<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed } from "vue";

const toaster = createToaster({});
const page = usePage();
const user_id = new URLSearchParams(window.location.search).get("user_id");
const user = page.props.users;
const errors = computed(() => page.props.errors || {});

const form = useForm({
    user_id: user_id,
    name: "",
    email: "",
    password: "",
    phone: "",
    role: [],
});

let URL = "/admin/user";
if (user_id != 0 && user != null) {
    form.name = user.name;
    form.email = user.email;
    form.phone = user.phone;
    form.role = user.roles.map((r) => r.name);
    URL = `/admin/user/${user_id}`;
}

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            } else if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/users");
            }
        },
    });
}

  const filttredRoles=computed(()=>{
    return page.props.roles.filter(role => role.name != 'superadmin');
})
</script>

<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="card shadow p-4 w-100" style="max-width: 600px">
            <h2 class="text-center mb-4">
                {{ user_id == 0 ? "User Registration" : "Update User" }}
            </h2>

            <form @submit.prevent="submitForm">
                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        name="name"
                        class="form-control"
                    />
                    <div v-if="errors.name" class="text-danger mt-1">
                        {{ errors.name[0] }}
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        name="email"
                        :readonly="user_id != 0"
                        class="form-control"
                    />
                    <div v-if="errors.email" class="text-danger mt-1">
                        {{ errors.email[0] }}
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        name="password"
                        class="form-control"
                    />
                    <div v-if="errors.password" class="text-danger mt-1">
                        {{ errors.password[0] }}
                    </div>
                </div>

                <!-- Roles -->
                <div class="mb-3">
                    <label class="form-label">Roles</label>
                    <select v-model="form.role" multiple class="form-select">
                        <option value="" disabled>Select Role</option>
                        <option
                            v-for="role in filttredRoles"
                            :key="role.id"
                            :value="role.name"
                        >
                            {{ role.name }}
                        </option>
                    </select>
                    <div v-if="errors.role" class="text-danger mt-1">
                        {{ errors.role[0] }}
                    </div>
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label class="form-label">Phone</label>
                    <input
                        v-model="form.phone"
                        type="tel"
                        name="phone"
                        class="form-control"
                    />
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        {{ user_id == 0 ? "Register" : "Update" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
