<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed ,ref} from "vue";

const toaster = createToaster({});
const page = usePage();
const booking_id = new URLSearchParams(window.location.search).get(
    "booking_id"
);
const booking = page.props.booking;
const errors = computed(() => page.props.errors || {});

const form = useForm({
    user_id: "",
    booking_id: booking_id,
    name: "",
    email: "",
    bd_phone: "",
    last_education: "",
    prefferred_country: "",
});

let URL = "/admin/booking";
if (booking_id != 0 && booking != null) {
    form.user_id = booking.user_id;
    form.name = booking.name;
    form.email = booking.email;
    form.bd_phone = booking.bd_mobile;
    form.last_education = booking.last_education;
    form.prefferred_country = booking.prefferred_country;
    URL = "/admin/booking/" + booking_id;
}

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            } else if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/bookings");
            }
        },
    });
}


// Table headers
const headers = [
    { text: "ID", value: "id" },
    { text: "Name", value: "name" },
    { text: "Email", value: "email" },
    { text: "Action", value: "action" },
];

// Users and search fields
const items = ref(page.props.users);

const searchField = ref(["id", "name", "email"]);
const searchItem = ref();

function selectUser(id){
    form.user_id = id;
    const user = items.value.find(user => user.id == id);
    form.name = user.name;
    form.email = user.email;
}
</script>

<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Left Side: Booking Form -->
            <div class="col-md-6 mb-4">
                <div class="card shadow p-4">
                    <h2 class="text-center mb-4">
                        {{ booking_id == 0 ? "Create Booking" : "Update Booking" }}
                    </h2>

                    <form @submit.prevent="submitForm">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input v-model="form.name" type="text" name="name" class="form-control" />
                            <div v-if="errors.name" class="text-danger mt-1">{{ errors.name[0] }}</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                v-model="form.email"
                                type="email"
                                name="email"
                                :readonly="booking_id != 0"
                                class="form-control"
                            />
                            <div v-if="errors.email" class="text-danger mt-1">{{ errors.email[0] }}</div>
                        </div>

                        <!-- Bd Phone -->
                        <div class="mb-3">
                            <label class="form-label">BD Phone</label>
                            <input v-model="form.bd_phone" type="text" class="form-control" />
                            <div v-if="errors.bd_phone" class="text-danger mt-1">{{ errors.bd_phone[0] }}</div>
                        </div>
                        <!-- Preferred Country -->
                        <div class="mb-3">
                            <label class="form-label">Preferred Country</label>
                            <select v-model="form.prefferred_country" class="form-select">
                                <option value="" disabled>Select country</option>
                                <option>Bangladesh</option>
                            </select>
                            <div v-if="errors.prefferred_country" class="text-danger mt-1">
                                {{ errors.prefferred_country[0] }}
                            </div>
                        </div>

                        <!-- Last Education -->
                        <div class="mb-4">
                            <label class="form-label">Last Education</label>
                            <input v-model="form.last_education" type="text" class="form-control" />
                            <div v-if="errors.last_education" class="text-danger mt-1">
                                {{ errors.last_education[0] }}
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ booking_id == 0 ? "Create Booking" : "Update Booking" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side: Users Table -->
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h4 class="mb-3">Users</h4>
                    <EasyDataTable
                        :headers="headers"
                        :items="items"
                        :rows-per-page="5"
                        alternating
                        table-class="table table-striped table-bordered"
                    >
                        <!-- Action column placeholder -->
                        <template #item-action="{ id }">
                            <div class="d-flex gap-2">
                                <button @click="selectUser(id)" type="button" class="btn btn-primary">Select</button>
                            </div>
                        </template>
                    </EasyDataTable>
                </div>
            </div>
        </div>
    </div>
</template>

