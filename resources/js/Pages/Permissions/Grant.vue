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
                                                Разрешения
                                            </h6>
                                            <h1 class="header-title">
                                                Раздача прав пользователям
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <!--                            {{ grant }}-->
                            <form class="mb-4">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Пользователь <span
                                                class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <v-select
                                                placeholder="Выберите из списка"
                                                class="style-chooser"
                                                :options="users"
                                                :reduce="users => users.id"
                                                label="name"
                                                v-model="grant.user_id"><span
                                                slot="no-options">нет такого пользователя</span>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Разрешения <span class="text-danger">*</span></label>
                                            <multiselect v-model="grantPermissions"
                                                         :options="selected_permissions.options" :multiple="true"
                                                         :close-on-select="false" :clear-on-select="false"
                                                         :preserve-search="true" placeholder="Выберите разрешение"
                                                         label="display_name" track-by="name" :preselect-first="false">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                                        <span class="multiselect__single"
                                                              v-if="values.length &amp;&amp; !isOpen">Выбрано видов: {{
                                                                values.length
                                                            }}</span>
                                                </template>
                                            </multiselect>
                                            <br/>
                                            <table class="table table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Название</th>
                                                    <th scope="col">Метка</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(permission, index) in grant.permissions" :key="index">
                                                    <th scope="row">{{ index + 1 }}</th>
                                                    <td>{{ permission.name }}</td>
                                                    <td>{{ permission.display_name }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <button type="button" class="btn btn-block btn-primary"
                                        @click="grant_permissions()">
                                    Сохранить
                                </button>

                                <a :href="route('permissions.index')" class="btn btn-block btn-link text-muted">
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
            DashboardLayout,
        },

        props: {
            users: Array,
            permissions: Array,
        },

        name: 'my-component',

        data() {
            return {
                grantPermissions: [],
                grant: {
                    permissions: [],
                    user_id: '',
                },
                selected_permissions: {
                    options: this.permissions
                },
            };
        },
        watch: {
            grantPermissions: function (val) {
                this.grant.permissions = val
            }
        },
        methods: {
            grant_permissions: function (id) {
                // alert(this.grant.user_id)
                axios.post(route("users.grant", this.grant.user_id), this.grant)
                    .then(
                        (response) => {
                            console.log(response)
                            this.$swal({title: response.data.message, timer: 3000})
                            this.$inertia.visit('/dashboard/permissions');
                        },
                        (error) => {
                            console.log(error)
                            this.$swal('Ошибка', 'Введите корректные данные', 'error')
                        }
                    )

            }
        }

    };


</script>
<style>

    .style-chooser .vs__dropdown-toggle {
        width: 100%;
        height: calc(1.5em + 1rem + 2px);
        padding: 0.5rem 0.75rem;
        font-size: 0.9375rem;
        font-weight: 400;
        line-height: 1.5;
        color: #12263F;
        background-clip: padding-box;
        border: 1px solid #d2ddec;
        border-radius: 0.375rem;
        transition: border-color 0.15s;
        background: #FFFFFF;
        /*background-clip: padding-box;*/
        text-transform: lowercase;
        font-variant: small-caps;
    }

    .style-chooser .vs__search::placeholder {
        color: #666565;
        font-size: small;
    }
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .tree-selec-allow {
        margin-top: 7px;
    }
</style>


