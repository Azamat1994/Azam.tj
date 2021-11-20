<template>
  <dashboard-layout>
    <div class="main-content">
      <div class="header">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Админ панель</h6>
                <h1 class="header-title">Заказы</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--                        {{ orders }}-->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-6 col-xl">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col">
                        <h4 class="card-header-title">Заказы</h4>
                      </div>
                      <div
                        v-if="$userPermissions.includes('orders-read') == true"
                        class="col-auto"
                      >
                        <a
                          :href="route('orders.archive')"
                          class="btn btn-secondary lift"
                        >
                          Архив заказов
                        </a>
                      </div>
                      <div
                        v-if="
                          $userPermissions.includes('orders-create') == true
                        "
                        class="col-auto"
                      >
                        <a
                          :href="route('orders.create')"
                          class="btn btn-primary lift"
                        >
                          Добавить
                        </a>
                      </div>
                    </div>
                  </div>
                  <div
                    data-list='{"valueNames": ["goal-project", "goal-status", "goal-progress", "goal-date"]}'
                    class="table-responsive mb-0"
                  >
                    <div
                      v-if="$userPermissions.includes('orders-read') == true"
                    >
                      <vue-good-table
                        :columns="columns"
                        :rows="rows"
                        @on-page-change="onPageChange"
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
                          setCurrentPage: currentPage,
                          nextLabel: 'след',
                          prevLabel: 'пред',
                          rowsPerPageLabel: 'Строк на странице',
                          ofLabel: 'из',
                          pageLabel: 'страница', // for 'pages' mode
                          allLabel: 'Все',
                        }"
                      >
                        <div slot="emptystate">Нет записей</div>
                        <template slot="table-row" slot-scope="props">
                          <span v-if="props.column.field == 'actions'">
                            <a
                              v-if="
                                $userPermissions.includes('orders-update') ==
                                true
                              "
                              :href="'/dashboard/orders/' + props.row.id"
                              title="Просмотр"
                              class="badge badge-info"
                            >
                              <i class="fe fe-eye"></i>
                            </a>

                            <a
                              v-if="
                                $userPermissions.includes('orders-update') ==
                                true
                              "
                              :href="
                                '/dashboard/orders/' + props.row.id + '/edit'
                              "
                              title="Редактировать"
                              class="badge badge-warning"
                            >
                              <i class="fe fe-edit"></i>
                            </a>

                            <button
                              v-if="
                                $userPermissions.includes('orders-update') ==
                                  true && props.row.status.name != 'выполнен'
                              "
                              title="Завершить заказ"
                              class="btn badge badge-success"
                              @click="update_status(props.row.id)"
                            >
                              <i class="fe fe-check-square"></i>
                            </button>
                          </span>
                          <span v-else-if="props.column.field == 'products'">
                            {{
                              props.row.products
                                .map(function (item) {
                                  return item.articul;
                                })
                                .join(",")
                            }}
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
import DashboardLayout from "./../../Layouts/DashboardLayout";
import axios from "axios";

export default {
  components: {
    DashboardLayout,
  },

  props: {
    orders: Array,
  },

  name: "my-component",

  data() {
    return {
      currentPage: 1,
      columns: [
        {
          label: "№",
          field: "id",
          type: "string",
        },
        {
          label: "Клиент",
          field: "client.name",
          type: "string",
        },
        {
          label: "Товары",
          field: "products",
          type: "string",
        },
        {
          label: "Телефон",
          field: "phone",
          type: "string",
        },
        {
          label: "Город",
          field: "city",
          type: "string",
        },
        {
          label: "Адрес",
          field: "address",
          type: "string",
        },
        {
          label: "Сумма",
          field: "total",
          type: "number",
        },
        {
          label: "Кешбэк",
          field: "cashback",
          type: "number",
        },
        {
          label: "Дата",
          field: "created_at",
          type: "date",
          dateInputFormat: "yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'",
          dateOutputFormat: "dd-MM-yyyy HH:mm",
        },
        {
          label: "Статус",
          field: "status.name",
          type: "string",
          filterOptions: {
            // styleClass: 'class1', // class to be added to the parent th element
            enabled: true, // enable filter for this column
            placeholder: "все", // placeholder for filter input
            // filterValue: 'все', // initial populated value for this filter
            filterDropdownItems: [
              "не просмотрен",
              "просмотрен",
              "подтвержден",
              "готов",
              "у курьера",
              "доставлен",
            ], // dropdown (with selected values) instead of text input
            // filterFn: this.columnFilterFn, //custom filter function that
            trigger: "enter", //only trigger on enter not on keyup
          },
        },
        {
          label: "Действия",
          field: "actions",
          sortable: false,
        },
      ],
      rows: this.orders,
      modalData: {
        client: {
          name: "",
        },
        status: {
          name: "",
        },
      },
    };
  },
  mounted() {
    this.currentPage = Number(localStorage.getItem("currentPageOrder"));
    if(this.currentPage === 0){
      this.currentPage+=1
    }
  },
  methods: {
    onPageChange(params) {
      localStorage.setItem("currentPageOrder", params.currentPage);
      console.log(Number(localStorage.getItem("currentPageOrder")));
      this.currentPage = Number(localStorage.getItem("currentPageOrder"));
    },
    update_status: function (id) {
      this.$swal({
        title: "Вы уверены?",
        text: "Заказ будет завершен!",
        type: "warning",
        buttons: {
          confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "isConfirm",
            closeModal: true,
          },
          cancel: {
            text: "Cancel",
            value: false,
            visible: true,
            className: "",
            closeModal: true,
          },
        },
      }).then((isConfirm) => {
        if (isConfirm === true) {
          axios.post(route("orders.completed", id)).then(
            (response) => {
              this.$swal({ title: response.data.message, timer: 3000 });
              const index = this.orders.map((order) => order.id).indexOf(id);
              this.orders[index].status = response.data.status;
            },
            (error) => {
              console.log(error);
            }
          );
        }
      });
    },
  },
};
</script>
