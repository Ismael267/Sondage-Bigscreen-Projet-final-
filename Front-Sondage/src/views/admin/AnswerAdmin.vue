<template>
    <div>
      <DashboardAdmin />
      <div v-for="(items,index) in data" :key="items.id">
        <h1 class="titre">Sondé N°{{index}}</h1>
        <table class="table table-dark">
          <thead class="table-primary">
            <tr>
              <th scope="col">Numero de la question</th>
              <th scope="col">Questions</th>
              <th scope="col">Réponses</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr v-for="item, in items" :key="item.question_id">
              <td>{{ item.question_id }}</td>
              <td >{{item.question.body}}</td>
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
        data: [],
        isLoading: true,
        
      };
    },
    mounted() {
      fetch("http://127.0.0.1:8000/api/answer/group", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
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
  
    },
  };
  </script>
  <style>
.titre{
    margin:30px 0px;
}


</style>