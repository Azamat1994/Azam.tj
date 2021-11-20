<template>
    <div>
        <Navbar :cart="cart"/>
        <slot></slot>
        <Footer :cartData="cartData" />
    </div>
</template>


<script>
import Navbar from './../Components/Navbar'
import Footer from './../Components/Footer'

export default {
    components: {
        Navbar,
        Footer
    },
    props: {
        cart: Number,
        cartData: Object,
    },
    data() {
        return {}
    },
    methods: {
    }
}
</script>
