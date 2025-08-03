<script setup>
import { Link, usePage } from "@inertiajs/vue3";
const page = usePage();
</script>

<template>
    <!-- Header Start -->
    <div
        class="container-fluid bg-breadcrumb"
        :style="{
            backgroundImage: `url(/storage/logo/${page.props.logo.image})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center',
            backgroundRepeat: 'no-repeat',
        }"
    >
        <div class="container text-center py-5" style="max-width: 900px">
            <h3 class="text-white display-3 mb-4">{{ page.props.logo.title }}</h3>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Services</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Services Start -->
    <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Services</h5>
                <h1 class="mb-0">Our Services</h1>
            </div>
            <div class="row g-4">
                <div
                    v-for="category in page.props.serviceCategories"
                    :key="category.id"
                    class="col-md-4"
                >
                    <div class="card service-card h-100 shadow-sm rounded-3">
                        <img
                            :src="`/storage/serviceCategory/${category.image}`"
                            class="card-img-top service-img"
                            :alt="category.service_name"
                        />
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                {{ category.service_name }}
                            </h5>
                            <p class="card-text flex-grow-1">
                                {{ category.service_title }}
                            </p>
                            <Link
                                :href="`/serviceByCategory/${category.id}`"
                                class="btn btn-primary mt-auto align-self-start"
                                >Learn More</Link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Services End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Testimonial</h5>
                <h1 class="mb-0">Our Clients Say!!!</h1>
            </div>
            <div class="testimonial-carousel owl-carousel">
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quis nostrum cupiditate, eligendi repellendus
                            saepe illum earum architecto dicta quisquam quasi
                            porro officiis. Vero reiciendis,
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img
                            src="../img/testimonial-1.jpg"
                            class="img-fluid rounded-circle"
                            alt="Image"
                        />
                    </div>
                    <div style="margin-top: -35px">
                        <h5 class="mb-0">John Abraham</h5>
                        <p class="mb-0">New York, USA</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quis nostrum cupiditate, eligendi repellendus
                            saepe illum earum architecto dicta quisquam quasi
                            porro officiis. Vero reiciendis,
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img
                            src="../img/testimonial-2.jpg"
                            class="img-fluid rounded-circle"
                            alt="Image"
                        />
                    </div>
                    <div style="margin-top: -35px">
                        <h5 class="mb-0">John Abraham</h5>
                        <p class="mb-0">New York, USA</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quis nostrum cupiditate, eligendi repellendus
                            saepe illum earum architecto dicta quisquam quasi
                            porro officiis. Vero reiciendis,
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img
                            src="../img/testimonial-3.jpg"
                            class="img-fluid rounded-circle"
                            alt="Image"
                        />
                    </div>
                    <div style="margin-top: -35px">
                        <h5 class="mb-0">John Abraham</h5>
                        <p class="mb-0">New York, USA</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Quis nostrum cupiditate, eligendi repellendus
                            saepe illum earum architecto dicta quisquam quasi
                            porro officiis. Vero reiciendis,
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img
                            src="../img/testimonial-4.jpg"
                            class="img-fluid rounded-circle"
                            alt="Image"
                        />
                    </div>
                    <div style="margin-top: -35px">
                        <h5 class="mb-0">John Abraham</h5>
                        <p class="mb-0">New York, USA</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
</template>

<style scoped>
.service-card {
    height: 350px;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
    cursor: pointer;
}
.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
}
.service-img {
    height: 160px;
    object-fit: cover;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}
.card-body {
    padding: 1rem 1.25rem;
}
.card-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
}
.card-text {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 1rem;
}
.btn-primary {
    font-size: 0.9rem;
    padding: 0.4rem 1rem;
    border-radius: 0.3rem;
}
</style>
