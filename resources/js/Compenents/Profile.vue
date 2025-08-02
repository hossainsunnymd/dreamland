<template>
  <div class="container py-5">
    <div class="card shadow-sm rounded-4 p-4">
      <div class="text-center position-relative mb-4">
        <img  alt="Profile" class="profile-img" />
        <label for="avatarInput" class="upload-btn">
          <i class="fa fa-camera"></i>
          <input type="file" id="avatarInput" accept="image/*" class="d-none" @change="handleImageChange" />
        </label>
      </div>

      <form @submit.prevent="submitForm">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input v-model="form.name" type="text" class="form-control" placeholder="Your name" />
            <p class="text-danger mt-2" v-if="errors.name">{{ errors.name[0] }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input v-model="form.email" type="email" class="form-control" placeholder="your@email.com" />
            <p class="text-danger mt-2" v-if="errors.email">{{ errors.email[0] }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input v-model="form.phone" type="text" class="form-control" placeholder="+8801XXXXXXX" />
            <p class="text-danger mt-2" v-if="errors.phone">{{ errors.phone[0] }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password</label>
            <input v-model="form.password" type="text" class="form-control" placeholder="Your password" />
            <p class="text-danger mt-2" v-if="errors.password">{{ errors.password[0] }}</p>
          </div>
        </div>

        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-primary px-4">Update Profile</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage, router } from "@inertiajs/vue3";
import { ref,computed } from "vue";
import { createToaster } from "@meforma/vue-toaster";

const page = usePage();
const toaster = createToaster({});

const errors = computed(() => page.props.errors || {});

const form = useForm({
  name: page.props.profile.name,
  email: page.props.profile.email,
  phone: page.props.profile.phone,
  password: page.props.profile.password,
  image: null,
});

const userId= page.props.profile.id;
const submitForm = () => {
  form.post(`/student/profile-update/${userId}`, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            } else if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/student/dashboard");
            }
        },
    });
};


</script>

<style scoped>
.profile-img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.upload-btn {
  position: absolute;
  bottom: 0;
  right: 0;
  background-color: #fff;
  border-radius: 50%;
  padding: 5px;
  border: 1px solid #ccc;
  cursor: pointer;
}

.upload-btn:hover {
  background-color: #f8f9fa;
}

</style>
