require('./bootstrap');
require('moment');

//manually
// require('./dashkit');
// require('./abuamr');

import Vue from 'vue';
import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueSwal from 'vue-swal';
import VueSweetalert2 from 'vue-sweetalert2';
import 'bootstrap';
import vSelect from 'vue-select'
import VueGoodTablePlugin from 'vue-good-table';
import Multiselect from 'vue-multiselect'
import VTreeselect from 'vue-treeselect'
import 'vue-good-table/dist/vue-good-table.css'
import 'vue-select/dist/vue-select.css';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueGoodTablePlugin);
Vue.use(VueSwal);
Vue.use(VueSweetalert2);
Vue.use(VueGoodTablePlugin);
Vue.use(VTreeselect);


Vue.component('multiselect', Multiselect)
Vue.component('v-select', vSelect)

Vue.mixin({ methods: { route } });

try {
    Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
    Vue.prototype.$userPermissions = JSON.parse(document.querySelector("meta[name='user-permissions']").getAttribute('content'));
    Vue.prototype.$userRoles = JSON.parse(document.querySelector("meta[name='user-roles']").getAttribute('content'));
}
catch(err) {
    Vue.prototype.$userId = 0;
}






const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
