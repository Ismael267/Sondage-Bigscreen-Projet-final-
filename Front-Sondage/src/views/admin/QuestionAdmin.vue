<template>
  <div>
    <!-- Le composant DashboardAdmin est inclus ici -->
    <DashboardAdmin />
    <table class="table table-dark">
      <thead class="table-primary">
        <tr>
          <th scope="col">Numero de la question</th>
          <th scope="col">Question</th>
          <th scope="col">Type de la question</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <!-- Condition pour afficher une icône de chargement lorsque isLoading est true -->
        <td>
          <div v-if="isLoading">
            <div class="text-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          </div>
        </td>
        <td>
          <div v-if="isLoading">
            <div class="text-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          </div>
        </td>
        <td>
          <div v-if="isLoading">
            <div class="text-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          </div>
        </td>

        <!-- Boucle sur les questions pour afficher les informations dans le tableau -->
        <tr v-for="question in questions" :key="question.id">
          <td>{{ question.title }}</td>
          <td>{{ question.body }}</td>
          <td>{{ question.type }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import DashboardAdmin from '../../components/DashboardAdmin.vue';
export default{
    components:{DashboardAdmin},
    data() {
      return {
        questions : [],// Le tableau vide pour stocker les questions
        isLoading: true // Propriété pour gérer l'affichage de l'icône de chargement
    
      }
    },
    mounted() {
          // Le code ici utilise la méthode fetch pour appeler une API et récupérer les questions.
    // Les données sont ensuite stockées dans la propriété "questions".
    // Lorsque les données sont chargées, isLoading est défini sur false.
    fetch("http://127.0.0.1:8000/api/question/all", {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      method: "GET",
    })
      .then((response) => response.json())
      .then((data) => {
        this.questions = data.data;
        this.count = data.data.length;
        this.answers = new Array(this.count).fill("");
        console.log(data.data);
      })
      .catch((error) => {
        console.log(error);
      })
      .finally(() => {
        this.isLoading = false;
      });
  },
}

</script>
<style>


</style>