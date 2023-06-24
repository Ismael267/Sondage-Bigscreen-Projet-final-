<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
// import Forms from './components/Forms.vue'
// import login from './views/public/Login.vue'

</script>

<template>
  <!-- <header> -->
  <img alt="Vue logo" class="logo" src="@/assets/bigscreen.svg" width="125" height="125" />
  <!-- <div class="wrapper"> 
      <HelloWorld msg="You did it!" /> 

    
    </div> -->
  <!-- </header> -->
  <!-- <h1 class="mainTitle">Bigscreen</h1> -->
  <!-- <p>Merci de repondre a toutes les questions et de valider le formulaire en bas de pages.</p>
<nav>
  <RouterLink to="/">Home</RouterLink>
  <RouterLink to="/about">About</RouterLink>
  <router-link to="/login">login</router-link>
</nav> -->


  <RouterView />
</template>

<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

.mainTitle {

  font-size: 70px;
  padding: 30px 0px;
  font-family: poppins;
  margin: 0 auto;
  display: flex;
  justify-content: space-around;
  font-weight: 500;

}

p {
  font-size: 20px;
}

.logo {
  display: block;
  width: 100%;
  padding: 20px;
  margin-bottom: 60px;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {

    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }



  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
