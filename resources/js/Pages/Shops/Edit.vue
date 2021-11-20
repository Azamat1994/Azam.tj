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
                      <h1 class="header-title">Редактирование</h1>
                    </div>
                  </div>
                </div>
              </div>
              <form class="mb-4">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Название <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shop.name"
                      />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Город <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shop.city"
                      />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Адрес <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shop.address"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Телефон <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shop.phone"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Email <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="shop.email"
                      />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label
                        >Ссылка гугл карты
                        <span class="text-danger">*</span></label
                      >
                      <input
                        type="text"
                        class="form-control"
                        v-model="shop.link"
                      />
                    </div>
                  </div>

                  <div class="col-2 pl-0">
                    <div class="form-group float-right">
                      <label for="validation">Активно</label>
                      <div class="input-group" style="cursor: pointer">
                        <div class="input-group-prepend">
                          <span
                            @click="shop.is_active = 1"
                            :class="`input-group-text ${
                              shop.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="popular"
                            >Да</span
                          >
                        </div>
                        <div class="input-group-append">
                          <span
                            @click="shop.is_active = 0"
                            :class="`input-group-text ${
                              !shop.is_active ? 'bg-primary text-white' : ''
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
                  @click="update_record(shop.id)"
                >
                  Сохранить
                </button>
                <a
                  :href="route('shops.index')"
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
import { Inertia } from "@inertiajs/inertia";
export default {
  components: {
    DashboardLayout,
    vueDropzone: vue2Dropzone,
  },
  props: {
    shop: Object,
  },
  name: "my-component",
  data() {
    return {
      sizes: [],
      shop: {
        picture: [],
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
    this.sizes = [
      { id: 1, name: 37 },
      { id: 2, name: 38 },
      { id: 3, name: 39 },
    ];
    this.shop = this.shop;
    if (this.shop.picture) {
      this.$refs.myVueDropzone.manuallyAddFile(
        this.shop.picture["fileType"],
        `/storage/${this.shop.picture["fileName"]}`
      );
    }
  },
  methods: {
    update_record: function (id) {
      this.checkDropzoneFiles();
      axios.put(route("shops.update", id), this.shop).then(
        (response) => {
          console.log(response);
          this.$swal({ title: response.data.message, timer: 3000 });
          this.$inertia.visit("/dashboard/shops");
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
          this.shop.picture = {
            fileName,
            fileType,
          };
        }
      }
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
