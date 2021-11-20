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
                                            <h6 class="header-pretitle">
                                                Записи
                                            </h6>
                                            <h1 class="header-title">
                                                Добавление
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label>Заголовок <span class="text-danger">*</span></label>
                                                    <input type="text" v-model="post.title" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <label for="validation">Активно</label>
                                                    <div class="input-group" style="cursor: pointer">
                                                        <div class="input-group-prepend">
                                                            <span @click="post.is_active=1"
                                                                :class="`input-group-text ${ post.is_active ? 'bg-primary text-white' : '' }`"
                                                                id="popular">Да</span>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span @click="post.is_active=0"
                                                                :class="`input-group-text ${ !post.is_active ? 'bg-primary text-white' : '' }`"
                                                                id="not_popular">Нет</span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Краткое содержание <span class="text-danger">*</span></label>
                                            <vue-editor id="editor1" :editor-toolbar="customToolbar" v-model="post.short_desc"> </vue-editor>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label> Описание </label>
                                                id="editor" :editorOptions="editorOption" useCustomImageHandler @image-added="handleImageAdded" v-model="post.description"> </vue-editor>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Изоброжения </label>
                                            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"
                                                        style="border: 2px dashed #999999; border-radius: 10px"></vue-dropzone>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Категория <span class="text-danger">*</span></label>
                                            <v-select
                                            :options="categories"
                                            label="name"
                                            :multiple="true"
                                            :reduce="category => category.id"
                                            v-model="post.categories"></v-select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Ссылка</label>
                                            <input type="text" v-model="post.link" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-block btn-primary"
                                        @click="save">
                                    Сохранить
                                </button>

                                <a :href="route('posts.index')" class="btn btn-block btn-link text-muted">
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
import DashboardLayout from './../../Layouts/DashboardLayout'
import axios from "axios";
import { VueEditor, Quill } from "vue2-editor";
import vue2Dropzone from 'vue2-dropzone'

export default {
    components: {
        DashboardLayout,
        VueEditor,
        vueDropzone: vue2Dropzone,
    },
    props: {
        categories: Array
    },
    data() {
        return {
            post: {
                title: '',
                description: '',
                short_desc: '',
                link: '',
                is_active: 0,
                image: [],
                categories: []
            },
            customToolbar: [
                [{ list: "ordered" }, { list: "bullet" }],
            ],
            editorOption: {
                theme: 'snow',
            },
            dropzoneOptions: {
                url: '/upload-files',
                thumbnailWidth: 150,
                maxFilesize: 100,
                maxFiles: 1,
                addRemoveLinks: true,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                },
                dictDefaultMessage: 'Выберите файл'
            }
        };
    },
    methods: {
        handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
            var formData = new FormData();
            formData.append("file", file);
            axios({
                url: route('upload-files'),
                method: "POST",
                data: formData
            })
                .then(result => {
                    let url = '/storage/' + result.data.fileName;
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch(err => {
                    console.log(err);
                });
        },
        save() {
            this.checkDropzoneFiles()
            axios.post(route("posts.store"), this.post)
                .then((response) => {
                    this.$swal({title: response.data.message,timer: 3000})
                    this.$inertia.visit('/dashboard/posts');
                })
                .catch((error) => {
                    this.$swal('Ошибка', 'Введите корректные данные', 'error')
                })
        },
        checkDropzoneFiles() {
            let files = this.$refs.myVueDropzone.dropzone.files
            if (files && files.length > 0) {
                if (files[0].status === 'success') {
                    let fileName = JSON.parse(files[0].xhr.response).fileName
                    let fileType = {
                        size: files[0].size,
                        name: files[0].name,
                        type: files[0].type,
                    };
                    this.post.image = {
                        fileName,
                        fileType
                    }
                }
            }
        },
    },
};
</script>
