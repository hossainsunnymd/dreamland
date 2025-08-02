<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { ref, computed } from "vue";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

import PageContentImage from "./PageContentImage.vue";

const toaster = createToaster();
const page = usePage();
const page_content_id =
    new URLSearchParams(window.location.search).get("page_content_id") ?? 0;
const pageContent = page.props.pageContent;
const errors = computed(() => page.props.errors || {});

const form = useForm({
    image: "",
    title: "",
    description: "",
    page_name: "",
    rank: "",
    meta_title: "",
    meta_description: "",
});

if (page_content_id != 0 && pageContent != null) {
    form.image = pageContent.image;
    form.title = pageContent.title;
    form.description = pageContent.description;
    form.page_name = pageContent.page_name;
    form.rank = pageContent.rank;
    form.meta_title = pageContent.meta_title;
    form.meta_description = pageContent.meta_description;
}

const URL =
    page_content_id != 0
        ? `/admin/page-content/${page_content_id}`
        : "/admin/page-content";

function submitForm() {
    form.post(URL, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/page-contents");
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
                            page_content_id == 0
                                ? "Create Page Content"
                                : "Update Page Content"
                        }}
                    </h4>

                    <form @submit.prevent="submitForm">
                        <!-- Rank -->
                        <div class="mb-3">
                            <label class="form-label">Rank</label>
                            <input
                                v-model="form.rank"
                                type="number"
                                class="form-control"
                            />
                            <div v-if="errors.rank" class="text-danger">
                                {{ errors.rank[0] }}
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

                        <!-- Page Name -->
                        <div class="mb-3">
                            <label class="form-label">Page Name</label>
                            <input
                                v-model="form.page_name"
                                type="text"
                                class="form-control"
                            />
                            <div v-if="errors.page_name" class="text-danger">
                                {{ errors.page_name[0] }}
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <QuillEditor
                                v-model:content="form.description"
                                content-type="html"
                                theme="snow"
                                style="height: 200px;"
                            />
                            <div v-if="errors.description" class="text-danger">
                                {{ errors.description[0] }}
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <PageContentImage
                                :pageContentImage="form.image"
                                @image="(e) => (form.image = e)"
                            />
                            <div v-if="errors.image" class="text-danger">
                                {{ errors.image[0] }}
                            </div>
                        </div>

                        <!-- Meta Title -->
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input
                                v-model="form.meta_title"
                                type="text"
                                class="form-control"
                            />
                            <div v-if="errors.meta_title" class="text-danger">
                                {{ errors.meta_title[0] }}
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <input
                                v-model="form.meta_description"
                                class="form-control"
                            />
                            <div
                                v-if="errors.meta_description"
                                class="text-danger"
                            >
                                {{ errors.meta_description[0] }}
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{
                                    page_content_id == 0
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
