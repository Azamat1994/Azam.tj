<template>
    <dashboard-layout>


        <div class="main-content">
            <div class="header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-end">
                            <div class="col">
                                <h6 class="header-pretitle">
                                    Админ панель
                                </h6>
                                <h1 class="header-title">
                                    Службы доставки
                                </h1></div>
                        </div>
                    </div>
                </div>
            </div>


            <!--            {{ deliveries }}-->


            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col"><h4 class="card-header-title">
                                                Службы доставки
                                            </h4></div>
                                            <div v-if="$userPermissions.includes('deliveries-create')==true"
                                                 class="col-auto"><a
                                                :href="route('deliveries.create')"
                                                class="btn btn-primary lift">
                                                Добавить
                                            </a></div>
                                        </div>
                                    </div>


                                    <div
                                        data-list="{&quot;valueNames&quot;: [&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]}"
                                        class="table-responsive mb-0">
                                        <div v-if="$userPermissions.includes('deliveries-read')==true">
                                            <vue-good-table
                                                :columns="columns"
                                                :rows="rows"
                                                :fixed-header="false"
                                                :line-numbers="true"
                                                :search-options="{
                                                    enabled: true,
                                                    skipDiacritics: true,
                                                    placeholder: 'Поиск',
                                                }"
                                                :pagination-options="{
                                                    enabled: true,
                                                    mode: 'pages',
                                                    perPage: 10,
                                                    perPageDropdown: [10, 20, 30, 50],
                                                    position: 'bottom',
                                                    dropdownAllowAll: true,
                                                    setCurrentPage: 1,
                                                    nextLabel: 'след',
                                                    prevLabel: 'пред',
                                                    rowsPerPageLabel: 'Строк на странице',
                                                    ofLabel: 'из',
                                                    pageLabel: 'страница', // for 'pages' mode
                                                    allLabel: 'Все',
                                                  }"
                                            >
                                                <div slot="emptystate">
                                                    Нет записей
                                                </div>
                                                <template slot="table-row" slot-scope="props">
                                                    <span v-if="props.column.field == 'actions'">

                                                     <a v-if="$userPermissions.includes('deliveries-update')==true"
                                                        :href="'/dashboard/deliveries/'+props.row.id+'/edit'"
                                                        title="Редактировать" class="badge badge-warning">
                                                         <i class="fe fe-edit"></i>
                                                     </a>

                                                     <button v-if="$userPermissions.includes('deliveries-delete')==true"
                                                             title="Удалить" class="btn badge badge-danger"
                                                             @click="delete_record(props.row.id)">
                                                            <i class="fe fe-trash"></i>
                                                    </button>
                                                    </span>
                                                    <span v-else-if="props.column.field == 'is_active'">
                                                         <span class="badge badge-danger" v-if="props.row.is_active==0">не активен</span>
                                                         <span class="badge badge-success"
                                                               v-else-if="props.row.is_active==1">активен</span>
                                                    </span>
                                                </template>

                                            </vue-good-table>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
        deliveries: Array
    },

    name: 'my-component',

    data() {
        return {
            columns: [
                {
                    label: 'Название',
                    field: 'name',
                    type: 'string',
                },
                {
                    label: 'Дата создания',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: "yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'",
                    dateOutputFormat: 'dd-MM-yyyy HH:mm',
                },
                {
                    label: 'Статус',
                    field: 'is_active',
                    type: 'boolean',
                },
                {
                    label: 'Действия',
                    field: 'actions',
                    sortable: false,
                }
            ],
            rows: this.deliveries
        };
    },
    methods: {
        delete_record: function (id) {

            this.$swal({
                title: 'Вы уверены?',
                text: "Город, а также все связанные данные будут удалены безвозвратно!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: "Да",
                        value: true,
                        visible: true,
                        className: "isConfirm",
                        closeModal: true
                    },
                    cancel: {
                        text: "Нет",
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    }
                }
            }).then((isConfirm) => {
                if (isConfirm === true) {
                    axios.delete(route("deliveries.destroy", id))
                        .then(
                            (response) => {
                                const index = this.deliveries.map(delivery => delivery.id).indexOf(id);
                                this.deliveries.splice(index, 1);
                                this.$swal({title: response.data.message, timer: 3000})
                            },
                            (error) => {
                                console.log(error)
                            }
                        )
                }
            });


        }
    }

};


</script>
