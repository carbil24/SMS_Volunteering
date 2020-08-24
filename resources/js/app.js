require('./bootstrap');

window.Vue = require('vue');

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
// CommonJS
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
})
window.Toast = Toast;

//global registration
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)


import Vue from 'vue'
import vueCountryRegionSelect from 'vue-country-region-select'
Vue.use(vueCountryRegionSelect)


import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader


let routes = [
    { path: '/teachers', component: require('./components/management/TeacherManagementComponent.vue').default },
    { path: '/students', component: require('./components/management/StudentManagementComponent.vue').default },
    { path: '/employees', component: require('./components/management/EmployeeManagementComponent.vue').default },
    { path: '/home', component: require('./components/portals/AdminPortalComponent.vue').default },
    { path: '/admissions', component: require('./components/schoolAdmissions/AdmissionsComponent.vue').default },
    { path: '*', component: require('./components/NoAccessComponent.vue').default }
  ]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })





//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('admin-menu', require('./components/menus/AdminMenuComponent.vue').default);
Vue.component('student-menu', require('./components/menus/StudentMenuComponent.vue').default);
Vue.component('teacher-menu', require('./components/menus/TeacherMenuComponent.vue').default);
Vue.component('school-manager-menu', require('./components/menus/SchoolManagerMenuComponent.vue').default);
Vue.component('recepcionist-menu', require('./components/menus/RecepcionistMenuComponent.vue').default);

Vue.component('admin-portal', require('./components/portals/AdminPortalComponent.vue').default);
Vue.component('student-portal', require('./components/portals/StudentPortalComponent.vue').default);
Vue.component('teacher-portal', require('./components/portals/TeacherPortalComponent.vue').default);
Vue.component('school-manager-portal', require('./components/portals/SchoolManagerPortalComponent.vue').default);
Vue.component('recepcionist-portal', require('./components/portals/RecepcionistPortalComponent.vue').default);

Vue.component('student-admissions-form', require('./components/schoolAdmissions/StudentFormComponent.vue').default);
Vue.component('responsible1-admissions-form', require('./components/schoolAdmissions/Responsible_1_FormComponent.vue').default);
Vue.component('responsible2-admissions-form', require('./components/schoolAdmissions/Responsible_2_FormComponent.vue').default);
Vue.component('responsible-admissions-section', require('./components/schoolAdmissions/RespoSectionComponent.vue').default);
Vue.component('emergency-admissions-form', require('./components/schoolAdmissions/EmergencyContactFormComponent.vue').default);
Vue.component('agreement-admissions-form', require('./components/schoolAdmissions/AgreementFormComponent.vue').default);
Vue.component('medical-admissions-form', require('./components/schoolAdmissions/MedicalFormComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify({
      icons: {
        iconfont: 'mdi'
      }
    }),
});

