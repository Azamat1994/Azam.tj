<template>
  <app-layout class="wrapper" :cart="cartItemCount">
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb my-5">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item" aria-current="page">Категории</li>
                <li
                  class="breadcrumb-item"
                  v-if="product.category"
                  aria-current="page"
                >
                  {{ product.category.name }}
                </li>
                <li
                  class="breadcrumb-item active text-danger"
                  aria-current="page"
                >
                  {{ product.name }}
                </li>
              </ol>
            </nav>
          </div>
          <div class="col-12 col-lg-6">
            <nav class="my-5 text-end">Артикул: {{ product.articul }}</nav>
          </div>
          <div class="az-single">
            <div class="row">
              <div class="col-12 col-lg-6">
                <!--                                <img :src="product.image[0]['fileName'] && '/storage/'+product.image[0]['fileName']" alt="" class="img-fluid" width="350" height="350">-->
                <img
                  :src="'/storage/' + product.image[mainImageInd]['fileName']"
                  id="mainImage"
                  alt=""
                  class="img-fluid"
                  width="90%"
                  height="350"
                  data-bs-toggle="modal"
                  data-bs-target="#imgModal"
                />
                <div
                  class="
                    az-single-gallery
                    d-flex
                    mt-3
                    flex-wrap
                    justify-content-between
                  "
                  style="width: 90%"
                >
                  <img
                    :src="item['fileName'] && '/storage/' + item['fileName']"
                    class="mb-3"
                    height="76"
                    v-for="(item, index) in product.image"
                    :key="index"
                    @click="mainImageInd = index"
                  />
                  <!--                                    @click="mainImageChange(item['fileName'] && '/storage/'+item['fileName'])">-->
                </div>
              </div>
              <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                <h1 class="display-3 mb-4">{{ product.name }}</h1>
                <!-- <span class="text-decoration-line-through fs-5">{{ product.price }} TJS</span> -->
                <h2>
                  {{ product.price - product.price * (product.sale / 100) }} TJS
                </h2>
                <div class="az-single-params my-4">
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <h5>Выбор цвета:</h5>
                      <label for="color-red" class="me-2">
                        <input
                          class="form-check-input visually-hidden"
                          type="radio"
                          id="color-red"
                          value="red"
                          name="color"
                        />
                        <span
                          class="cursor-pointer border az-params-colors d-block"
                          >{{ product.color.name }}</span
                        >
                      </label>
                    </div>
                    <div v-if="accessories" class="col-lg-6 col-12">
                      <h5>Выбор размера:</h5>
                      <select
                        class="form-select"
                        name="size"
                        id="size"
                        v-model.number="size"
                        v-model="btnChangesWatch"
                      >
                        <option selected disabled>Выберите размер</option>
                        <option
                          v-for="item in sizes"
                          :key="item.size"
                          :value="item.size"
                          :class="item.quantity > 0 ? '' : 'text-danger'"
                        >
                          {{ item.size }}
                          {{ item.quantity > 0 ? "" : "нет в наличии" }}
                        </option>
                      </select>
                      <span v-if="valSize" style="color: red"
                        >Выберите размер</span
                      >
                    </div>
                    <!-- <div class="col-lg-6 col-12">
                      <h5>Раздел:</h5>
                      <label for="color-red" class="me-2">
                        {{
                          product.category_id == 4
                            ? "Мужские"
                            : product.category_id == 3
                            ? "Женские"
                            : product.category_id == 25
                            ? "Детские"
                            : ""
                        }}
                      </label>
                    </div> -->
                  </div>
                </div>
                <div class="az-countable d-flex my-3 w-50">
                  <!--                                    <button  @click="setQuantity('minus', cart[product.id])" type="button" class="btn p-0 shadow-none" id="az-countable-minus">-->
                  <button
                    @click="pcount--"
                    type="button"
                    class="btn p-0 shadow-none"
                    id="az-countable-minus"
                    :disabled="pcount <= 1"
                  >
                    <img src="/img/icons/minus.svg" width="35" height="35" />
                  </button>
                  <input
                    type="number"
                    disabled
                    v-model="pcount"
                    class="
                      form-control
                      border-0
                      outline-fs-0
                      text-center
                      fs-2
                      shadow-none
                      hide-arrows
                    "
                    id="az-countable-count"
                    min="1"
                    step="1"
                  />
                  <!--                                    <button @click="setQuantity('plus', cart[product.id])" type="button"-->
                  <!--                                            class="btn p-0 shadow-none" id="az-countable-plus">-->
                  <button
                    @click="pcount++"
                    type="button"
                    class="btn p-0 shadow-none"
                    id="az-countable-plus"
                  >
                    <img src="/img/icons/plus.svg" width="35" height="35" />
                  </button>
                </div>
                <div v-if="btnChange" class="az-prdouct-payments d-flex">
                  <!--                                    <button type="button" class="btn btn-danger text-white px-5 fs-5 rounded-0 me-3"-->
                  <!--                                            @click="addToCartCustom(product.id)">Купить-->
                  <!--                                    </button>-->
                  <!--                                    <a :href="route('checkout')" class="btn btn-dark rounded-0">-->
                  <!--                                        <img src="/img/icons/cart.svg" alt="" srcset="" width="35">-->
                  <!--                                    </a>-->
                  <a
                    id="checkout"
                    @click="
                      $page.props.user ? addToCart(product.id, pcount) : ''
                    "
                    class="btn btn-danger text-white px-5 fs-5 rounded-0 me-3"
                    data-bs-toggle="modal"
                    :data-bs-target="$page.props.user ? '#cart' : '#auth'"
                  >
                    Купить
                  </a>

                  <button
                    @click="addToCartCustom(product.id, pcount, size)"
                    type="button"
                    class="btn btn-dark rounded-0"
                  >
                    <img
                      src="/img/icons/cart.svg"
                      alt=""
                      srcset=""
                      width="35"
                    />
                  </button>
                </div>

                <div
                  v-if="btnChange === false"
                  class="az-prdouct-payments d-flex"
                >
                  <a
                    @click="btnChanges"
                    id="checkout"
                    class="btn btn-danger text-white px-5 fs-5 rounded-0 me-3"
                    :data-bs-target="$page.props.user ? '#cart' : '#auth'"
                  >
                    Купить
                  </a>

                  <button
                    type="button"
                    @click="addToCartCustom(product.id, pcount, size)"
                    class="btn btn-dark rounded-0"
                  >
                    <img
                      src="/img/icons/cart.svg"
                      alt=""
                      srcset=""
                      width="35"
                    />
                  </button>
                </div>

                <div class="d-flex align-items-center mt-4">
                  <h2>Поделиться:</h2>
                  <a
                    :href="
                      'http://www.facebook.com/sharer.php?p[title]=' +
                      encodeURI(product.name) +
                      'amp;p[summary]=' +
                      encodeURI(product.description) +
                      '&amp;p[url]=' +
                      encodeURI(route('home') + this.$page.url) +
                      '&amp;p[images][0]=' +
                      encodeURI(
                        route('home') +
                          '/storage/' +
                          product.image['0'].fileName
                      )
                    "
                  >
                    <svg
                      style="margin-left: 15px"
                      width="42"
                      height="42"
                      viewBox="0 0 42 42"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M20.9999 0C32.5986 0 42 9.40274 42 21.0001C42 32.5987 32.5986 42 20.9999 42C9.4013 42 0 32.5986 0 21.0001C0 9.40274 9.40145 0 20.9999 0Z"
                        fill="#3B5998"
                      />
                      <path
                        d="M23.5569 14.4571H26.2632V10.4592H23.0818V10.4736C19.2269 10.6102 18.4369 12.7771 18.3672 15.053H18.3593V17.0493H15.7344V20.9645H18.3593V31.4592H22.3152V20.9645H25.5558L26.1818 17.0493H22.3165V15.8432C22.3165 15.074 22.8284 14.4571 23.5569 14.4571Z"
                        fill="white"
                      />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            <div class="az-details">
              <div class="row">
                <div class="col-12">
                  <ul
                    class="nav nav-pills mb-3 az-product-details"
                    id="pills-tab"
                    role="tablist"
                  >
                    <li class="nav-item me-3" role="presentation">
                      <a
                        class="nav-link active fs-5 rounded-0 ps-0"
                        id="pills-type-tab"
                        data-bs-toggle="pill"
                        href="#pills-type"
                        role="tab"
                        aria-controls="pills-type"
                        aria-selected="true"
                        >Описание</a
                      >
                    </li>
                    <!--                                        <li class="nav-item me-3" role="presentation">-->
                    <!--                                            <a class="nav-link fs-5 rounded-0 ps-0" id="pills-outsole-tab" data-bs-toggle="pill" href="#pills-outsole" role="tab" aria-controls="pills-outsole" aria-selected="false">Подошва</a>-->
                    <!--                                        </li>-->
                    <!--                                        <li class="nav-item me-3" role="presentation">-->
                    <!--                                            <a class="nav-link fs-5 rounded-0 ps-0" id="pills-girth-tab" data-bs-toggle="pill" href="#pills-girth" role="tab" aria-controls="pills-girth" aria-selected="false">Обхват</a>-->
                    <!--                                        </li>-->
                    <li class="nav-item me-3" role="presentation">
                      <a
                        class="nav-link fs-5 rounded-0 ps-0"
                        id="pills-season-tab"
                        data-bs-toggle="pill"
                        href="#pills-season"
                        role="tab"
                        aria-controls="pills-contact"
                        aria-selected="false"
                        >Сезон</a
                      >
                    </li>
                  </ul>
                  <hr />
                  <div class="tab-content" id="pills-tabContent">
                    <div
                      v-html="product.description"
                      class="tab-pane fade show active"
                      id="pills-type"
                      role="tabpanel"
                      aria-labelledby="pills-type-tab"
                      style="white-space: normal"
                    >
                      <!-- {{product.description}} -->
                    </div>
                    <!--                                        <div class="tab-pane fade lh-lg" id="pills-outsole" role="tabpanel" aria-labelledby="pills-outsole-tab">-->
                    <!--                                           -->
                    <!--                                        </div>-->
                    <!--                                        <div class="tab-pane fade lh-lg" id="pills-girth" role="tabpanel" aria-labelledby="pills-girth-tab">-->
                    <!--                                            -->
                    <!--                                        </div>-->
                    <div
                      class="tab-pane fade"
                      id="pills-season"
                      role="tabpanel"
                      aria-labelledby="pills-season-tab"
                      style="white-space: normal"
                    >
                      {{ product.season.name }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="divider"></div>
            <div>
              <h3 class="mb-5">Отзывы</h3>
              <div class="leave_comments">
                <textarea
                  v-model="newComment.text"
                  class="w-100 p-2 mb-2"
                  name=""
                  id=""
                  rows="5"
                  placeholder="Оставьте отзыв"
                ></textarea>
                <button
                  @click="addComment()"
                  class="w-100 mb-3 text-white bg-danger comment-btn"
                  data-bs-toggle="modal"
                  :data-bs-target="$page.props.user ? '' : '#auth'"
                >
                  ОСТАВИТЬ ОТЗЫВ
                </button>
              </div>
              <div
                class="comments_item p-4"
                v-for="(item, index) in allComments"
                :key="index"
              >
                <div class="w-100 fw-bold d-flex justify-content-between">
                  <div class="mb-2">
                    {{ item.user.name }}
                  </div>
                  <div class="fw-light text-muted ml-4">
                    {{ item.created_at.substring(0, 10) }}
                  </div>
                </div>
                <div class="text-muted">
                  {{ item.text }}
                </div>
              </div>
            </div>
            <div class="az-recomends-products">
              <div class="product-news">
                <div class="az-title d-flex mb-5">
                  <hr class="col-1 bg-dark me-4" />
                  <h5>Рекомендуемые товары</h5>
                </div>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                  <div
                    class="col"
                    v-for="(item, index) in recomended"
                    :key="index"
                  >
                    <div
                      class="
                        card
                        bg-light
                        recomends-products
                        cursor-pointer
                        border-0
                        p-4
                        pt-4
                      "
                    >
                      <img
                        :src="'/storage/' + item.image[0]['fileName']"
                        class="mx-auto img-fluid"
                        width="211.48"
                        height="225.78"
                      />
                      <button
                        class="
                          btn btn-danger
                          rounded-0
                          fw-bold
                          position-absolute
                          top-0
                          end-0
                          translate-middle
                          text-white
                        "
                        type="button"
                        v-if="item.sale"
                      >
                        {{ item.sale }}% OFF
                      </button>
                      <div class="card-body">
                        <h5 class="card-title">
                          <a
                            class="text-dark"
                            :href="route('show-product', item.slug)"
                            >{{ item.name }}</a
                          >
                        </h5>
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
                        <nav
                          v-if="item.sale > 0"
                          class="card-text text-decoration-line-through"
                        >
                          {{ item.price }} TJS
                        </nav>
                        <span class="fs-4 text-uppercase"
                          >{{
                            item.price - item.price * (item.sale / 100)
                          }}
                          TJS</span
                        >
                      </div>
                      <div class="az-add-product justify-content-around">
                        <!--                                                <img src="/images/icons/product_cart.svg" @click="addToCart(item.id)">-->
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
    </section>
    <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
      <div
        class="modal-dialog modal-dialog-centered"
        style="width: 100%; max-width: 1000px"
      >
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <img
              :src="'/storage/' + product.image[mainImageInd]['fileName']"
              alt=""
              width="100%"
            />
          </div>
          <div class="modal-footer">
            <div style="width: 100%; height: 60px"></div>
            <div class="az-navs-slider" style="bottom: 70px !important">
              <a
                class="carousel-control-prev"
                role="button"
                data-bs-slide="prev"
                @click="
                  mainImageInd === 0
                    ? (mainImageInd = product.image.length - 1)
                    : mainImageInd--
                "
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </a>
              <a
                @click="
                  mainImageInd === product.image.length - 1
                    ? (mainImageInd = 0)
                    : mainImageInd++
                "
                class="carousel-control-next"
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
        </div>
      </div>
    </div>
    <div class="modal fade" id="auth" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div>
                <div class="card rounded-0 auth-card">
                  <div class="card-body p-lg-5">
                    <div class="alert alert-danger" role="alert" v-if="message">
                      {{ message }}
                    </div>
                    <h2 class="card-title fw-bold">Вход</h2>
                    <form
                      action=""
                      class=""
                      id="login"
                      @submit.prevent="login"
                      method="post"
                    >
                      <div class="form-floating mb-3">
                        <input
                          required
                          v-model="auth.login"
                          type="text"
                          class="form-control feedback-input"
                          id="name"
                          placeholder="Введите телефон"
                          maxlength="9"
                          oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        />
                        <label for="name">Телефон</label>
                      </div>
                      <div class="form-floating mb-5">
                        <input
                          type="password"
                          required
                          v-model="auth.password"
                          class="form-control feedback-input"
                          id="password"
                          placeholder="Введите пароль"
                        />
                        <label for="password">Пароль</label>
                      </div>
                    </form>
                    <p class="card-text lh-lg">
                      Если вы забыли пароль, его очень легко <br />
                      восстановить с помощью
                      <a :href="route('auth.reset-password')" class="text-dark"
                        >ссылки</a
                      >
                    </p>
                    <button
                      type="submit"
                      form="login"
                      class="
                        btn btn-danger
                        text-white
                        w-100
                        rounded-0
                        mt-4
                        fs-4
                      "
                    >
                      Вход
                    </button>
                    <a
                      class="btn btn-light text-dark rounded-0 mt-4 fs-4 w-100"
                      :href="route('auth.register')"
                      >Регистрация</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="cart"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div
        class="
          modal-dialog modal-xl modal-dialog-centered modal-fullscreen-sm-down
        "
      >
        <div class="modal-content rounded-0">
          <div class="modal-body">
            <div class="orders">
              <div v-for="(item, index) in cart" :key="index">
                <div
                  class="row"
                  v-for="(size, indexSize) in item.size_quantity"
                  :key="indexSize"
                >
                  <div class="col">
                    <div class="d-flex">
                      <img
                        :src="'/storage/' + item.image[0]['fileName']"
                        alt=""
                        width="145px"
                        height="145px"
                        class="me-4"
                        style="object-fit: cover; overflow: hidden"
                      />
                      <nav class="d-flex flex-column">
                        <h5>{{ item.name }}</h5>
                        <h6>Размер: {{ size.size }}</h6>
                      </nav>
                    </div>
                  </div>
                  <div class="col">
                    <div
                      class="
                        d-flex
                        align-content-between
                        flex-column
                        justify-content-between
                        h-100
                        my-3 my-lg-0
                      "
                    >
                      <div
                        class="
                          d-flex
                          align-items-lg-center
                          justify-content-between
                        "
                      >
                        <span>Количество</span>
                        <span>Цена</span>
                        <span
                          class="text-muted cursor-pointer"
                          @click="removeCart({ clear: true })"
                          >Очистить корзину</span
                        >
                      </div>
                      <div
                        class="
                          d-flex
                          align-items-lg-center
                          justify-content-between
                        "
                      >
                        <div class="az-countable d-flex">
                          <button
                            type="button"
                            @click="setQuantity('minus', item, indexSize)"
                            class="btn p-0 shadow-none"
                            id="az-countable-minus"
                          >
                            <img
                              src="/images/icons/minus.svg"
                              width="35"
                              height="35"
                            />
                          </button>
                          <input
                            type="number"
                            disabled
                            v-model="size.quantity"
                            class="
                              form-control
                              border-0
                              mx-3
                              outline-fs-0
                              text-center
                              fs-2
                              shadow-none
                              w-50
                              hide-arrows
                            "
                            id="az-countable-count"
                            min="1"
                            max="9999"
                            value="1"
                            step="1"
                          />
                          <button
                            type="button"
                            @click="setQuantity('plus', item, indexSize)"
                            class="btn p-0 shadow-none"
                            id="az-countable-plus"
                          >
                            <img
                              src="/images/icons/plus.svg"
                              width="35"
                              height="35"
                            />
                          </button>
                        </div>
                        <h4 class="fw-bold">{{ item.price }} TJS</h4>
                        <button
                          type="button"
                          @click="
                            removeCart({
                              productId: item.id,
                              indexSize: indexSize,
                            })
                          "
                          class="btn"
                        >
                          <img src="/images/icons/trash.svg" alt="" srcset="" />
                        </button>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-3" />
                </div>
              </div>
              <!-- <div class="row" v-for="(item, index) in cart" :key="index">
                                <div class="col">
                                    <div class="d-flex">
                                        <img :src="'/storage/' + item.image[0]['fileName']" alt="" width="145px"
                                             class="me-4">
                                        <nav class="d-flex flex-column">
                                            <h5>{{ item.name }}</h5>
                                            <p class="fs-4 fw-bold">{{ item.price }} TJS</p>
                                            <span>Размер:</span>
                                            <span>{{ item.size_quantity.size }}</span>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex align-content-between flex-column justify-content-between h-100 my-3 my-lg-0">
                                        <div class="d-flex align-items-lg-center justify-content-between">
                                            <span>Количество</span>
                                            <span>Цена</span>
                                            <span class="text-muted cursor-pointer" @click="removeCart({clear: true})">Очистить корзину</span>
                                        </div>
                                        <div class="d-flex align-items-lg-center justify-content-between">
                                            <div class="az-countable d-flex">
                                                <button type="button" @click="setQuantity('minus', item)"
                                                        class="btn p-0 shadow-none" id="az-countable-minus" :disabled="product.quantity <=1">
                                                    <img src="/images/icons/minus.svg" width="35" height="35">
                                                </button>
                                                <input type="number" disabled v-model="item.size_quantity.quantity"
                                                       class="form-control border-0 mx-3 outline-fs-0 text-center fs-2 shadow-none w-50 hide-arrows"
                                                       id="az-countable-count" min="1"  max="9999" value="1" step="1">
                                                <button type="button" @click="setQuantity('plus', item)"
                                                        class="btn p-0 shadow-none" id="az-countable-plus" :disabled="product.quantity <= item.quantity">
                                                    <img src="/images/icons/plus.svg" width="35" height="35">
                                                </button>
                                            </div>
                                            <h4 class="fw-bold">{{ item.price }} TJS</h4>
                                            <button type="button" @click="removeCart(item)" class="btn">
                                                <img src="/images/icons/trash.svg" alt="" srcset="">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-3">
                            </div> -->
            </div>
            <div class="row">
              <div class="col-lg-6">
                <!-- <p>Lorem Ipsum is simply dummy text of the printing <br>
                                    and typesetting text ever since the 1500s, </p> -->
              </div>
              <div class="col-lg-6">
                <!-- <nav class="text-decoration-line-through text-end">1100 TJs</nav> -->
                <nav class="fs-5 text-end">
                  Cумма: <strong class="fs-4">{{ summ }} TJS</strong>
                </nav>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <a
              :href="route('checkout')"
              class="btn btn-danger text-white rounded-0 w-100 fs-4"
              >Купить</a
            >
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import Button from "../../Jetstream/Button.vue";
import AppLayout from "./../../Layouts/AppLayout";
import axios from "axios";

export default {
  components: {
    AppLayout,
  },
  props: {
    product: Object,
    cartData: Object,
    recomended: Array,
    comments: Array,
    users: Array,
  },
  data() {
    return {
      accessories: true,
      btnChangesWatch: "",
      btnChange: false,
      wallet: false,
      valSize: false,
      seasons: [],
      colors: [],
      productCategories: [],
      products: {},
      cart: [],
      pcount: 1,
      size: null,
      // mainImage: this.product.image[0]['fileName'] && '/storage/' + this.product.image[0]['fileName'],
      mainImageInd: 0,
      auth: {
        login: "",
        password: "",
      },
      message: "",
      cartItemCount: 0,
      summ: 0,
      cartItemCount: 0,
      sizes: [],
      allComments: {},
      newComment: {
        user_id: 0,
        user: {
          name: "",
        },
        text: "",
        product_id: 0,
        created_at: "Сейчас",
      },
    };
  },
  mounted() {
    if (
      this.product.category.name.toLowerCase() === "сумки и аксессуары" ||
      this.product.category.name.toLowerCase() === "аксессуары"
    ) {
      this.accessories = false;
    }
    if (this.product.name.toLowerCase() === "кошелек") {
      this.wallet = this.product.name.toLowerCase();
      this.size = this.product.size;
    }
    this.cart = this.cartData;
    this.allComments = this.comments;
    this.$page.props.user
      ? (this.newComment.user_id = this.$page.props.user.id)
      : "";
    this.newComment.product_id = this.product.id;
    // if($page.props.user){
    //     this.newComment.user_id = this.$page.props.user.id;
    // }
    for (const [key, value] of Object.entries(this.cart)) {
      value.size_quantity.forEach((element) => {
        this.summ += value.price * element.quantity;
        this.cartItemCount++;
      });
    }
    // this.sizes = JSON.parse(JSON.stringify(this.product.sizes)).map(x => x.size);
    this.sizes = JSON.parse(JSON.stringify(this.product.sizes));
    // console.log(this.product.sizes)
    this.sizes.map(function (x) {
      return (x.item_data = x.size + " " + x.quantity);
    });
    if (this.wallet) {
      this.btnChange = true;
    }
  },
  watch: {
    btnChangesWatch() {
      if (this.product.size) {
        this.btnChange = true;
      }
    },
    cart: function () {
      this.summ = 0;
      this.cartItemCount = 0;
      for (const [key, value] of Object.entries(this.cart)) {
        value.size_quantity.forEach((element) => {
          this.summ += value.price * element.quantity;
          this.cartItemCount++;
        });
      }
    },
  },
  methods: {
    btnChanges() {
      if (this.product.size !== true) {
        this.valSize = true;
      }
    },
    addToCart(id, pcount) {
      if (this.size !== null || this.wallet) {
        this.valSize = false;
        axios
          .post(route("addToCart", id), { quantity: pcount })
          .then((response) => {
            // this.$inertia.visit(route('checkout'));
            this.cart = response.data.cart;
            // this.$swal({
            //     toast: true,
            //     position: 'top-end',
            //     showConfirmButton: false,
            //     timer: 2000,
            //     timerProgressBar: true,
            //     icon: 'success',
            //     title: 'Товар добавлен в корзину'
            // })
          });
      } else {
        this.valSize = true;
      }
      // event.target.firstChild.classList.add('cart-animate')
    },
    addToCartCustom(id, pcount, size) {
      if (Object.keys(this.cart).length > 0) {
        if (this.cart[id]) {
          if (
            this.cart[id.toString()].size_quantity.filter((x) => x.size == size)
              .length > 0
          ) {
            return this.$swal({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              icon: "warning",
              title:
                "Этот размер уже в корзине! Переходите в корзину, чтобы увеличить количество товара",
            });
          }
        }
      }
      if (this.size !== null || this.wallet) {
        axios
          .post(route("addToCart", id), { quantity: pcount, size: this.size })
          .then((response) => {
            this.cart = response.data.cart;
            this.$swal({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              icon: "success",
              title: "Товар добавлен в корзину",
            });
          });
      } else {
        this.valSize = true;
      }
    },
    login() {
      // if (this.auth.login.match(/^\d{9}$/)) {
      axios
        .post(route("auth.sign-in"), this.auth)
        .then((response) => {
          if (response.data.status === "signed") {
            window.location.href = this.$page.url;
          }
        })
        .catch((error) => {
          this.message = error.response.data.message;
        });
      // }
    },
    setQuantity(type, item, indexSize) {
      item.indexsize = indexSize;
      if (type === "minus" && item.size_quantity[indexSize].quantity > 1) {
        axios.post(route("setQuantity", type), item).then((response) => {
          this.cart = response.data.cart;
        });
      } else if (type === "plus" && item) {
        axios.post(route("setQuantity", type), item).then((response) => {
          this.cart = response.data.cart;
        });
      }
    },
    removeCart(item) {
      axios.post(route("removeCart"), item).then((response) => {
        this.cart = response.data.cart;
      });
    },
    addComment() {
      let userAuth = this.$page.props.user ? true : false;
      if (userAuth && this.newComment.text != "") {
        axios.post(route("comment.store"), this.newComment).then((res) => {
          this.$swal({ timer: 1500, icon: "success", title: res.data.message });
          this.newComment.user.name = this.$page.props.user.name;
          this.allComments.unshift(JSON.parse(JSON.stringify(this.newComment)));
          this.newComment.text = "";
        });
      }
    },
  },
};
</script>
