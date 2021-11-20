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
                                    Роли
                                </h1></div>
                        </div>
                    </div>
                </div>
            </div>


            <!--            {{ roles }}-->


            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col"><h4 class="card-header-title">
                                                Роли
                                            </h4></div>
                                            <div v-if="$userPermissions.includes('roles-create')==true"
                                                 class="col-auto"><a
                                                :href="route('roles.create')"
                                                class="btn btn-primary lift">
                                                Добавить
                                            </a></div>
                                        </div>
                                    </div>


                                    <div
                                        data-list="{&quot;valueNames&quot;: [&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]}"
                                        class="table-responsive mb-0">
                                        <div v-if="$userPermissions.includes('roles-read')==true">
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

                                                     <a v-if="$userPermissions.includes('roles-update')==true"
                                                        :href="'/dashboard/roles/'+props.row.id+'/edit'"
                                                        title="Редактировать" class="badge badge-warning">
                                                         <i class="fe fe-edit"></i>
                                                     </a>

                                                     <button v-if="$userPermissions.includes('roles-delete')==true"
                                                             title="Удалить" class="btn badge badge-danger"
                                                             @click="delete_record(props.row.id)">
                                                            <i class="fe fe-trash"></i>
                                                    </button>
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
        roles: Array
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
                    label: 'Метка',
                    field: 'display_name',
                    type: 'string',
                },
                {
                    label: 'Описание',
                    field: 'description',
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
                    label: 'Действия',
                    field: 'actions',
                    sortable: false,
                }
            ],
            rows: this.roles
        };
    },
    methods: {
        delete_record: function (id) {


            this.$swal({
                title: 'Вы уверены?',
                text: "Роль будет удален безвозвратно!",
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
                    axios.delete(route("roles.destroy", id))
                        .then(
                            (response) => {
                                const index = this.roles.map(role => role.id).indexOf(id);
                                this.roles.splice(index, 1);
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
