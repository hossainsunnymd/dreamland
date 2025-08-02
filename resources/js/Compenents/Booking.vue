<script setup>
import { useForm, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed, ref } from "vue";

const toaster = createToaster({});
const page = usePage();
const errors = computed(() => page.props.errors || {});

const form = useForm({
    user_id: page.props.user.authUser.id,
    name: page.props.user.login == true ? page.props.user.authUser.name : "",
    email: page.props.user.login == true ? page.props.user.authUser.email : "",
    bd_phone: page.props.user.login == true ? page.props.user.authUser.phone : "",
    last_education: "",
    prefferred_country: "",
    pdf: "",
});

// Custom dropdown logic
const isOpen = ref(false);
const selectedCountry = ref(null);

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};

const selectCountry = (country) => {
    selectedCountry.value = country;
    form.prefferred_country = country.country_name;
    isOpen.value = false;
};

function submitForm() {
    form.post("/student/booking", {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            } else if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/");
            }
        },
    });
}
</script>

<template>
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px">
            <h3 class="text-white display-3 mb-4">Online Booking</h3>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">
                    Online Booking
                </li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Tour Booking Start -->
    <div class="container-fluid booking py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h5 class="section-booking-title pe-3">Booking</h5>
                    <h1 class="text-white mb-4">Online Booking</h1>
                    <p class="text-white mb-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Aspernatur maxime ullam esse fuga blanditiis accusantium
                        pariatur quis sapiente, veniam doloribus praesentium?
                        Repudiandae iste voluptatem fugiat doloribus quasi quo
                        iure officia.
                    </p>
                    <p class="text-white mb-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Aspernatur maxime ullam esse fuga blanditiis accusantium
                        pariatur quis sapiente, veniam doloribus praesentium?
                        Repudiandae iste voluptatem fugiat doloribus quasi quo
                        iure officia.
                    </p>
                    <a
                        href="#"
                        class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2"
                        >Read More</a
                    >
                </div>
                <div class="col-lg-6">
                    <h1 class="text-white mb-3">Book A Tour Deals</h1>
                    <p class="text-white mb-4">
                        Get <span class="text-warning">50% Off</span> On Your
                        First Adventure Trip With Travela. Get More Deal Offers
                        Here.
                    </p>
                    <form @submit.prevent="submitForm">
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="form-control bg-white border-0"
                                        id="name"
                                        placeholder="Your Name"
                                        :readonly="page.props.user.login==true"
                                    />
                                    <label for="name">Your Name</label>
                                    <div
                                        v-if="errors.name"
                                        class="text-white mt-1"
                                    >
                                        {{ errors.name[0] }}
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        class="form-control bg-white border-0"
                                        id="email"
                                        placeholder="Your Email"
                                        :readonly="page.props.user.login==true"
                                    />
                                    <label for="email">Your Email</label>
                                    <div
                                        v-if="errors.email"
                                        class="text-white mt-1"
                                    >
                                        {{ errors.email[0] }}
                                    </div>
                                </div>
                            </div>

                            <!-- BD Phone -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input
                                        v-model="form.bd_phone"
                                        type="text"
                                        class="form-control bg-white border-0"
                                        placeholder="Mobile No"
                                        :readonly="page.props.user.login==true"
                                    />
                                    <label for="bd_phone">Mobile</label>
                                    <div
                                        v-if="errors.bd_phone"
                                        class="text-white mt-1"
                                    >
                                        {{ errors.bd_phone[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input
                                        @input="form.pdf = $event.target.files[0]"
                                        type="file"
                                        class="form-control bg-white border-0"
                                        placeholder="PDF"
                                    />
                                    <label for="pdf">PDF</label>
                                    <div
                                        v-if="errors.pdf"
                                        class="text-white mt-1"
                                    >
                                        {{ errors.pdf[0] }}
                                    </div>
                                     <progress v-if="form.progress" class="w-100" :max="form.pdf.size">
                                            {{ form.progress.percentage }}
                                        </progress>
                                </div>
                            </div>

                            <!-- Last Education -->
                            <div class="col-xl-6">
                                <div class="form-floating">
                                    <select
                                        v-model="form.last_education"
                                        class="form-select border"
                                    >
                                        <option value="hsc">HSC</option>
                                        <option value="bechelor">
                                            Bechelor
                                        </option>
                                    </select>
                                    <label for="last-education"
                                        >Last Education</label
                                    >
                                    <div
                                        v-if="errors.last_education"
                                        class="text-white mt-1"
                                    >
                                        {{ errors.last_education[0] }}
                                    </div>
                                </div>
                            </div>

                            <!-- Preferred Country (custom dropdown) -->
                            <div class="col-xl-6">
                                <div class="form-floating position-relative">
                                    <div class="dropdown w-100">
                                        <!-- Button -->
                                        <button
                                            class="btn bg-white border dropdown-toggle w-100 d-flex align-items-center justify-content-between"
                                            type="button"
                                            @click="toggleDropdown"
                                        >
                                            <div
                                                class="d-flex align-items-center gap-2"
                                                style="height: 44px"
                                            >
                                                <div
                                                    class="d-flex justify-content-center align-items-center gap-2"
                                                >
                                                    <img
                                                        v-if="selectedCountry"
                                                        :src="`/storage/country/${selectedCountry.country_flag}`"
                                                        alt="flag"
                                                        style="
                                                            width: 20px;
                                                            height: 14px;
                                                            object-fit: cover;
                                                        "
                                                    />
                                                    <span>
                                                        {{
                                                            selectedCountry
                                                                ? selectedCountry.country_name
                                                                : "Select Country"
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                        </button>

                                        <!-- Dropdown List -->
                                        <ul
                                            v-if="isOpen"
                                            class="dropdown-menu show w-100 mt-1 shadow-sm"
                                            style="
                                                max-height: 200px;
                                                overflow-y: auto;
                                                background: white;
                                                z-index: 1000;
                                            "
                                        >
                                            <li
                                                v-for="(country, index) in page
                                                    .props.countries"
                                                :key="index"
                                                @click.stop="
                                                    selectCountry(country)
                                                "
                                                class="dropdown-item d-flex align-items-center gap-2"
                                                style="cursor: pointer"
                                            >
                                                <img
                                                    :src="`/storage/country/${country.country_flag}`"
                                                    alt="flag"
                                                    style="
                                                        width: 20px;
                                                        height: 14px;
                                                        object-fit: cover;
                                                    "
                                                />
                                                {{ country.country_name }}
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Error -->
                                    <div
                                        v-if="errors.prefferred_country"
                                        class="text-white mt-1"
                                    >
                                        {{ errors.prefferred_country[0] }}
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="col-12">
                                <button
                                    class="btn btn-primary text-white w-100 py-3"
                                    type="submit"
                                >
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tour Booking End -->
</template>

<style scoped></style>
