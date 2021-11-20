<template>
    <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
        <section id="contain">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-5">
                        <li class="breadcrumb-item"><a :href="route('home')">Главная</a></li>
                        <li class="breadcrumb-item active text-danger" aria-current="page">Таблица размеров</li>
                    </ol>
                </nav>
                <h1>Таблица размеров</h1>
                <div class="divider"></div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
export default{
    components: {
        AppLayout
    },
    props: {
        cartData: Object
    },
    data() {
        return {
            cart: [],
            cartItemCount: 0,
        }
    },
    mounted() {
        this.cart = this.cartData;
        for (const [key, value] of Object.entries(this.cart)) {
            value.size_quantity.forEach(element => {
                this.cartItemCount++
            });
        }
    },
    watch:{
        cart: function(){
            this.cartItemCount = 0;
            for (const [key, value] of Object.entries(this.cart)) {
                value.size_quantity.forEach(element => {
                    this.cartItemCount++
                });
            }
        }
    },
}
</script>
