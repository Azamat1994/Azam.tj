<template>
    <!--<div>-->
    <!--    <header class="bg-white shadow">-->
    <!--        <Sidebar/>-->
    <!--    </header>-->
    <!--    <main>-->
    <!--        <slot></slot>-->
    <!--    </main>-->
    <!--</div>-->


    <div>

        <!-- NAVIGATION
    ================================================== -->
        <Sidebar/>

        <slot></slot>
    </div>


</template>


<script>

import Sidebar from './../Components/Sidebar'

export default {
    components: {
        Sidebar
    },
    data() {
        return {
        }
    },
    methods: {
    }
}
</script>
