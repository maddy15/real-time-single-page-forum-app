import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/Login/Login.vue'
import Signup from '../components/Login/Signup.vue'
import Logout from '../components/Login/Logout.vue'
import Forum from '../components/Forum/Forum.vue'
import Category from '../components/Category/CreateCategory.vue'
import Read from '../components/Forum/Read.vue'
import Create from '../components/Forum/Create.vue'
import AppHome from '../components/AppHome.vue'

Vue.use(VueRouter);

const routes = [
    { path: '/forum', component: Forum },
    { path: '/login', component: Login, 
    beforeEnter: (to, from, next) => {
      if(User.loggedIn()) next(from.path);;
      next();
    } 
  },
    { path: '/signup', component: Signup,
    beforeEnter: (to, from, next) => {
      if(User.loggedIn()) next(from.path);
      next();
    } 
   },
    { path: '/questions/:slug', component: Read,
    beforeEnter: (to, from, next) => {
      if(!User.loggedIn()) {
        localStorage.setItem('path',to.path);
        next('/login');
      }
      next();
    } 
   },
    { path: '/category', component: Category },
    { path: '/create', component: Create },
    { path: '/logout', component: Logout },
  ];

  const router = new VueRouter({
    routes,
    mode: 'history',
  });

  export default router