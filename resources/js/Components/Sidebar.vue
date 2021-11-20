<template>
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="/">
                <img src="/images/logo.svg" class="navbar-brand-img mx-auto" alt="Logo">
            </a>

            <div class="navbar-user d-md-none">
                <div class="dropdown">
                    <a href="#!" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown">
                        <div class="avatar avatar-sm avatar-online">
                            <img src="/img/avatars/profiles/avatar-1.jpg" class="avatar-img rounded-circle" alt="Logo">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
                        <a href="#!" class="dropdown-item">!Профиль</a>
                        <a href="/account-general" class="dropdown-item">Настройки</a>
                        <hr class="dropdown-divider">
                        <a href="/logout" class="dropdown-item">Выйти</a>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended"
                               placeholder="Поиск по админке...">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fe fe-search"></span></div>
                        </div>
                    </div>
                </form>
                <hr class="navbar-divider my-3">
                <h6 class="navbar-heading">Страницы</h6>
                <ul class="navbar-nav">
                    <li v-if="$userPermissions.includes('orders-create') || $userPermissions.includes('orders-read')" class="nav-item">
                        <a :class="`nav-link ${this.$page.url == '/dashboard/orders' || this.$page.url == '/dashboard/orders/archive' ? 'text-danger' : ''}`" href="/dashboard/orders">
                            <i class="fe fe-list"></i> Заказы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a :class="`nav-link ${this.$page.url == '/dashboard/get-bids' ? 'text-danger' : ''}`" href="/dashboard/get-bids">
                            <i class="fe fe-layers"></i> Заявки
                        </a>
                    </li>
                    <li v-if="$userPermissions.includes('products-create') || $userPermissions.includes('products-read')" class="nav-item">
                        <a :class="`nav-link ${this.$page.url == '/dashboard/products' ? 'text-danger' : ''}`" href="/dashboard/products">
                            <i class="fe fe-shopping-bag"></i> Продукты
                        </a>
                    </li>
                    <li v-if="$userPermissions.includes('shops-create') || $userPermissions.includes('shops-read')" class="nav-item">
                        <a :class="`nav-link ${this.$page.url == '/dashboard/shops' ? 'text-danger' : ''}`" href="/dashboard/shops">
                            <i class="fe fe-box"></i> Наши магазины
                        </a>
                    </li>
                    <li v-if="$userPermissions.includes('crudes-create') || $userPermissions.includes('crudes-read')" class="nav-item">
                        <a :class="`nav-link ${this.$page.url == '/dashboard/crudes' ? 'text-danger' : ''}`" href="/dashboard/crudes">
                            <i class="fe fe-box"></i> Сырье
                        </a>
                    </li>
                    <li v-if="$userPermissions.includes('warehouses-create') || $userPermissions.includes('warehouses-read')" class="nav-item">
                        <a :class="`nav-link ${this.$page.url == '/dashboard/warehouses' ? 'text-danger' : ''}`" href="/dashboard/warehouses">
                            <i class="fe fe-home"></i> Склады
                        </a>
                    </li>
                </ul>
                <div>
                    <hr class="navbar-divider my-3"></hr>
                    <h6 class="navbar-heading">Справочники</h6>
                    <ul class="navbar-nav">
                        <li v-if="$userPermissions.includes('cities-create') || $userPermissions.includes('cities-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/cities' ? 'text-danger' : ''}`" href="/dashboard/cities">
                                <i class="fe fe-compass"></i> Города
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('units-create') || $userPermissions.includes('units-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/units' ? 'text-danger' : ''}`" href="/dashboard/units">
                                <i class="fe fe-underline"></i> Единицы
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('posts-create') || $userPermissions.includes('posts-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/posts' ? 'text-danger' : ''}`" href="/dashboard/posts">
                                <i class="fe fe-layers"></i> Записи
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('categories-create') || $userPermissions.includes('categories-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/categories' ? 'text-danger' : ''}`" href="/dashboard/categories">
                                <i class="fe fe-grid"></i> Категории
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('partners-create') || $userPermissions.includes('partners-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/partners' ? 'text-danger' : ''}`" href="/dashboard/partners">
                                <i class="fe fe-users"></i> Партнёры
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('users-create') || $userPermissions.includes('users-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/users' ? 'text-danger' : ''}`" href="/dashboard/users">
                                <i class="fe fe-user"></i> Пользователи
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('sliders-create') || $userPermissions.includes('sliders-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/sliders' ? 'text-danger' : ''}`" href="/dashboard/sliders">
                                <i class="fe fe-layers"></i> Слайдеры
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('deliveries-create') || $userPermissions.includes('deliveries-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/deliveries' ? 'text-danger' : ''}`" href="/dashboard/deliveries">
                                <i class="fe fe-underline"></i> Службы доставки
                            </a>
                        </li>
                        <li v-if="$userPermissions.includes('statuses-create') || $userPermissions.includes('statuses-read')" class="nav-item">
                            <a :class="`nav-link ${this.$page.url == '/dashboard/statuses' ? 'text-danger' : ''}`" href="/dashboard/statuses">
                                <i class="fe fe-star"></i> Статусы
                            </a>
                        </li>
                    </ul>
                </div>
                <div v-if="$userRoles.includes('administrator')">
                <hr class="navbar-divider my-3"></hr>
<!--                <h6 class="navbar-heading">Администрирование</h6>-->
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#humans" data-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="humans">Администрирование</a>
                        <div class="collapse" id="humans" style="">
                            <ul class="nav nav-sm flex-column">
                                <li v-if="$userPermissions.includes('permissions-create')" class="nav-item">
                                    <a :class="`nav-link ${this.$page.url == '/dashboard/grant' ? 'text-danger' : ''}`" href="/dashboard/grant">
                                        <i class="fe fe-unlock"></i> Раздача прав
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a :class="`nav-link ${this.$page.url == '/dashboard/permissions' ? 'text-danger' : ''}`" href="/dashboard/permissions">
                                        <i class="fe fe-alert-circle"></i> Разрешения
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a :class="`nav-link ${this.$page.url == '/dashboard/roles' ? 'text-danger' : ''}`" href="/dashboard/roles">
                                        <i class="fe fe-airplay"></i> Роли
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                </div>
                <hr class="navbar-divider my-3"></hr>
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        <i class="fe fe-log-in"></i> Выйти
                    </a>
                </li>
                </ul>
            </div>
<!--            <div id="sidebarUser" class="navbar-user d-none d-md-flex">-->
<!--                <div class="dropup"><a href="#" id="sidebarIconCopy" role="button" data-toggle="dropdown"-->
<!--                                       aria-haspopup="true" aria-expanded="true" class="dropdown-toggle">-->
<!--                    <div class="avatar avatar-sm avatar-online"><img src="/images/avatar.png" alt="..."-->
<!--                                                                     class="avatar-img rounded-circle"></div>-->
<!--                </a>-->
<!--                    <div aria-labelledby="sidebarIconCopy" class="dropdown-menu"><a href="#"-->
<!--                                                                                    onclick="alert('Страница находится на стадии разработки');"-->
<!--                                                                                    class="dropdown-item">Профиль</a>-->
<!--                        <hr class="dropdown-divider">-->
<!--                        <a href="/logout" class="dropdown-item">Выйти</a></div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </nav>
</template>
<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {},
};
</script>
