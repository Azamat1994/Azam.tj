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
              Ремонт
            </li>
          </ol>
        </nav>

        <div class="az-repairs">
          <div class="row row-cols-1 row-cols-lg g-4">
            <div class="col">
              <div class="card py-3 border-0 bg-light">
                <div class="card-body">
                  <h3 class="card-title">
                    Ремонт обуви <strong class="text-danger">“Азам”</strong> и
                    <strong class="text-dark"> других брендов</strong>
                  </h3>
                  <p class="card-text">
                    Вся обувь от нашего бренда ремонтируеться на 50% дешевле.
                    Оставьте заявку для ремонта обуви. Мы проверим состояние и
                    свяжемся с Вами. В телефонном разговоре наш менеджер сообщит
                    Вам стоимость вашего ремонта.
                  </p>
                </div>
                <label for="image" class="cursor-pointer">
                  <img
                    :src="
                      bidAzamImage
                        ? bidAzamImage
                        : '/images/icons/add_photos.svg'
                    "
                    class="card-img-top my-4"
                    alt="..."
                    width="100%"
                    height="224px"
                    style="object-fit: cover"
                  />
                </label>
                <div class="card-body">
                  <form action="">
                    <input
                      type="file"
                      class="d-none"
                      name="image"
                      id="image"
                      @change="handleUpload($event, 0)"
                    />
                    <div class="form-floating mb-3">
                      <input
                        type="text"
                        class="form-control feedback-input bg-light"
                        id="name"
                        v-model="bidAzam.name"
                        name="name"
                        placeholder="Введите имя"
                      />
                      <label for="name">Имя</label>
                    </div>
                    <div class="form-floating mb-5">
                      <input
                        type="text"
                        minlength="9"
                        maxlength="9"
                        class="form-control feedback-input bg-light"
                        id="phone"
                        v-model="bidAzam.phone"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        name="phone"
                        placeholder="Введите номер телефона"
                      />
                      <label for="phone">Контакты</label>
                      <span v-if="valPhone" style="color: red"
                        >Номер телефона должен содержать 9 цифр</span
                      >
                    </div>
                    <div class="form-group">
                      <label>Описание</label>
                      <textarea
                        class="form-control feedback-input bg-light mb-4"
                        v-model="bidAzam.city"
                        data-toggle="autosize"
                        rows="2"
                        placeholder="Введите  описание проблемы..."
                      ></textarea>
                    </div>
                    <button
                      type="button"
                      :disabled="!showButton.t0"
                      class="btn btn-outline-dark rounded-0 w-100 py-3 fs-4"
                      @click="sendBid(0)"
                      data-bs-toggle="modal"
                      :data-bs-target="$page.props.user ? '' : '#auth'"
                    >
                      Отправить заявку
                    </button>
                  </form>
                </div>
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
                      <div
                        class="alert alert-danger"
                        role="alert"
                        v-if="message"
                      >
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
                          <input
                            class="show-password mt-4 cursor-pointer"
                            type="checkbox"
                            @click="showPassword()"
                          />
                        </div>
                      </form>
                      <p class="card-text lh-lg">
                        Если вы забыли пароль, его очень легко <br />
                        восстановить с помощью
                        <a
                          :href="route('auth.reset-password')"
                          class="text-dark"
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
                        class="
                          btn btn-light
                          text-dark
                          rounded-0
                          mt-4
                          fs-4
                          w-100
                        "
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
    </section>
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
    patrtners: Array,
    sliders: Array,
    cartData: Object,
  },
  data() {
    return {
      valPhone: false,
      showButton: {
        t0: true,
        t1: true,
      },
      auth: {
        login: "",
        password: "",
      },
      message: "",
      bidAzam: {
        name: "",
        phone: "",
        image: "",
      },
      bidOther: {
        name: "",
        phone: "",
        image: "",
      },
      bidOtherImage: "",
      bidAzamImage: "",
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
    showPassword() {
      let password = document.getElementById("password");
      if (password.type === "password") {
        password.type = "text";
      } else {
        password.type = "password";
      }
    },
    handleUpload($event, type) {
      if (type && $event.target.files.length > 0) {
        this.bidOther.image = $event.target.files[0];
        this.bidOtherImage = URL.createObjectURL(this.bidOther.image);
      } else if (!type && $event.target.files.length > 0) {
        this.bidAzam.image = $event.target.files[0];
        this.bidAzamImage = URL.createObjectURL(this.bidAzam.image);
      }
    },
    sendBid(type) {
      if (!this.$page.props.user) {
        return;
      }
      if (
        !(
          this.bidAzam.name &&
          this.bidAzam.phone &&
          this.bidAzam.image &&
          type === 0
        ) &&
        !(
          this.bidOther.name &&
          this.bidOther.phone &&
          this.bidOther.image &&
          type === 1
        )
      ) {
        this.$swal({
          position: "top-end",
          icon: "error",
          title: "Введите корректные данные",
          showConfirmButton: true,
          timer: 2000,
        });
        return 0;
      }

      if (this.bidAzam.phone.length == 9) {
        let fd = new FormData();
        (this.valPhone = false),
          fd.append(
            "name",
            type === 1 ? this.bidOther.name : this.bidAzam.name
          );
        fd.append(
          "phone",
          type === 1 ? this.bidOther.phone : this.bidAzam.phone
        );
        fd.append(
          "image",
          type === 1 ? this.bidOther.image : this.bidAzam.image
        );
        fd.append("type", type);

        axios
          .post(route("repairs-save"), fd, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
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
          });
        this.bidAzam.name = "";
        this.bidAzam.phone = "";
        this.bidAzamImage = "";
        this.bidAzamImage = "";
        this.bidAzam.city = "";
      } else if (this.bidAzam.phone.length !== 9) {
        this.valPhone = true;
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
