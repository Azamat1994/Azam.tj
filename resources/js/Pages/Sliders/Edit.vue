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
                      <h6 class="header-pretitle">Слайдеры</h6>
                      <h1 class="header-title">Добавление</h1>
                    </div>
                  </div>
                </div>
              </div>
              <form class="mb-4">
                <div class="row">
                  <div class="col-10">
                    <div class="form-group">
                      <label>Название <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="slider.title"
                      />
                    </div>
                  </div>
                  <div class="col-2 pl-0">
                    <div class="form-group float-right">
                      <label for="validation">Активно</label>
                      <div class="input-group" style="cursor: pointer">
                        <div class="input-group-prepend">
                          <span
                            @click="slider.is_active = 1"
                            :class="`input-group-text ${
                              slider.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="popular"
                            >Да</span
                          >
                        </div>
                        <div class="input-group-append">
                          <span
                            @click="slider.is_active = 0"
                            :class="`input-group-text ${
                              !slider.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="not_popular"
                            >Нет</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-10">
                    <div class="form-group">
                      <select
                        v-model="slider.category_id"
                        class="custom-select"
                      >
                        <option disabled selected value>
                          Выберите категорию
                        </option>
                        <option
                          :value="category.id"
                          v-for="category in categories"
                          v-bind:key="category.id"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label> Описание<span class="text-danger">*</span></label>
                      <vue-editor
                        id="editor"
                        :editorOptions="editorOption"
                        useCustomImageHandler
                        @image-added="handleImageAdded"
                        v-model="slider.description"
                      >
                      </vue-editor>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label
                        >Краткое содержание
                        <span class="text-danger">*</span></label
                      >
                      <vue-editor
                        id="editor1"
                        :editor-toolbar="customToolbar"
                        v-model="slider.short_desc"
                      >
                      </vue-editor>
                    </div>
                  </div>
                  <div class="col-12">
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
                  @click="create_record()"
                >
                  Сохранить
                </button>

                <a
                  :href="route('sliders.index')"
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
import axios from "axios";
import vue2Dropzone from "vue2-dropzone";
import { VueEditor, Quill } from "vue2-editor";

export default {
  components: {
    DashboardLayout,
    vueDropzone: vue2Dropzone,
    VueEditor,
  },
  props: {
    slider_data: Object,
    categories: Array,
  },
  data() {
    return {
      slider: {
        title: "",
        short_desc: "",
        description: "",
        is_active: 0,
        image: [],
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
      editorOption: {
        theme: "snow",
      },
      customToolbar: [[{ list: "ordered" }, { list: "bullet" }]],
    };
  },
  mounted() {
    this.slider = this.slider_data;
    if (this.slider.image) {
      this.$refs.myVueDropzone.manuallyAddFile(
        this.slider.image["fileType"],
        `/storage/${this.slider.image["fileName"]}`
      );
    }
  },
  methods: {
    create_record() {
      this.checkDropzoneFiles();
      axios.put(route("sliders.update", this.slider.id), this.slider).then(
        (response) => {
          this.$swal({ title: response.data.message, timer: 3000 });
          this.$inertia.visit("/dashboard/sliders");
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
          this.slider.image = {
            fileName,
            fileType,
          };
        }
      }
    },
    handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
      var formData = new FormData();
      formData.append("file", file);
      axios({
        url: "/upload-files",
        method: "POST",
        data: formData,
      })
        .then((result) => {
          let url = "/storage/" + result.data.fileName;
          Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="css">
@import "~vue2-editor/dist/vue2-editor.css";
@import "~quill/dist/quill.core.css";
@import "~quill/dist/quill.bubble.css";
@import "~quill/dist/quill.snow.css";
</style>
