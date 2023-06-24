<template>
    <div>
        
    </div>
</template>

<script>
export default {
  name: "register",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        // password_confirmation: "",
        successMessage: "",
        errorMessage: ""
      }
    };
  },
  methods: {
    register() {
      fetch("http://127.0.0.1:8000/api/users/register", {
        headers: {
          accept: "application/json",
          "Content-Type": "application/json"
        },
        method: "POST",
        body: JSON.stringify(this.user)
      })
        .then(response => {
          if (response.ok) {
            this.successMessage = "Inscription réussie !";
            this.errorMessage = "";
            this.$router.push({ name: "login" });
          } else {
            this.successMessage = "";
            this.errorMessage = "Échec de l'inscription";
          }
          console.log(response.status);
          return response.json();
        })
        .then(data => console.log(data))
        .catch(error => console.log(error));
    }
  }
};
</script>