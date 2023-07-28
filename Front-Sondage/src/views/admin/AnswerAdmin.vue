<template>
  <div>
    <!-- Le composant DashboardAdmin est inclus ici -->
    <DashboardAdmin />
    <div v-for="(items, index) in data" :key="items.id">
      <h1 class="titre">Sondé N°{{ index }}</h1>
      <table class="table table-dark">
        <thead class="table-primary">
          <tr>
            <th scope="col">Numero de la question</th>
            <th scope="col">Questions</th>
            <th scope="col">Réponses</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <!-- Boucle sur les réponses pour afficher les informations -->
          <tr v-for="item in items" :key="item.question_id">
            <td>{{ item.question_id }}</td>
            <td>{{ item.question.body }}</td>
            <td>{{ item.answer }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

  <script>
  import DashboardAdmin from '../../components/DashboardAdmin.vue';
  
  export default {
    name: "AnswerAdmin",
    components: {
      DashboardAdmin
    },
    data() {
      return {
        data: [],// Le tableau vide pour stocker les réponses des sondages
        isLoading: true,
      };
    },
    mounted() {
    // Le code ici utilise la méthode fetch pour appeler une API et récupérer les données.
    // Il utilise le token stocké dans le local storage pour s'authentifier auprès de l'API.
    // Les données sont ensuite stockées dans la propriété "data".

    // Lorsque les données sont chargées, isLoading est défini sur false.
  
      const token = localStorage.getItem("token");
  
      if (token) {
        fetch("http://127.0.0.1:8000/api/answer/group", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`, // Add the token to the Authorization header
          },
          method: "GET",
        })
          .then((response) => response.json())
          .then((data) => {
            this.data = data.data;
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        console.log("No token found. Please log in or get a valid token.");
      }
    },
  };
  </script>
  
  <style>
.titre{
    margin:30px 0px;
}


</style>