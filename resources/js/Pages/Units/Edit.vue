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
                                                Единицы
                                            </h6>
                                            <h1 class="header-title">
                                                Редактирование
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">

                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group"><label>Название <span class="text-danger">*</span></label> <input
                                            type="text" class="form-control" v-model="unit.name">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group float-right">
                                            <label for="validation">Активен</label>
                                            <div class="input-group" style="cursor: pointer">
                                                <div class="input-group-prepend">
                                                    <span @click="unit.is_active=1" :class="`input-group-text ${ unit.is_active ? 'bg-primary text-white' : '' }`" id="popular">Да</span>
                                                </div>
                                                <div class="input-group-append">
                                                    <span @click="unit.is_active=0" :class="`input-group-text ${ !unit.is_active ? 'bg-primary text-white' : '' }`" id="not_popular">Нет</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button type="button" class="btn btn-block btn-primary" @click="update_record(unit.id)">
                                    Сохранить
                                </button>

                                <a :href="route('units.index')" class="btn btn-block btn-link text-muted">
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
        unit: Object
    },

    name: 'my-component',

    data() {
        return {};
    },
    methods: {
        update_record: function (id) {
            if (confirm('Вы уверены что хотите изменить запись?'))
                axios.put(route("units.update", id), this.unit)
                    .then(
                        (response) => {
                            this.$swal({title: response.data.message,timer: 3000})
                            this.$inertia.visit(route('units.index'));
                        },
                        (error) => {
                            this.$swal('Ошибка', 'Введите корректные данные', 'error')
                        }
                    )

        }
    }

};


</script>
