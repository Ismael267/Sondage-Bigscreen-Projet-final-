<template>
  <!-- Modèle de la barre de navigation -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <img alt="Logo Vue" class="" src="@/assets/bigscreen.svg" width="125" height="125" />
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Basculer la navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Menu déroulant (offcanvas) -->
      <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <img alt="Logo Vue" class="" src="@/assets/bigscreen.svg" width="125" height="50" />
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>
        <div class="offcanvas-body">
          <!-- Liens de navigation -->
          <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
            <li class="nav-item">
              <router-link to="/Administration">Accueil</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/QuestionAdmin">Questions</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/answerAdmin">Réponses</router-link>
            </li>
          </ul>
          <!-- Bouton de déconnexion -->
          <button class="btn btn-success" @click="deleteToken" type="submit">Déconnexion</button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js";
// import DashboardAdmin from '../../components/DashboardAdmin.vue';
export default {
  // components:{DashboardAdmin}
  methods: {
    // Méthode pour supprimer le jeton (token) du stockage local (localStorage) et rediriger vers la page de connexion
    deleteToken() {
      localStorage.removeItem('token');
      this.$router.push("/login");
    },
  },
}
</script>

<style>
/* Import des styles de Bootstrap */
@import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css");

/* Styles pour le corps du menu déroulant (offcanvas) */
.offcanvas-body {
  display: grid;
  align-content: space-around;
  justify-items: center;
  font-size: 20px;    
}

/* Styles pour l'effet au survol des éléments de navigation */
.nav-item:hover {
  background-color: gray;
  width: 100%;
  display: block;
}
.nav-item:hover  {
  width: 100%;
}
</style>
