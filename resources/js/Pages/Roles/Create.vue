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
                                                Роли
                                            </h6>
                                            <h1 class="header-title">
                                                Добавление
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">

                                <div class="form-group"><label>Название <span class="text-danger">*</span></label> <input
                                    type="text" class="form-control" v-model="role.name">
                                </div>

                                <div class="form-group"><label>Метка <span class="text-danger">*</span></label> <input
                                    type="text" class="form-control" v-model="role.display_name">
                                </div>

                                <div class="form-group"><label>Описание <span class="text-danger">*</span></label> <input
                                    type="text" class="form-control" v-model="role.description">
                                </div>


                                <button type="button" class="btn btn-block btn-primary" @click="create_record(role.id)">
                                    Сохранить
                                </button>

                                <a :href="route('roles.index')" class="btn btn-block btn-link text-muted">
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
    },

    name: 'my-component',

    data() {
        return {
            role: {}
        };
    },
    methods: {
        create_record: function (id) {
                axios.post(route("roles.store", id), this.role)
                    .then(
                        (response) => {
                            this.$swal({title: response.data.message,timer: 3000})
                            this.$inertia.visit('/dashboard/roles');
                        },
                        (error) => {
                          this.$swal('Ошибка', 'Введите корректные данные', 'error')
                        }
                    )

        }
    }

};


</script>
