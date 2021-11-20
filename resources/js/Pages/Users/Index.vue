<template>
  <dashboard-layout>
    <div class="main-content">
      <div class="header">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Админ панель</h6>
                <h1 class="header-title">Users</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--                        {{ users }}-->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-6 col-xl">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col">
                        <h4 class="card-header-title">Пользователи</h4>
                      </div>
                      <div
                        v-if="$userPermissions.includes('users-create') == true"
                        class="col-auto"
                      >
                        <a
                          :href="route('users.create')"
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
                    <div v-if="$userPermissions.includes('users-read') == true">
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
                          <span v-if="props.column.field == 'avatar'">
                            <img
                              class="rounded"
                              height="50"
                              width="50"
                              :src="
                                props.row.avatar
                                  ? '/storage/' + props.row.avatar.fileName
                                  : '/img/avatar.png'
                              "
                            />
                          </span>
                          <span v-else-if="props.column.field == 'actions'">
                            <a
                              v-if="
                                $userPermissions.includes('users-update') ==
                                true
                              "
                              :href="
                                '/dashboard/users/' + props.row.id + '/edit'
                              "
                              title="Редактировать"
                              class="badge badge-warning"
                            >
                              <i class="fe fe-edit"></i>
                            </a>

                            <button
                              v-if="
                                $userPermissions.includes('users-delete') ==
                                true
                              "
                              title="Удалить"
                              class="btn badge badge-danger"
                              @click="delete_record(props.row.id)"
                            >
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
import DashboardLayout from "./../../Layouts/DashboardLayout";
import axios from "axios";

export default {
  components: {
    DashboardLayout,
  },

  props: {
    users: Array,
  },

  name: "my-component",

  data() {
    return {
      currentPage: 1,
      columns: [
        {
          label: "Фото",
          field: "avatar",
          sortable: false,
        },
        {
          label: "Имя",
          field: "name",
          type: "string",
        },
        {
          label: "Email",
          field: "email",
          type: "string",
        },
        {
          label: "Телефон",
          field: "phone",
          type: "string",
        },
        {
          label: "Город",
          field: "city.name",
          type: "string",
        },
        {
          label: "Адрес",
          field: "address",
          type: "string",
        },
        {
          label: "Кешбек",
          field: "cashback",
          type: "float",
        },
        {
          label: "Дата создания",
          field: "created_at",
          type: "date",
          dateInputFormat: "yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'",
          dateOutputFormat: "dd-MM-yyyy HH:mm",
        },
        {
          label: "Действия",
          field: "actions",
          sortable: false,
        },
      ],
      rows: this.users,
    };
  },

  mounted() {
    this.currentPage = Number(localStorage.getItem("currentPageUser"));
    if(this.currentPage === 0){
      this.currentPage+=1
    }
  },

  methods: {
    onPageChange(params) {
      localStorage.setItem("currentPageUser", params.currentPage);
      this.currentPage = Number(localStorage.getItem("currentPageUser"));
    },
    delete_record: function (id) {
      this.$swal({
        title: "Вы уверены?",
        text: "Пользователь, а также все его склады будут удалены безвозвратно!",
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
          axios.delete(route("users.destroy", id)).then(
            (response) => {
              const index = this.users.map((user) => user.id).indexOf(id);
              this.users.splice(index, 1);
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
