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
                            <h1 class="mb-4">Бонусы</h1>
                            <div class="az-bonus">
                                <h3>Кешбэк: {{user.cashback}} TJS </h3>
                            </div>
                            <div class="row">
                                <div class="col col-lg-2">
                                    <nav class="text-danger">Кешбэк {{bonusPercent[level-1]}} %</nav>
                                    <nav class="text-dark mt-2">Уровень {{level}}</nav>
                                </div>
                                <div class="col-auto col-lg-8">
                                    <hr>
                                </div>
                                <div class="col-auto col-lg-2 text-end">
                                    <nav class="text-danger">Кешбэк {{bonusPercent[level]}} %</nav>
                                    <nav class="text-secondary o-25 mt-2">Уровень {{level == 5 ? '5' : level + 1}}</nav>
                                </div>
                                <div class="col-12  my-3">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" :style="{width: percent + '%'}" :aria-valuenow="percent" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col col-lg-2">
                                    <nav class="text-dark">{{level == 1 ? '0' : level == 2 ? '1000' : level == 3 ? '2000' : level == 4 ? '3000' : '10000'}} TJS</nav>
                                </div>
                                <div class="col col-lg-8 text-center">
                                    <nav class="text-dark">{{level == 1 ? '500' : level == 2 ? '1500' : level == 3 ? '2500' : level == 4 ? '6500' : ''}} TJS</nav>
                                </div>
                                <div class="col col-lg-2 text-end">
                                    <nav class="text-secondary">{{level == 1 ? '1000' : level == 2 ? '2000' : level == 3 ? '3000' : level == 4 ? '10000' : '∞'}} TJS</nav>
                                </div>
                                <h3 class="mt-5">Как можно получить больше Кешбэка?</h3>
                                <p>Бонусы на покупку продукции для клиентов, которые покупали продукт на сумму:</p>
                                <div class="col-auto col-lg-3">
                                    <nav :class="level == 1 ? 'text-danger' : 'text-secondary'">Первый уровень</nav>
                                    <nav :class="level == 2 ? 'text-danger' : 'text-secondary'">Второй уровень</nav>
                                    <nav :class="level == 3 ? 'text-danger' : 'text-secondary'">Третий уровень</nav>
                                    <nav :class="level == 4 ? 'text-danger' : 'text-secondary'">Четвертый уровень</nav>
                                    <nav :class="level == 5 ? 'text-danger' : 'text-secondary'">Пятый уровень</nav>
                                </div>
                                <div class="col-auto">
                                    <nav :class="level == 1 ? 'text-danger' : 'text-secondary'">до 1000 – {{bonusPercent[0]}}% Бонусов</nav>
                                    <nav :class="level == 2 ? 'text-danger' : 'text-secondary'">от 1000 до 2000 – {{bonusPercent[1]}}% Бонусов</nav>
                                    <nav :class="level == 3 ? 'text-danger' : 'text-secondary'">от 2000 до 3000 - {{bonusPercent[2]}}% Бонусов</nav>
                                    <nav :class="level == 4 ? 'text-danger' : 'text-secondary'">от 3000 до 10000 – {{bonusPercent[3]}}% Бонусов</nav>
                                    <nav :class="level == 5 ? 'text-danger' : 'text-secondary'">от 10000 до 20000 – {{bonusPercent[4]}}% Бонусов</nav>
                                </div>
                                <div class="col-auto col-lg-3">
                                    <nav :class="level == 1 ? 'text-danger' : 'text-secondary'">{{level == 1 ? 'Активирован' : 'Недоступен'}}</nav>
                                    <nav :class="level == 2 ? 'text-danger' : 'text-secondary'">{{level == 2 ? 'Активирован' : 'Недоступен'}}</nav>
                                    <nav :class="level == 3 ? 'text-danger' : 'text-secondary'">{{level == 3 ? 'Активирован' : 'Недоступен'}}</nav>
                                    <nav :class="level == 4 ? 'text-danger' : 'text-secondary'">{{level == 4 ? 'Активирован' : 'Недоступен'}}</nav>
                                    <nav :class="level == 5 ? 'text-danger' : 'text-secondary'">{{level == 5 ? 'Активирован' : 'Недоступен'}}</nav>
                                </div>
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
<!--                    </div>-->
<!--                    <div class="col-lg-6">-->
<!--                        <nav class="fs-5 text-end">Cумма: <strong class="fs-4">{{ getSumm }} TJs</strong></nav>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="modal-footer border-0">-->
<!--              <a :href="route('checkout')" class="btn btn-danger rounded-0 w-100 fs-4">Купить</a>-->
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
        orders: Array,
        user: Object,
        ordersTotal: Object,
    },
    data() {
        return {
            cart: [],
            level: 0,
            percent: '',
            cartItemCount: 0,
            bonusPercent: [],
        }
    },
    mounted() {
        this.cart = this.cartData;
        this.bonusPercent = JSON.parse(this.user.bonus)
        // computing user level
        if (this.ordersTotal < 1000){
            this.level = 1;
            this.percent = this.ordersTotal / 10;
        }else if(this.ordersTotal < 2000){
            this.level = 2;
            this.percent = (this.ordersTotal - 1000) / 10;
        }else if(this.ordersTotal < 3000){
            this.level = 3;
            this.percent = (this.ordersTotal - 2000) / 10;
        }else if(this.ordersTotal < 10000){
            this.level = 4;
            this.percent = (this.ordersTotal - 3000) / 70;
        }else if(this.ordersTotal > 10000){
            this.level = 5;
            this.percent = 100;
        }
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
        //         .then(response => {
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
    // computed: {
    //     getSumm() {
    //         let pc = 0;
    //         for (const [key, value] of Object.entries(this.cart)) {
    //             pc += (value.price * value.quantity)
    //         }
    //         return pc
    //     }
    // }
}
</script>
