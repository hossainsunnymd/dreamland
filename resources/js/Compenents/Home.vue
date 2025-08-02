<script setup>
import { useForm, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { computed, ref } from "vue";

const toaster = createToaster({});
const page = usePage();
const errors = computed(() => page.props.errors || {});

const form = useForm({
    user_id: page.props.user.authUser.id,
    name: "",
    email: "",
    bd_phone: "",
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
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->

    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div
                        class="h-100"
                        style="
                            border: 50px solid;
                            border-color: transparent #13357b transparent
                                #13357b;
                        "
                    >
                        <img
                            src="../img/about-img.jpg"
                            class="img-fluid w-100 h-100"
                            alt=""
                        />
                    </div>
                </div>
                <div
                    class="col-lg-7"
                    style="
                        background: linear-gradient(
                                rgba(255, 255, 255, 0.8),
                                rgba(255, 255, 255, 0.8)
                            ),
                            url(img/about-img-1.png);
                    "
                >
                    <h5 class="section-about-title pe-3">About Us</h5>
                    <h1 class="mb-4">
                        Welcome to <span class="text-primary">Travela</span>
                    </h1>
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Molestias, dolorum, doloribus sunt dicta, officia
                        voluptatibus libero necessitatibus natus impedit quam
                        ullam assumenda? Id atque iste consectetur. Commodi odit
                        ab saepe!
                    </p>
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Accusantium quos voluptatem suscipit neque enim,
                        doloribus ipsum rem eos distinctio, dignissimos nisi
                        saepe nulla? Libero numquam perferendis provident
                        placeat molestiae quia?
                    </p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-right text-primary me-2"
                                ></i
                                >First Class Flights
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-right text-primary me-2"
                                ></i
                                >Handpicked Hotels
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-right text-primary me-2"
                                ></i
                                >5 Star Accommodations
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-right text-primary me-2"
                                ></i
                                >Latest Model Vehicles
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-right text-primary me-2"
                                ></i
                                >150 Premium City Tours
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0">
                                <i
                                    class="fa fa-arrow-right text-primary me-2"
                                ></i
                                >24/7 Service
                            </p>
                        </div>
                    </div>
                    <a
                        class="btn btn-primary rounded-pill py-3 px-5 mt-2"
                        href=""
                        >Read More</a
                    >
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Searvices</h5>
                <h1 class="mb-0">Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0"
                            >
                                <div class="service-content text-end">
                                    <h5 class="mb-4">WorldWide Tours</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                                <div class="service-icon p-4">
                                    <i
                                        class="fa fa-globe fa-4x text-primary"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0"
                            >
                                <div class="service-content text-end">
                                    <h5 class="mb-4">Hotel Reservation</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                                <div class="service-icon p-4">
                                    <i
                                        class="fa fa-hotel fa-4x text-primary"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0"
                            >
                                <div class="service-content text-end">
                                    <h5 class="mb-4">Travel Guides</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                                <div class="service-icon p-4">
                                    <i
                                        class="fa fa-user fa-4x text-primary"
                                    ></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0"
                            >
                                <div class="service-content text-end">
                                    <h5 class="mb-4">Event Management</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                                <div class="service-icon p-4">
                                    <i class="fa fa-cog fa-4x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0"
                            >
                                <div class="service-icon p-4">
                                    <i
                                        class="fa fa-globe fa-4x text-primary"
                                    ></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">WorldWide Tours</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0"
                            >
                                <div class="service-icon p-4">
                                    <i
                                        class="fa fa-hotel fa-4x text-primary"
                                    ></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Hotel Reservation</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0"
                            >
                                <div class="service-icon p-4">
                                    <i
                                        class="fa fa-user fa-4x text-primary"
                                    ></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Travel Guides</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0"
                            >
                                <div class="service-icon p-4">
                                    <i class="fa fa-cog fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="mb-4">Event Management</h5>
                                    <p class="mb-0">
                                        Dolor sit amet consectetur adipisicing
                                        elit. Non alias eum, suscipit expedita
                                        corrupti officiis debitis possimus nam
                                        laudantium beatae quidem dolore
                                        consequuntur voluptate rem reiciendis,
                                        omnis sequi harum earum.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <a
                            class="btn btn-primary rounded-pill py-3 px-5 mt-2"
                            href=""
                            >Service More</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Destination Start -->
    <div class="container-fluid destination py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Destination</h5>
                <h1 class="mb-0">Popular Destination</h1>
            </div>
            <div class="tab-class text-center">
                <ul
                    class="nav nav-pills d-inline-flex justify-content-center mb-5"
                >
                    <li class="nav-item">
                        <a
                            class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active"
                            data-bs-toggle="pill"
                            href="#tab-1"
                        >
                            <span class="text-dark" style="width: 150px"
                                >All</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill"
                            href="#tab-2"
                        >
                            <span class="text-dark" style="width: 150px"
                                >USA</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill"
                            href="#tab-3"
                        >
                            <span class="text-dark" style="width: 150px"
                                >Canada</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill"
                            href="#tab-4"
                        >
                            <span class="text-dark" style="width: 150px"
                                >Europe</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill"
                            href="#tab-5"
                        >
                            <span class="text-dark" style="width: 150px"
                                >China</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill"
                            href="#tab-6"
                        >
                            <span class="text-dark" style="width: 150px"
                                >Singapore</span
                            >
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-xl-8">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="destination-img">
                                            <img
                                                class="img-fluid rounded w-100"
                                                src="../img/destination-1.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="destination-overlay p-4"
                                            >
                                                <a
                                                    href="#"
                                                    class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                                    >20 Photos</a
                                                >
                                                <h4
                                                    class="text-white mb-2 mt-3"
                                                >
                                                    New York City
                                                </h4>
                                                <a
                                                    href="#"
                                                    class="btn-hover text-white"
                                                    >View All Place
                                                    <i
                                                        class="fa fa-arrow-right ms-2"
                                                    ></i
                                                ></a>
                                            </div>
                                            <div class="search-icon">
                                                <a
                                                    href="../img/destination-1.jpg"
                                                    data-lightbox="destination-1"
                                                    ><i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="destination-img">
                                            <img
                                                class="img-fluid rounded w-100"
                                                src="../img/destination-2.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="destination-overlay p-4"
                                            >
                                                <a
                                                    href="#"
                                                    class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                                    >20 Photos</a
                                                >
                                                <h4
                                                    class="text-white mb-2 mt-3"
                                                >
                                                    Las vegas
                                                </h4>
                                                <a
                                                    href="#"
                                                    class="btn-hover text-white"
                                                    >View All Place
                                                    <i
                                                        class="fa fa-arrow-right ms-2"
                                                    ></i
                                                ></a>
                                            </div>
                                            <div class="search-icon">
                                                <a
                                                    href="../img/destination-2.jpg"
                                                    data-lightbox="destination-2"
                                                    ><i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="destination-img">
                                            <img
                                                class="img-fluid rounded w-100"
                                                src="../img/destination-7.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="destination-overlay p-4"
                                            >
                                                <a
                                                    href="#"
                                                    class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                                    >20 Photos</a
                                                >
                                                <h4
                                                    class="text-white mb-2 mt-3"
                                                >
                                                    Los angelas
                                                </h4>
                                                <a
                                                    href="#"
                                                    class="btn-hover text-white"
                                                    >View All Place
                                                    <i
                                                        class="fa fa-arrow-right ms-2"
                                                    ></i
                                                ></a>
                                            </div>
                                            <div class="search-icon">
                                                <a
                                                    href="../img/destination-7.jpg"
                                                    data-lightbox="destination-7"
                                                    ><i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="destination-img">
                                            <img
                                                class="img-fluid rounded w-100"
                                                src="../img/destination-8.jpg"
                                                alt=""
                                            />
                                            <div
                                                class="destination-overlay p-4"
                                            >
                                                <a
                                                    href="#"
                                                    class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                                    >20 Photos</a
                                                >
                                                <h4
                                                    class="text-white mb-2 mt-3"
                                                >
                                                    Los angelas
                                                </h4>
                                                <a
                                                    href="#"
                                                    class="btn-hover text-white"
                                                    >View All Place
                                                    <i
                                                        class="fa fa-arrow-right ms-2"
                                                    ></i
                                                ></a>
                                            </div>
                                            <div class="search-icon">
                                                <a
                                                    href="../img/destination-8.jpg"
                                                    data-lightbox="destination-8"
                                                    ><i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="destination-img h-100">
                                    <img
                                        class="img-fluid rounded w-100 h-100"
                                        src="../img/destination-9.jpg"
                                        style="
                                            object-fit: cover;
                                            min-height: 300px;
                                        "
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-9.jpg"
                                            data-lightbox="destination-4"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-4.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            Los angelas
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-4.jpg"
                                            data-lightbox="destination-4"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-5.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            Los angelas
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-5.jpg"
                                            data-lightbox="destination-5"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-6.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            Los angelas
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-6.jpg"
                                            data-lightbox="destination-6"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-5.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-5.jpg"
                                            data-lightbox="destination-5"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-6.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-6.jpg"
                                            data-lightbox="destination-6"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-5.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-5.jpg"
                                            data-lightbox="destination-5"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-6.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-6.jpg"
                                            data-lightbox="destination-6"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-5.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-5.jpg"
                                            data-lightbox="destination-5"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-6.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-6.jpg"
                                            data-lightbox="destination-6"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-5" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-5.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-5.jpg"
                                            data-lightbox="destination-5"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-6.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-6.jpg"
                                            data-lightbox="destination-6"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-6" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-5.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-5.jpg"
                                            data-lightbox="destination-5"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="destination-img">
                                    <img
                                        class="img-fluid rounded w-100"
                                        src="../img/destination-6.jpg"
                                        alt=""
                                    />
                                    <div class="destination-overlay p-4">
                                        <a
                                            href="#"
                                            class="btn btn-primary text-white rounded-pill border py-2 px-3"
                                            >20 Photos</a
                                        >
                                        <h4 class="text-white mb-2 mt-3">
                                            San francisco
                                        </h4>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                    <div class="search-icon">
                                        <a
                                            href="../img/destination-6.jpg"
                                            data-lightbox="destination-6"
                                            ><i
                                                class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination End -->

    <!-- Explore Tour Start -->
    <div class="container-fluid ExploreTour py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Explore Tour</h5>
                <h1 class="mb-4">The World</h1>
                <p class="mb-0">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Laborum tempore nam, architecto doloremque velit explicabo?
                    Voluptate sunt eveniet fuga eligendi! Expedita laudantium
                    fugiat corrupti eum cum repellat a laborum quasi.
                </p>
            </div>
            <div class="tab-class text-center">
                <ul
                    class="nav nav-pills d-inline-flex justify-content-center mb-5"
                >
                    <li class="nav-item">
                        <a
                            class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active"
                            data-bs-toggle="pill"
                            href="#NationalTab-1"
                        >
                            <span class="text-dark" style="width: 250px"
                                >National Tour Category</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill"
                            data-bs-toggle="pill"
                            href="#InternationalTab-2"
                        >
                            <span class="text-dark" style="width: 250px"
                                >International tour Category</span
                            >
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div
                        id="NationalTab-1"
                        class="tab-pane fade show p-0 active"
                    >
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="national-item">
                                    <img
                                        src="../img/explore-tour-1.jpg"
                                        class="img-fluid w-100 rounded"
                                        alt="Image"
                                    />
                                    <div class="national-content">
                                        <div class="national-info">
                                            <h5
                                                class="text-white text-uppercase mb-2"
                                            >
                                                Weekend Tour
                                            </h5>
                                            <a
                                                href="#"
                                                class="btn-hover text-white"
                                                >View All Place
                                                <i
                                                    class="fa fa-arrow-right ms-2"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="national-plus-icon">
                                        <a href="#" class="my-auto"
                                            ><i
                                                class="fas fa-link fa-2x text-white"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="national-item">
                                    <img
                                        src="../img/explore-tour-2.jpg"
                                        class="img-fluid w-100 rounded"
                                        alt="Image"
                                    />
                                    <div class="national-content">
                                        <div class="national-info">
                                            <h5
                                                class="text-white text-uppercase mb-2"
                                            >
                                                Holiday Tour
                                            </h5>
                                            <a
                                                href="#"
                                                class="btn-hover text-white"
                                                >View All Place
                                                <i
                                                    class="fa fa-arrow-right ms-2"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="national-plus-icon">
                                        <a href="#" class="my-auto"
                                            ><i
                                                class="fas fa-link fa-2x text-white"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="national-item">
                                    <img
                                        src="../img/explore-tour-3.jpg"
                                        class="img-fluid w-100 rounded"
                                        alt="Image"
                                    />
                                    <div class="national-content">
                                        <div class="national-info">
                                            <h5
                                                class="text-white text-uppercase mb-2"
                                            >
                                                Road Trip
                                            </h5>
                                            <a
                                                href="#"
                                                class="btn-hover text-white"
                                                >View All Place
                                                <i
                                                    class="fa fa-arrow-right ms-2"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="tour-offer bg-info">
                                        15% Off
                                    </div>
                                    <div class="national-plus-icon">
                                        <a href="#" class="my-auto"
                                            ><i
                                                class="fas fa-link fa-2x text-white"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="national-item">
                                    <img
                                        src="../img/explore-tour-4.jpg"
                                        class="img-fluid w-100 rounded"
                                        alt="Image"
                                    />
                                    <div class="national-content">
                                        <div class="national-info">
                                            <h5
                                                class="text-white text-uppercase mb-2"
                                            >
                                                Historical Trip
                                            </h5>
                                            <a
                                                href="#"
                                                class="btn-hover text-white"
                                                >View All Place
                                                <i
                                                    class="fa fa-arrow-right ms-2"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="national-plus-icon">
                                        <a href="#" class="my-auto"
                                            ><i
                                                class="fas fa-link fa-2x text-white"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="national-item">
                                    <img
                                        src="../img/explore-tour-5.jpg"
                                        class="img-fluid w-100 rounded"
                                        alt="Image"
                                    />
                                    <div class="national-content">
                                        <div class="national-info">
                                            <h5
                                                class="text-white text-uppercase mb-2"
                                            >
                                                Family Tour
                                            </h5>
                                            <a
                                                href="#"
                                                class="btn-hover text-white"
                                                >View All Place
                                                <i
                                                    class="fa fa-arrow-right ms-2"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="tour-offer bg-warning">
                                        50% Off
                                    </div>
                                    <div class="national-plus-icon">
                                        <a href="#" class="my-auto"
                                            ><i
                                                class="fas fa-link fa-2x text-white"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="national-item">
                                    <img
                                        src="../img/explore-tour-6.jpg"
                                        class="img-fluid w-100 rounded"
                                        alt="Image"
                                    />
                                    <div class="national-content">
                                        <div class="national-info">
                                            <h5
                                                class="text-white text-uppercase mb-2"
                                            >
                                                Beach Tour
                                            </h5>
                                            <a
                                                href="#"
                                                class="btn-hover text-white"
                                                >View All Place
                                                <i
                                                    class="fa fa-arrow-right ms-2"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="national-plus-icon">
                                        <a href="#" class="my-auto"
                                            ><i
                                                class="fas fa-link fa-2x text-white"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="InternationalTab-2" class="tab-pane fade show p-0">
                        <div class="InternationalTour-carousel owl-carousel">
                            <div class="international-item">
                                <img
                                    src="../img/explore-tour-1.jpg"
                                    class="img-fluid w-100 rounded"
                                    alt="Image"
                                />
                                <div class="international-content">
                                    <div class="international-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            Australia
                                        </h5>
                                        <a
                                            href="#"
                                            class="btn-hover text-white me-4"
                                            ><i
                                                class="fas fa-map-marker-alt me-1"
                                            ></i>
                                            8 Cities</a
                                        >
                                        <a href="#" class="btn-hover text-white"
                                            ><i class="fa fa-eye ms-2"></i>
                                            <span>143+ Tour Places</span></a
                                        >
                                    </div>
                                </div>
                                <div class="tour-offer bg-success">30% Off</div>
                                <div class="international-plus-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div class="international-item">
                                <img
                                    src="../img/explore-tour-2.jpg"
                                    class="img-fluid w-100 rounded"
                                    alt="Image"
                                />
                                <div class="international-content">
                                    <div class="international-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            Germany
                                        </h5>
                                        <a
                                            href="#"
                                            class="btn-hover text-white me-4"
                                            ><i
                                                class="fas fa-map-marker-alt me-1"
                                            ></i>
                                            12 Cities</a
                                        >
                                        <a href="#" class="btn-hover text-white"
                                            ><i class="fa fa-eye ms-2"></i>
                                            <span>21+ Tour Places</span></a
                                        >
                                    </div>
                                </div>
                                <div class="international-plus-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div class="international-item">
                                <img
                                    src="../img/explore-tour-3.jpg"
                                    class="img-fluid w-100 rounded"
                                    alt="Image"
                                />
                                <div class="international-content">
                                    <div class="tour-offer bg-warning">
                                        45% Off
                                    </div>
                                    <div class="international-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            Spain
                                        </h5>
                                        <a
                                            href="#"
                                            class="btn-hover text-white me-4"
                                            ><i
                                                class="fas fa-map-marker-alt me-1"
                                            ></i>
                                            9 Cities</a
                                        >
                                        <a href="#" class="btn-hover text-white"
                                            ><i class="fa fa-eye ms-2"></i>
                                            <span>133+ Tour Places</span></a
                                        >
                                    </div>
                                </div>
                                <div class="international-plus-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div class="international-item">
                                <img
                                    src="../img/explore-tour-4.jpg"
                                    class="img-fluid w-100 rounded"
                                    alt="Image"
                                />
                                <div class="international-content">
                                    <div class="international-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            Japan
                                        </h5>
                                        <a
                                            href="#"
                                            class="btn-hover text-white me-4"
                                            ><i
                                                class="fas fa-map-marker-alt me-1"
                                            ></i>
                                            8 Cities</a
                                        >
                                        <a href="#" class="btn-hover text-white"
                                            ><i class="fa fa-eye ms-2"></i>
                                            <span>137+ Tour Places</span></a
                                        >
                                    </div>
                                </div>
                                <div class="international-plus-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div class="international-item">
                                <img
                                    src="../img/explore-tour-5.jpg"
                                    class="img-fluid w-100 rounded"
                                    alt="Image"
                                />
                                <div class="international-content">
                                    <div class="tour-offer bg-info">
                                        70% Off
                                    </div>
                                    <div class="international-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            London
                                        </h5>
                                        <a
                                            href="#"
                                            class="btn-hover text-white me-4"
                                            ><i
                                                class="fas fa-map-marker-alt me-1"
                                            ></i>
                                            17 Cities</a
                                        >
                                        <a href="#" class="btn-hover text-white"
                                            ><i class="fa fa-eye ms-2"></i>
                                            <span>26+ Tour Places</span></a
                                        >
                                    </div>
                                </div>
                                <div class="international-plus-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Explore Tour Start -->

    <!-- Packages Start -->
    <div class="container-fluid packages py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Packages</h5>
                <h1 class="mb-0">Awesome Packages</h1>
            </div>
            <div class="packages-carousel owl-carousel">
                <div class="packages-item">
                    <div class="packages-img">
                        <img
                            src="../img/packages-4.jpg"
                            class="img-fluid w-100 rounded-top"
                            alt="Image"
                        />
                        <div
                            class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5"
                        >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-map-marker-alt me-2"></i>Venice
                                - Italy</small
                            >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-calendar-alt me-2"></i>3
                                days</small
                            >
                            <small class="flex-fill text-center py-2"
                                ><i class="fa fa-user me-2"></i>2 Person</small
                            >
                        </div>
                        <div class="packages-price py-2 px-4">$349.00</div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Venice - Italy</h5>
                            <small class="text-uppercase">Hotel Deals</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Nesciunt nemo quia quae illum
                                aperiam fugiat voluptatem repellat
                            </p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Read More</a
                                >
                            </div>
                            <div class="col-6 text-end px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Book Now</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="packages-item">
                    <div class="packages-img">
                        <img
                            src="../img/packages-2.jpg"
                            class="img-fluid w-100 rounded-top"
                            alt="Image"
                        />
                        <div
                            class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5"
                        >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-map-marker-alt me-2"></i>Venice
                                - Italy</small
                            >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-calendar-alt me-2"></i>3
                                days</small
                            >
                            <small class="flex-fill text-center py-2"
                                ><i class="fa fa-user me-2"></i>2 Person</small
                            >
                        </div>
                        <div class="packages-price py-2 px-4">$449.00</div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">The New California</h5>
                            <small class="text-uppercase">Hotel Deals</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Nesciunt nemo quia quae illum
                                aperiam fugiat voluptatem repellat
                            </p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Read More</a
                                >
                            </div>
                            <div class="col-6 text-end px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Book Now</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="packages-item">
                    <div class="packages-img">
                        <img
                            src="../img/packages-3.jpg"
                            class="img-fluid w-100 rounded-top"
                            alt="Image"
                        />
                        <div
                            class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5"
                        >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-map-marker-alt me-2"></i>Venice
                                - Italy</small
                            >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-calendar-alt me-2"></i>3
                                days</small
                            >
                            <small class="flex-fill text-center py-2"
                                ><i class="fa fa-user me-2"></i>2 Person</small
                            >
                        </div>
                        <div class="packages-price py-2 px-4">$549.00</div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Discover Japan</h5>
                            <small class="text-uppercase">Hotel Deals</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Nesciunt nemo quia quae illum
                                aperiam fugiat voluptatem repellat
                            </p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Read More</a
                                >
                            </div>
                            <div class="col-6 text-end px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Book Now</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="packages-item">
                    <div class="packages-img">
                        <img
                            src="../img/packages-1.jpg"
                            class="img-fluid w-100 rounded-top"
                            alt="Image"
                        />
                        <div
                            class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5"
                        >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-map-marker-alt me-2"></i
                                >Thayland</small
                            >
                            <small class="flex-fill text-center border-end py-2"
                                ><i class="fa fa-calendar-alt me-2"></i>3
                                days</small
                            >
                            <small class="flex-fill text-center py-2"
                                ><i class="fa fa-user me-2"></i>2 Person</small
                            >
                        </div>
                        <div class="packages-price py-2 px-4">$649.00</div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Thayland Trip</h5>
                            <small class="text-uppercase">Hotel Deals</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Nesciunt nemo quia quae illum
                                aperiam fugiat voluptatem repellat
                            </p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Read More</a
                                >
                            </div>
                            <div class="col-6 text-end px-0">
                                <a
                                    href="#"
                                    class="btn-hover btn text-white py-2 px-4"
                                    >Book Now</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Packages End -->

    <!-- Gallery Start -->
    <div class="container-fluid gallery py-5 my-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px">
            <h5 class="section-title px-3">Our Gallery</h5>
            <h1 class="mb-4">Tourism & Traveling Gallery.</h1>
            <p class="mb-0">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                tempore nam, architecto doloremque velit explicabo? Voluptate
                sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti
                eum cum repellat a laborum quasi.
            </p>
        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a
                        class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active"
                        data-bs-toggle="pill"
                        href="#GalleryTab-1"
                    >
                        <span class="text-dark" style="width: 150px">All</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill"
                        data-bs-toggle="pill"
                        href="#GalleryTab-2"
                    >
                        <span class="text-dark" style="width: 150px"
                            >World tour</span
                        >
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                        data-bs-toggle="pill"
                        href="#GalleryTab-3"
                    >
                        <span class="text-dark" style="width: 150px"
                            >Ocean Tour</span
                        >
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                        data-bs-toggle="pill"
                        href="#GalleryTab-4"
                    >
                        <span class="text-dark" style="width: 150px"
                            >Summer Tour</span
                        >
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill"
                        data-bs-toggle="pill"
                        href="#GalleryTab-5"
                    >
                        <span class="text-dark" style="width: 150px"
                            >Sport Tour</span
                        >
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="GalleryTab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-2">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-1.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-1.jpg"
                                        data-lightbox="gallery-1"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-2.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-2.jpg"
                                        data-lightbox="gallery-2"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-3.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-3.jpg"
                                        data-lightbox="gallery-3"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-4.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-4.jpg"
                                        data-lightbox="gallery-4"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-5.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-5.jpg"
                                        data-lightbox="gallery-5"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-6.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-6.jpg"
                                        data-lightbox="gallery-6"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-7.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-7.jpg"
                                        data-lightbox="gallery-7"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-8.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-8.jpg"
                                        data-lightbox="gallery-8"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-9.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-9.jpg"
                                        data-lightbox="gallery-9"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-10.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-10.jpg"
                                        data-lightbox="gallery-10"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="GalleryTab-2" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-2.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-2.jpg"
                                        data-lightbox="gallery-2"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-3.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-3.jpg"
                                        data-lightbox="gallery-3"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="GalleryTab-3" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-2.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-2.jpg"
                                        data-lightbox="gallery-2"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-3.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-3.jpg"
                                        data-lightbox="gallery-3"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="GalleryTab-4" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-2.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-2.jpg"
                                        data-lightbox="gallery-2"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-3.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-3.jpg"
                                        data-lightbox="gallery-3"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="GalleryTab-5" class="tab-pane fade show p-0">
                    <div class="row g-2">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-2.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-2.jpg"
                                        data-lightbox="gallery-2"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                            <div class="gallery-item h-100">
                                <img
                                    src="../img/gallery-3.jpg"
                                    class="img-fluid w-100 h-100 rounded"
                                    alt="Image"
                                />
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5
                                            class="text-white text-uppercase mb-2"
                                        >
                                            World Tour
                                        </h5>
                                        <a href="#" class="btn-hover text-white"
                                            >View All Place
                                            <i
                                                class="fa fa-arrow-right ms-2"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a
                                        href="../img/gallery-3.jpg"
                                        data-lightbox="gallery-3"
                                        class="my-auto"
                                        ><i
                                            class="fas fa-plus fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

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
                                        @input="
                                            form.pdf = $event.target.files[0]
                                        "
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
                                    <progress
                                        v-if="form.progress"
                                        class="w-100"
                                        :max="form.pdf.size"
                                    >
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

    <!-- Travel Guide Start -->
    <div class="container-fluid guide py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Travel Guide</h5>
                <h1 class="mb-0">Meet Our Guide</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="guide-img-efects">
                                <img
                                    src="../img/guide-1.jpg"
                                    class="img-fluid w-100 rounded-top"
                                    alt="Image"
                                />
                            </div>
                            <div class="guide-icon rounded-pill p-2">
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-twitter"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-instagram"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                            </div>
                        </div>
                        <div class="guide-title text-center rounded-bottom p-4">
                            <div class="guide-title-inner">
                                <h4 class="mt-3">Full Name</h4>
                                <p class="mb-0">Designation</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="guide-img-efects">
                                <img
                                    src="../img/guide-2.jpg"
                                    class="img-fluid w-100 rounded-top"
                                    alt="Image"
                                />
                            </div>
                            <div class="guide-icon rounded-pill p-2">
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-twitter"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-instagram"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                            </div>
                        </div>
                        <div class="guide-title text-center rounded-bottom p-4">
                            <div class="guide-title-inner">
                                <h4 class="mt-3">Full Name</h4>
                                <p class="mb-0">Designation</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="guide-img-efects">
                                <img
                                    src="../img/guide-3.jpg"
                                    class="img-fluid w-100 rounded-top"
                                    alt="Image"
                                />
                            </div>
                            <div class="guide-icon rounded-pill p-2">
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-twitter"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-instagram"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                            </div>
                        </div>
                        <div class="guide-title text-center rounded-bottom p-4">
                            <div class="guide-title-inner">
                                <h4 class="mt-3">Full Name</h4>
                                <p class="mb-0">Designation</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="guide-item">
                        <div class="guide-img">
                            <div class="guide-img-efects">
                                <img
                                    src="../img/guide-4.jpg"
                                    class="img-fluid w-100 rounded-top"
                                    alt="Image"
                                />
                            </div>
                            <div class="guide-icon rounded-pill p-2">
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-twitter"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-instagram"></i
                                ></a>
                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href=""
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                            </div>
                        </div>
                        <div class="guide-title text-center rounded-bottom p-4">
                            <div class="guide-title-inner">
                                <h4 class="mt-3">Full Name</h4>
                                <p class="mb-0">Designation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Travel Guide End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px">
                <h5 class="section-title px-3">Our Blog</h5>
                <h1 class="mb-4">Popular Travel Blogs</h1>
                <p class="mb-0">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Deleniti deserunt tenetur sapiente atque. Magni non
                    explicabo beatae sit, vel reiciendis consectetur numquam id
                    similique sunt error obcaecati ducimus officia maiores.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-img">
                            <div class="blog-img-inner">
                                <img
                                    class="img-fluid w-100 rounded-top"
                                    src="../img/blog-1.jpg"
                                    alt="Image"
                                />
                                <div class="blog-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div
                                class="blog-info d-flex align-items-center border border-start-0 border-end-0"
                            >
                                <small
                                    class="flex-fill text-center border-end py-2"
                                    ><i
                                        class="fa fa-calendar-alt text-primary me-2"
                                    ></i
                                    >28 Jan 2050</small
                                >
                                <a
                                    href="#"
                                    class="btn-hover flex-fill text-center text-white border-end py-2"
                                    ><i
                                        class="fa fa-thumbs-up text-primary me-2"
                                    ></i
                                    >1.7K</a
                                >
                                <a
                                    href="#"
                                    class="btn-hover flex-fill text-center text-white py-2"
                                    ><i
                                        class="fa fa-comments text-primary me-2"
                                    ></i
                                    >1K</a
                                >
                            </div>
                        </div>
                        <div
                            class="blog-content border border-top-0 rounded-bottom p-4"
                        >
                            <p class="mb-3">Posted By: Royal Hamblin</p>
                            <a href="#" class="h4">Adventures Trip</a>
                            <p class="my-3">
                                Tempor erat elitr rebum at clita. Diam dolor
                                diam ipsum sit diam amet diam eos
                            </p>
                            <a
                                href="#"
                                class="btn btn-primary rounded-pill py-2 px-4"
                                >Read More</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-img">
                            <div class="blog-img-inner">
                                <img
                                    class="img-fluid w-100 rounded-top"
                                    src="../img/blog-2.jpg"
                                    alt="Image"
                                />
                                <div class="blog-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div
                                class="blog-info d-flex align-items-center border border-start-0 border-end-0"
                            >
                                <small
                                    class="flex-fill text-center border-end py-2"
                                    ><i
                                        class="fa fa-calendar-alt text-primary me-2"
                                    ></i
                                    >28 Jan 2050</small
                                >
                                <a
                                    href="#"
                                    class="btn-hover flex-fill text-center text-white border-end py-2"
                                    ><i
                                        class="fa fa-thumbs-up text-primary me-2"
                                    ></i
                                    >1.7K</a
                                >
                                <a
                                    href="#"
                                    class="btn-hover flex-fill text-center text-white py-2"
                                    ><i
                                        class="fa fa-comments text-primary me-2"
                                    ></i
                                    >1K</a
                                >
                            </div>
                        </div>
                        <div
                            class="blog-content border border-top-0 rounded-bottom p-4"
                        >
                            <p class="mb-3">Posted By: Royal Hamblin</p>
                            <a href="#" class="h4">Adventures Trip</a>
                            <p class="my-3">
                                Tempor erat elitr rebum at clita. Diam dolor
                                diam ipsum sit diam amet diam eos
                            </p>
                            <a
                                href="#"
                                class="btn btn-primary rounded-pill py-2 px-4"
                                >Read More</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-img">
                            <div class="blog-img-inner">
                                <img
                                    class="img-fluid w-100 rounded-top"
                                    src="../img/blog-3.jpg"
                                    alt="Image"
                                />
                                <div class="blog-icon">
                                    <a href="#" class="my-auto"
                                        ><i
                                            class="fas fa-link fa-2x text-white"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                            <div
                                class="blog-info d-flex align-items-center border border-start-0 border-end-0"
                            >
                                <small
                                    class="flex-fill text-center border-end py-2"
                                    ><i
                                        class="fa fa-calendar-alt text-primary me-2"
                                    ></i
                                    >28 Jan 2050</small
                                >
                                <a
                                    href="#"
                                    class="btn-hover flex-fill text-center text-white border-end py-2"
                                    ><i
                                        class="fa fa-thumbs-up text-primary me-2"
                                    ></i
                                    >1.7K</a
                                >
                                <a
                                    href="#"
                                    class="btn-hover flex-fill text-center text-white py-2"
                                    ><i
                                        class="fa fa-comments text-primary me-2"
                                    ></i
                                    >1K</a
                                >
                            </div>
                        </div>
                        <div
                            class="blog-content border border-top-0 rounded-bottom p-4"
                        >
                            <p class="mb-3">Posted By: Royal Hamblin</p>
                            <a href="#" class="h4">Adventures Trip</a>
                            <p class="my-3">
                                Tempor erat elitr rebum at clita. Diam dolor
                                diam ipsum sit diam amet diam eos
                            </p>
                            <a
                                href="#"
                                class="btn btn-primary rounded-pill py-2 px-4"
                                >Read More</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
</template>

<style scoped></style>
