<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { ref, computed } from "vue";
import LogoImage from "./LogoImage.vue";

const toaster = createToaster();
const page = usePage();
const logo_id = new URLSearchParams(window.location.search).get("logo_id") ?? 0;
const logo = page.props.logo;
const errors = computed(() => page.props.errors || {});


const form = useForm({
    content_name: "",
    image: "",
    title: "",
});

if(logo_id != 0 && logo != null){
    form.content_name = logo.content_name;
    form.title = logo.title;
    form.image = logo.image;

}

const URL = logo_id != 0 ? `/admin/logo/${logo_id}` : "/admin/logo";

function submitForm() {
  form.post(URL, {
    preserveScroll: true,
    onSuccess: () => {
      if (page.props.flash.status == true) {
        toaster.success(page.props.flash.message);
        router.get("/admin/logos");
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
          <h4 class="text-center mb-3">{{ logo_id == 0 ? "Create Logo/Banner" : "Update Logo/Banner" }}</h4>
          <form @submit.prevent="submitForm">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input v-model="form.content_name" type="text" class="form-control" />
              <div v-if="errors.content_name" class="text-danger">{{ errors.content_name[0] }}</div>
            </div>

              <div class="mb-3">
              <label class="form-label">Title</label>
              <input v-model="form.title" type="text" class="form-control" />
              <div v-if="errors.title" class="text-danger">{{ errors.title[0] }}</div>
            </div>

            <div class="mb-3">
              <LogoImage :logoImage="form.image" @image="(e)=> form.image = e" />
              <div v-if="errors.image" class="text-danger">{{ errors.image[0] }}</div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                {{ logo_id == 0 ? "Create Logo/Banner " : "Update Logo/Banner" }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

