<template>
  <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
    <section id="content">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-5">
            <li class="breadcrumb-item">
              <a :href="route('home')">Главная</a>
            </li>
            <li class="breadcrumb-item active text-danger" aria-current="page">
              Магазин
            </li>
          </ol>
        </nav>

        <div class="az-filter">
          <div class="row">
            <div class="col-lg-3 col-12">
              <form action="">
                <div
                  class="
                    row
                    g-2
                    align-items-center
                    px-3
                    justify-content-between
                  "
                >
                  <div class="col-3">
                    <label for="price">Цена до:</label>
                  </div>
                  <div class="col-9">
                    <input
                      type="number"
                      v-model="productFilter.price"
                      class="form-control border-0"
                      id="price"
                      placeholder="500"
                      style="text-align: end"
                    />
                  </div>
                  <!--                                    <div class="col text-end">-->
                  <!--                                        <button type="button" @click="filterProducts" class="btn btn-danger text-white  rounded-0">OK</button>-->
                  <!--                                    </div>-->
                </div>
                <hr />
                <div class="az-filters-actions">
                  <div class="form-floating">
                    <select
                      v-model="productFilter.color"
                      class="form-select border-0 pb-0 fs-5"
                      id="color"
                      aria-label="Цвет"
                    >
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
                    <label for="color">Цвет</label>
                  </div>
                  <hr />
                  <div class="form-floating">
                    <select
                      v-model="productFilter.category"
                      class="form-select border-0 pb-0 fs-5"
                      id="size"
                      aria-label="Категория"
                    >
                      <option
                        :value="item.id"
                        v-for="item in productCategories.length > 0
                          ? productCategories[0].subcategories
                          : []"
                        v-bind:key="item.id"
                      >
                        {{ item.name }}
                      </option>
                    </select>
                    <label for="size">Категория</label>
                  </div>
                  <hr />
                  <div class="form-floating">
                    <select
                      v-model="productFilter.size"
                      class="form-select border-0 pb-0 fs-5"
                      id="size"
                      aria-label="Размер"
                    >
                      <option disabled selected="">Выберите размер</option>
                      <option value="39">39</option>
                      <option value="40">40</option>
                      <option value="41">41</option>
                      <option value="42">42</option>
                      <option value="43">43</option>
                      <option value="44">44</option>
                      <option value="45">45</option>
                    </select>
                    <label for="size">Размер</label>
                  </div>
                  <hr />
                  <div class="form-floating">
                    <select
                      v-model="productFilter.season"
                      class="form-select border-0 pb-0 fs-5"
                      id="season"
                      aria-label="Сезон"
                    >
                      <option selected disabled>Выберите категорию</option>
                      <option
                        v-for="(item, index) in seasons.length > 0
                          ? seasons[0].subcategories
                          : []"
                        :key="item.id"
                        v-if="index !== 0"
                        :value="item.id"
                      >
                        {{ item.name }}
                      </option>
                    </select>
                    <label for="season">Сезон</label>
                  </div>
                  <hr />
                </div>
                <button
                  type="button"
                  @click="filterProducts"
                  class="btn btn-danger text-white w-100 fs-5 rounded-0"
                >
                  Применить фильтр
                </button>
              </form>
            </div>
            <div class="col-lg-9 col-12 my-5 my-lg-0">
              <!--                            <div class="az-seasons">-->
              <!--                                <div class="d-flex align-items-center">-->
              <!--                                    <nav class="seasons-title fs-6 me-3">-->
              <!--                                        Сезон:-->
              <!--                                    </nav>-->
              <!--                                    <div class="bg-gray d-flex">-->
              <!--                                        <nav :class="'season_' + index" v-for="(item, index) in seasons.length > 0 ? seasons[0].subcategories : []"-->
              <!--                                             :key="index" v-if="index !== 0">-->
              <!--                                            <input type="checkbox" @change="changeSeason($event, item.id)" class="btn-check" :id="'season_' + index" autocomplete="off">-->
              <!--                                            <label class="btn btn-outline-danger flt-seasons px-4" :for="'season_' + index">{{ item.name }}</label>-->
              <!--                                        </nav>-->
              <!--                                    </div>-->
              <!--                                </div>-->
              <!--                            </div>-->
              <div class="az-gender">
                <div class="d-flex align-items-center overflow-hidden">
                  <div class="d-flex align-items-center gender-title fs-6 me-3">
                    Тип:
                  </div>
                  <div class="row bg-gray w-100">
                    <div
                      class="col-12 col-sm px-0"
                      v-for="(item, index) in categories[0].subcategories"
                      :key="index"
                    >
                      <input
                        type="radio"
                        name="gender"
                        class="btn-check opacity-0"
                        :value="item.id"
                        v-model="productFilter.gender_id"
                        :id="`gender_` + index"
                        autocomplete="off"
                        @change="filterProducts"
                      />
                      <label
                        :for="`gender_` + index"
                        class="btn btn-outline-danger flt-seasons px-4 w-100"
                        >{{ item.name }}</label
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="az-products mt-5">
                <div class="product-news">
                  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
                    <div
                      class="col"
                      v-for="(item, index) in products"
                      :key="index"
                    >
                      <div
                        class="
                          card
                          bg-linear-light
                          cursor-pointer
                          border-0
                          pb-4
                          px-4
                        "
                      >
                        <img
                          :src="
                            item.image.length > 0
                              ? '/storage/' + item.image[0]['fileName']
                              : ''
                          "
                          class="mx-auto"
                          width="100%"
                          height="43.75%"
                          style="object-fit: cover"
                        />
                        <div class="card-body px-0">
                          <h5 class="card-title">{{ item.name }}</h5>
                          <h6 class="card-title">
                            {{
                              item.category_id == 4
                                ? "Мужские"
                                : item.category_id == 3
                                ? "Женские"
                                : item.category_id == 25
                                ? "Детские"
                                : ""
                            }}
                          </h6>
                          <nav class="card-text text-decoration-line-through">
                            {{ item.sale == 0 ? "" : item.price + " TJS" }}
                          </nav>
                          <span class="fs-4 text-uppercase"
                            >{{
                              item.price - item.price * (item.sale / 100)
                            }}
                            TJS</span
                          >
                        </div>
                        <div class="az-add-product justify-content-around">
                          <!--                                                    <img src="/images/icons/product_cart.svg" @click="addToCart(item.id)">-->
                          <button
                            type="button"
                            class="btn bg-brown text-white rounded-0 w-100"
                            @click="addToCart(item.id)"
                          >
                            Купить
                          </button>
                        </div>
                        <a
                          :href="route('show-product', item.slug)"
                          class="stretched-link"
                        ></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--        <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--        <div class="modal-dialog modal-xl  modal-dialog-centered modal-fullscreen-sm-down">-->
    <!--          <div class="modal-content rounded-0 ">-->
    <!--            <div class="modal-body">-->
    <!--                <div class="orders">-->
    <!--                    <div class="row" v-for="(item, index) in cart" :key="index">-->
    <!--                        <div class="col">-->
    <!--                            <div class="d-flex">-->
    <!--                                <img :src="'/storage/' + item.image[0]['fileName']" alt="" width="145px" class="me-4">-->
    <!--                                <nav class="d-flex flex-column">-->
    <!--                                    <h5>{{ item.name }}</h5>-->
    <!--                                    &lt;!&ndash; <span class="text-decoration-line-through">300 TJS</span> &ndash;&gt;-->
    <!--                                    <p class="fs-4 fw-bold">{{ item.price }} TJS</p>-->
    <!--                                    <span>Размер:</span>-->
    <!--                                    <span>{{ item.size }}</span>-->
    <!--                                </nav>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="col">-->
    <!--                            <div class="d-flex align-content-between flex-column justify-content-between h-100 my-3 my-lg-0">-->
    <!--                                <div class="d-flex align-items-lg-center justify-content-between">-->
    <!--                                    <span>Количество</span>-->
    <!--                                    <span>Цена</span>-->
    <!--                                    <span class="text-muted cursor-pointer" @click="removeCart({clear: true})">Очистить корзину</span>-->
    <!--                                </div>-->
    <!--                                <div class="d-flex align-items-lg-center justify-content-between">-->
    <!--                                    <div class="az-countable d-flex">-->
    <!--                                        <button type="button" @click="setQuantity('minus', item)" class="btn p-0 shadow-none" id="az-countable-minus">-->
    <!--                                            <img src="/images/icons/minus.svg" width="35" height="35">-->
    <!--                                        </button>-->
    <!--                                        <input type="number" disabled v-model="item.quantity" class="form-control border-0 mx-3 outline-fs-0 text-center fs-2 shadow-none w-50" id="az-countable-count" min="1" max="9999" value="1" step="1">-->
    <!--                                        <button type="button" @click="setQuantity('plus', item)" class="btn p-0 shadow-none" id="az-countable-plus">-->
    <!--                                            <img src="/images/icons/plus.svg" width="35" height="35">-->
    <!--                                        </button>-->
    <!--                                    </div>-->
    <!--                                    <h4 class="fw-bold">{{ item.price }} TJS</h4>-->
    <!--                                    <button type="button" @click="removeCart(item)" class="btn">-->
    <!--                                        <img src="/images/icons/trash.svg" alt="" srcset="">-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <hr class="mt-3">-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="row">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        &lt;!&ndash; <p>Lorem Ipsum is simply dummy text of the printing <br>-->
    <!--                            and typesetting text ever since the 1500s, </p> &ndash;&gt;-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        &lt;!&ndash; <nav class="text-decoration-line-through text-end">1100 TJs</nav> &ndash;&gt;-->
    <!--                        <nav class="fs-5 text-end">Cумма: <strong class="fs-4">{{ getSumm }} TJs</strong></nav>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="modal-footer border-0">-->
    <!--              <a :href="route('checkout')" class="btn btn-danger text-white  rounded-0 w-100 fs-4">Купить</a>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
