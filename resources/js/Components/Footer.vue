<template>
    <section id="footer" class="bg-dark">
        <footer class="pt-4 mt-md-5 pt-md-5 container text-light">
            <div class="row pb-4">
                <div class="col-12 col-md">
                    <h5 class="mb-5">О Бренде</h5>
                    <p class="lh-lg">
                        Наша продукция изготавливается в Таджикистане из высококачественной натуральной кожи и является абсолютно безопасной с экологической точки зрения.
                    </p>
                    
                    <nav class="mt-3">
                        <h5>Рабочие часы</h5>
                        <p>Без выходных<br>С 9:00 до 18:00</p>
                    </nav>
                </div>
                <div class="col-6 col-md">
                    <h5 class="mb-5">Помощь</h5>
                    <ul class="list-unstyled lh-lg text-small">
                        <li><a class="link-light text-decoration-none" :href="route('history')">Статус заказа</a></li>
                        <li><a class="link-light text-decoration-none" :href="route('help')">Как оформить заказ?</a></li>
                        <li><a class="link-light text-decoration-none" :href="route('delivery')">Доставка и оплата</a></li>
                        <li><a class="link-light text-decoration-none" :href="route('return')">Гарантия и возврат</a></li>
                        <li><a class="link-light text-decoration-none" :href="route('sizeTable')">Таблица размеров</a></li>
                        <li><a class="link-light text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#complaint">Книга жалоб</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5 class="mb-5">Информация</h5>
                    <ul class="list-unstyled lh-lg text-small">
                        <li><a class="link-light text-decoration-none" :href="route('about')">О бренде</a></li>
                        <li><a class="link-light text-decoration-none" :href="route('mass-media')">Новости</a></li>
                        <li><a class="link-light text-decoration-none" :href="route('contacts')">Контакты</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5 class="mb-5">Мой аккаунт</h5>
                    <ul class="list-unstyled lh-lg text-small">
                        <li><a class="link-light text-decoration-none" :href="route('profile')">Профиль</a></li>
                        <li><a class="link-light text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#cart">Корзина</a></li>
                    </ul>
                    <div class="social">
                        <a href="https://www.facebook.com/www.azam.tj/">
                            <svg class="social-icon" width="39" height="42" viewBox="0 0 39 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.84375" width="38" height="40.3135" rx="19" stroke="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5507 28.9445V20.999H16V18.2608H17.5507V16.6168C17.5507 14.383 18.4264 13.0547 20.9142 13.0547H22.9853V15.7932H21.6907C20.7223 15.7932 20.6582 16.1758 20.6582 16.89L20.6547 18.2605H23L22.7256 20.9987H20.6547V28.9445H17.5507Z" fill="white"/>
                            </svg>
                        </a>
                        <a href="https://instagram.com/azam.company">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 0C9.40215 0 0 9.40215 0 21C0 32.5979 9.40215 42 21 42C32.5979 42 42 32.5979 42 21C41.987 9.40762 32.5924 0.0129883 21 0ZM21 40.6C10.1753 40.6 1.4 31.8247 1.4 21C1.4 10.1753 10.1753 1.4 21 1.4C31.8247 1.4 40.6 10.1753 40.6 21C40.5877 31.8196 31.8196 40.5877 21 40.6Z" fill="white"/>
                                <path d="M28.2222 11H13.7778C12.2443 11.0019 11.0019 12.2443 11 13.7778V28.2222C11.0019 29.7557 12.2443 30.9981 13.7778 31H28.2222C29.7557 30.9981 30.9981 29.7557 31 28.2222V13.7778C30.9981 12.2443 29.7557 11.0019 28.2222 11ZM29.8889 28.2222C29.8889 29.1426 29.1426 29.8889 28.2222 29.8889H13.7778C12.8574 29.8889 12.1111 29.1426 12.1111 28.2222V13.7778C12.1111 12.8574 12.8574 12.1111 13.7778 12.1111H28.2222C29.1426 12.1111 29.8889 12.8574 29.8889 13.7778V28.2222Z" fill="white"/>
                                <path d="M21 15C17.6862 15 15 17.6862 15 21C15 24.3138 17.6862 27 21 27C24.3138 27 27 24.3138 27 21C26.9965 17.6877 24.3123 15.0035 21 15ZM21 25.8C18.3489 25.8 16.2 23.6511 16.2 21C16.2 18.3489 18.3489 16.2 21 16.2C23.6511 16.2 25.8 18.3489 25.8 21C25.7971 23.6496 23.6496 25.7971 21 25.8Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3636 12C12.6105 12 12 12.6105 12 13.3636V28.6364C12 29.3895 12.6105 30 13.3636 30H28.6364C29.3895 30 30 29.3895 30 28.6364V13.3636C30 12.6105 29.3895 12 28.6364 12H13.3636ZM21.0341 26.1136C23.8771 26.1136 26.1818 23.8089 26.1818 20.9659C26.1818 18.1229 23.8771 15.8182 21.0341 15.8182C18.1911 15.8182 15.8864 18.1229 15.8864 20.9659C15.8864 23.8089 18.1911 26.1136 21.0341 26.1136ZM25.3636 15C25.3636 14.0963 26.0963 13.3636 27 13.3636C27.9037 13.3636 28.6364 14.0963 28.6364 15C28.6364 15.9037 27.9037 16.6364 27 16.6364C26.0963 16.6364 25.3636 15.9037 25.3636 15Z" fill="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
                    
            </div>
        </footer>
        <div class="modal fade" id="complaint" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="width: 100%; max-width: 600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Книга жалоб</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="complaintFormClose"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="plaintiff" class="form-label">Имя<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="complaint.name" placeholder="Имя">
                        </div>
                        <div class="mb-3">
                            <label for="complaintEmail" class="form-label">Адрес электронной почты<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" v-model="complaint.email" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="complaintTextArea" class="form-label">Ваше сообщение</label>
                            <textarea class="form-control" v-model="complaint.text" rows="3"></textarea>
                        </div>
                        <button class="btn btn-danger text-light w-100" @click="send_complaint()">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
        <div  v-if="this.$page.url.indexOf('product') == -1"  class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl  modal-dialog-centered modal-fullscreen-sm-down">
                <div class="modal-content rounded-0 ">
                    <div class="modal-body">
                        <div class="orders">
                            <div v-for="(item, index) in cart" :key="index">
                                <div class="row" v-for="(size, indexSize) in item.size_quantity" :key="indexSize">
                                    <div class="col">
                                        <div class="d-flex">
                                            <img :src="'/storage/' + item.image[0]['fileName']" alt="" width="145px" height="145px"
                                                class="me-4">
                                            <nav class="d-flex flex-column">
                                                <h5>{{ item.name }}</h5>
                                                <p class="fs-4 fw-bold">{{ item.price }} TJS</p>
                                                <span>Размер: {{size.size}}</span>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col">
                                    <div
                                        class="d-flex align-content-between flex-column justify-content-between h-100 my-3 my-lg-0">
                                        <div class="d-flex align-items-lg-center justify-content-between">
                                            <span>Количество</span>
                                            <span>Цена</span>
                                            <span class="text-muted cursor-pointer" @click="removeCart({clear: true})">Очистить корзину</span>
                                        </div>
                                        <div class="d-flex align-items-lg-center justify-content-between">
                                            <div class="az-countable d-flex">
                                                <button type="button" @click="setQuantity('minus', item, indexSize)"
                                                        class="btn p-0 shadow-none" id="az-countable-minus" >
                                                    <img src="/images/icons/minus.svg" width="35" height="35">
                                                </button>
                                                <input type="number" disabled v-model="size.quantity"
                                                       class="form-control border-0 mx-3 outline-fs-0 text-center fs-2 shadow-none w-50 hide-arrows"
                                                       id="az-countable-count" min="1"  max="9999" value="1" step="1">
                                                <button type="button" @click="setQuantity('plus', item, indexSize)"
                                                        class="btn p-0 shadow-none" id="az-countable-plus" >
                                                    <img src="/images/icons/plus.svg" width="35" height="35">
                                                </button>
                                            </div>
                                            <h4 class="fw-bold">{{ item.price }} TJS</h4>
                                            <button type="button" @click="removeCart({productId: item.id, indexSize: indexSize})" class="btn">
                                                <img src="/images/icons/trash.svg" alt="" srcset="">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing <br>
                                    and typesetting text ever since the 1500s, </p> -->
                            </div>
                            <div class="col-lg-6">
                                <!-- <nav class="text-decoration-line-through text-end">1100 TJs</nav> -->
                                <nav class="fs-5 text-end">Cумма: <strong class="fs-4">{{ summ }} TJS</strong></nav>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <a :href="route('checkout')" class="btn btn-danger text-white  rounded-0 w-100 fs-4">Купить</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
