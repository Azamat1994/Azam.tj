<template>
    <dashboard-layout>


        <div class="main-content">
            <div class="card">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10 col-xl-8">
                            <div class="header mt-md-5">
                                <div class="header-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="header-pretitle">
                                                Пользователи
                                            </h6>
                                            <h1 class="header-title">
                                                Редактирование
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">

                                <div class="form-group"><label>Имя <span class="text-danger">*</span></label> <input
                                    type="text" class="form-control" v-model="user.name">
                                </div>

                                <div class="form-group"><label>Номер телефона <span
                                    class="text-danger">*</span></label> <input
                                    type="email" class="form-control" v-model="user.phone">
                                </div>

                                <div class="form-group"><label>Электронная почта <span
                                    class="text-danger">*</span></label> <input
                                    type="email" class="form-control" v-model="user.email">
                                </div>

                                <div class="form-group">
                                    <label>Город <span class="text-danger">*</span></label>
                                    <select v-model="user.city_id" class="custom-select">
                                        <option disabled selected value>Выберите город</option>
                                        <option :value="city.id" v-for="city in cities" v-bind:key="city.id">
                                            {{ city.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group"><label>Адрес <span
                                    class="text-danger">*</span></label> <input
                                    type="email" class="form-control" v-model="user.address">
                                </div>

                                <div class="custom-control custom-switch mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                           v-model="changePassword">
                                    <label class="custom-control-label" for="customSwitch1">Изменить пароль</label>
                                </div>

                                <div class="form-group" v-if="this.changePassword">
                                    <label>Пароль <span class="text-danger">* </span></label>
                                    <input type="password" class="form-control" v-model="password">
                                </div>


                                <div class="form-group" v-if="this.changePassword">
                                    <label>Повторите пароль <span class="text-danger">*</span>
                                        <span class="text-danger"
                                              v-if="passwordConfirm!='' && passwordConfirm!=password">(пароли не совпадают)</span>
                                        <span class="text-success"
                                              v-if="passwordConfirm!='' && passwordConfirm==password">(пароли совпадают)</span>
                                    </label>
                                    <input type="password" class="form-control" v-model="passwordConfirm">
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <h1>Процент бонуса</h1>
                                    </div>
                                    <div class="col-12">
                                        <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col" class="text-secondary">От</th>
                                        <th scope="col" class="text-secondary">До</th>
                                        <th scope="col" class="text-secondary">%</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="fs-5" v-for="(percent, index) in bonusPercent" :key="index">
                                        <td>{{bonusTotalSum[index][0]}}</td>
                                        <td>{{bonusTotalSum[index][1]}}</td>
                                        <td><input v-model.number="bonusPercent[index]" type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <h1>История заказов</h1>
                                    </div>
                                    <div class="col-12">
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

                                


                                <button type="button" class="btn btn-block btn-primary" @click="update_record(user.id)">
                                    Сохранить
                                </button>

                                <a :href="route('users.index')" class="btn btn-block btn-link text-muted">
                                    Отмена
                                </a>
<!--                                {{changePassword}}-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </dashboard-layout>
</template>

<script>
import DashboardLayout from './../../Layouts/DashboardLayout'
import axios from "axios";

export default {
    components: {
        DashboardLayout
    },

    props: {
        user: Object,
        cities: Array,
        orders: Array,
    },

    name: 'my-component',

    data() {
        return {
            changePassword: false,
            password: '',
            passwordConfirm: '',
            bonusTotalSum:[
                [0,1000],
                [1000,2000],
                [2000,3000],
                [3000,10000],
                [10000,20000],
            ],
            bonusPercent:[],
        };
    },
    mounted(){
        this.bonusPercent = JSON.parse(this.user.bonus)
    },
    methods: {
        update_record: function (id) {
            if (confirm('Вы уверены что хотите изменить запись?'))
                if(this.changePassword) {
                    this.user.password = this.password
                }
                this.user.bonus = JSON.stringify(this.bonusPercent)
                console.log(this.user);
                axios.put(route("users.update", id), this.user)
                    .then(
                        (response) => {
                            this.$swal({title: response.data.message, timer: 3000})
                            this.$inertia.visit(route('users.index'));
                        },
                        (error) => {
                            this.$swal('Ошибка', 'Введите корректные данные', 'error')
                        }
                    )

        }
    }

};


</script>
