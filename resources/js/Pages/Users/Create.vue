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
                                                Добавление
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">

                                <div class="form-group"><label>Имя <span class="text-danger">*</span></label> <input
                                    type="text" class="form-control" v-model="user.name">
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

                                <div class="form-group">
                                    <label>Пароль <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" v-model="user.password">
                                </div>


                                <div class="form-group">
                                    <label>Повторите пароль <span class="text-danger">*</span>
                                        <span class="text-danger"
                                              v-if="passwordConfirm!='' && passwordConfirm!=user.password">(пароли не совпадают)</span>
                                        <span class="text-success"
                                              v-if="passwordConfirm!='' && passwordConfirm==user.password">(пароли совпадают)</span>
                                    </label>
                                    <input type="password" class="form-control" v-model="passwordConfirm">
                                </div>

                                <button type="button" class="btn btn-block btn-primary" @click="create_record(user.id)">
                                    Сохранить
                                </button>

                                <a :href="route('users.index')" class="btn btn-block btn-link text-muted">
                                    Отмена
                                </a>
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
        cities: Array,
    },

    name: 'my-component',

    data() {
        return {
            user: {},
            passwordConfirm: '',
        };
    },
    methods: {
        create_record: function (id) {
            axios.post(route("users.store", id), this.user)
                .then(
                    (response) => {
                        // console.log(response)
                        this.$swal({title: response.data.message, timer: 3000})
                        this.$inertia.visit('/dashboard/users');
                    },
                    (error) => {
                        this.$swal('Ошибка', 'Введите корректные данные', 'error')
                    }
                )

        }
    }

};


</script>
