<template>
    <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
        <section id="contain">
            <div class="container">
                <div class="card bg-gray text-dark border-0 text-center" style="margin-bottom: 50px">
                    <div class="divider"></div>
                    <div class="card-body top-50 position-relative">
                        <h1 class="card-title">Ваш заказ оплачен</h1>
                        <p class="card-text">Наш менеджер свяжется с вами.</p>
                        <a type="button" href="/" class="btn btn-danger text-white  px-5 fs-4 rounded-0">На
                            главную страницу</a>
                    </div>
                    <div class="divider"></div>
                </div>
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
