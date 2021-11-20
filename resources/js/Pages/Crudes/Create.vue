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
                      <h6 class="header-pretitle">Сырье</h6>
                      <h1 class="header-title">Добавление</h1>
                    </div>
                  </div>
                </div>
              </div>
              <form class="mb-4">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Артикул <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="crude.articul"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Название <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="crude.name"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label
                        >Ед. измерения <span class="text-danger">*</span></label
                      >
                      <select v-model="crude.unit_id" class="custom-select">
                        <option disabled selected value>
                          Выберите ед. изм-я
                        </option>
                        <option
                          :value="unit.id"
                          v-for="unit in units"
                          v-bind:key="unit.id"
                        >
                          {{ unit.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label
                        >Количество <span class="text-danger">*</span></label
                      >
                      <input
                        type="text"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="crude.quantity"
                      />
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Цена <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="crude.price"
                      />
                    </div>
                  </div>
                  <div class="col-2 pl-0">
                    <div class="form-group float-right">
                      <label for="validation">Активно</label>
                      <div class="input-group" style="cursor: pointer">
                        <div class="input-group-prepend">
                          <span
                            @click="crude.is_active = 1"
                            :class="`input-group-text ${
                              crude.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="popular"
                            >Да</span
                          >
                        </div>
                        <div class="input-group-append">
                          <span
                            @click="crude.is_active = 0"
                            :class="`input-group-text ${
                              !crude.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="not_popular"
                            >Нет</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Картинка</label>
                      <vue-dropzone
                        ref="myVueDropzone"
                        id="dropzone"
                        :options="dropzoneOptions"
                        style="border: 2px dashed #999999"
                      ></vue-dropzone>
                    </div>
                  </div>
                </div>
                <button
                  type="button"
                  class="btn btn-block btn-primary"
                  @click="create_record(crude.id)"
                >
                  Сохранить
                </button>
                <a
                  :href="route('crudes.index')"
                  class="btn btn-block btn-link text-muted"
                >
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
import DashboardLayout from "./../../Layouts/DashboardLayout";
import vue2Dropzone from "vue2-dropzone";
import axios from "axios";

export default {
  components: {
    DashboardLayout,
    vueDropzone: vue2Dropzone,
  },
  props: {
    units: Array,
  },
  name: "my-component",
  data() {
    return {
      crude: {
        name: "",
        articul: "",
        quantity: "",
        unit_id: "",
        image: [],
        price: "",
        is_active: 0,
      },
      dropzoneOptions: {
        url: "/upload-files",
        thumbnailWidth: 150,
        maxFilesize: 100,
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
          "X-CSRF-TOKEN":
            document.head.querySelector("[name=csrf-token]").content,
        },
        dictDefaultMessage: "Выберите файл",
      },
    };
  },
  mounted() {
    console.log(Number(localStorage.getItem("currentPage")));
    console.log('adadasdasdasda');
  },
  methods: {
    create_record: function (id) {
      this.checkDropzoneFiles();
      axios.post(route("crudes.store", id), this.crude).then(
        (response) => {
          this.$swal({ title: response.data.message, timer: 3000 });
          this.$inertia.visit("/dashboard/crudes");
        },
        (error) => {
          this.$swal("Ошибка", "Введите корректные данные", "error");
        }
      );
    },
    checkDropzoneFiles() {
      let files = this.$refs.myVueDropzone.dropzone.files;
      if (files && files.length > 0) {
        if (files[0].status === "success") {
          let fileName = JSON.parse(files[0].xhr.response).fileName;
          let fileType = {
            size: files[0].size,
            name: files[0].name,
            type: files[0].type,
          };
          this.crude.image = {
            fileName,
            fileType,
          };
        }
      }
    },
  },
};
</script>
