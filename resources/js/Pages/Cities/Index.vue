<template>
  <dashboard-layout>
    <div class="main-content">
      <div class="header">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Админ панель</h6>
                <h1 class="header-title">Города</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--            {{ cities }}-->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-6 col-xl">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col">
                        <h4 class="card-header-title">Города</h4>
                      </div>
                      <div
                        v-if="
                          $userPermissions.includes('cities-create') == true
                        "
                        class="col-auto"
                      >
                        <a
                          :href="route('cities.create')"
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
                      v-if="$userPermissions.includes('cities-read') == true"
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
                          <span v-if="props.column.field == 'actions'">
                            <a
                              v-if="
                                $userPermissions.includes('cities-update') ==
                                true
                              "
                              :href="
                                '/dashboard/cities/' + props.row.id + '/edit'
                              "
                              title="Редактировать"
                              class="badge badge-warning"
                            >
                              <i class="fe fe-edit"></i>
                            </a>

                            <button
                              v-if="
                                $userPermissions.includes('cities-delete') ==
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
    cities: Array,
  },

  name: "my-component",

  data() {
    return {
      currentPage: 1,
      columns: [
        {
          label: "Название",
          field: "name",
          type: "string",
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
          type: "boolean",
        },
        {
          label: "Действия",
          field: "actions",
          sortable: false,
        },
      ],
      rows: this.cities,
    };
  },
  mounted() {
    this.currentPage = Number(localStorage.getItem("currentPageCategory"));
    if(this.currentPage === 0){
      this.currentPage+=1
    }
  },
  methods: {
    onPageChange(params) {
      localStorage.setItem("currentPageCitie", params.currentPage);
      this.currentPage = Number(localStorage.getItem("currentPageCitie"));
    },
    delete_record: function (id) {
      this.$swal({
        title: "Вы уверены?",
        text: "Город, а также все связанные данные будут удалены безвозвратно!",
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
          axios.delete(route("cities.destroy", id)).then(
            (response) => {
              const index = this.cities.map((city) => city.id).indexOf(id);
              this.cities.splice(index, 1);
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
