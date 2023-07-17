<template>
  <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
          <img alt="Vue logo" class="" src="@/assets/bigscreen.svg" width="125" height="125" />
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
              <img alt="Vue logo" class="" src="@/assets/bigscreen.svg" width="125" height="50" />
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
              <li class="nav-item">
                <router-link to="/Administration">Accueil</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/QuestionAdmin" >Questions</router-link>
              </li>
              <li class="nav-item">
                 <router-link to="/answerAdmin">Reponses</router-link>
              </li>
            </ul>
              <button class="btn btn-success" @click="deleteToken" type="submit">Deconnexion</button>
          </div>
        </div>
      </div>
    </nav>
    
  </template>
<script>
import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
// import DashboardAdmin from '../../components/DashboardAdmin.vue';
export default{
  // components:{DashboardAdmin}
  methods: {
    deleteToken() {
      localStorage.removeItem('token');
      this.$router.push("/login")
    }
  },
}

</script>
<style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css");
.offcanvas-body{
  display: grid;
  align-content: space-around;
  justify-items: center;
  font-size: 20px;    
}
.nav-item:hover {
  background-color: gray;
  width: 100%;
  display: block;
}
.nav-item:hover  {
  width: 100%;
}



</style>