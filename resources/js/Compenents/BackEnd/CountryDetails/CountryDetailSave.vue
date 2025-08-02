<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { ref, computed } from "vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import CountryDetialImage from "./CountryDetailImage.vue";

const toaster = createToaster();
const page = usePage();
const country_detail_id =
    new URLSearchParams(window.location.search).get("country_detail_id") ?? 0;
const countryDetail = page.props.countryDetail;
const errors = computed(() => page.props.errors || {});

const form = useForm({
    country_id: "",
    country_detail_id: country_detail_id,
    image: "",
    title: "",
    description: "",
    key_points: "",
});

if (country_detail_id != 0 && countryDetail != null) {
    form.country_id = countryDetail.country_id;
    form.image = countryDetail.image;
    form.title = countryDetail.title;
    form.description = countryDetail.description;
    form.key_points = countryDetail.key_points;
}

const URL =
    country_detail_id != 0
        ? `/admin/country-detail/${country_detail_id}`
        : "/admin/country-detail";

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/country-details");
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
            <div class="col-md-8">
                <div class="card shadow p-4 bg-white">
                    <h4 class="text-center mb-3">
                        {{
                            country_detail_id == 0
                                ? "Create Country Detail"
                                : "Update Country Detail"
                        }}
                    </h4>

                    <form @submit.prevent="submitForm">
                        <!-- Country -->
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select
                                v-model="form.country_id"
                                class="form-select"
                            >
                                <option value="0">Select Country</option>
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

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input
                                v-model="form.title"
                                type="text"
                                class="form-control"
                            />
                            <div v-if="errors.title" class="text-danger">
                                {{ errors.title[0] }}
                            </div>
                        </div>

                          <!-- Image Upload -->
                        <div class="mb-3">
                            <CountryDetialImage
                                :countryDetailImage="form.image"
                                @image="(e) => (form.image = e)"
                            />
                            <div v-if="errors.image" class="text-danger">
                                {{ errors.image[0] }}
                            </div>
                        </div>

                        <!-- Key Points -->
                        <div class="mb-3">
                            <label class="form-label">Key Points</label>
                            <QuillEditor
                                v-model:content="form.key_points"
                                content-type="html"
                                theme="snow"
                                style="height: 200px"
                            />
                            <div v-if="errors.key_points" class="text-danger">
                                {{ errors.key_points[0] }}
                            </div>
                        </div>


                           <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <QuillEditor
                                v-model:content="form.description"
                                content-type="html"
                                theme="snow"
                                style="height: 200px"
                            />
                            <div v-if="errors.description" class="text-danger">
                                {{ errors.description[0] }}
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{
                                    country_detail_id == 0
                                        ? "Create Page Content"
                                        : "Update Page Content"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
