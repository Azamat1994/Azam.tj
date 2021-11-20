<template>
    <div class="wrapper" style="display: table; width: 100%; height: 100%;">
        <section id="content vh-100" style="display: table-cell; vertical-align: middle;">
            <div class="container mt-4 mb-4" style="width:100%; max-width: 525px;">
                <!-- <div class="card rounded-0 auth-card" style="width: 30rem"> -->
                <div class="card rounded-0 auth-card">
                    <div class="card-body p-sm-5">
                        <div class="alert alert-danger" role="alert" v-if="message">
                            {{ message }}
                        </div>
                        <h2 class="card-title fw-bold">Вход</h2>
                        <form action="" class="" id="login" @submit.prevent="login" method="post">
                            <div class="form-floating mb-3">
                                <input required v-model="auth.login" type="text" class="form-control feedback-input"
                                       id="name" placeholder="Введите телефон" maxlength="9"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="name">Телефон</label>
                            </div>
                            <div class="form-floating mb-5">
                                <input required v-model="auth.password" type="password"
                                       class="form-control feedback-input" id="password" placeholder="Введите пароль">
                                <label for="password">Пароль</label>
                                <input class="show-password mt-4 cursor-pointer" type="checkbox" @click="showPassword()">
                            </div>
                        </form>
                        <div class="divider"></div>
                        <p class="card-text lh-lg">Если вы забыли пароль, его очень легко <br> восстановить с помощью <a
                            :href="route('auth.reset-password')" class="text-dark">ссылки</a></p>
                        <p class="card-text lh-lg"><a :href="route('auth.register')" class="text-dark">Регистрация</a>
                        </p>
                        <p class="card-text lh-lg"><a :href="route('home')" class="text-dark">Главная</a>
                        </p>
                    </div>
                </div>
                <button type="submit" form="login" class="btn btn-danger text-white w-100 rounded-0 mt-4 fs-4">Вход
                </button>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            auth: {
                login: '',
                password: ''
            },
            message: ''
        }
    },
    methods: {
        login() {
            // if (this.auth.login.match(/^\d{9}$/)) {
            axios.post(route('auth.sign-in'), this.auth)
                .then(response => {
                    if (response.data.status === 'signed') {
                        window.location.href = route('home')
                    }
                })
                .catch(error => {
                    this.message = error.response.data.message
                })
            // }
        },
        showPassword(){
            let password = document.getElementById('password')
            if (password.type === 'password') {
                password.type = 'text'
            } else{
                password.type = 'password'
            }
        }
    }
}
</script>
