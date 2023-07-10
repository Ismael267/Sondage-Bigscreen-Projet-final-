<template>
  <div>
    <div v-if="errorMessage" class="notification">
      {{ errorMessage }}
    </div>
    <div class="form-container">
      <h1 class="form-title">Page de connexion</h1>
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-input" v-model="user.email" required>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password" class="form-input" v-model="user.password" required>
        </div>
        <button class="form-button" :disabled="loading">
          <span v-if="loading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
          <span v-if="loading" class="visually-hidden">Loading...</span>
          <span v-if="!loading">Se connecter</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      user: {
        email: "",
        password: ""
      },
      errorMessage: "",
      loading: false
    };
  },
  methods: {
    login() {
      this.loading = true; // Start the loading animation

      fetch("http://127.0.0.1:8000/api/login", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        },
        method: "POST",
        body: JSON.stringify(this.user)
      })
        .then(res => {
          if (res.ok) {
            return res.json();
          } else {
            throw new Error("Échec de la connexion. Veuillez vérifier vos informations d'identification.");
          }
        })
        .then(data => {
          if (data.status === "failed") {
            throw new Error("Échec de la connexion. Veuillez vérifier vos informations d'identification.");
          }
          localStorage.setItem("token", data.Token);
          this.$router.push({ name: "statAdmin" });
        })
        .catch(error => {
          this.errorMessage = error.message;
          console.log(error);
        })
        .finally(() => {
          this.loading = false; // Stop the loading animation
        });
    }
  }
};
</script>

<style>
.form-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 0px;
  background-color: white;
  color: black;
  font-family: "Poppins", sans-serif;
  border-radius: 10px;
  width: 350px;
  margin: 0 auto; /* Ajout de cette ligne pour centrer le formulaire horizontalement */
}

.form-title {
  font-size: 24px;
  margin-bottom: 20px;
  font-weight: 600;
  text-transform: uppercase;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

label {
  font-size: 18px;
}

.form-input {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.form-button {
  padding: 10px 20px;
  font-size: 18px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.form-button:hover {
  background-color: #0056b3;
}

.notification {
  background-color: #ff0000;
  color: #fff;
  padding: 1rem;
  margin-top: 1rem;
  border-radius: 0.25rem;
  width: 350px;
  justify-content: center;
  margin: 0 auto;
}

.spinner-grow {
  display: inline-block;
  width: 1rem;
  height: 1rem;
  vertical-align: text-bottom;
  border: 0.2em solid currentColor;
  border-right-color: transparent;
  border-radius: 50%;
  animation: spinner-grow 0.75s linear infinite;
}

@keyframes spinner-grow {
  0% {
    transform: scale(0);
  }
  50% {
    opacity: 1;
    transform: none;
  }
}

.visually-hidden {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}
</style>