export default {
  components: {
    AppLayout,
  },
  props: {
    productsData: Array,
    categories: Array,
    cartData: Object,
    q: String,
    categoryId: String,
  },
  data() {
    return {
      seasons: [],
      colors: [],
      productCategories: [],
      productFilter: {
        ajax: 1,
        price: 5000,
        color: 0,
        gender_id: 0,
        seasons: [],
        season: "",
        category: 0,
        size: 0,
        q: "",
      },
      products: {},
      cart: [],
      cartItemCount: 0,
    };
  },
  mounted() {
    if (this.categoryId) {
      this.productFilter.category = this.categoryId;
      this.filterProducts();
    } else {
      this.filterProducts();
    }
    this.productFilter.gender_id = this.categoryId;
    this.products = this.productsData;
    this.seasons = this.categories.filter((item) => item.resource === "season");
    this.colors = this.categories.filter((item) => item.resource === "colors");
    this.productCategories = this.categories.filter(
      (item) => item.resource === "products"
    );
    this.cart = this.cartData;
    this.productFilter.q = this.q;
    for (const [key, value] of Object.entries(this.cart)) {
      value.size_quantity.forEach((element) => {
        this.cartItemCount++;
      });
    }
  },
  watch: {
    cart: function () {
      this.cartItemCount = 0;
      for (const [key, value] of Object.entries(this.cart)) {
        value.size_quantity.forEach((element) => {
          this.cartItemCount++;
        });
      }
    },
  },
  methods: {
    //     addToCart(id) {
    //     event.target.firstChild.classList.add('cart-animate')
    //     axios.post(route('addToCart', id))
    //     .then((response)=> {
    //         this.cart = response.data.cart
    //         this.$swal({
    //             toast: true,
    //             position: 'top-end',
    //             showConfirmButton: false,
    //             timer: 2000,
    //             timerProgressBar: true,
    //             icon: 'success',
    //             title: 'Товар добавлен в корзину'
    //         })
    //     })
    // },
    // setQuantity(type, item) {
    //     if (type === 'minus' && item.quantity > 1) {
    //         axios.post(route('setQuantity', type), item)
    //         .then(response=> {
    //             this.cart = response.data.cart
    //         })
    //     } else if (type === 'plus' && item) {
    //         axios.post(route('setQuantity', type), item)
    //         .then(response=> {
    //             this.cart = response.data.cart
    //         })
    //     }
    // },
    // removeCart(item) {
    //     axios.post(route('removeCart'), item)
    //     .then(response=> {
    //         this.cart = response.data.cart
    //     })
    // },
    changeSeason($event, id) {
      if ($event.target.checked) {
        this.productFilter.seasons.push(id);
      } else {
        let index = this.productFilter.seasons.indexOf(id);
        this.productFilter.seasons.splice(index, 1);
      }
    },
    filterProducts() {
      // this.productFilter.season = this.productFilter.seasons.join()
      axios
        .get(route("filter"), { params: this.productFilter })
        .then((response) => {
          this.products = response.data.products;
        })
        .catch((error) => {
          console.log();
        });
    },
  },
  computed: {
    // getSumm() {
    //     let pc = 0;
    //     for (const [key, value] of Object.entries(this.cart)) {
    //         pc += (value.price * value.quantity)
    //     }
    //     return pc
    // }
  },
};
</script>
