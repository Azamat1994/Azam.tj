<template>
    <app-layout class="wrapper" :cart="cartItemCount" :cartData="cartData">
        <section id="contain">
            <div class="container">
                <div class="divider"></div>
                <div class="az-checkout" v-if="Object.keys(cart).length > 0">
                    <ul class="nav nav-pills mb-5 justify-content-center align-items-center" id="pills-checkout"
                        role="tablist">
                        <li class="nav-item col-12 col-lg-3" role="presentation">
                            <a :class="`nav-link fs-5 text-center ${step === 1 && 'active'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" class="d-block m-auto"
                                     viewBox="0 0 49 49">
                                    <path
                                        d="M20.8757 14.9163L23.1115 12.6828V20.0677C23.1115 21.0043 23.8688 21.7608 24.8064 21.7608C25.7441 21.7608 26.5014 21.0043 26.5014 20.0677V12.7188L28.7372 14.9523C29.0617 15.2765 29.4945 15.4566 29.9272 15.4566C30.36 15.4566 30.7927 15.2765 31.1173 14.9523C31.7664 14.3039 31.7664 13.2231 31.1173 12.5747L25.9965 7.45931C25.3834 6.8469 24.2655 6.8469 23.6164 7.45931L18.4956 12.5747C17.8465 13.2231 17.8465 14.3039 18.4956 14.9523C19.1808 15.6007 20.2266 15.6007 20.8757 14.9163Z"></path>
                                    <path
                                        d="M38.9433 25.1832C38.4745 24.6789 33.2095 19.0591 33.2095 19.0591C32.5604 18.3747 31.5146 18.3387 30.8294 18.9871C30.1442 19.6355 30.1082 20.6802 30.7573 21.3647L33.8225 24.6068H15.7916L18.8569 21.3647C19.506 20.6802 19.4699 19.6355 18.7847 18.9871C18.0996 18.3747 17.0538 18.3747 16.4047 19.0591C16.4047 19.0591 11.0675 24.7509 10.6708 25.1832C10.2741 25.5795 9.84141 26.408 10.0578 27.1645L13.4476 39.7009C13.7 40.5655 14.4934 41.1779 15.3949 41.1779H34.2192C35.1208 41.1779 35.9141 40.5655 36.1666 39.7009L39.5564 27.1645C39.7727 26.408 39.4121 25.6876 38.9433 25.1832ZM20.0469 35.8463C20.0469 36.4587 19.542 36.9631 18.929 36.9631C18.3159 36.9631 17.8111 36.4587 17.8111 35.8463V29.9744C17.8111 29.362 18.3159 28.8577 18.929 28.8577C19.542 28.8577 20.0469 29.362 20.0469 29.9744V35.8463ZM25.925 35.8463C25.925 36.4587 25.4201 36.9631 24.8071 36.9631C24.194 36.9631 23.6892 36.4587 23.6892 35.8463V29.9744C23.6892 29.362 24.194 28.8577 24.8071 28.8577C25.4201 28.8577 25.925 29.362 25.925 29.9744V35.8463ZM31.8031 35.8463C31.8031 36.4587 31.2982 36.9631 30.6852 36.9631C30.0721 36.9631 29.5672 36.4587 29.5672 35.8463V29.9744C29.5672 29.362 30.0721 28.8577 30.6852 28.8577C31.2982 28.8577 31.8031 29.362 31.8031 29.9744V35.8463Z"></path>
                                </svg>
                                Детали покупки
                            </a>
                        </li>

                        <hr class="col-1 bg-dark me-4 d-none d-lg-block">
                        <li class="nav-item col-12 col-lg-3" role="presentation">
                            <a :class="`nav-link fs-5 text-center ${step === 2 && 'active'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" class="d-block m-auto"
                                     viewBox="0 0 49 49">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M36.4438 12.25H9.49375C8.47893 12.25 7.65625 13.0727 7.65625 14.0875V34.9125C7.65625 35.9273 8.47893 36.75 9.49375 36.75H36.4438C37.4586 36.75 38.2812 35.9273 38.2812 34.9125V14.0875C38.2812 13.0727 37.4586 12.25 36.4438 12.25ZM37.0562 34.9125C37.0562 35.2508 36.782 35.525 36.4437 35.525H9.49371C9.15543 35.525 8.88121 35.2508 8.88121 34.9125V14.0875C8.88121 13.7493 9.15543 13.475 9.49371 13.475H36.4437C36.782 13.475 37.0562 13.7493 37.0562 14.0875V34.9125ZM15.6186 19.6C15.9569 19.6 16.2311 19.3258 16.2311 18.9875C16.2311 18.6492 15.9569 18.375 15.6186 18.375H11.9436C11.6053 18.375 11.3311 18.6492 11.3311 18.9875C11.3311 19.3258 11.6053 19.6 11.9436 19.6H15.6186ZM22.9687 19.6H18.0687C17.7304 19.6 17.4562 19.3258 17.4562 18.9875C17.4562 18.6492 17.7304 18.375 18.0687 18.375H22.9687C23.3069 18.375 23.5812 18.6492 23.5812 18.9875C23.5812 19.3258 23.3069 19.6 22.9687 19.6ZM27.869 25.2758C28.5863 24.7711 29.4419 24.5002 30.319 24.5C32.1657 24.499 33.8054 25.6812 34.3878 27.4337C34.9703 29.1862 34.3645 31.1147 32.8845 32.2193C31.4045 33.3239 29.3834 33.3561 27.869 32.2992C26.0871 33.5474 23.6528 33.2631 22.2065 31.638C20.7601 30.0129 20.7601 27.5621 22.2065 25.937C23.6528 24.3119 26.0871 24.0277 27.869 25.2758ZM25.4188 31.85C23.7274 31.85 22.3563 30.4789 22.3563 28.7875C22.3563 27.0961 23.7274 25.725 25.4188 25.725C27.1102 25.725 28.4813 27.0961 28.4813 28.7875C28.4793 30.4781 27.1093 31.848 25.4188 31.85ZM28.7801 31.4199C29.2453 31.6983 29.7767 31.8469 30.3188 31.85C32.0102 31.85 33.3813 30.4789 33.3813 28.7875C33.3813 27.0961 32.0102 25.725 30.3188 25.725C29.7767 25.7281 29.2453 25.8766 28.7801 26.155C30.0151 27.6927 30.0151 29.8822 28.7801 31.4199Z"></path>
                                    <circle cx="35.2188" cy="15.3125" r="6.125" stroke="white"></circle>
                                    <path d="M33.1768 15.8228L35.2184 17.3541L38.2809 13.2708" stroke="white"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Оплата</a>
                        </li>
                        <hr class="col-1 bg-dark me-4 d-none d-lg-block">
                        <li class="nav-item col-12 col-lg-3" role="presentation">
                            <a :class="`nav-link fs-5 text-center ${step === 3 && 'active'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="49" class="d-block m-auto"
                                     viewBox="0 0 50 49">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M11.8932 10.6411H13.1554C14.201 10.6411 15.0486 11.4718 15.0486 12.4965V37.2347C15.0486 38.2594 14.201 39.0901 13.1554 39.0901H11.8932C10.8476 39.0901 10 38.2594 10 37.2347V12.4965C10 11.4718 10.8476 10.6411 11.8932 10.6411ZM38.3982 10.6411H19.4659C18.4202 10.6411 17.5726 11.4718 17.5726 12.4965V37.2347C17.5726 38.2594 18.4202 39.0901 19.4659 39.0901H38.3982C39.4438 39.0901 40.2914 38.2594 40.2914 37.2347V12.4965C40.2914 11.4718 39.4438 10.6411 38.3982 10.6411ZM39.0299 37.2348C39.0294 37.5762 38.7471 37.8528 38.3988 37.8532H19.4665C19.1181 37.8528 18.8358 37.5762 18.8354 37.2348V12.4965C18.8358 12.1551 19.1181 11.8785 19.4665 11.8781H38.3988C38.7471 11.8785 39.0294 12.1551 39.0299 12.4965V37.2348ZM35.8741 19.2995C36.2226 19.2995 36.5052 19.0226 36.5052 18.6811C36.5052 18.3395 36.2226 18.0626 35.8741 18.0626H28.3012C27.9526 18.0626 27.6701 18.3395 27.6701 18.6811C27.6701 19.0226 27.9526 19.2995 28.3012 19.2995H35.8741ZM26.2232 17.0069C26.4696 17.2484 26.4696 17.6399 26.2232 17.8814L23.6989 20.3552C23.4525 20.5967 23.053 20.5967 22.8066 20.3552L21.5444 19.1183C21.3053 18.8756 21.3087 18.4899 21.5521 18.2513C21.7955 18.0128 22.1891 18.0094 22.4368 18.2438L23.2528 19.0435L25.3309 17.0069C25.5773 16.7655 25.9768 16.7655 26.2232 17.0069ZM35.8741 25.4841C36.2226 25.4841 36.5052 25.2072 36.5052 24.8656C36.5052 24.524 36.2226 24.2472 35.8741 24.2472H28.3012C27.9526 24.2472 27.6701 24.524 27.6701 24.8656C27.6701 25.2072 27.9526 25.4841 28.3012 25.4841H35.8741ZM26.2232 23.1914C26.4696 23.433 26.4696 23.8244 26.2232 24.0659L23.6989 26.5398C23.4525 26.7812 23.053 26.7812 22.8066 26.5398L21.5444 25.3029C21.3053 25.0602 21.3087 24.6745 21.5521 24.4359C21.7955 24.1973 22.1891 24.194 22.4368 24.4284L23.2528 25.228L25.3309 23.1914C25.5773 22.95 25.9768 22.95 26.2232 23.1914ZM35.8741 31.6686C36.2226 31.6686 36.5052 31.3917 36.5052 31.0502C36.5052 30.7086 36.2226 30.4317 35.8741 30.4317H28.3012C27.9526 30.4317 27.6701 30.7086 27.6701 31.0502C27.6701 31.3917 27.9526 31.6686 28.3012 31.6686H35.8741ZM26.2232 29.376C26.4696 29.6175 26.4696 30.009 26.2232 30.2505L23.6989 32.7243C23.4525 32.9657 23.053 32.9657 22.8066 32.7243L21.5444 31.4874C21.3053 31.2447 21.3087 30.859 21.5521 30.6204C21.7955 30.3819 22.1891 30.3785 22.4368 30.6129L23.2528 31.4126L25.3309 29.376C25.5773 29.1346 25.9768 29.1346 26.2232 29.376ZM13.7864 37.2347C13.786 37.5761 13.5037 37.8528 13.1554 37.8532H11.8932C11.5448 37.8528 11.2625 37.5761 11.2621 37.2347V16.8257H13.7864V37.2347ZM11.2621 15.5888H13.7864V12.4965C13.786 12.1551 13.5037 11.8785 13.1554 11.8781H11.8932C11.5448 11.8785 11.2625 12.1551 11.2621 12.4965V15.5888Z"></path>
                                </svg>
                                Подтверждение</a>
                        </li>
                    </ul>
                    <div>
                        <form @submit.prevent="nextStep(2)" v-if="step === 1">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card bg-gray px-lg-5 px-3 py-4 border-0 h-100">
                                        <h3 class="mb-5 mt-3 ps-2 fw-bold">Адрес доставки</h3>
                                        <div action="" class="">
                                            <div class="form-floating mb-3">
                                                <v-select
                                                    id="city"
                                                    placeholder="Выберите город"
                                                    class="style-chooser"
                                                    :options="cities"
                                                    :reduce="cities => cities.name"
                                                    label="name"
                                                    v-model="order.city"
                                                    @input="setSelected(value)">
                                                    <span slot="no-options">нет такого города</span>
                                                </v-select>

                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" required class="form-control feedback-input bg-gray"
                                                       v-model="order.address" id="address" name="address"
                                                       placeholder="ул. Борбад 124/1">
                                                <label for="address">Адрес</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" required
                                                       class="form-control feedback-input bg-gray hide-arrows" v-model="order.phone"
                                                       id="phone">
                                                <label for="phone">Телефон для доставки </label>
                                                <small class="text-danger text-sm" v-if="examplePhone">Введите правильный номер. Пример: 92ХХХХХХХ</small>
                                            </div>
                                            <div class="form-floating mb-3 display-none">
                                                <select required class="form-select feedback-input bg-gray" id="courier"
                                                        v-model="order.courier" name="courier_id"
                                                        aria-label="Выбрать курьера">
                                                    <option selected="">Oson Delivrty</option>
                                                    <option value="1">Beeyor</option>
                                                    <option value="2">Кенгуру</option>
                                                    <option value="3">Бул-булча</option>
                                                </select>
                                                <label for="courier">Выбрать курьера</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card bg-gray px-lg-5 px-3 py-4 border-0">
                                        <h3 class="mb-5 mt-3 ps-2 fw-bold">Детали заказа </h3>
                                        <div class="row">
                                            <div class="col-6">
                                                <p>Цена продукта</p>
                                                <p>Цена доставки</p>
                                                <p>Промо код</p>
                                                <p>Упаковка</p>
                                            </div>
                                            <div class="col-6">
                                                <p>{{ summ }} TJS</p>
                                                <p>0.0 TJS</p>
                                                <p>Нет</p>
                                                <p>Стандарт</p>
                                            </div>
                                        </div>
                                        <hr class="w-100">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <p class="fs-4">Общая сумма</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="fs-2">{{ summ }} TJS</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="az-checkout-action mt-3">
                                        <div class="row d-flex align-items-end">
