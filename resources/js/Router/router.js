import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/Login/Login.vue'
import AppHome from '../components/AppHome.vue'
Vue.use(VueRouter);

const routes = [
    { path: '/', component: AppHome },
    { path: '/login', component: Login },
  ];

  const router = new VueRouter({
    routes,
    mode: 'history',
  });

  export default router