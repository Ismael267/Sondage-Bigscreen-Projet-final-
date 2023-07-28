import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import QuestionSondage from '../views/public/QuestionSondage.vue';
import AnswerSondage from '../views/public/AnswerSondage.vue';
import Login from '../views/public/auth/Login.vue';
import Register from '../views/public/auth/Register.vue';
import NotFound from '../views/public/NotFound.vue';
import StatAdmin from '../views/admin/StatAdmin.vue';
import AdminLayout from '../views/admin/AdminLayout.vue';
import QuestionAdmin from '../views/admin/QuestionAdmin.vue';
import AnswerAdmin from '../views/admin/AnswerAdmin.vue';
import { authGuard } from '../_helpers/auth-guard';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // Routes publiques
    {
      path: '/',
      name: 'question',
      component: QuestionSondage
    },
    {
      path: '/answerSondage/:answerToken',
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

    // Routes protégées par authGuard dans AdminLayout
    {
      path: '/AdminLayout',
      name: 'AdminLayout',
      beforeEnter: authGuard, // Utilise la fonction authGuard comme garde de route pour cette vue.
      component: AdminLayout,
      children: [
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
          path: '/Administration',
          name: 'Administration',
          component: StatAdmin,
        },
      ]
    },

    // Route pour la page 404
    {
      path: '/404',
      name: '404',
      component: NotFound
    },
    {
      path:'/:pathmatch(.*)*',
      redirect:'/404'
     },

    // Route d'exemple avec chargement différé (lazy loading)
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue') // Lazy loading de la vue AboutView
    }
  ]
});

// Middleware qui sera exécuté avant chaque navigation
router.beforeEach((to, from, next) => {
  if (to.matched[0].name == 'statAdmin') {
    authGuard(); // Vérifie l'authentification avant d'accéder à la route protégée AdminLayout
  }
  next(); // Continue la navigation
});

export default router;
