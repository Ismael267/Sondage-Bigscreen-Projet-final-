<template>
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
            <button type="submit" class="form-button">Se connecter</button>
        </form>
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
      errorMessage: ""
    };
  },
  methods: {
    login() {
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
          this.$router.push({ name: "question" });
        })
        .catch(error => {
          this.errorMessage = error.message;
          console.log(error);
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
    font-family: Poppins, sans-serif;
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
    margin:0 auto;
    
}
</style>
