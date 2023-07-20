<template>
  <div>
    <p class="title">Vous trouverez ci-dessous les réponses que vous avez apportées à notre sondage le {{ formattedDate }}.</p>
    <div class="form">
      <div class="card" v-for="(question, index) in questions" :key="question.id">
        <h1 class="question-title">Question {{ index + 1 }}/{{ count }}</h1>
        <div class="card-body">
          <p class="question-body">{{ question.body }}</p>
          <div class="dotted-line">
            <div class="answer-container">
              <p v-if="answers[index]">{{ answers[index].answer }}</p>
            </div>
          </div> <!-- Pointillés formant un rectangle -->
        </div>
      </div>
      <div class="button-container">
        <button @click="$router.push({name: 'question'})">Retour</button>
      </div>
    </div>
  </div>
</template>

<style>
.card {
  margin: 50px 0px;
  padding: 20px;
  background-color: #f8f8f8;
}
.title {
  text-align: center;
  font-size: 1.7em;
  font-family: poppins;
}

.form {
  padding: 0px;
  border-radius: 10px;
  color: #333333;
  margin-top: 50px;
}

.question-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.question-body {
  font-size: 17px;
  margin-bottom: 20px;
  font-family: poppins;
}

.dotted-line {
  border: 2px dashed #dddddd; /* Pointillés ajoutés */
  border-radius: 10px;
  margin: 10px 0; /* Pointillés ajoutés */
  padding: 10px; /* Ajout d'une marge interne */
  background-color: #3255b8d6;
}

.answer-container {
  /* Ajoutez ici les styles pour les éléments de réponse */
  color: white;
}

.submit-button {
  background-color: #333333;
  color: #ffffff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  margin-left: auto;
}

.submit-button:hover {
  background-color: #555555;
}
</style>

<script>
export default {
  data() {
    return {
      questions: [],
      count: 0,
      answers: [],
      formattedDate: "", // Nouvelle variable pour la date formatée
    };
  },
  mounted() {
    fetch("http://127.0.0.1:8000/api/question/all")
      .then((response) => response.json())
      .then((data) => {
        this.questions = data.data;
        this.count = data.data.length;
        this.answers = new Array(this.count).fill("");
        console.log(data.data);
      })
      .catch((error) => {
        console.log(error);
      });

    const token = this.$route.params.answerToken;
    console.log(token);
    fetch(`http://127.0.0.1:8000/api/answer/display/${token}`)
      .then((response) => response.json())
      .then((data) => {
        const date = new Date(data.created_at);
        this.formattedDate = date.toLocaleString("fr-FR");
        this.answers = data.answers;
        console.log(data.answers);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