export default {
    props: {
        cartData: Object,
    },
    data() {
        return {
            complaint: {
                name: '',
                email: '',
                text: ''
            },
            cart: [],
            cartProducts: [],
            cartItemCount: 0,
            summ: 0,
        };
    },
    mounted() {
        this.cart = this.cartData
        axios.post(route("getProductsQuantity"), Object.keys(this.cartData))
            .then(
                (response) => {
                    this.cartProducts = response.data.products
                },
                (error) => {
                    console.log(error)
                }
            )
        for (const [key, value] of Object.entries(this.cart)) {
            value.size_quantity.forEach(element => {
                this.summ += value.price * element.quantity
            });
        }
    },
    watch:{
        cart: function(){
                this.summ = 0;
                this.cartItemCount = 0;
                for (const [key, value] of Object.entries(this.cart)) {
                    value.size_quantity.forEach(element => {
                        this.summ += value.price * element.quantity
                    });
                }
        }
    },
    methods: {
        send_complaint: function () {
            // alert(JSON.stringify(this.complaint))
            axios.post(route("sendComplaint"), this.complaint)
                .then(
                    (response) => {
                        console.log(response)
                    },
                    (error) => {
                        console.log(error)
                    }
                )
            this.$swal({title: 'Спасибо! Ваше сообщение отправлено',timer: 3000})
            document.getElementById('complaintFormClose').click()
        },
        setQuantity(type, item, indexSize) {
            
            item.indexsize = indexSize
            if (type === 'minus' && item.size_quantity[indexSize].quantity > 1) {
                axios.post(route('setQuantity', type), item)
                    .then(response => {
                        this.cart = response.data.cart
                        this.pcount = this.cart[this.product.id].size_quantity[indexSize].quantity
                    })
            } else if (type === 'plus' && item) {
                
                axios.post(route('setQuantity', type), item)
                    .then(response => {
                        this.cart = response.data.cart
                        this.pcount = this.cart[this.product.id].size_quantity[indexSize].quantity
                    })
            }
        },
        removeCart(item) {
            axios.post(route('removeCart'), item)
                .then(response => {
                    console.log(response);
                    this.cart = response.data.cart
                
                })
        },
    },
    computed: {
        // getSumm() {
        //     this.cartItemCount = 0;
        //     let pc = 0;
        //     for (const [key, value] of Object.entries(this.cart)) {
        //         value.size_quantity.forEach(element => {
        //            pc += element.quantity * value.price;
        //            this.cartItemCount++;
        //         });
        //         // pc += (value.price * value.size_quantity.quantity)
        //     }
        //     return pc
        // }
    }
}
</script>
