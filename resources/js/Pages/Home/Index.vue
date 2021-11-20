<template>
  <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
    <section id="content">
      <div class="container">
        <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div
              :class="`carousel-item ${index === 0 && 'active'}`"
              data-bs-interval="10000"
              v-for="(slider, index) in sliders"
              :key="index"
            >
              <img
                :src="slider.image && '/storage/' + slider.image.fileName"
                class="d-block w-100"
                alt="..."
                style="max-height: 506px"
              />
              <div class="carousel-item-content col-6 text-white">
                <h1 class="display-5 text-uppercase">{{ slider.title }}</h1>
                <hr class="col-2 bg-white" />
                <p class="lead my-3" v-html="slider.short_desc"></p>
                <!-- <a
                  :href="slider.id == 1 ? '#product-news' : 'filter/4'"
                  class="btn btn-danger text-white rounded-0 py-3 px-5 mt-5"
                  type="button"
                  >Подробнее</a
                > -->
                <a
                  :href="'filter/' + slider.category_id"
                  class="btn btn-danger text-white rounded-0 py-3 px-5 mt-5"
                  type="button"
                  >Подробнее</a
                >
              </div>
            </div>
          </div>
          <div class="az-navs-slider az-navs-slider-custom">
            <a
              class="carousel-control-prev"
              href="#main-carousel"
              role="button"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a
              class="carousel-control-next"
              href="#main-carousel"
              role="button"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
        </div>

        
        <div id="main-category" class="mt-5">
          <div class="row row-cols-1 row-cols-lg-3 g-4">
            <div class="col">
              <div class="card h-100 border-0 bg-light">
                <div class="card-body py-4 px-5">
                  <h5 class="card-title"><strong>Мужские</strong> Товары</h5>
                  <p class="card-text">
                    Ботинки, кеды, мокасины, полуботинки сапоги, тапочки и
                    шлепанцы, туфли.
                  </p>
                  <a href="/filter/4" class="text-dark fw-bold stretched-link"
                    >Подробнее</a
                  >
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 border-0 bg-light">
                <div class="card-body py-4 px-5">
                  <h5 class="card-title"><strong>Женские</strong> Товары</h5>
                  <p class="card-text">
                    Ботинки, кеды, мокасины, полуботинки сапоги, тапочки и
                    шлепанцы, туфли.
                  </p>
                  <a href="/filter/3" class="text-dark fw-bold stretched-link"
                    >Подробнее</a
                  >
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 border-0 bg-light">
                <div class="card-body py-4 px-5">
                  <h5 class="card-title"><strong>Детские</strong> Товары</h5>
                  <p class="card-text">
                    Ботинки, кеды, мокасины, полуботинки сапоги, тапочки и
                    шлепанцы, туфли.
                  </p>
                  <a href="/filter/2" class="text-dark fw-bold stretched-link"
                    >Подробнее</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="divider"></div>
        <div class="az-products">
          <div class="product-news">
            <div class="az-title d-flex mb-5">
              <hr class="col-1 bg-dark me-4" />
              <h3>Новые товары</h3>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-5">
              <div
                class="col"
                v-for="(product, index) in lastProducts"
                v-bind:key="index"
              >
                <div
                  class="card bg-linear-light cursor-pointer border-0 pb-4 px-4"
                >
                  <img
                    :src="
                      product.image &&
                      '/storage/' + product.image[0]['fileName']
                    "
                    class="mx-auto"
                    width="100%"
                    height="43.75%"
                    style="object-fit: cover"
                  />
                  <div class="card-body px-0">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <h6 class="card-title">
                      {{
                        product.category_id == 4
                          ? "Мужские"
                          : product.category_id == 3
                          ? "Женские"
                          : product.category_id == 25
                          ? "Детские"
                          : ""
                      }}
                    </h6>
                    <nav class="card-text text-decoration-line-through">
                      {{ product.sale == 0 ? "" : product.price + " TJS" }}
                    </nav>
                    <span class="fs-4 text-uppercase"
                      >{{
                        product.price - product.price * (product.sale / 100)
                      }}
                      TJS</span
                    >
                  </div>
                  <div class="az-add-product justify-content-around">
                    <!--                                        <img src="/images/icons/product_cart.svg" @click="addToCart(product.id)">-->
                    <button
                      type="button"
                      class="btn bg-brown text-white rounded-0 w-100"
                      @click="addToCart(product.id)"
                    >
                      Купить
                    </button>
                  </div>
                  <a
                    :href="route('show-product', product.slug)"
                    class="stretched-link"
                  ></a>
                </div>
              </div>
            </div>
          </div>
          <div class="divider"></div>
          <div class="product-news" id="product-news">
            <div class="az-title d-flex mb-5">
              <hr class="col-1 bg-dark me-4" />
              <h3>Распродажа</h3>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-5">
              <div
                class="col"
                v-for="(product, index) in saleProducts"
                v-bind:key="index"
              >
                <div
                  class="card bg-linear-light border-0 cursor-pointer pb-4 px-4"
                >
                  <img
                    :src="
                      product.image &&
                      '/storage/' + product.image[0]['fileName']
                    "
                    class="mx-auto"
                    width="100%"
                    height="43.75%"
                    style="object-fit: cover"
                  />
                  <div class="card-body px-0">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <h6 class="card-title">
                      {{
                        product.category_id == 4
                          ? "Мужские"
                          : product.category_id == 3
                          ? "Женские"
                          : product.category_id == 25
                          ? "Детские"
                          : ""
                      }}
                    </h6>
                    <nav class="card-text text-decoration-line-through">
                      {{ product.sale == 0 ? "" : product.price + " TJS" }}
                    </nav>
                    <span class="fs-4 text-uppercase"
                      >{{
                        product.price - product.price * (product.sale / 100)
                      }}
                      TJS</span
                    >
                  </div>
                  <div class="az-add-product justify-content-around">
                    <!--                                        <img src="/images/icons/product_cart.svg" @click="addToCart(product.id)">-->
                    <button
                      type="button"
                      class="btn bg-brown text-white rounded-0 w-100"
                      @click="addToCart(product.id)"
                    >
                      Купить
                    </button>
                  </div>
                  <a
                    :href="route('show-product', product.slug)"
                    class="stretched-link"
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="divider"></div>
        <div class="az-title d-flex my-5"></div>
        <hr class="col-1 bg-dark me-4" />
        <h3>Кто носит нашу обувь</h3>
        <div
          id="carouselCustomers"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <ol class="carousel-indicators carousel-indicators-custom">
            <li
              data-bs-target="#carouselCustomers"
              data-bs-slide-to="0"
              class="active"
            ></li>
            <li data-bs-target="#carouselCustomers" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselCustomers" data-bs-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
              <div class="about--content">
                <div class="row align-items-center">
                  <div
                    class="col-lg-6 col-12 text-center mt-5 order-2 order-lg-1"
                  >
                    <span class="fs-6">Даниель Рустамов</span>
                    <p class="fs-2 mt-3 mb-5">
                      В чем состоит уникальность обуви?
                    </p>
                    <p>
                      Вы меня удивили ребята! Не знал, что в моем родном
                      Таджикистане делают такую качественную обувь.
                    </p>
                    <!--                                        <a href="#"-->
                    <!--                                           class="btn btn-outline-dark rounded-0 px-5">Подробнее</a>-->
                  </div>
                  <div
                    class="
                      col-lg-6 col-12
                      text-center text-lg-left
                      order-1 order-lg-2
                      mt-5
                    "
                  >
                    <img
                      src="../../../../storage/customers/photo_2021-02-25_19-25-25.jpg"
                      alt=""
                      class="img-custom-shadow"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <div class="about--content">
                <div class="row align-items-center">
                  <div
                    class="col-lg-6 col-12 text-center mt-5 order-2 order-lg-1"
                  >
                    <span class="fs-6">Хуршед Сатторов</span>
                    <p class="fs-2 mt-3 mb-5">
                      В чем состоит уникальность обуви?
                    </p>
                    <p>
                      У меня обуви много, но приобрести такую шикарную обувь
                      ручной работы захотелось мне сразу, как увидел.
                    </p>
                    <!--                                        <a href="#"-->
                    <!--                                           class="btn btn-outline-dark rounded-0 px-5">Подробнее</a>-->
                  </div>
                  <div
                    class="
                      col-lg-6 col-12
                      text-center text-lg-left
                      order-1 order-lg-2
                      mt-5
                    "
                  >
                    <img
                      src="../../../../storage/customers/photo_2021-02-25_19-25-31.jpg"
                      alt=""
                      class="img-custom-shadow"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <div class="about--content">
                <div class="row align-items-center">
                  <div
                    class="col-lg-6 col-12 text-center mt-5 order-2 order-lg-1"
                  >
                    <span class="fs-6">Далер Гуфронов</span>
                    <p class="fs-2 mt-3 mb-5">
                      В чем состоит уникальность обуви?
                    </p>
                    <p>
                      Я один из первых ваших клиентов, который купил сапоги.
                      После того, как поносил сезон, понял, что надо купить и
                      туфли и не одни.
                    </p>
                    <!--                                        <a href="#"-->
                    <!--                                           class="btn btn-outline-dark rounded-0 px-5">Подробнее</a>-->
                  </div>
                  <div
                    class="
                      col-lg-6 col-12
                      text-center text-lg-left
                      order-1 order-lg-2
                      mt-5
                    "
                  >
                    <img
                      src="../../../../storage/customers/photo_2021-02-25_19-25-34.jpg"
                      alt=""
                      class="img-custom-shadow"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--                    <a class="carousel-control-prev carousel-control-prev-custom" href="#carouselCustomers" role="button" data-bs-slide="prev">-->
          <!--                        <span class="carousel-control-prev-icon carousel-control-prev-icon-custom" aria-hidden="true"></span>-->
          <!--                        <span class="visually-hidden">Previous</span>-->
          <!--                    </a>-->
          <!--                    <a class="carousel-control-next carousel-control-next-custom" href="#carouselCustomers" role="button" data-bs-slide="next">-->
          <!--                        <span class="carousel-control-next-icon carousel-control-next-icon-custom" aria-hidden="true"></span>-->
          <!--                        <span class="visually-hidden">Next</span>-->
          <!--                    </a>-->
        </div>
        <div class="divider"></div>

        <!--                <div class="az-about" v-if="shoes">-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-12">-->
        <!--                            <div class="az-title d-flex my-5">-->
        <!--                                <hr class="col-1 bg-dark me-4">-->
        <!--                                <h3>Кто носит нашу обувь</h3>-->
        <!--                            </div>-->
        <!--                            <div class="about&#45;&#45;content">-->
        <!--                                <div class="row  align-items-center">-->
        <!--                                    <div class="col-lg-6 col-12 text-center mt-5 order-2 order-lg-1">-->
        <!--                                        <span class="fs-6" v-html="shoes.short_desc"></span>-->
        <!--                                        <p class="fs-2 mt-3 mb-5" v-html="shoes.title"></p>-->
        <!--                                        <a :href="route('news', shoes.slug)"-->
        <!--                                           class="btn btn-outline-dark rounded-0 px-5">Подробнее</a>-->
        <!--                                    </div>-->
        <!--                                    <div class="col-lg-6 col-12 text-center  text-lg-left order-1 order-lg-2 mt-5">-->
        <!--                                        <img :src="'/storage/' + shoes.image['fileName']" alt=""-->
        <!--                                             class="img-custom-shadow img-fluid" width="487" height="484">-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <div class="az-partners">
          <div class="az-title d-flex my-5">
            <hr class="col-1 bg-dark me-4" />
            <h3>Наши Партнёры</h3>
          </div>
          <!--                    <div class="row row-cols-1 row-cols-md-3 g-4">-->
          <!--                        <div class="col" v-for="(patrtner, index) in patrtners" v-bind:key="index">-->
          <!--                            <div class="card mb-3 border-0">-->
          <!--                                <div class="row">-->
          <!--                                    <div class="col-md-4">-->
          <!--                                        <img :src="patrtner.image && '/storage/' + patrtner.image.fileName" alt="..."-->
          <!--                                             width="160" class="img-fluid">-->
          <!--                                    </div>-->
          <!--                                    <div class="col-md-8">-->
          <!--                                        <div class="card-body ps-4">-->
          <!--                                            <h5 class="card-title">{{ patrtner.name }}</h5>-->
          <!--                                            <a :href="patrtner.link" class="stretched-link"></a>-->
          <!--                                        </div>-->
          <!--                                    </div>-->
          <!--                                </div>-->
          <!--                            </div>-->
          <!--                        </div>-->
          <!--                    </div>-->
          <div class="row align-items-center">
            <div class="col-12 col-sm-6 col-lg-3">
              <a href="https://iamdifferent.store/" target="_blank"
                ><img
                  src="../../../../storage/partners/0000682.png"
                  class="partnerImg"
                  alt=""
              /></a>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <a href="http://www.apost.tj/" target="_blank"
                ><img
                  src="../../../../storage/partners/photo_2021-02-25_18-08-44.jpg"
                  class="partnerImg"
                  alt=""
              /></a>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <a href="facebook.com/auchantadjikistan/" target="_blank"
                ><img
                  src="../../../../storage/partners/photo_2021-02-25_18-08-48.jpg"
                  class="partnerImg"
                  alt=""
              /></a>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <a href="https://colibri.tj/" target="_blank"
                ><img
                  src="../../../../storage/partners/photo_2021-02-25_18-08-56.jpg"
                  class="partnerImg"
                  alt=""
              /></a>
            </div>
          </div>
        </div>
        <div class="az-stay-partners">
          <div class="az-title d-flex my-5">
            <hr class="col-1 bg-dark me-4" />
            <h3>Cтать партнёром</h3>
          </div>
          <div class="row justify-content-between">
            <div class="col-lg-6 col-12">
              <div class="bg-light px-5 py-4 h-100">
                <h3 class="fs-2 mb-3">Как стать нашим партнером</h3>
                <p class="lh-lg" style="font-size: 18px">
                  Если хотите сотрудничать с нами, оставьте контакты, наш
                  менеджер свяжется с вами.
                </p>
              </div>
            </div>
            <div class="col-lg-5 col-12">
              <form action="" class="">
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    v-model="bid.name"
                    class="form-control feedback-input"
                    id="name"
                    placeholder="Введите имя"
                  />
                  <label for="name">Имя</label>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    v-model="bid.city"
                    class="form-control feedback-input"
                    id="city"
                    placeholder="Введите город"
                  />
                  <label for="city">Город</label>
                </div>
                <div class="form-floating mb-5">
                  <input
                    type="text"
                    v-model="bid.phone"
                    class="form-control feedback-input"
                    id="phone"
                    maxlength="9"
                    placeholder="Введите номер телефона"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                  />
                  <label for="phone">Контакты</label>
                </div>
                <button
                  type="button"
                  @click="sendBid"
                  :disabled="!showBidButton"
                  class="btn btn-dark rounded-0 w-100 py-3"
                >
                  Подать заявку
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="divider"></div>
        <div class="az-stay-partners">
          <div class="az-title d-flex my-5 text-center justify-content-center">
            <hr class="col-1 bg-dark me-4" />
            <h3>Наши магазины</h3>
            <hr class="col-1 bg-dark ms-4" />
          </div>
          <ul class="nav nav-pills contact mb-3" id="pills-tab" role="tablist">
            <li class="nav-item col-3 text-center" role="presentation">
              <a
                class="nav-link active az-nav-link fs-5 rounded-0"
                id="pills-home-tab"
                data-bs-toggle="pill"
                href="#pills-home"
                role="tab"
                aria-controls="pills-home"
                aria-selected="true"
                >г.Худжанд</a
              >
            </li>
            <li class="nav-item col-3 text-center" role="presentation">
              <a
                class="nav-link az-nav-link fs-5 rounded-0"
                id="pills-profile-tab"
                data-bs-toggle="pill"
                href="#pills-profile"
                role="tab"
                aria-controls="pills-profile"
                aria-selected="false"
                >г.Душанбе</a
              >
            </li>
            <li class="nav-item col-3 text-center" role="presentation">
              <!--                            <a class="nav-link az-nav-link fs-5 rounded-0" id="pills-contact-tab" data-bs-toggle="pill"-->
              <!--                               :href="route('contacts')" role="tab" aria-controls="pills-contact" aria-selected="false" >Другие</a>-->
              <a
                :href="route('contacts')"
                class="nav-link az-nav-link fs-5 rounded-0"
                >Другие</a
              >
            </li>
          </ul>
          <div class="divider d-none d-lg-block"></div>
          <div class="tab-content mt-5" id="pills-tabContent">
            <div
              class="tab-pane fade show active"
              id="pills-home"
              role="tabpanel"
              aria-labelledby="pills-home-tab"
            >
              <div class="row">
                <div class="col-12 col-lg-6">
                  <img
                    src="/images/azam-khujand.jpg"
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
                      <h3 class="">Магазин AZAM “Худжанд”</h3>
                      <nav class="nav flex-column">
                        <span
                          class="nav-link disabled px-0"
                          tabindex="-1"
                          aria-disabled="true"
                          >Адрес: ул. Б. Гафурова (рядом с Сомон базаром)</span
                        >
                        <a
                          class="nav-link link-secondary px-0"
                          aria-current="page"
                          href="tel:+992929941010"
                          >Телефон: +992 92 994 10 10</a
                        >
                        <a
                          class="nav-link link-secondary px-0"
                          href="tel:+992929941010"
                          >Контакты для сотрудничество: +992 92 994 10 10
                        </a>
                        <a
                          class="nav-link link-secondary px-0"
                          href="mailto:info@azam.tj"
                        >
                          E-mail: info@azam.tj
                        </a>
                      </nav>
                    </nav>
                  </div>
                </div>
              </div>
              <div class="divider"></div>
              <div class="az-maps">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1567.3099963408815!2d69.69685094459135!3d40.24500839120153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b053a84d067391%3A0x16e58f3aca717e24!2zQXphbSBCdXN0b24gKNCQ0LfQsNC8INCl0YPQtNC20LDQvdC0KQ!5e0!3m2!1sru!2s!4v1614160471096!5m2!1sru!2s"
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
            <div
              class="tab-pane fade"
              id="pills-profile"
              role="tabpanel"
              aria-labelledby="pills-profile-tab"
            >
              <div class="row">
                <div class="col-12 col-lg-6">
                  <img
                    src="/images/azam-dushanbe.jpg"
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
                      <h3 class="">Магазин AZAM “Душанбе”</h3>
                      <nav class="nav flex-column">
                        <span
                          class="nav-link disabled px-0"
                          tabindex="-1"
                          aria-disabled="true"
                          >Адрес: Улица Айни 14/2</span
                        >
                        <a
                          class="nav-link link-secondary px-0"
                          aria-current="page"
                          href="tel:+992921994010"
                          >Телефон: +992 92 994 10 10</a
                        >
                        <a
                          class="nav-link link-secondary px-0"
                          href="tel:+992929941010"
                          >Контакты для сотрудничество: +992 92 994 10 10
                        </a>
                        <a
                          class="nav-link link-secondary px-0"
                          href="mailto:info@azam.tj"
                        >
                          E-mail: info@azam.tj
                        </a>
                      </nav>
                    </nav>
                  </div>
                </div>
              </div>
              <div class="divider"></div>
              <div class="az-maps">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3119.7835569145163!2d68.78648316854786!3d38.56180034380349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b5d140f16aaaab%3A0xc3379b28f98a6386!2sAzam!5e0!3m2!1sen!2s!4v1609238006068!5m2!1sen!2s"
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
            <div
              class="tab-pane fade"
              id="pills-contact"
              role="tabpanel"
              aria-labelledby="pills-contact-tab"
            ></div>
          </div>
        </div>
        <!--                <div class="divider"></div>-->
        <!--                <div class="az-maps">-->
        <!--                    <iframe-->
        <!--                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3119.7835569145163!2d68.78648316854786!3d38.56180034380349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b5d140f16aaaab%3A0xc3379b28f98a6386!2sAzam!5e0!3m2!1sen!2s!4v1609238006068!5m2!1sen!2s"-->
        <!--                        style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" width="100%" height="450"-->
        <!--                        frameborder="0"></iframe>-->
        <!--                </div>-->
        <!--                <div class="divider"></div>-->
      </div>
    </section>
    <!--        <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--            <div class="modal-dialog modal-xl  modal-dialog-centered modal-fullscreen-sm-down">-->
    <!--                <div class="modal-content rounded-0 ">-->
    <!--                    <div class="modal-body">-->
    <!--                        <div class="orders">-->
    <!--                            <div class="row" v-for="(item, index) in cart" :key="index">-->
    <!--                                <div class="col">-->
    <!--                                    <div class="d-flex">-->
    <!--                                        <img :src="'/storage/' + item.image[0]['fileName']" alt="" width="145px"-->
    <!--                                             class="me-4">-->
    <!--                                        <nav class="d-flex flex-column">-->
    <!--                                            <h5>{{ item.name }}</h5>-->
    <!--                                            &lt;!&ndash; <span class="text-decoration-line-through">300 TJS</span> &ndash;&gt;-->
    <!--                                            <p class="fs-4 fw-bold">{{ item.price }} TJS</p>-->
    <!--                                            <span>Размер:</span>-->
    <!--                                            <span>{{ item.size }}</span>-->
    <!--                                        </nav>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="col">-->
    <!--                                    <div-->
    <!--                                        class="d-flex align-content-between flex-column justify-content-between h-100 my-3 my-lg-0">-->
    <!--                                        <div class="d-flex align-items-lg-center justify-content-between">-->
    <!--                                            <span>Количество</span>-->
    <!--                                            <span>Цена</span>-->
    <!--                                            <span class="text-muted cursor-pointer" @click="removeCart({clear: true})">Очистить корзину</span>-->
    <!--                                        </div>-->
    <!--                                        <div class="d-flex align-items-lg-center justify-content-between">-->
    <!--                                            <div class="az-countable d-flex">-->
    <!--                                                <button type="button" @click="setQuantity('minus', item)"-->
    <!--                                                        class="btn p-0 shadow-none" id="az-countable-minus">-->
    <!--                                                    <img src="/images/icons/minus.svg" width="35" height="35">-->
    <!--                                                </button>-->
    <!--                                                <input type="number" disabled v-model="item.quantity"-->
    <!--                                                       class="form-control border-0 mx-3 outline-fs-0 text-center fs-2 shadow-none w-50"-->
    <!--                                                       id="az-countable-count" min="1" max="9999" value="1" step="1">-->
    <!--                                                <button type="button" @click="setQuantity('plus', item)"-->
    <!--                                                        class="btn p-0 shadow-none" id="az-countable-plus">-->
    <!--                                                    <img src="/images/icons/plus.svg" width="35" height="35">-->
    <!--                                                </button>-->
    <!--                                            </div>-->
    <!--                                            <h4 class="fw-bold">{{ item.price }} TJS</h4>-->
    <!--                                            <button type="button" @click="removeCart(item)" class="btn">-->
    <!--                                                <img src="/images/icons/trash.svg" alt="" srcset="">-->
    <!--                                            </button>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <hr class="mt-3">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="row">-->
    <!--                            <div class="col-lg-6">-->
    <!--                                &lt;!&ndash; <p>Lorem Ipsum is simply dummy text of the printing <br>-->
    <!--                                    and typesetting text ever since the 1500s, </p> &ndash;&gt;-->
    <!--                            </div>-->
    <!--                            <div class="col-lg-6">-->
    <!--                                &lt;!&ndash; <nav class="text-decoration-line-through text-end">1100 TJs</nav> &ndash;&gt;-->
    <!--                                <nav class="fs-5 text-end">Cумма: <strong class="fs-4">{{ getSumm }} TJs</strong></nav>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="modal-footer border-0">-->
    <!--                        <a :href="route('checkout')" class="btn btn-danger rounded-0 w-100 fs-4">Купить</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
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
    lastProducts: Array,
    saleProducts: Array,
    patrtners: Array,
    sliders: Array,
    shoes: Object,
    cartData: Object,
  },
  data() {
    return {
      showBidButton: true,
      bid: {
        name: "",
        phone: "",
        city: "",
      },
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
  methods: {
    // addToCart(id) {
    //     event.target.firstChild.classList.add('cart-animate')
    //     axios.post(route('addToCart', id))
    //         .then((response) => {
    //             this.cart = response.data.cart
    //             this.$swal({
    //                 toast: true,
    //                 position: 'top-end',
    //                 showConfirmButton: false,
    //                 timer: 2000,
    //                 timerProgressBar: true,
    //                 icon: 'success',
    //                 title: 'Товар добавлен в корзину'
    //             })
    //         })
    // },
    // setQuantity(type, item) {
    //     if (type === 'minus' && item.quantity > 1) {
    //         axios.post(route('setQuantity', type), item)
    //             .then(response => {
    //                 this.cart = response.data.cart
    //             })
    //     } else if (type === 'plus' && item) {
    //         axios.post(route('setQuantity', type), item)
    //             .then(response => {
    //                 this.cart = response.data.cart
    //             })
    //     }
    // },
    // removeCart(item) {
    //     axios.post(route('removeCart'), item)
    //         .then(response => {
    //             this.cart = response.data.cart
    //         })
    // },
    sendBid() {
      if (!(this.bid.name && this.bid.phone.length === 9 && this.bid.city)) {
        this.$swal({
          position: "top-end",
          icon: "error",
          title: "Введите корректные данные",
          showConfirmButton: true,
          timer: 2000,
        });
        return 0;
      }

      this.showBidButton = false;

      axios
        .post(route("partner-bid-save"), this.bid)
        .then((response) => {
          this.$swal({
            position: "top-end",
            icon: "success",
            title: response.data.message,
            showConfirmButton: true,
            timer: 2000,
          });
        })
        .catch((error) => {
          this.$swal({
            position: "top-end",
            icon: "error",
            title: "Введите корректные данные",
            showConfirmButton: true,
            timer: 2000,
          });
          this.showBidButton = true;
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
