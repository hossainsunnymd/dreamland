<script>
import { usePage } from "@inertiajs/vue3";
const page = usePage();
console.log(page.props.serviceList);
</script>

<template>
    hello world
    <!-- Header Start -->
    <!-- <div
        class="container-fluid bg-breadcrumb"
     :style="{
            backgroundImage: `url(/storage/service/${page.props.a.service_image})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center',
            backgroundRepeat: 'no-repeat',
            height: '400px',
        }"
    >
        <div class="container text-center py-5" style="max-width: 900px">
            <h3 class="text-white display-3 mb-4">{{ page.props.booking.title }}</h3>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">
                    Online Booking
                </li>
            </ol>
        </div>
    </div> -->
    <!-- Header End -->
</template>

<style scoped></style>