<!--                                            <div class="col-12 col-lg-8 mb-3 mb-lg-0">-->
<!--                                                <a :href="route('filter')" class="btn btn-outline-dark w-100 fs-4 rounded-0">Продолжить покупку</a>-->
<!--                                            </div>-->
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-danger text-white  rounded-0 w-100 fs-4">
                                                    Продолжить покупку
                                                </button>
                                            </div>
                                            <!-- <div class="col-12 col-lg-6 mb-3">
                                                <button type="button" class="btn btn-danger text-white  w-100 fs-4
                                                rounded-0" id="azc-next-payments" @click="nextStep(2)" data-bs-toggle="pill"
                                                href="#pills-payments" role="tab" aria-controls="pills-payments">Оплата</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="" v-if="step === 2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card bg-gray px-lg-5 px-3 py-4 border-0">
                                        <h3 class="mt-3 ps-2 fw-bold">Способ оплаты</h3>
                                        <div class="row">
<!--                                            <div class="form-floating mb-3">-->
<!--                                                <div class="btn-group-toggle" data-toggle="buttons">-->
<!--                                                    <label class="btn btn-white">-->
<!--                                                        <input class="custom-radio" type="radio" name="options" id="option1" checked=""-->
<!--                                                               @click="order.payment='cash'"> <i-->
<!--                                                        class="fe fe-check-circle"></i> Наличными-->
<!--                                                    </label>-->
<!--                                                    <label class="btn btn-white active">-->
<!--                                                        <input type="radio" name="options" id="option2"-->
<!--                                                               @click="order.payment='cashback'"> <i-->
<!--                                                        class="fe fe-check-circle"></i> Кешбеком-->
<!--                                                    </label>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                            <div class="form-floating mb-3">
                                                <div class="btn-group-toggle" data-toggle="buttons">
                                                    <input class="custom-radio" type="radio" name="options" id="option1" :checked="radio == true"
                                                        @click="order.payment='cash'"><label style="margin-right: 100px" @click="radio = true,order.payment='cash'"> Наличными</label>
                                                    <input class="custom-radio" type="radio" name="options" ><label @click="confirmOrder" style="margin-right: 100px"> Корти милли</label>
                                                    <input v-if="user.cashback > 0" class="custom-radio" type="radio" name="options" id="option2"
                                                        @click="order.payment='cashback'" :checked="radio == false" ><label v-if="user.cashback > 0" @click="radio=false,order.payment='cashback'"> Кешбеком</label>
                                                </div>
                                            </div>
                                            <!--                                            <div class="btn-group-toggle" data-toggle="buttons">-->
                                            <!--                                                <input type="radio" name="cash" id="cash" checked-->
                                            <!--                                                       @click="order.payment='cash'">-->
                                            <!--                                                <label class="form-check-label fs-5" for="cash">Наличными</label>-->
                                            <!--                                            </div>-->
                                            <!--                                            <div class="btn-group-toggle" data-toggle="buttons">-->
                                            <!--                                                <input type="radio" name="cashback" id="cashback"-->
                                            <!--                                                       @click="order.payment='cashback'">-->
                                            <!--                                                <label class="form-check-label fs-5" for="cashback">Кешбек</label>-->
                                            <!--                                            </div>-->
                                            <div class="form-floating mb-3">
                                            <div v-if="order.payment==='cashback'"
                                                 class="form-check d-flex align-items-center col-lg-5 col-12">
                                                <input type="text" class="form-control feedback-input bg-gray"
                                                       v-model="order.cashback"
                                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                       placeholder="какую сумму кешбека хотите использовать?">
                                            </div>
                                            
                                            </div>
                                        </div>
                                        <div v-if="order.payment === 'cashback'">
                                            У вас {{user.cashback}} сомони кешбеком на балансе
                                        <p class="">
                                            Оплата покупки с бонусного счёта.
                                            У вас есть возможность оплатить полную или частичную стоимость товара. Просто укажите нужную сумму, и она спишется с бонусного счёта.
                                        </p>
                                        </div>
                                        <div v-else>
                                            Можете оплатить продукт во время доставки.
                                        </div>
                                        <div class="row px-3">
                                            <div class="col-12 col-lg-6">
                                                <p class="text-muted">

                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="d-flex justify-content-end">
                                                    <div class="float-right">
                                                        <button type="button"
                                                                class="btn btn-outline-dark fs-4 rounded-0"
                                                                @click="nextStep(1)">Назад
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-danger text-white  fs-4 rounded-0"
                                                                @click="nextStep(3) " :disabled="paymentButton">
                                                            <a class="text-light" style="text-decoration: none">Подтвердить</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="" v-else-if="Object.keys(cart).length == 0 && step == 1">
                    <h1>Корзина пуста</h1>
                    <p>Воспользуйтесь поиском, чтобы найти всё что нужно.</p>
                </div>
                <div class="" v-if="step === 3 ">
                    <ul class="nav nav-pills mb-5 justify-content-center align-items-center" id="pills-checkout"
                        role="tablist">
                        <li class="nav-item col-12 col-lg-3" role="presentation">
                            <a :class="`nav-link fs-5 text-center ${step === 1 && 'active'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" class="d-block m-auto"
                                     viewBox="0 0 49 49">
                                    <path
                                        d="M20.8757 14.9163L23.1115 12.6828V20.0677C23.1115 21.0043 23.8688 21.7608 24.8064 21.7608C25.7441 21.7608 26.5014 21.0043 26.5014 20.0677V12.7188L28.7372 14.9523C29.0617 15.2765 29.4945 15.4566 29.9272 15.4566C30.36 15.4566 30.7927 15.2765 31.1173 14.9523C31.7664 14.3039 31.7664 13.2231 31.1173 12.5747L25.9965 7.45931C25.3834 6.8469 24.2655 6.8469 23.6164 7.45931L18.4956 12.5747C17.8465 13.2231 17.8465 14.3039 18.4956 14.9523C19.1808 15.6007 20.2266 15.6007 20.8757 14.9163Z"></path>
                                    <path
                                        d="M38.9433 25.1832C38.4745 24.6789 33.2095 19.0591 33.2095 19.0591C32.5604 18.3747 31.5146 18.3387 30.8294 18.9871C30.1442 19.6355 30.1082 20.6802 30.7573 21.3647L33.8225 24.6068H15.7916L18.8569 21.3647C19.506 20.6802 19.4699 19.6355 18.7847 18.9871C18.0996 18.3747 17.0538 18.3747 16.4047 19.0591C16.4047 19.0591 11.0675 24.7509 10.6708 25.1832C10.2741 25.5795 9.84141 26.408 10.0578 27.1645L13.4476 39.7009C13.7 40.5655 14.4934 41.1779 15.3949 41.1779H34.2192C35.1208 41.1779 35.9141 40.5655 36.1666 39.7009L39.5564 27.1645C39.7727 26.408 39.4121 25.6876 38.9433 25.1832ZM20.0469 35.8463C20.0469 36.4587 19.542 36.9631 18.929 36.9631C18.3159 36.9631 17.8111 36.4587 17.8111 35.8463V29.9744C17.8111 29.362 18.3159 28.8577 18.929 28.8577C19.542 28.8577 20.0469 29.362 20.0469 29.9744V35.8463ZM25.925 35.8463C25.925 36.4587 25.4201 36.9631 24.8071 36.9631C24.194 36.9631 23.6892 36.4587 23.6892 35.8463V29.9744C23.6892 29.362 24.194 28.8577 24.8071 28.8577C25.4201 28.8577 25.925 29.362 25.925 29.9744V35.8463ZM31.8031 35.8463C31.8031 36.4587 31.2982 36.9631 30.6852 36.9631C30.0721 36.9631 29.5672 36.4587 29.5672 35.8463V29.9744C29.5672 29.362 30.0721 28.8577 30.6852 28.8577C31.2982 28.8577 31.8031 29.362 31.8031 29.9744V35.8463Z"></path>
                                </svg>
                                Детали покупки
                            </a>
                        </li>

                        <hr class="col-1 bg-dark me-4 d-none d-lg-block">
                        <li class="nav-item col-12 col-lg-3" role="presentation">
                            <a :class="`nav-link fs-5 text-center ${step === 2 && 'active'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" class="d-block m-auto"
                                     viewBox="0 0 49 49">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M36.4438 12.25H9.49375C8.47893 12.25 7.65625 13.0727 7.65625 14.0875V34.9125C7.65625 35.9273 8.47893 36.75 9.49375 36.75H36.4438C37.4586 36.75 38.2812 35.9273 38.2812 34.9125V14.0875C38.2812 13.0727 37.4586 12.25 36.4438 12.25ZM37.0562 34.9125C37.0562 35.2508 36.782 35.525 36.4437 35.525H9.49371C9.15543 35.525 8.88121 35.2508 8.88121 34.9125V14.0875C8.88121 13.7493 9.15543 13.475 9.49371 13.475H36.4437C36.782 13.475 37.0562 13.7493 37.0562 14.0875V34.9125ZM15.6186 19.6C15.9569 19.6 16.2311 19.3258 16.2311 18.9875C16.2311 18.6492 15.9569 18.375 15.6186 18.375H11.9436C11.6053 18.375 11.3311 18.6492 11.3311 18.9875C11.3311 19.3258 11.6053 19.6 11.9436 19.6H15.6186ZM22.9687 19.6H18.0687C17.7304 19.6 17.4562 19.3258 17.4562 18.9875C17.4562 18.6492 17.7304 18.375 18.0687 18.375H22.9687C23.3069 18.375 23.5812 18.6492 23.5812 18.9875C23.5812 19.3258 23.3069 19.6 22.9687 19.6ZM27.869 25.2758C28.5863 24.7711 29.4419 24.5002 30.319 24.5C32.1657 24.499 33.8054 25.6812 34.3878 27.4337C34.9703 29.1862 34.3645 31.1147 32.8845 32.2193C31.4045 33.3239 29.3834 33.3561 27.869 32.2992C26.0871 33.5474 23.6528 33.2631 22.2065 31.638C20.7601 30.0129 20.7601 27.5621 22.2065 25.937C23.6528 24.3119 26.0871 24.0277 27.869 25.2758ZM25.4188 31.85C23.7274 31.85 22.3563 30.4789 22.3563 28.7875C22.3563 27.0961 23.7274 25.725 25.4188 25.725C27.1102 25.725 28.4813 27.0961 28.4813 28.7875C28.4793 30.4781 27.1093 31.848 25.4188 31.85ZM28.7801 31.4199C29.2453 31.6983 29.7767 31.8469 30.3188 31.85C32.0102 31.85 33.3813 30.4789 33.3813 28.7875C33.3813 27.0961 32.0102 25.725 30.3188 25.725C29.7767 25.7281 29.2453 25.8766 28.7801 26.155C30.0151 27.6927 30.0151 29.8822 28.7801 31.4199Z"></path>
                                    <circle cx="35.2188" cy="15.3125" r="6.125" stroke="white"></circle>
                                    <path d="M33.1768 15.8228L35.2184 17.3541L38.2809 13.2708" stroke="white"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Оплата</a>
                        </li>
                        <hr class="col-1 bg-dark me-4 d-none d-lg-block">
                        <li class="nav-item col-12 col-lg-3" role="presentation">
                            <a :class="`nav-link fs-5 text-center ${step === 3 && 'active'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="49" class="d-block m-auto"
                                     viewBox="0 0 50 49">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M11.8932 10.6411H13.1554C14.201 10.6411 15.0486 11.4718 15.0486 12.4965V37.2347C15.0486 38.2594 14.201 39.0901 13.1554 39.0901H11.8932C10.8476 39.0901 10 38.2594 10 37.2347V12.4965C10 11.4718 10.8476 10.6411 11.8932 10.6411ZM38.3982 10.6411H19.4659C18.4202 10.6411 17.5726 11.4718 17.5726 12.4965V37.2347C17.5726 38.2594 18.4202 39.0901 19.4659 39.0901H38.3982C39.4438 39.0901 40.2914 38.2594 40.2914 37.2347V12.4965C40.2914 11.4718 39.4438 10.6411 38.3982 10.6411ZM39.0299 37.2348C39.0294 37.5762 38.7471 37.8528 38.3988 37.8532H19.4665C19.1181 37.8528 18.8358 37.5762 18.8354 37.2348V12.4965C18.8358 12.1551 19.1181 11.8785 19.4665 11.8781H38.3988C38.7471 11.8785 39.0294 12.1551 39.0299 12.4965V37.2348ZM35.8741 19.2995C36.2226 19.2995 36.5052 19.0226 36.5052 18.6811C36.5052 18.3395 36.2226 18.0626 35.8741 18.0626H28.3012C27.9526 18.0626 27.6701 18.3395 27.6701 18.6811C27.6701 19.0226 27.9526 19.2995 28.3012 19.2995H35.8741ZM26.2232 17.0069C26.4696 17.2484 26.4696 17.6399 26.2232 17.8814L23.6989 20.3552C23.4525 20.5967 23.053 20.5967 22.8066 20.3552L21.5444 19.1183C21.3053 18.8756 21.3087 18.4899 21.5521 18.2513C21.7955 18.0128 22.1891 18.0094 22.4368 18.2438L23.2528 19.0435L25.3309 17.0069C25.5773 16.7655 25.9768 16.7655 26.2232 17.0069ZM35.8741 25.4841C36.2226 25.4841 36.5052 25.2072 36.5052 24.8656C36.5052 24.524 36.2226 24.2472 35.8741 24.2472H28.3012C27.9526 24.2472 27.6701 24.524 27.6701 24.8656C27.6701 25.2072 27.9526 25.4841 28.3012 25.4841H35.8741ZM26.2232 23.1914C26.4696 23.433 26.4696 23.8244 26.2232 24.0659L23.6989 26.5398C23.4525 26.7812 23.053 26.7812 22.8066 26.5398L21.5444 25.3029C21.3053 25.0602 21.3087 24.6745 21.5521 24.4359C21.7955 24.1973 22.1891 24.194 22.4368 24.4284L23.2528 25.228L25.3309 23.1914C25.5773 22.95 25.9768 22.95 26.2232 23.1914ZM35.8741 31.6686C36.2226 31.6686 36.5052 31.3917 36.5052 31.0502C36.5052 30.7086 36.2226 30.4317 35.8741 30.4317H28.3012C27.9526 30.4317 27.6701 30.7086 27.6701 31.0502C27.6701 31.3917 27.9526 31.6686 28.3012 31.6686H35.8741ZM26.2232 29.376C26.4696 29.6175 26.4696 30.009 26.2232 30.2505L23.6989 32.7243C23.4525 32.9657 23.053 32.9657 22.8066 32.7243L21.5444 31.4874C21.3053 31.2447 21.3087 30.859 21.5521 30.6204C21.7955 30.3819 22.1891 30.3785 22.4368 30.6129L23.2528 31.4126L25.3309 29.376C25.5773 29.1346 25.9768 29.1346 26.2232 29.376ZM13.7864 37.2347C13.786 37.5761 13.5037 37.8528 13.1554 37.8532H11.8932C11.5448 37.8528 11.2625 37.5761 11.2621 37.2347V16.8257H13.7864V37.2347ZM11.2621 15.5888H13.7864V12.4965C13.786 12.1551 13.5037 11.8785 13.1554 11.8781H11.8932C11.5448 11.8785 11.2625 12.1551 11.2621 12.4965V15.5888Z"></path>
                                </svg>
                                Подтверждение</a>
                        </li>
                    </ul>
                    <div class="card bg-gray text-dark border-0 text-center" style="margin-bottom: 50px">
                        <div class="divider"></div>
                        <div class="card-body top-50 position-relative">
                            <h1 class="card-title">Ваш заказ принят</h1>
                            <p class="card-text">Наш менеджер свяжется с вами.</p>
                            <a type="button" href="/" class="btn btn-danger text-white  px-5 fs-4 rounded-0">На
                                главную страницу</a>
                        </div>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>
            <form class="d-none" action="https://alifpay.tj/web/#/checkout" method="post" ref="alifForm">
                <input type="text" name="token" :value="token">
                <input type="text" name="key" :value="key">
                <input type="text" name="callbackUrl" value="https://azam.tj/thank-you">
                <input type="text" name="returnUrl" value="https://azam.tj/">
                <input type="text" name="amount" :value="total" required>
                <input type="text" name="orderId" :value="orderId">
                <input type="text" name="info" value="AZAM">
                <input type="text" name="email" :value="user.email">
                <input type="text" name="phone" :value="user.phone">
                <input type="submit" value="Ok">
            </form>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'

