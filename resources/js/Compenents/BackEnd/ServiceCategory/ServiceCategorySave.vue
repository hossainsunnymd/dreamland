<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed } from "vue";
import CategoryImage from "./CategoryImage.vue";

const toaster = createToaster();
const page = usePage();
const service_category_id = new URLSearchParams(window.location.search).get("service_category_id") ?? 0;
const serviceCategory = page.props.serviceCategory;
const errors = computed(() => page.props.errors || {});


const form = useForm({
    image: "",
    service_name: "",
    service_title: "",
});

if(service_category_id != 0 && serviceCategory != null){
    form.image = serviceCategory.image;
    form.service_name = serviceCategory.service_name;
    form.service_title = serviceCategory.service_title;

}

const URL = service_category_id != 0 ? `/admin/update-service-category/${service_category_id}` : "/admin/save-service-category";

function submitForm() {
  form.post(URL, {
    preserveScroll: true,
    onSuccess: () => {
      if (page.props.flash.status == true) {
        toaster.success(page.props.flash.message);
        router.get("/admin/service-categories");
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
          <h4 class="text-center mb-3">{{ service_category_id == 0 ? "Create Service Category" : "Update Service Category" }}</h4>
          <form @submit.prevent="submitForm">
            <div class="mb-3">
              <label class="form-label">Service Name</label>
              <input v-model="form.service_name" type="text" class="form-control" />
              <div v-if="errors.service_name" class="text-danger">{{ errors.service_name[0] }}</div>
            </div>

             <div class="mb-3">
              <label class="form-label"> Service Title</label>
              <textarea v-model="form.service_title" type="text" class="form-control" >
              </textarea>
              <div v-if="errors.service_title" class="text-danger">{{ errors.service_title[0] }}</div>
            </div>
            <div class="mb-3">
                <CategoryImage :categoryImage="form.image" @image="(e)=> form.image = e"/>
                <div v-if="errors.image" class="text-danger">{{ errors.image[0] }}</div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                {{ service_category_id == 0 ? "Create Service Category" : "Update Service Category" }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

