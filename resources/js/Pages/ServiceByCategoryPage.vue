<script setup>
import SideNav from '../Compenents/Layout/SideNav.vue';
import ServiceByCategory from '../Compenents/FrontEnd/ServiceByCategoryffff.vue';
import { usePage } from "@inertiajs/vue3";
const page = usePage();
console.log(page.props.serviceList);
</script>

<template>
    <SideNav>>
    <ServiceByCategory/>
</SideNav>

</template>

<style scoped>

</style>
