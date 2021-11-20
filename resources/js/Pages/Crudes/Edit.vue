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
                                                Сырье
                                            </h6>
                                            <h1 class="header-title">
                                                Редактирование
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Артикул <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" v-model="crude.articul">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Название <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="crude.name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Ед. измерения <span class="text-danger">*</span></label>
                                            <select v-model="crude.unit_id" class="custom-select">
                                                <option disabled selected value>Выберите ед. измерения</option>
                                                <option :value="unit.id" v-for="unit in units" v-bind:key="unit.id">{{ unit.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Количество <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" v-model="crude.quantity">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Цена <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" v-model="crude.price">
                                        </div>
                                    </div>
                                    <div class="col-2 pl-0">
                                        <div class="form-group float-right">
                                            <label for="validation">Активно</label>
                                            <div class="input-group" style="cursor: pointer">
                                                <div class="input-group-prepend">
                                                    <span @click="crude.is_active=1" :class="`input-group-text ${ crude.is_active ? 'bg-primary text-white' : '' }`" id="popular">Да</span>
                                                </div>
                                                <div class="input-group-append">
                                                    <span @click="crude.is_active=0" :class="`input-group-text ${ !crude.is_active ? 'bg-primary text-white' : '' }`" id="not_popular">Нет</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    sizes-->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Размеры <span class="text-danger">*</span></label>
                                            <multiselect v-model="crude.sizes"
                                                         :options="this.sizes" :multiple="true"
                                                         :close-on-select="false" :clear-on-select="false"
                                                         :preserve-search="true" placeholder="Выберите размер"
                                                         label="name" track-by="name" :preselect-first="false">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                                        <span class="multiselect__single"
                                                              v-if="values.length &amp;&amp; !isOpen">Выбрано размеров: {{
                                                                values.length
                                                            }}</span>
                                                </template>
                                            </multiselect>
                                            <br/>
                                            <table class="table table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Размер</th>
                                                    <th scope="col">Количество</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(size, index) in crude.sizes" :key="index">
                                                    <th scope="row">{{ index + 1 }}</th>
                                                    <td>{{ size.name }}</td>
                                                    <td><input type="text" class="form-control border-0"
                                                               v-model="size.quantity">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Картинка</label>
                                            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" style="border: 2px dashed #999999;"></vue-dropzone>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-block btn-primary" @click="update_record(crude.id)">
                                    Сохранить
                                </button>
                                <a :href="route('crudes.index')" class="btn btn-block btn-link text-muted">
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
import vue2Dropzone from 'vue2-dropzone'
import axios from "axios";
import {Inertia} from '@inertiajs/inertia'
export default {
    components: {
        DashboardLayout,
        vueDropzone: vue2Dropzone
    },
    props: {
        crude_data: Object,
        units: Array
    },
    name: 'my-component',
    data() {
        return {
            sizes: [],
            crude: {
                name: '',
                articul: 0,
                quantity: 0,
                unit_id: 0,
                image: [],
                price: 0,
                is_active: 0
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
    mounted(){
        this.sizes=[{'id': 1, 'name': 37},{'id': 2, 'name': 38},{'id': 3, 'name': 39}]
        this.crude = this.crude_data
        if (this.crude.image){
            this.$refs.myVueDropzone.manuallyAddFile(this.crude.image['fileType'], `/storage/${this.crude.image['fileName']}`);
        }
    },
    methods: {
        update_record: function (id) {
            this.checkDropzoneFiles()
            axios.put(route("crudes.update", id), this.crude)
                .then(
                    (response) => {
                        console.log(response)
                        this.$swal({title: response.data.message,timer: 3000})
                        // this.$inertia.visit(route('crudes.index'));
                    },
                    (error) => {
                        this.$swal('Ошибка', 'Введите корректные данные', 'error')
                    }
                )
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
                    this.crude.image = {
                        fileName,
                        fileType
                    }
                }
            }
        },
    }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
