<template>
  <dashboard-layout>
    <div class="main-content">
      <div class="header">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Админ панель</h6>
                <h1 class="header-title">Продукты</h1>
              </div>
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
                      <div class="col">
                        <h4 class="card-header-title">Продукты</h4>
                      </div>
                      <div
                        v-if="
                          $userPermissions.includes('products-read') == true
                        "
                        class="col-auto"
                      >
                        <a @click="badPrices()" class="btn btn-default lift">
                          {{ badPricesSelected ? "все" : "плохие цены" }}
                        </a>
                      </div>
                      <div
                        v-if="
                          $userPermissions.includes('products-create') == true
                        "
                        class="col-auto"
                      >
                        <a
                          :href="route('products.create')"
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
                      v-if="$userPermissions.includes('products-read') == true"
                    >
                      <vue-good-table
                        :columns="columns"
                        @on-page-change="onPageChange"
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
                          <span v-if="props.column.field == 'image'">
                            <img
                              class="rounded"
                              style="
                                object-fit: cover;
                                overflow: hidden;
                                height: 50px;
                                width: 50px;
                              "
                              :src="
                                props.row.image.length > 0
                                  ? '/storage/' + props.row.image[0]['fileName']
                                  : ''
                              "
                            />
                          </span>
                          <span v-else-if="props.column.field == 'actions'">
                            <a
                              :href="'/dashboard/products/' + props.row.id"
                              title="Просмотр"
                              class="badge badge-info"
                            >
                              <i class="fe fe-eye"></i>
                            </a>

                            <a
                              v-if="
                                $userPermissions.includes('products-update') ==
                                true
                              "
                              :href="
                                '/dashboard/products/' + props.row.id + '/edit'
                              "
                              title="Редактировать"
                              class="badge badge-warning"
                            >
                              <i class="fe fe-edit"></i>
                            </a>

                            <button
                              v-if="
                                $userPermissions.includes('products-delete') ==
                                true
                              "
                              title="Удалить"
                              class="btn badge badge-danger"
                              @click="delete_record(props.row.id)"
                            >
                              <i class="fe fe-trash"></i>
                            </button>
                          </span>
                          <span v-else-if="props.column.field == 'is_active'">
                            <span
                              class="badge badge-danger"
                              v-if="props.row.is_active == 0"
                              >не активен</span
                            >
                            <span
                              class="badge badge-success"
                              v-else-if="props.row.is_active == 1"
                              >активен</span
                            >
                          </span>
                        </template>
                      </vue-good-table>
                    </div>
                  </div>
                  <!--                                    {{products}}-->
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
    products: Array,
  },

  name: "my-component",

  data() {
    return {
      currentPage: 1,
      columns: [
        {
          label: "Фото",
          field: "image",
          sortable: false,
        },
        {
          label: "Название",
          field: "name",
        },
        {
          label: "Артикул",
          field: "articul",
        },
        // {
        //     label: 'Описание',
        //     field: 'description',
        // },
        {
          label: "Количество",
          field: "quantity",
        },
        {
          label: "Себестоимость",
          field: "cost",
        },
        // {
        //     label: 'Наценка',
        //     field: 'markup',
        // },
        {
          label: "Цена",
          field: "price",
          // filterOptions: {
          //     // styleClass: 'class1', // class to be added to the parent th element
          //     enabled: true, // enable filter for this column
          //     placeholder: 'выберите', // placeholder for filter input
          //     // filterValue: 'все', // initial populated value for this filter
          //     filterDropdownItems: ['все', 'плохие цены'], // dropdown (with selected values) instead of text input
          //     filterFn: this.badPrices, //custom filter function that
          //     trigger: 'enter', //only trigger on enter not on keyup
          // },
        },
        {
          label: "Категория",
          field: "category.name",
        },
        {
          label: "Пол",
          field: "gender.name",
        },
        {
          label: "Дата создания",
          field: "created_at",
          type: "date",
          dateInputFormat: "yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'",
          dateOutputFormat: "dd-MM-yyyy HH:mm",
        },
        {
          label: "Статус",
          field: "is_active",
        },
        {
          label: "Действия",
          field: "actions",
          sortable: false,
        },
      ],
      rows: this.products,
      modalData: {
        category: {
          name: "",
        },
        crude: [],
      },
      badPricesSelected: false,
    };
  },
  mounted() {
    this.currentPage = Number(localStorage.getItem("currentPageProduct"));
    if(this.currentPage === 0){
      this.currentPage+=1
    }
  },
  methods: {
    onPageChange(params) {
      localStorage.setItem("currentPageProduct", params.currentPage);
      this.currentPage = Number(localStorage.getItem("currentPageProduct"));
    },
    badPrices: function () {
      this.badPricesSelected = !this.badPricesSelected;
      // this.rows = JSON.parse(JSON.stringify(this.products))
      if (this.badPricesSelected) {
        this.rows = this.products.filter(
          (product) => product.price < product.cost
        );
      } else {
        this.rows = this.products;
      }
      // console.log(data)
      // var x = parseInt(filterString)
    },
    MyEval: function (str) {
      return eval("this.modalData." + str);
    },
    delete_record: function (id) {
      this.$swal({
        title: "Вы уверены?",
        text: "Продукт, а также все записи о нем на складах будут удалены безвозвратно!",
        type: "warning",
        buttons: {
          confirm: {
            text: "Да",
            value: true,
            visible: true,
            className: "isConfirm",
            closeModal: true,
          },
          cancel: {
            text: "Нет",
            value: false,
            visible: true,
            className: "",
            closeModal: true,
          },
        },
      }).then((isConfirm) => {
        if (isConfirm === true) {
          axios.delete(route("products.destroy", id)).then(
            (response) => {
              const index = this.products
                .map((product) => product.id)
                .indexOf(id);
              this.products.splice(index, 1);
              this.$swal({ title: response.data.message, timer: 3000 });
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
