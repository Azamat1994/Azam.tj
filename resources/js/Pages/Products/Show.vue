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
                                                Продукт
                                            </h6>
                                            <h1 class="header-title">
                                                Просмотр
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="mb-4">


                                <!--                                <div class="card" v-for="productColumn in [{name: 'Артикул', value: this.product.articul},-->
                                <!--                {name: 'Название', value: this.product.name},-->
                                <!--                {name: 'Размер', value: this.product.size},-->
                                <!--                {name: 'Ширина', value: this.product.width},-->
                                <!--                {name: 'Обхват', value: this.product.girth},-->
                                <!--                {name: 'Количество', value: this.product.quantity},-->
                                <!--                {name: 'Категория', value: this.product.category.name},-->
                                <!--                {name: 'Себестоимость', value: this.product.cost},-->
                                <!--                {name: 'Наценка', value: this.product.markup},-->
                                <!--                {name: 'Цена', value: this.product.price}]">-->
                                <!--                                    <div class="card-body">-->
                                <!--                                        <div class="row align-items-center">-->
                                <!--                                            <div class="col">-->
                                <!--                                                &lt;!&ndash; Title &ndash;&gt;-->
                                <!--                                                <h6 class="text-uppercase text-muted mb-2">-->
                                <!--                                                    {{ productColumn.name }}-->
                                <!--                                                </h6>-->
                                <!--                                                &lt;!&ndash; Heading &ndash;&gt;-->
                                <!--                                                <span class="h2 mb-0">{{ productColumn.value }}</span>-->
                                <!--                                            </div>-->
                                <!--                                        </div> &lt;!&ndash; / .row &ndash;&gt;-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <div class="row">
                                </div>

                                <div class="row justify-content-between">
                                    <div class="card col-10">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Название
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.name }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img class="rounded" width="100" :src="'/storage/'+product.image[0].fileName">
                                    </div>

                                </div>
                                <div class="row justify-content-between">
                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Артикул
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.articul }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>

                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Размер
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.size }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="row justify-content-between">-->
<!--                                    <div class="card col-5">-->
<!--                                        <div class="card-body">-->
<!--                                            <div class="row align-items-center">-->
<!--                                                <div class="col">-->
<!--                                                    &lt;!&ndash; Title &ndash;&gt;-->
<!--                                                    <h6 class="text-uppercase text-muted mb-2">-->
<!--                                                        Ширина-->
<!--                                                    </h6>-->
<!--                                                    &lt;!&ndash; Heading &ndash;&gt;-->
<!--                                                    <span class="h2 mb-0">{{  product.width }}</span>-->
<!--                                                </div>-->
<!--                                            </div> &lt;!&ndash; / .row &ndash;&gt;-->
<!--                                        </div>-->
<!--                                    </div>-->

<!--                                    <div class="card col-5">-->
<!--                                        <div class="card-body">-->
<!--                                            <div class="row align-items-center">-->
<!--                                                <div class="col">-->
<!--                                                    &lt;!&ndash; Title &ndash;&gt;-->
<!--                                                    <h6 class="text-uppercase text-muted mb-2">-->
<!--                                                        Обхват-->
<!--                                                    </h6>-->
<!--                                                    &lt;!&ndash; Heading &ndash;&gt;-->
<!--                                                    <span class="h2 mb-0">{{  product.girth }}</span>-->
<!--                                                </div>-->
<!--                                            </div> &lt;!&ndash; / .row &ndash;&gt;-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <div class="row justify-content-between">
                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Категория
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.category.name }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>

                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Количество
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.quantity }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Себестоимость
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.cost }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>

                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Наценка
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.markup }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>
                                </div>


                                <div class="row justify-content-between">
                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Цена
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.price }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>

                                    <div class="card col-5">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <!-- Title -->
                                                    <h6 class="text-uppercase text-muted mb-2">
                                                        Статус
                                                    </h6>
                                                    <!-- Heading -->
                                                    <span class="h2 mb-0">{{  product.is_active == '0' ? 'активен' : 'не активен' }}</span>
                                                </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card col">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Title -->
                                                <h6 class="text-uppercase text-muted mb-2">
                                                    Сырьё
                                                </h6>
                                                <!-- Heading -->

                                                <vue-good-table
                                                    :columns="crudes.columns"
                                                    :rows="crudes.rows">
                                                    <div slot="emptystate">
                                                        Сырьё не выбрано
                                                    </div>
                                                    <template slot="table-row" slot-scope="props">
                                                    <span v-if="props.column.field == 'pivot.crude_qty'">
                                                        {{props.row.pivot.crude_qty}}
<!--                                                        {{props.row.pivot.crude_qty+' '+ this.units[1].find(x => x.id === props.row.unit_id)}}-->
                                                    </span>
                                                    </template>

                                                </vue-good-table>

                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--{{product}}-->
                                <a :href="route('products.index')" class="btn btn-block btn-link text-muted">
                                    Назад
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
import vue2Dropzone from 'vue2-dropzone'

import axios from "axios";

export default {
    components: {
        DashboardLayout,
        vueDropzone: vue2Dropzone
    },
    props: {
        product: Object,
        units: Array,
    },
    name: 'my-component',
    data() {
        return {
            crudes: {
                columns: [
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
                        label: 'Количество',
                        field: 'pivot.crude_qty',
                        type: 'number'
                    },
                    // {
                    //     label: 'Ед. измерения',
                    //     field: 'unit_id',
                    //     type: 'number'
                    // },
                ],
                rows: this.product.crudes,
            },
        };
    },
    mounted() {
    },
    methods: {
    }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

