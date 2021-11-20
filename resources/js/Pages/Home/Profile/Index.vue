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
                            <form class="az-profile-aside d-flex flex-column align-items-center">
                                <label for="avatar" class="text-center">
                                    <img :src="user.avatar ? '/storage/' + user.avatar : '/img/avatar.png'" alt="" class="rounded-circle" style="object-fit: cover" width="170" height="170">
                                    <input type="file" id="avatar" accept="image/*" class="d-none" @change="setAvatar">
                                </label>
                                <h1 class="text-lg-center my-4 fw-normal">{{ $page.props.user.name }}</h1>
                            </form>
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
                            <h1 class="mb-4">Профиль</h1>
                            <div class="az-profile">
                                <form @submit.prevent="save">
                                    <div class="form-floating mb-3">
                                        <input type="text" @input="validate" required v-model="user.name" class="form-control feedback-input fs-5" id="name" placeholder="Введите ваше ФИО">
                                        <label for="name">ФИО</label>
                                    </div>
                                    <div class="form-floating mb-3" v-if="!$page.props.user.email">
                                        <input type="text" @input="validate" :required="emailRequire" v-model="user.email" class="form-control feedback-input fs-5" id="email" placeholder="Введите email">
                                        <label for="">Введите email</label>
                                    </div>
                                    <div class="form-floating mb-3" v-if="!$page.props.user.phone">
                                        <input type="text" @input="validate" v-model="user.phone" class="form-control feedback-input fs-5" id="phone" placeholder="Введите номер телефона">
                                        <label for="">Введите номер телефона</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" @input="validate" v-model="user.password" class="form-control feedback-input fs-5" id="password" placeholder="Введите текущий пароль">
                                        <label for="">Введите текущий пароль</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" @input="validate" v-model="user.new_password" class="form-control feedback-input fs-5" id="new_password" placeholder="Введите новый пароль">
                                        <label for="">Введите новый пароль</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" @input="validate" v-model="user.confirm_password" class="form-control feedback-input fs-5" id="confirm_password" placeholder="Повторите пароль">
                                        <label for="">Повторите пароль</label>
                                    </div>
                                    <div class="form-group">
                                        <small v-for="(error, index) in errorList" :key="index" class="text-danger d-block">{{ error }}</small>
                                    </div>
                                    <button type="submit" class="btn btn-danger text-white px-5 rounded-0 my-5">Сохранить</button>
                                </form>
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
        cartData: Object
    },
    data() {
        return {
            cart: [],
            user: {
                name: this.$page.props.user.name,
                password: '',
                new_password: '',
                confirm_password: '',
                phone: '',
                email: '',
                avatar: this.$page.props.user.avatar
            },
            errorList: {
                passwordConfirm: "",
                passwordLength: "",
                emailValide: ''
            },
            emailRequire: false,
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
            save(){
                axios.post(route('profile.store'), this.user)
                .then(response=> {
                    this.$swal({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        icon: 'success',
                        title: response.data.message
                    })
                })
                .catch(error=> {
                    this.$swal({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: error.response.data.message
                    })
                })
            },
            validate(){
                this.errorList.passwordLength = !(this.user.password && this.user.new_password.length >= 8) ? "Пароль должен содержать более 8 символов" : ''
                this.errorList.passwordConfirm = !(this.user.password && this.user.new_password === this.user.confirm_password) ? "Пароль не совпадает" : ''
                this.emailRequire = /\S+@\S+\.\S+/.test(this.user.email) ? true : false
            },
        //     addToCart(id) {
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
        setAvatar() {
            if (event.target.files.length > 0) {
                let fd = new FormData()
                fd.append('avatar', event.target.files[0])
                axios.post(route('profile.avatar'), fd)
                .then(response=> {
                    this.user.avatar = response.data.fileName
                    // location.href = route('profile')
                })
            }
        }
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
