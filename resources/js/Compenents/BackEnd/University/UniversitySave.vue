<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { ref, computed } from "vue";
import UniversityImage from "./UniversityImage.vue";

const toaster = createToaster();
const page = usePage();
const university_id =
    new URLSearchParams(window.location.search).get("university_id") ?? 0;
const university = page.props.university;
const errors = computed(() => page.props.errors || {});

const form = useForm({
    country_id: "",
    name: "",
    title: "",
    image: "",
    rank: "",
});

if (university_id != 0 && university != null) {
    form.country_id = university.country_id;
    form.name = country.name;
    form.title = country.title;
    form.image = country.image;
}

const URL =
    university_id != 0
        ? `/admin/university/${country_id}`
        : "/admin/university";

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/universities");
            } else if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            }
        },
    });
}
</script>

<template>
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row w-100 justify-content-center">
            <!-- Booking Form -->
            <div class="col-md-6">
                <div class="card shadow p-4 bg-white">
                    <h4 class="text-center mb-3">
                        {{
                            university_id == 0
                                ? "Create University"
                                : "Update University"
                        }}
                    </h4>
                    <form @submit.prevent="submitForm">
                        <div class="mb-3">
                            <label class="form-label">Rank</label>
                            <input
                                v-model="form.rank"
                                type="text"
                                class="form-control"
                            />
                            <div v-if="errors.rank" class="text-danger">
                                {{ errors.rank[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country Name</label>
                            <select
                                v-model="form.country_id"
                                class="form-select"
                            >
                                <option selected value="">
                                    Select Country
                                </option>
                                <option
                                    v-for="country in page.props.countries"
                                    :key="country.id"
                                    :value="country.id"
                                >
                                    {{ country.country_name }}
                                </option>
                            </select>
                            <div v-if="errors.country_id" class="text-danger">
                                {{ errors.country_id[0] }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">University Name</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                            />
                            <div v-if="errors.name" class="text-danger">
                                {{ errors.name[0] }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">University Title</label>
                            <input
                                v-model="form.title"
                                type="text"
                                class="form-control"
                            />
                            <div v-if="errors.title" class="text-danger">
                                {{ errors.title[0] }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <UniversityImage
                                :universityImage="form.image"
                                @image="(e) => (form.image = e)"
                            />
                            <div v-if="errors.image" class="text-danger">
                                {{ errors.image[0] }}
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{
                                    university_id == 0
                                        ? "Create University"
                                        : "Update University"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
