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
                                                Заказ
                                            </h6>
                                            <h1 class="header-title">
                                                Просмотр
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="mb-4">

                                <div class="card col">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <h6 class="text-uppercase text-muted mb-2">
                                                            Клиент
                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <!-- Heading -->
                                                        <span class="h2 mb-0">{{ this.order.client.name }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <h6 class="text-uppercase text-muted mb-2">
                                                            Электронная почта
                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <!-- Heading -->
                                                        <span class="h2 mb-0">{{ this.order.client.email }}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <h6 class="text-uppercase text-muted mb-2">
                                                            Телефон
                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                        <!-- Heading -->
                                                        <span class="h2 mb-0">{{ this.order.client.phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <h6 class="text-uppercase text-muted mb-2">Итог
                                                </h6>
                                                <!-- Heading -->
                                                <span class="h2 mb-3 d-block">{{order.total}}</span>
                                                <h6 class="text-uppercase text-muted mb-2">Кешбэк</h6>
                                                <span class="h2 mb-3 d-block">{{order.cashback}}</span>
                                                <h6 class="text-uppercase text-muted mb-2">С учётом кешбэка</h6>
                                                <span class="h2 mb-3 d-block">{{order.total - order.cashback}}</span>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>


                                <div class="card" v-for="orderColumn in [
                {name: 'Статус', value: this.order.status.name},
                {name: 'Количество продуктов', value: this.products.length}]" :key="orderColumn.name">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <h6 class="text-uppercase text-muted mb-2">
                                                    {{ orderColumn.name }}
                                                </h6>
                                                <!-- Heading -->
                                                <span class="h2 mb-0">{{ orderColumn.value }}</span>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>


                                <div class="card col">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Title -->
                                                <h6 class="text-uppercase text-muted mb-2">
                                                    Продукты
                                                </h6>
                                                <!-- Heading -->

                                                <vue-good-table
                                                    :columns="productsTable.columns"
                                                    :rows="productsTable.rows">
                                                    <div slot="emptystate">
                                                        Продукт не выбран
                                                    </div>
                                                    <template slot="table-row" slot-scope="props">
                                                        <span v-if="props.column.field == 'image'">
                                                            <img @click="modalImg = '/storage/'+props.row.image[0].fileName" class="rounded" height="100" width="100" style="object-fit: cover; overflow:hidden;"
                                                                :src="props.row.image ? '/storage/'+props.row.image[0].fileName : ''"
                                                                data-bs-toggle="modal" data-bs-target="#imgModal">
                                                        </span>
                                                    </template>
                                                </vue-good-table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                {{this.order.products}}-->
                                <a :href="route('orders.index')" class="btn btn-block btn-link btn-primary text-white">
                                    Назад
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="width: 100%; max-width: 1000px;">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-end">
                        <span style="cursor:pointer;" data-bs-dismiss="modal" aria-label="Close">Закрыть</span>
                    </div>
                    <div class="modal-body">
                        <img :src="modalImg" alt="" width="100%">
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
        DashboardLayout,
    },
    props: {
        order: Object,
        products: Array,
    },
    name: 'my-component',
    data() {
        return {
            modalImg:'',
            productsTable: {
                columns: [
                    {
                        label: 'Фото',
                        field: 'image',
                        sortable: false,
                    },
                    {
                        label: 'Имя',
                        field: 'name',
                        type: 'string',
                    },
                    {
                        label: 'Артикул',
                        field: 'articul',
                        type: 'number',
                    },
                    {
                        label: 'Артикул',
                        field: 'color.name',
                        type: 'string',
                    },
                    {
                        label: 'Количество',
                        field: 'pivot.product_qty',
                        type: 'number'
                    },
                ],
                rows: this.products,
            },
        };
    },
    mounted() {
    },
    methods: {}
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

