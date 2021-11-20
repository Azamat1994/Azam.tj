<template>
    <dashboard-layout>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>


    </dashboard-layout>
</template>

<script>
import DashboardLayout from '../Layouts/DashboardLayout'
export default {
    components: {
        DashboardLayout
    },
    mounted() {
        window.location.href = '/dashboard/orders';
    }
}
</script>
