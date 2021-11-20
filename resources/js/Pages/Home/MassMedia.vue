<template>
    <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
        <section id="content">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-5">
                        <li class="breadcrumb-item"><a :href="route('home')">Главная</a></li>
                        <li class="breadcrumb-item active text-danger" aria-current="page">СМИ</li>
                    </ol>
                </nav>

                <div class="az-mass">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <div class="col" v-for="(item, index) in news" :key="index">
                            <div class="card h-100 border-0 bg-light">
                                <div class="d-flex align-items-center">
                                    <img :src="item.image['fileName'] ? '/storage/' + item.image['fileName'] : '/images/cean.svg'" class="massmedia-card-img p-3" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ item.title }}</h5>
                                    <p class="card-text text-secondary" v-html="shortDesc(item.short_desc)"></p>
                                </div>
                                <a :href="item.link || '#'" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="divider"></div>
<!--        <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--        <div class="modal-dialog modal-xl  modal-dialog-centered modal-fullscreen-sm-down">-->
<!--          <div class="modal-content rounded-0 ">-->
<!--            <div class="modal-body">-->
<!--                <div class="orders">-->
<!--                    <div class="row" v-for="(item, index) in cart" :key="index">-->
<!--                        <div class="col">-->
<!--                            <div class="d-flex">-->
<!--                                <img :src="'/storage/' + item.image[0]['fileName']" alt="" width="145px" class="me-4">-->
<!--                                <nav class="d-flex flex-column">-->
<!--                                    <h5>{{ item.name }}</h5>-->
<!--                                    &lt;!&ndash; <span class="text-decoration-line-through">300 TJS</span> &ndash;&gt;-->
<!--                                    <p class="fs-4 fw-bold">{{ item.price }} TJS</p>-->
<!--                                    <span>Размер:</span>-->
<!--                                    <span>{{ item.size }}</span>-->
<!--                                </nav>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col">-->
<!--                            <div class="d-flex align-content-between flex-column justify-content-between h-100 my-3 my-lg-0">-->
<!--                                <div class="d-flex align-items-lg-center justify-content-between">-->
<!--                                    <span>Количество</span>-->
<!--                                    <span>Цена</span>-->
<!--                                    <span class="text-muted cursor-pointer" @click="removeCart({clear: true})">Очистить корзину</span>-->
<!--                                </div>-->
<!--                                <div class="d-flex align-items-lg-center justify-content-between">-->
<!--                                    <div class="az-countable d-flex">-->
<!--                                        <button type="button" @click="setQuantity('minus', item)" class="btn p-0 shadow-none" id="az-countable-minus">-->
<!--                                            <img src="/images/icons/minus.svg" width="35" height="35">-->
<!--                                        </button>-->
<!--                                        <input type="number" disabled v-model="item.quantity" class="form-control border-0 mx-3 outline-fs-0 text-center fs-2 shadow-none w-50" id="az-countable-count" min="1" max="9999" value="1" step="1">-->
<!--                                        <button type="button" @click="setQuantity('plus', item)" class="btn p-0 shadow-none" id="az-countable-plus">-->
<!--                                            <img src="/images/icons/plus.svg" width="35" height="35">-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                    <h4 class="fw-bold">{{ item.price }} TJS</h4>-->
<!--                                    <button type="button" @click="removeCart(item)" class="btn">-->
<!--                                        <img src="/images/icons/trash.svg" alt="" srcset="">-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <hr class="mt-3">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-lg-6">-->
<!--                        &lt;!&ndash; <p>Lorem Ipsum is simply dummy text of the printing <br>-->
<!--                            and typesetting text ever since the 1500s, </p> &ndash;&gt;-->
<!--                    </div>-->
<!--                    <div class="col-lg-6">-->
<!--                        &lt;!&ndash; <nav class="text-decoration-line-through text-end">1100 TJs</nav> &ndash;&gt;-->
<!--                        <nav class="fs-5 text-end">Cумма: <strong class="fs-4">{{ getSumm }} TJs</strong></nav>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="modal-footer border-0">-->
<!--              <a :href="route('checkout')" class="btn btn-danger text-white  rounded-0 w-100 fs-4">Купить</a>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        </div>-->
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
export default{
    components: {
        AppLayout
    },
    props: {
        news: Array,
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
    methods: {
        //         addToCart(id) {
        //     event.target.firstChild.classList.add('cart-animate')
        //     axios.post(route('addToCart', id))
        //     .then((response)=> {
        //         this.cart = response.data.cart
        //         this.$swal({
        //             toast: true,
        //             position: 'top-end',
        //             showConfirmButton: false,
        //             timer: 2000,
        //             timerProgressBar: true,
        //             icon: 'success',
        //             title: 'Товар добавлен в корзину'
        //         })
        //     })
        // },
        // setQuantity(type, item) {
        //     if (type === 'minus' && item.quantity > 1) {
        //         axios.post(route('setQuantity', type), item)
        //         .then(response=> {
        //             this.cart = response.data.cart
        //         })
        //     } else if (type === 'plus' && item) {
        //         axios.post(route('setQuantity', type), item)
        //         .then(response=> {
        //             this.cart = response.data.cart
        //         })
        //     }
        // },
        // removeCart(item) {
        //     axios.post(route('removeCart'), item)
        //     .then(response=> {
        //         this.cart = response.data.cart
        //     })
        // },
        shortDesc(desc){
                let descArray = desc.split(' ',15);
                return descArray.join(' ') + '<b> . . .</b>'
        },
    },
    computed: {
        // getSumm() {
        //     let pc = 0;
        //     for (const [key, value] of Object.entries(this.cart)) {
        //         pc += (value.price * value.quantity)
        //     }
        //     return pc
        // }
    }
}
</script>
