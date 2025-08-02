<script setup>
import { ref } from "vue";

const props = defineProps({
    countryDetailImage: {
        type: [String, File],
        default: null,
    },
});

const currentImage = props.countryDetailImage
    ? `/storage/countryDetail/${props.countryDetailImage}`
    : null;
const preview = ref(currentImage);
const emit = defineEmits(["image"]);

const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    emit("image", e.target.files[0]);
};

const clearImage = () => {
    preview.value = null;
    emit("image", null);
    document.getElementById("image").value = null;
};
</script>

<template>
  <div class="position-relative d-inline-block">
    <label for="image" class="d-block">
      <img
        :src="preview ? preview : countryDetailImage ? `/storage/countryDetail/${countryDetailImage}` : 'placeholder.png'"
        class="img-thumbnail border border-dark rounded w-100"
        style="width: 100px; height: 100px; object-fit: cover;"
        alt="Banner Image"
      />
    </label>

    <!-- Remove Button -->
    <button
      @click="clearImage"
      type="button"
      class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle px-2 py-1"
      title="Remove Image"
      style="z-index: 2;"
    >
      ✕
    </button>

    <!-- Hidden file input (but clickable over the image) -->
    <input
      @change="imageSelected($event)"
      type="file"
      id="image"
      class="position-absolute"
      style="top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;"
    />
  </div>
</template>
