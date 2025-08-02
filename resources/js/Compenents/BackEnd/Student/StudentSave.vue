<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed } from "vue";

const toaster = createToaster({});
const page = usePage();
const student_id = new URLSearchParams(window.location.search).get("student_id");
const student = page.props.student;
const errors = computed(() => page.props.errors || {});

const form = useForm({
    student_id: student_id,
    name: "",
    email: "",
    password: "",
    phone: "",
    activity: "",
});

let URL = "/admin/student";
if (student_id != 0 && student != null) {
    form.name = student.name;
    form.email = student.email;
    form.phone = student.phone;
    form.activity = student.is_active;
    URL = `/admin/student/${student_id}`;
}

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            } else if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/students");
            }
        },
    });
}

</script>

<template>
    <div class="d-flex justify-content-center mt-5">
        <div class="card shadow p-4 w-100" style="max-width: 600px">
            <h2 class="text-center mb-4">
                {{ student_id == 0 ? "Create Student" : "Update Student" }}
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
                        :readonly="student_id != 0"
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

                <!-- Phone -->
                <div class="mb-4">
                    <label class="form-label">Phone</label>
                    <input
                        v-model="form.phone"
                        type="tel"
                        name="phone"
                        class="form-control"
                    />
                     <div v-if="errors.phone" class="text-danger mt-1">
                        {{ errors.phone[0] }}
                    </div>
                </div>

                  <!-- Activity -->
                <div class="mb-4">
                    <label class="form-label">Activity</label>
                    <select v-model="form.activity" class="form-select">
                        <option value="" disabled>Select Activity</option>
                        <option value="Enable">Enable</option>
                        <option value="Disable">Disable</option>
                    </select>
                     <div v-if="errors.phone" class="text-danger mt-1">
                        {{ errors.phone[0] }}
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        {{ student_id == 0 ? "Register" : "Update" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
