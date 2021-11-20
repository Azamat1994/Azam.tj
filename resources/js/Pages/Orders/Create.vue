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
                                                Заказы
                                            </h6>
                                            <h1 class="header-title">
                                                Добавление
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">
                                <div class="row mb-4">
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Клиент <span class="text-danger">*</span></label>
                                            <select v-model="order.client_id" class="custom-select">
                                                <option disabled selected value>Выберите клиента</option>
                                                <option :value="client.id" v-for="client in clients"
                                                        v-bind:key="client.id">{{ client.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Статус <span class="text-danger">*</span></label>
                                            <select v-model="order.status_id" class="custom-select">
                                                <option disabled selected value>Выберите статус</option>
                                                <option :value="status.id" v-for="status in statuses"
                                                        v-bind:key="status.id">{{ status.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4"><label>Город <span class="text-danger">*</span></label>
                                        <input
                                            type="text" class="form-control"
                                            v-model="order.city">
                                    </div>
                                    <div class="col-12 col-lg-4"><label>Адрес <span class="text-danger">*</span></label>
                                        <input
                                            type="text" class="form-control"
                                            v-model="order.address">
                                    </div>
                                    <div class="col-12 col-lg-4"><label>Телефон <span class="text-danger">*</span></label>
                                        <input
                                            type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                             v-model="order.phone">
                                    </div>
                                    <div class="col-12 col-lg-4"><label>Итог <span class="text-danger">*</span></label>
                                        <input
                                            type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            v-model.number="order.total">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-block btn-primary"
                                        @click="create_record(order.id)">
                                    Сохранить
                                </button>

                                <a :href="route('orders.index')" class="btn btn-block btn-link text-muted">
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
        clients: Array,
        statuses: Array,
    },

    name: 'my-component',

    data() {
        return {
            order: {
                client_id: 0,
                status_id: 0,
                total: 0,
                city: '',
                address:'',
                phone: '',
            }
        };
    },
    methods: {
        create_record: function (id) {
            axios.post(route("orders.store", id), this.order)
                .then(
                    (response) => {
                        this.$swal({title: response.data.message,timer: 3000})
                        this.$inertia.visit('/dashboard/orders');
                    },
                    (error) => {
                        this.$swal('Ошибка', 'Введите корректные данные', 'error')
                    }
                )

        }
    }

};


</script>
