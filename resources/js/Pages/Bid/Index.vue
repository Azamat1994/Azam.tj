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
                                    Заявки
                                </h1></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col"><h4 class="card-header-title">
                                                Статусы
                                            </h4></div>
                                        </div>
                                    </div>


                                    <div
                                        data-list="{&quot;valueNames&quot;: [&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]}"
                                        class="table-responsive mb-0">
                                        <div>
                                            <vue-good-table
                                                :columns="columns"
                                                :rows="rows"
                                                :fixed-header="false"
                                                :line-numbers="true"
                                                :filterDropdownItems="filterDropdownItems"
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
                                                    <span v-if="props.column.field == 'image'">
                                                        <img @click="modalImg = '/storage/'+props.row.image" class="rounded" height="50" width="50"
                                                             :src="props.row.image ? '/storage/'+props.row.image : ''"
                                                             data-bs-toggle="modal" data-bs-target="#imgModal">
                                                    </span>
                                                    <span v-else-if="props.column.field == 'actions'">
                                                     <!-- <a :href="'/dashboard/partners/'+props.row.id+'/edit'" title="Редактировать" class="badge badge-warning">
                                                         <i class="fe fe-edit"></i>
                                                     </a>

                                                     <button title="Удалить" class="btn badge badge-danger" @click="delete_record(props.row.id)">
                                                            <i class="fe fe-trash"></i>
                                                    </button> -->
                                                    </span>
                                                    <span v-else-if="props.column.field == 'type'">
                                                         <span class="badge badge-success" v-if="props.row.type==0">Ремонт от бренда “Азам”</span>
                                                         <span class="badge badge-primary" v-else-if="props.row.type==1">Ремонт обуви другого Бренда</span>
                                                         <span class="badge badge-danger" v-else-if="props.row.type==2">Партнёры</span>
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
        DashboardLayout
    },
    props: {
        bids: Array
    },
    data() {
        return {
            modalImg:'',
            filterDropdownItems: [
                { value: 'n', text: 'Inactive' },
                { value: 'y', text: 'Active' },
                { value: 'c', text: 'Check' }
            ],
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
                    label: 'Номер телефона',
                    field: 'phone',
                    type: 'string',
                },
                // {
                //     label: 'Город',
                //     field: 'city',
                //     type: 'string',
                // },
                {
                    label: 'Тип заявки',
                    field: 'type',
                    type: 'string',
                },
                {
                    label: 'Дата создания',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: "yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'",
                    dateOutputFormat: 'dd-MM-yyyy HH:mm',
                },
            ],
            rows: this.bids
        };
    },
};


</script>
