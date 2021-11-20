<template>
    <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
        <section id="contain">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-5">
                        <li class="breadcrumb-item"><a :href="route('home')">Главная</a></li>
                        <li class="breadcrumb-item active text-danger" aria-current="page">Профиль</li>
                    </ol>
                </nav>
                <div class="az-profile">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="az-profile-aside d-flex flex-column align-items-center">
                                <img :src="this.$page.props.user.avatar ? '/storage/' + this.$page.props.user.avatar : '/img/avatar.png'" alt="" class="rounded-circle" style="object-fit: cover" width="170" height="170">
                                <h1 class="text-lg-center my-4 fw-normal">{{ $page.props.user.name }}</h1>
                            </div>
                            <div class="az-profile-navs">
                                <ul class="list-group list-group-flush az-profile-list">
                                    <li class="list-group-item">
                                        <a :href="route('bonus')" :class="`text-decoration-none text-secondary fs-5 ${route().current('bonus') ? 'active' : ''}`">
                                            Бонусы
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a :href="route('history')" :class="`text-decoration-none text-secondary fs-5 ${route().current('history') ? 'active' : ''}`">
                                            История заказов
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a :href="route('profile')" :class="`text-decoration-none text-secondary fs-5 ${route().current('profile') ? 'active' : ''}`">
                                            Профиль
                                        </a>
                                    </li>
                                  </ul>
                            </div>
                            <div class="divider"></div>
                        </div>
                        <div class="col-12 col-lg-9">
                            <h1 class="mb-4">История заказов</h1>
                            <div class="az-history-orders">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col" class="text-secondary">Название</th>
                                        <th scope="col" class="text-secondary">Дата</th>
                                        <th scope="col" class="text-secondary">Цена</th>
                                        <th scope="col" class="text-secondary">Статус</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="fs-5" v-for="(order, index) in orders" :key="index">
                                        <td>
                                            <a :href="item.is_active ? route('show-product', item.slug) : '#'" class="d-block" v-for="(item, index) in order.products" :key="index">
                                                <small>{{ item.name }}</small></a>
                                        </td>
                                        <td>{{ new Date(order.created_at).toLocaleString() }}</td>
                                        <td>{{ order.total }} TJS</td>
                                        <td :class="order.status_id === 1 ? 'text-danger' : 'text-success'">{{ order.status.name}}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
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
import AppLayout from '../../../Layouts/AppLayout'
export default{
    components: {
        AppLayout
    },
    props: {
        cartData: Object,
        orders: Array
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
