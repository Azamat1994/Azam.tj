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
                      <h6 class="header-pretitle">Продукты</h6>
                      <h1 class="header-title">Добавление</h1>
                    </div>
                  </div>
                </div>
              </div>
              <form class="mb-4">
                <div class="row">
                  <!--                                    <div class="col-lg-12">-->
                  <!--                                        <div class="form-group">-->
                  <!--                                            <label>Поиск</label>-->
                  <!--                                             <v-select-->
                  <!--                                                :options="parents"-->
                  <!--                                                label="name"-->
                  <!--                                                v-model="product"></v-select>-->
                  <!--                                        </div>-->
                  <!--                                    </div>-->
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Артикул <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="product.articul"
                      />
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="form-group">
                      <label>Название <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="product.name"
                      />
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4">
                    <div class="form-group">
                      <label for="validation">Активно</label>
                      <div class="input-group" style="cursor: pointer">
                        <div class="input-group-prepend">
                          <span
                            @click="product.is_active = 1"
                            :class="`input-group-text ${
                              product.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="popular"
                            >Да</span
                          >
                        </div>
                        <div class="input-group-append">
                          <span
                            @click="product.is_active = 0"
                            :class="`input-group-text ${
                              !product.is_active ? 'bg-primary text-white' : ''
                            }`"
                            id="not_popular"
                            >Нет</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Описание <span class="text-danger">*</span></label>
                      <textarea
                        class="form-control"
                        v-model="product.description"
                        data-toggle="autosize"
                        rows="1"
                        placeholder="Введите описание продукта..."
                      ></textarea>
                      <!--                                            <input type="text" class="form-control" >-->
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label>Размер <span class="text-danger">*</span></label>
                      <select
                        class="form-control custom-select"
                        v-model="product.size"
                      >
                        <option disabled selected value>
                          Выберите категорию
                        </option>
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
                      <label>Пол</label>
                      <select v-model="gender" class="custom-select">
                        <option disabled selected value>Выберите пол</option>
                        <option
                          :value="item.id"
                          v-for="item in genders.length > 0
                            ? genders[0].subcategories
                            : []"
                          v-bind:key="item.id"
                        >
                          {{ item.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label
                        >Категория <span class="text-danger">*</span></label
                      >
                      <select
                        v-model="product.category_id"
                        class="custom-select"
                      >
                        <option disabled selected value>
                          Выберите категорию
                        </option>
                        <option
                          :value="category.id"
                          v-for="category in category_product_gender"
                          v-bind:key="category.id"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label>Сезон</label>
                      <select v-model="product.season" class="custom-select">
                        <option disabled selected value>Выберите сезон</option>
                        <option
                          :value="item.id"
                          v-for="item in seasons.length > 0
                            ? seasons[0].subcategories
                            : []"
                          v-bind:key="item.id"
                        >
                          {{ item.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label>Цвет</label>
                      <select v-model="product.color" class="custom-select">
                        <option disabled selected value>Выберите цвет</option>
                        <option
                          :value="item.id"
                          v-for="item in colors.length > 0
                            ? colors[0].subcategories
                            : []"
                          v-bind:key="item.id"
                        >
                          {{ item.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label
                        >Себестоимость <span class="text-danger">*</span></label
                      >
                      <input
                        type="text"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="productCost"
                      />
                    </div>
                  </div>
                  <!--                                    <div class="col-lg-4 col-md-6">-->
                  <!--                                        <div class="form-group">-->
                  <!--                                            <label>Наценка <span class="text-danger">*</span></label>-->
                  <!--                                            <input type="text" class="form-control"-->
                  <!--                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"-->
                  <!--                                                   v-model="productMarkup">-->
                  <!--                                        </div>-->
                  <!--                                    </div>-->
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label>Цена <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="product.price"
                      />
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label>Распродажа</label>
                      <input
                        type="number"
                        maxlength="100"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="product.sale"
                      />
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                      <label>Количество</label>
                      <input
                        type="text"
                        class="form-control"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        v-model="product.quantity"
                      />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Сырьё <span class="text-danger">*</span></label>
                      <multiselect
                        v-model="productCrudes"
                        :options="selected_crudes.options"
                        :multiple="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        placeholder="Выберите сырьё"
                        label="name"
                        track-by="name"
                        :preselect-first="false"
                      >
                        <template
                          slot="selection"
                          slot-scope="{ values, search, isOpen }"
                        >
                          <span
                            class="multiselect__single"
                            v-if="values.length &amp;&amp; !isOpen"
                            >Выбрано видов: {{ values.length }}</span
                          >
                        </template>
                      </multiselect>
                      <br />
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
                          <tr
                            v-for="(crude, index) in product.crudes"
                            :key="index"
                          >
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ crude.name }}</td>
                            <td>{{ crude.articul }}</td>
                            <td>{{ crude.price }}</td>
                            <td>
                              <input
                                type="text"
                                class="form-control border-0"
                                v-model="crude.crude_qty"
                              />
                              {{ crude.unit.name }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Размеры<span class="text-danger">*</span></label>
                      <multiselect
                      v-model="productSizes"
                      :options="selected_sizes.options"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      :preserve-search="true"
                      placeholder="Выберите размер"
                      label="size"
                      track-by="size"
                      :preselect-first="false"
                      >
                        
                      </multiselect>
                      <table class="table table-responsive-sm">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Размер</th>
                            <th scope="col">Количество</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in product.sizes"
                            :key="index"
                          >
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.size }}</td>
                            <td>
                              <input
                                type="text"
                                class="form-control border-0"
                                v-model="item.quantity"
                              />
                            </td>
                            <!--                                                    <td></td>-->
                            <!--                                                    <crude-component :crude="crude"-->
                            <!--                                                                     v-bind:product="product"-->
                            <!--                                                                     v-bind:productCost="productCost"-->
                            <!--                                                                     @eventname="updateparent"-->
                            <!--                                                                     v-for="(crude, index) in product.crudes" :key="index">-->
                            <!--                                                    </crude-component>-->
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
                  @click="create_record(product.id)"
                >
                  Сохранить
                </button>
                <a
                  :href="route('products.index')"
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
    categories: Array,
    crudes: Array,
    parents: Array,
    child: Array,
    man: Array,
    woman: Array,
    sizes: Array,
  },
  data() {
    return {
      gender: "",
      category_product_gender: "",
      productCost: 0,
      productMarkup: 30,
      productCrudes: [],
      productSizes: [],
      product: {
        name: "",
        articul: "",
        quantity: 1,
        markup: 30,
        unit_id: "",
        image: [],
        cost: 0,
        sale: 0,
        color: 0,
        season: 0,
        parent_id: 0,
        color: 0,
        price: "",
        is_active: 0,
        crudes: [],
        sizes: []
      },
      dropzoneOptions: {
        url: "/upload-files",
        thumbnailWidth: 150,
        maxFilesize: 100,
        maxFiles: 5,
        addRemoveLinks: true,
        headers: {
          "X-CSRF-TOKEN":
            document.head.querySelector("[name=csrf-token]").content,
        },
        dictDefaultMessage: "Выберите файл",
      },
      selected_crudes: {
        options: this.crudes,
      },
      selected_sizes:{
        options: this.sizes
      },
      seasons: [],
      colors: [],
      genders: [],
      productCategories: [],
    };
  },
  mounted() {
    this.seasons = this.categories.filter((item) => item.resource === "season");
    this.colors = this.categories.filter((item) => item.resource === "colors");
    this.genders = this.categories.filter((item) => item.resource === "gender");
    this.productCategories = this.categories.filter(
      (item) => item.resource === "products"
    );
  },
  watch: {
    gender(val) {
      console.log(this.man, 'val');
      this.product.gender_id = val;
      if (val === 4) {
        this.category_product_gender = this.man;
      } else if (val === 3) {
        this.category_product_gender = this.woman;
      } else if (val === 2) {
        this.category_product_gender = this.child;
      }
    },
    productCost: function (val) {
      this.product.cost = val;
      // this.product.price=val*(1+this.product.markup/100)
    },
    productCrudes: function (val) {
      this.product.crudes = val;
      var cost = 0;
      val.forEach((element) => (cost += element.price * element.crude_qty));
      this.productCost = cost;
    },
    productSizes(val) {
      // console.log('productCrudes changed')
      this.product.sizes = val;
    },
  },
  methods: {
    create_record: function (id) {
      this.checkDropzoneFiles();
      axios
        .post(route("products.store", id), this.product)
        .then((response) => {
          console.log(response);
          this.$swal({ title: response.data.message, timer: 3000 });
          this.$inertia.visit("/dashboard/products");
        })
        .catch((error) => {
          if (error.message.includes("Request failed with status code 422")) {
            alert(
              "Ошибка: Одно или несколько полей не заполнены. Заполните все поля!"
            );
          }
        });
    },
    checkDropzoneFiles() {
      let files = this.$refs.myVueDropzone.dropzone.files;
      this.product.image = [];
      if (files && files.length > 0) {
        for (let i = 0; i < files.length; i++) {
          if (files[i].status == "success") {
            let fileName = JSON.parse(files[i].xhr.response).fileName;
            let fileType = {
              size: files[i].size,
              name: files[i].name,
              type: files[i].type,
            };
            this.product.image.push({
              fileName,
              fileType,
            });
          }
        }
      }
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.tree-selec-allow {
  margin-top: 7px;
}
</style>

