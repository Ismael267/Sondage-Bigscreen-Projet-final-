import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import QuestionSondage from '../views/public/QuestionSondage.vue'
import AnswerSondage from '../views/public/AnswerSondage.vue'
import Login from '../views/public/auth/Login.vue'
import Register from '../views/public/auth/Register.vue'
import NotFound from '../views/public/NotFound.vue'
import StatAdmin from '../views/admin/StatAdmin.vue'
import AdminLayout from '../views/admin/AdminLayout.vue'
import QuestionAdmin from '../views/admin/QuestionAdmin.vue'
import AnswerAdmin from '../views/admin/AnswerAdmin.vue'
import { authGuard } from '../_helpers/auth-guard'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'question',
      component: QuestionSondage
    },
    {
      path: '/answerSondage',
      name: 'answerSondage',
      component: AnswerSondage
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/AdminLayout',
      name: 'AdminLayout',
      beforeEnter:authGuard,
      component: AdminLayout,
      children:[
        {
          path: '/QuestionAdmin',
          name: 'questionAdmin',
          component: QuestionAdmin
        },
        {
          path: '/AnswerAdmin',
          name: 'answerAdmin',
          component: AnswerAdmin
        },
        {
      path: '/statAdmin',
      name: 'statAdmin',
      component: StatAdmin,
        },
      ]
    },
    {
      path: '/404',
      name: '404',
      component: NotFound
    },
    {
      path:'/:pathmatch(.*)*',
      redirect:'/404'
     },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }
  ]
})
router.beforeEach((to,from,next)=>{
  if (to.matched[0].name=='statAdmin') {
    authGuard()
  }
  next()
})
export default router
