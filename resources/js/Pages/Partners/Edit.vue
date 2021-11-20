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
                                                Партнёры
                                            </h6>
                                            <h1 class="header-title">
                                                Редактирование
                                            </h1></div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group"><label>Название <span
                                            class="text-danger">*</span></label> <input
                                            type="text" class="form-control" v-model="partner.name">
                                        </div>
                                    </div>
                                    <div class="col-2 pl-0">
                                        <div class="form-group float-right">
                                            <label for="validation">Активно</label>
                                            <div class="input-group" style="cursor: pointer">
                                                <div class="input-group-prepend">
                                                    <span @click="partner.is_active=1"
                                                          :class="`input-group-text ${ partner.is_active ? 'bg-primary text-white' : '' }`"
                                                          id="popular">Да</span>
                                                </div>
                                                <div class="input-group-append">
                                                    <span @click="partner.is_active=0"
                                                          :class="`input-group-text ${ !partner.is_active ? 'bg-primary text-white' : '' }`"
                                                          id="not_popular">Нет</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group"><label>Ссылка</label>
                                            <input
                                                type="text" class="form-control" v-model="partner.link">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Картинка</label>
                                            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"
                                                          style="border: 2px dashed #999999;"></vue-dropzone>
                                    </div>
                                </div>
                                </div>


                                <button type="button" class="btn btn-block btn-primary"
                                        @click="create_record(partner.id)">
                                    Сохранить
                                </button>

                                <a :href="route('partners.index')" class="btn btn-block btn-link text-muted">
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
import vue2Dropzone from 'vue2-dropzone'


export default {
    components: {
        DashboardLayout,
        vueDropzone: vue2Dropzone
    },
    props: {
        partner_data: Object
    },
    data() {
        return {
            partner: {
                name: '',
                link: '',
                is_active: 0,
                image: []
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
        this.partner = this.partner_data
        if (this.partner.image) {
            this.$refs.myVueDropzone.manuallyAddFile(this.partner.image['fileType'], `/storage/${this.partner.image['fileName']}`);
        }
    },
    methods: {
        create_record() {
            this.checkDropzoneFiles()
            axios.put(route("partners.update", this.partner.id), this.partner)
                .then(
                    (response) => {
                        this.$swal({title: response.data.message,timer: 3000})
                        this.$inertia.visit('/dashboard/partners');
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
                    this.partner.image = {
                        fileName,
                        fileType
                    }
                }
            }
        },
    },

};


</script>
