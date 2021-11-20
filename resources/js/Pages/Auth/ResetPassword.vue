<template>
    <div class="wrapper align-self-center" style="display: table; height: 100%; width: 100%;">
        <section id="content vh-100" style="display: table-cell; vertical-align: middle;">
            <form class="container mb-4 mt-4" style="max-width: 525px; width: 100%;" v-if="step===1"
                  @submit.prevent="resetPassword" method="post">
                <!-- <div class="card rounded-0 auth-card" style="width: 30rem"> -->
                <div class="card rounded-0 auth-card">
                    <div class="card-body p-sm-5">
                        <h2 class="card-title fw-bold">Восстановить пароль</h2>


                        <div class="form-floating mb-3">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-white">
                                    <input type="radio" name="options" id="option1" checked=""
                                           @click="auth.country='tj';"> <i
                                    class="fe fe-check-circle"></i> Таджикистан
                                </label>
                                <label class="btn btn-white active">
                                    <input type="radio" name="options" id="option2"
                                           @click="auth.country='other';"> <i
                                    class="fe fe-check-circle"></i> Другая страна
                                </label>
                            </div>
                        </div>


                        <form action="" class="" id="register">
                            <div class="form-floating mb-3">
                                <input type="text" v-model="auth.login" class="form-control feedback-input" id="name"
                                       placeholder="Введите email">
                                <label
                                    for="name">{{ auth.country === 'tj' ? '+992 Введите номер телефона' : 'Введите email' }}</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a :href="route('auth.login')"
                           class="btn btn-outline-dark w-100 rounded-0 mt-2 mt-md-4 fs-4 btn-login">Вход</a>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-danger text-white  w-100 rounded-0 mt-2 mt-md-4 fs-4">
                            Восстановить
                        </button>
                    </div>
                </div>
            </form>
            <form @submit.prevent="confirmCode" method="post" style="max-width: 525px; width: 100%;"
                  class="container mt-4 mb-4" v-if="step===2">
                <!-- <div class="card rounded-0 auth-card" style="width: 30rem"> -->
                <div class="card rounded-0 auth-card">
                    <div class="card-body p-lg-5">
                        <h2 class="card-title fw-bold">Введите код подтверждения</h2>
                        <div>
                            <div class="form-floating mb-3">
                                <input required v-model="auth.confirmCode" type="text" maxlength="4"
                                       class="form-control feedback-input"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       id="name" placeholder="Введите код подтверждения">
                                <label for="name">Код подтверждения</label>
                            </div>
                            <div class="col">
                                <p>Отправить код повторно
                                    <span class="text-secondary" v-if="!resent">(Через {{ confirmTime }} секунд)</span>
                                    <!--                                    <button type="button" @click="resetPassword" v-if="resent" class="btn btn-primary btn-sm">Повторить</button>-->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <a :href="route('auth.login')" class="btn btn-outline-dark w-100 rounded-0 mt-4 fs-4 btn-login">Вход</a>
                    </div>
                    <div class="col-12 col-sm-6">
                        <button type="submit" class="btn btn-danger text-white  w-100 rounded-0 mt-4 fs-4">Далее
                        </button>
                    </div>
                </div>
            </form>
            <form @submit.prevent="setNewPassword" method="post" style="max-width: 525px; width: 100%;"
                  class="container mt-4 mb-4" v-if="step===3">
                <!-- <div class="card rounded-0 auth-card" style="width: 30rem"> -->
                <div class="card rounded-0 auth-card">
                    <div class="card-body p-lg-5">
                        <h2 class="card-title fw-bold">Придумайте пароль</h2>
                        <div>
                            <div class="form-floating mb-3">
                                <input required v-model="auth.password" type="text"
                                       class="form-control feedback-input" id="name">
                                <label for="name">Новый пароль</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required v-model="auth.passwordConfirm" type="text"
                                       class="form-control feedback-input" id="name">
                                <label for="name">Повторите пароль</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <a :href="route('auth.login')" class="btn btn-outline-dark w-100 rounded-0 mt-4 fs-4 btn-login">Вход</a>
                    </div>
                    <div class="col-12 col-sm-6">
                        <button type="submit" class="btn btn-danger text-white  w-100 rounded-0 mt-4 fs-4">Далее
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            auth: {
                login: '',
                confirm: '',
                country: 'tj',
            },
            confirmTime: "00:00",
            step: 1,
            resent: true,
            isDisable: false
        }
    },
    methods: {
        resetPassword() {
            this.isDisable = true
            if (this.auth.login) {
                axios.post(route('auth.confirm.password', 'reset-password'), this.auth)
                    .then(response => {
                        if (this.step === 1) {
                            this.confirmTimer(60)
                            this.step = 2
                        }
                    })
                    .catch(error => {
                        this.$swal({
                            position: 'top-end',
                            icon: 'error',
                            title: error.response.data.message,
                            showConfirmButton: true,
                            timer: 2000
                        })
                    })
                    .finally(response => {
                        this.isDisable = false
                    })
            } else {
                this.$swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Введите корректные данные',
                    showConfirmButton: true,
                    timer: 2000
                })
            }
        },
        confirmCode() {
            axios.post(route('auth.confirm.password', 'confirm'), this.auth)
                .then(response => {
                    if (response.data.success === 'true') {
                        this.step = 3
                    } else {
                        this.$swal({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Вы ввели неправильный код подтверждения! Попробуйте еще раз запросить код!',
                            showConfirmButton: true,
                            timer: 5000
                        })
                        this.step = 1
                    }
                })
        },
        setNewPassword() {
            axios.post(route('auth.confirm.password', 'set-new-password'), this.auth)
                .then(response => {
                    console.log(response)
                    this.$swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Пароль сброшен! Выполните вход используя новый пароль',
                        showConfirmButton: true,
                        timer: 5000
                    })
                    this.$inertia.visit(route('auth.login'));
                })
        },
        confirmTimer(duration) {
            let _this = this
            this.resent = false
            var timer = duration, minutes, seconds;
            let clearTimer = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                _this.confirmTime = minutes + ":" + seconds
                if (--timer < 0 || _this.step === 1) {
                    _this.confirmTime = '00:00'
                    _this.resent = true
                    _this.step = 1
                    clearInterval(clearTimer)
                }
            }, 1000);
        }
    }
}
</script>

<style>

</style>
