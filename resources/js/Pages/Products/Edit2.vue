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
                                                Продукты
                                            </h6>
                                            <h1 class="header-title">
                                                Редактирование
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="mb-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Поиск</label>
                                            <v-select
                                                :options="parents"
                                                @selected="changeParent"
                                                label="name"
                                                v-model="parent"></v-select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Артикул <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="product.articul">
                                        </div>
                                    </div>
                                    <div class="col col-lg-8">
                                        <div class="form-group">
                                            <label>Название <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="product.name">
                                        </div>
                                    </div>
                                    <div class="col col-lg-4">
                                        <div class="form-group" style="text-align: right">
                                            <label for="validation">Активно</label>
                                            <div class="input-group justify-content-end" style="cursor: pointer">
                                                <div class="input-group-prepend">
                                                    <span @click="product.is_active=1"
                                                          :class="`input-group-text ${ product.is_active ? 'bg-primary text-white' : '' }`"
                                                          id="popular">Да</span>
                                                </div>
                                                <div class="input-group-append">
                                                    <span @click="product.is_active=0"
                                                          :class="`input-group-text ${ !product.is_active ? 'bg-primary text-white' : '' }`"
                                                          id="not_popular">Нет</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Описание <span class="text-danger">*</span></label>
                                            <textarea class="form-control" v-model="product.description"
                                                      data-toggle="autosize" rows="1"
                                                      placeholder="Try typing something..."></textarea>
                                            <!--                                            <input type="text" class="form-control" >-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Размер <span class="text-danger">*</span></label>
                                            <select class="form-control custom-select" v-model="product.size">
                                                <option disabled selected value>Выберите категорию</option>
                                                <option value="38">38</option>
                                                <option value="39">39</option>
                                                <option value="40">40</option>
                                                <option value="41">41</option>
                                                <option value="42">42</option>
                                                <option value="43">43</option>
                                                <option value="44">44</option>
                                                <option value="45">45</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Категория <span class="text-danger">*</span></label>
                                            <select v-model="product.category_id" class="custom-select">
                                                <option disabled selected value>Выберите категорию</option>
                                                <option :value="category.id"
                                                        v-for="category in productCategories.length > 0 ? productCategories[0].subcategories : []"
                                                        v-bind:key="category.id">{{ category.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Сезон</label>
                                            <select v-model="product.season" class="custom-select">
                                                <option disabled selected value>Выберите сезон</option>
                                                <option :value="item.id"
                                                        v-for="item in seasons.length > 0 ? seasons[0].subcategories : []"
                                                        v-bind:key="item.id">{{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Цвет</label>
                                            <select v-model="product.color" class="custom-select">
                                                <option disabled selected value>Выберите цвет</option>
                                                <option :value="item.id"
                                                        v-for="item in colors.length > 0 ? colors[0].subcategories : []"
                                                        v-bind:key="item.id">{{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Себестоимость <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                   v-model="product.cost">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Наценка <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                   v-model="product.markup">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Цена <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                   v-model="product.price">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Распродажа</label>
                                            <input type="number" maxlength="100" class="form-control"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                   v-model="product.sale">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Количество</label>
                                            <input type="text" class="form-control"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                   v-model="product.quantity">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Сырьё <span class="text-danger">*</span></label>
                                            <multiselect v-model="productCrudes"
                                                         :options="selected_crudes.options" :multiple="true"
                                                         :close-on-select="false" :clear-on-select="false"
                                                         :preserve-search="true" placeholder="Выберите сырьё"
                                                         label="name" track-by="name" :preselect-first="true">
                                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                                        <span class="multiselect__single"
                                                              v-if="values.length &amp;&amp; !isOpen">Выбрано видов: {{
                                                                values.length
                                                            }}</span>
                                                </template>
                                            </multiselect>
                                            <br/>
                                            <table class="table table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Название</th>
                                                    <th scope="col">Артикул</th>
                                                    <th scope="col">Цена</th>
                                                    <th scope="col">Количество</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(crude, index) in product.crudes" :key="index">
                                                    <th scope="row">{{ index + 1 }}</th>
                                                    <td>{{ crude.name }}</td>
                                                    <td>{{ crude.articul }}</td>
                                                    <td>{{ crude.price }}</td>
                                                    <td><input type="text" class="form-control border-0"
                                                               v-model="crude.pivot.crude_qty">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <crude-component :crude="crude"
                                                             v-bind:product="product"
                                                             v-bind:productCost="productCost"
                                                             @eventname="updateparent"
                                                             v-for="(crude, index) in product.crudes" :key="index">
                                            </crude-component>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Картинка</label>
                                            <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"
                                                          style="border: 2px dashed #999999;"></vue-dropzone>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-block btn-primary"
                                        @click="update_record(product.id)">
                                    Сохранить
                                </button>
                                <a :href="route('products.index')" class="btn btn-block btn-link text-muted">
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
    import axios from "axios"
    import Vue from 'vue'
    import {Inertia} from '@inertiajs/inertia'


    Vue.component('crude-component', {
        props: ["crude", "product", "productCost"],
        template: `
            <div class="crude">
            </div>`,
        // {{crude.name}}
        // <input type='text' v-model='crude.crude_qty'/>
        watch: {
            crude: {
                handler: function (newValue) {
                    console.log('child watch')
                    var cost = 0
                    this.product.crudes.forEach(crude => cost += crude.price * crude.pivot.crude_qty)
                    this.productCost = cost
                    console.log('child watch before emit')
                    this.$emit('eventname', this.productCost)
                    console.log('child watch after emit')

                    // console.log("Crude with ID:" + newValue.name + " modified")
                    // console.log("New crude_qty: " + newValue.crude_qty)
                },
                deep: true
            }
        },
        methods: {
            updateValue: function (product) {
                this.$emit('input', product);
            }
        }
    });


    export default {
        components: {
            DashboardLayout,
            vueDropzone: vue2Dropzone
        },
        props: {
            product_data: Object,
            categories: Array,
            crudes: Array,
            parents: Array
        },
        name: 'my-component',
        data() {
            return {
                productCost: 0,
                productMarkup: 30,
                productCrudes: [],
                product: {
                    name: '',
                    articul: 0,
                    size: 0,
                    width: 0,
                    girth: 0,
                    quantity: 0,
                    cost: 0,
                    markup: 0,
                    price: 0,
                    category_id: 0,
                    image: [],
                    is_active: 0,
                    crudes: []
                },
                dropzoneOptions: {
                    url: '/upload-files',
                    thumbnailWidth: 150,
                    maxFilesize: 100,
                    maxFiles: 5,
                    addRemoveLinks: true,
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    },
                    dictDefaultMessage: 'Выберите файл'
                },
                selected_crudes: {
                    options: this.crudes
                },
                seasons: [],
                colors: [],
                productCategories: [],
                parent: []
            };
        },
        created() {
            this.product = this.product_data
            console.log(this.product)
            this.productCrudes=this.product.crudes
            console.log(this.productCrudes)
            this.product.crudes.forEach(crude => crude.crude_qty = crude.pivot.crude_qty)
        },
        mounted() {

            this.seasons = this.categories.filter(item => item.resource === 'season')
            this.colors = this.categories.filter(item => item.resource === 'colors')
            this.productCategories = this.categories.filter(item => item.resource === 'products')
            this.parent = this.product_data.parent
            if (this.product.image.length > 0) {
                this.product.image.forEach(doc => {
                    this.$refs.myVueDropzone.manuallyAddFile(doc.fileType, `/storage/${doc.fileName}`);
                });
            } else {
                this.product.image = []
            }
        },
        watch: {
            productCost: function (val) {
                this.product.cost = val
                this.product.price = val * (1 + this.product.markup / 100)
            },
            productMarkup: function (val) {
                this.product.markup = val
                this.product.price = this.product.cost * (1 + val / 100)
            },
            productCrudes: function (val) {
                // console.log(val)
                this.product.crudes = val
                var cost = 0
                val.forEach(element => cost += element.price * element.crude_qty)
                this.productCost = cost
            },
        },
        methods: {
            updateparent(variable) {
                this.productCost = variable
            },
            update_record: function (id) {
                if (confirm('Вы уверены что хотите изменить запись?')) {
                    this.checkDropzoneFiles()
                    this.product.parent_id = this.parent ? this.parent.id : 0
                    axios.put(route("products.update", id), this.product)
                        .then((response) => {
                            // console.log(response)
                            this.$swal({title: response.data.message, timer: 3000})
                            this.$inertia.visit(route('products.index'));
                        })
                        .catch((error) => {
                            console.log(error)
                            this.$swal({title: 'Введите корректные данные', status: 'error', timer: 3000})
                        })
                }
            },
            changeParent() {
                this.product.parent_id = this.parent.id
            },
            checkDropzoneFiles() {
                let files = this.$refs.myVueDropzone.dropzone.files
                let images = []
                if (files) {
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].status == 'success') {
                            let fileName = JSON.parse(files[i].xhr.response).fileName
                            let fileType = {
                                size: files[i].size,
                                name: files[i].name,
                                type: files[i].type,
                            };
                            images.push({
                                fileName,
                                fileType
                            })
                        } else {
                            if (files[i].name) {
                                for (let j = 0; j < this.product.image.length; j++) {
                                    if (files[i].name == this.product.image[j].fileType.name && files[i].size == this.product.image[j].fileType.size && files[i].type == this.product.image[j].fileType.type) {
                                        images.push(this.product.image[j])
                                    }
                                }
                            }
                        }
                    }
                    this.product.image = images
                }
            },
        }
    };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .tree-selec-allow {
        margin-top: 7px;
    }
</style>