export default {
    components: {
        AppLayout
    },
    props: {
        cartData: Object,
        user: Object,
        cities: Array,
    },
    data() {
        return {
            token: '',
            key: '',
            orderId: '',
            total: '',
            cart: [],
            order: {
                city: '',
                address: '',
                phone: '',
                courier: 1,
                payment: 'cash',
                cashback: 0,
            },
            step: 1,
            radio: true,
            paymentButton: false,
            cartItemCount: 0,
            summ: 0,
            examplePhone: false,
        }
    },
    mounted() {
        this.cart = this.cartData;
        for (const [key, value] of Object.entries(this.cart)) {
            value.size_quantity.forEach(element => {
                this.summ += value.price * element.quantity
                this.cartItemCount++
            });
        }
    },
    watch:{
        cart: function(){
            this.cartItemCount = 0;
            for (const [key, value] of Object.entries(this.cart)) {
                value.size_quantity.forEach(element => {
                    this.cartItemCount++
                });
            }
        }
    },
    created(){
        this.cities.unshift({
                        "id":this.cities.length,
                        "name":"Новый город",
                        "is_active":1,
                        "created_at":"",
                        "updated_at":"",
                        "deleted_at":null
                        })
    },
    methods: {
        confirmOrder(){
            this.paymentButton = true;
            axios.post(route('confirm-order'), this.order)
            .then(response => {
                this.orderId = response.data.order_id
                this.key = response.data.key
                this.token = response.data.token
                this.total = response.data.total
                this.step = 3
                this.cart = response.data.cart
                this.$refs.alifForm.submit();
            })
        },
        setSelected(){
            if(this.order.city == 'Новый город'){
                this.order.city = prompt("Введите город")
            }
        },
        nextStep(step) {
            if (step === 2) {
                if (this.order.city && this.order.address && this.order.phone.length == 9 && this.order.courier) {
                    this.step = step
                }else {
                    this.examplePhone = true
                }
            } else if (step === 3) {
                if (this.order.city && this.order.address && this.order.phone && this.order.courier) {
                    if (this.order.cashback > this.user.cashback || this.order.cashback < 0) {
                        this.$swal({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            icon: 'error',
                            title: 'Указанная сумма привышает баланс кешбека!'
                        })
                        return
                    } else {
                        if (this.summ < this.order.cashback) this.order.cashback = this.summ
                        this.paymentButton = true;
                        axios.post(route('confirm-order'), this.order)
                        .then(response => {
                            this.step = step
                            this.cart = response.data.cart
                        })
                    }
                }
            } else if (step === 1) {
                this.step = step
            }
        },
        
    },
}
</script>
