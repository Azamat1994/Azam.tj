<template>
  <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
    <section id="contain">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-5">
            <li class="breadcrumb-item">
              <a :href="route('home')">Главная</a>
            </li>
            <li class="breadcrumb-item active text-danger" aria-current="page">
              Контакты
            </li>
          </ol>
        </nav>
        <div class="az-stay-partners">
          <div class="az-title d-flex my-5 text-center justify-content-center">
            <hr class="col-1 bg-dark me-4" />
            <h3>Наши магазины</h3>
            <hr class="col-1 bg-dark ms-4" />
          </div>
          <div v-for="(shop, id) in shops" :key="id" class="store">
            <div class="divider d-none d-lg-block"></div>
            <div
              class="az-title d-flex my-5 text-center justify-content-center"
            >
              <h3 v-text="shop.city">Г. Худжанд</h3>
            </div>
            <div class="divider d-none d-lg-block"></div>
            <div class="tab-content mt-5" id="pills-tabContent">
              <div
                class="tab-pane fade show active"
                id="pills-adress1"
                role="tabpanel"
                aria-labelledby="pills-adress1"
              >
                <div class="row">
                  <div class="col-12 col-lg-6">
                    <img
                      :src="'/storage/' + shop.picture.fileName"
                      alt=""
                      class="img-custom-shadow-start d-none d-lg-block"
                      style="
                        height: 400px;
                        overflow: hidden;
                        object-fit: cover;
                        width: 95%;
                      "
                    />
                  </div>
                  <div class="col-12 col-lg-6">
                    <div
                      class="
                        d-flex
                        flex-column
                        justify-content-between
                        h-100
                        mt-5 mt-lg-0
                      "
                    >
                      <nav>
                        <h3 v-text="shop.name" class="">
                          Магазин AZAM “Худжанд”
                        </h3>
                        <nav class="nav flex-column">
                          <span
                            class="nav-link disabled px-0"
                            tabindex="-1"
                            aria-disabled="true"
                            >Адрес: {{ shop.address }}</span
                          >
                          <a
                            class="nav-link link-secondary px-0"
                            aria-current="page"
                            href="tel:+992929941010"
                            >Телефон: {{ shop.phone }}</a
                          >
                          <a
                            class="nav-link link-secondary px-0"
                            href="tel:+992929941010"
                            >Контакты для сотрудничество: {{ shop.phone }}
                          </a>
                          <a
                            class="nav-link link-secondary px-0"
                            href="mailto:info@azam.tj"
                          >
                            E-mail: {{ shop.email }}
                          </a>
                        </nav>
                      </nav>
                    </div>
                  </div>
                </div>
                <div class="divider"></div>
                <div v-html="shop.link" class="az-maps">
                  <iframe
                    :src="shop.link"
                    style="border: 0"
                    allowfullscreen=""
                    aria-hidden="false"
                    tabindex="0"
                    width="100%"
                    height="450"
                    frameborder="0"
                  ></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--         <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
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
    <!--        </div>-->
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
export default {
  components: {
    AppLayout,
  },
  props: {
    cartData: Object,
    abouts: Array,
    shops: Array,
  },
  data() {
    return {
      cart: [],
      cartItemCount: 0,
    };
  },
  mounted() {
    this.cart = this.cartData;
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
};
</script>
