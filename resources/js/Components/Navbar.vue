<template>
    <section id="header">
            <div class="top-bar container-fluid bg-dark">
                <div class="container">
                    <div class="row justify-content-between text-white">
                        <div class="col-6">Режим работы: С 9:00 до 18:00. Без выходных </div>
                        <div class="col-6 text-end">
                            Тел.: <a href="tel:+992929941010" class="text-decoration-none text-white">92 994 10 10</a>
                            Email: <a href="mailto:info@azam.tj" class="text-decoration-none text-white">info@azam.tj</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navigation">
                <nav class="navbar navbar-expand-lg navbar-light bg-white py-4" aria-label="Eighth navbar example">
                    <div class="container">
                        <a class="navbar-brand" :href="route('home')">
                            <img src="/images/logo.svg" alt="" srcset="">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarsExample07">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item active">
                                    <a :class="`nav-link ${route().current('home') ? 'active' : ''}`" :href="route('home')">Главная</a>
                                </li>
                                <li class="nav-item">
                                    <a :class="`nav-link ${route().current('repairs') ? 'active' : ''}`" :href="route('repairs')">Ремонт</a>
                                </li>
                                <li class="nav-item">
                                    <a :class="`nav-link ${route().current('about') ? 'active' : ''}`" :href="route('about')">О нас</a>
                                </li>
                                <li class="nav-item">
                                    <a :class="`nav-link ${route().current('mass-media') ? 'active' : ''}`" :href="route('mass-media')">СМИ</a>
                                </li>
                                <li class="nav-item">
                                    <a :class="`nav-link ${route().current('contacts') ? 'active' : ''}`" :href="route('contacts')">Контакты</a>
                                </li>
                            </ul>
                            <form :action="route('filter')">
                                <div class="input-group">
                                    <input class="form-control" type="search" placeholder="Поиск" v-model="q" aria-label="Search" name="q">
                                    <button type="submit" class="input-group-text bg-danger border-0">
                                        <img src="/images/icons/search.svg" alt="">
                                    </button>
                                </div>
                            </form>
                            <div class="mt-3 mt-lg-0">
                                <a :href="route('auth.logout')" class="text-decoration-none fw-bold text-dark mx-2" v-if="$page.props.user">
                                    <span class="me-3">
                                        Выход
                                    </span>
                                    <a :href="route('profile')" class="btn btn-danger text-white  position-relative rounded-circle az-icon-head">
                                        <img src="/images/icons/user.svg" alt="" srcset="">
                                    </a>
                                </a>
                                <a :href="route('auth.login')" class="text-decoration-none fw-bold text-dark mx-2" v-else>
                                    <span class="me-3">
                                        Войти
                                    </span>
                                    <button type="button" class="btn btn-danger text-white  position-relative rounded-circle az-icon-head">
                                        <img src="/images/icons/user.svg" alt="" srcset="">
                                    </button>
                                </a>
                                <button type="button" class="btn btn-danger text-white  position-relative rounded-circle az-icon-head" data-bs-toggle="modal" data-bs-target="#cart">
                                    <img src="/images/icons/cart.svg" alt="" srcset=""><span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-white text-dark">{{ cart }}<span class="visually-hidden">unread messages</span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </section>
</template>

<script>
export default {
    props: {
        cart: Number
    },
    data() {
        return {
            q: route().current('filter') && this.$page.url.split('?q=').length >1 ? decodeURI(this.$page.url.split('?q=')[1])  : '',
        }
    },
    mounted() {
    },

}
</script>
