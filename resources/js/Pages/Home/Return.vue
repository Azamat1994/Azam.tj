<template>
    <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
        <section id="contain">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-5">
                        <li class="breadcrumb-item"><a :href="route('home')">Главная</a></li>
                        <li class="breadcrumb-item active text-danger" aria-current="page">Гарантия и возврат</li>
                    </ol>
                </nav>
                <div class="az-return">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h1 class="line-height">Гарантия и возврат</h1>
                            <p class="lh-lg my-5">Мы даем сезон (три месяца) гарантии на всю продукцию, в течении которого осуществляется
                                бесплатный ремонт или замена, в случае если продукция не пригодна к ремонту.
                                (продукции испорченные внешними физическими воздействиями, не попадают в эту
                                категорию и ремонтируется платно) Возврат товара возможен в течение 14 дней в первоначальном
                                виде товара (если обувь не ношена на улице). </p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <img src="" alt="" class="rounded img-fluid">
                        </div>
                    </div>
                </div>
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
