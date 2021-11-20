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
                                                Категории
                                            </h6>
                                            <h1 class="header-title">
                                                Редактирование
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">

                                <div class="form-group"><label>Название <span
                                    class="text-danger">*</span></label> <input
                                    type="text" class="form-control" v-model="category.name">
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Категория <span class="text-danger">*</span></label>
                                            <select v-model="category.parent_id" class="custom-select">
                                                <option disabled selected value>Выберите категорию</option>
                                                <option :value="category.id" v-for="category in categories"
                                                        v-bind:key="category.id">{{ category.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2 pl-0">
                                        <div class="form-group float-right">
                                            <label for="validation">Активно</label>
                                            <div class="input-group" style="cursor: pointer">
                                                <div class="input-group-prepend">
                                                    <span @click="category.is_active=1"
                                                          :class="`input-group-text ${ category.is_active ? 'bg-primary text-white' : '' }`"
                                                          id="popular">Да</span>
                                                </div>
                                                <div class="input-group-append">
                                                    <span @click="category.is_active=0"
                                                          :class="`input-group-text ${ !category.is_active ? 'bg-primary text-white' : '' }`"
                                                          id="not_popular">Нет</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <button type="button" class="btn btn-block btn-primary" @click="update_record(category.id)">
                                    Сохранить
                                </button>

                                <a :href="route('categories.index')" class="btn btn-block btn-link text-muted">
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
        category: Object,
        categories: Array
    },

    name: 'my-component',

    data() {
        return {};
    },
    methods: {
        update_record: function (id) {
            if (confirm('Вы уверены что хотите изменить запись?'))
                axios.put(route("categories.update", id), this.category)
                    .then(
                        (response) => {
                            this.$swal({title: response.data.message,timer: 3000})
                            this.$inertia.visit(route('categories.index'));
                        },
                        (error) => {
                            this.$swal('Ошибка', 'Введите корректные данные', 'error')
                        }
                    )

        }
    }

};


</script>
