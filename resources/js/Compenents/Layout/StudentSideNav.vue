<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const open = ref(false);

const URL = computed(() => page.url);

const isActiveRoute = (route) => {
  return URL.value.includes(route);
};

function toggleSidebar() {
  open.value = !open.value;
}
</script>

<template>
  <div class="admin-container-fluid position-relative admin-bg-white d-flex" style="height: 100vh; overflow: hidden">
    <!-- Sidebar Start -->
    <div :class="['admin-sidebar pe-0 pb-3', open ? 'open' : '']" style="height: 100vh; overflow-y: auto">
      <nav class="admin-navbar admin-bg-light admin-navbar-light">
        <!-- User Info -->
        <div class="d-flex align-items-center ms-4 mb-4">
          <div class="position-relative">
            <div class="admin-bg-success rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
          </div>
          <div class="ms-3">
            <h6 class="mb-0">Hi, {{ page.props.user.authUser.name }}</h6>
          </div>
        </div>

        <!-- Sidebar Nav -->
        <div class="admin-navbar-nav w-100 d-flex flex-column gy-2 mt-3">
          <!-- Dashboard -->
          <Link
            href="/student/dashboard"
            :class="['admin-nav-item admin-nav-link', isActiveRoute('/dashboard') ? 'active' : '']"
            style="text-decoration: none;"
          >
            <i class="fa fa-tachometer-alt me-2"></i> MY Bookings
          </Link>

        </div>
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div :class="['admin-content', open ? 'open' : '']" style="flex: 1; overflow-y: auto">
      <!-- Navbar Start -->
      <nav class="admin-navbar admin-navbar-expand d-flex sticky-top px-4 py-0" style="background-color: #f3f6f9; height: 50px">
        <a href="#" class="admin-navbar-brand d-flex d-lg-none me-4">
          <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
        </a>
        <button @click="toggleSidebar" class="admin-sidebar-toggler flex-shrink-0">
          <i class="fa fa-bars"></i>
        </button>

        <div class="admin-navbar-nav align-items-center ms-auto">
          <div class="admin-nav-item dropdown">
            <a href="#" class="admin-nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <span class="d-none d-lg-inline-flex">{{ page.props.user.authUser.name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end admin-bg-light border-0 rounded-0 rounded-bottom m-0">
              <Link href="/logout" class="dropdown-item">Log Out</Link>
              <Link href="/profile" class="dropdown-item">Profile</Link>
            </div>
          </div>
        </div>
      </nav>
      <!-- Navbar End -->

      <!-- Content Body -->
      <div class="admin-container-fluid pt-4 px-4">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
