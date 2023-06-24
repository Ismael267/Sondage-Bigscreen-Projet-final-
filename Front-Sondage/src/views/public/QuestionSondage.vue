<template>
    <p >Merci de repondre a toutes les questions et de valider le formulaire en bas de pages.</p>
    <div class="form">
      <form action="">
        <div class="element" v-for="question in questions" :key="question.id">
          <h1 class="question-title">Question {{ question.title }}/{{ count }}</h1>
          <p class="question-body">{{ question.body }}</p>
          <div>
            <div v-if="question.type === 'A'" class="choice-container">
              <select class="choice-select">
                <option v-for="choice in getChoices(question.choices)" :value="choice" aria-required="">{{ choice }}</option>
              </select>
            </div>
            <div v-else-if="question.type === 'B'" class="choice-container">
              <input type="text" maxlength="255" class="choice-input">
            </div>
            <div v-else-if="question.type === 'C'" class="choice-container">
              <input type="number" min="1" max="5 " class="choice-input">
            </div>
          </div>
        </div>
        <button type="submit" class="submit-button">Finaliser</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        questions: [],
        count: 0,
      };
    },
    methods: {
      getChoices(choices) {
        if (!choices) {
          return [];
        }
        if (typeof choices === "string") {
          return JSON.parse(choices);
        }
        return choices;
      },
    },
    mounted() {
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
          this.count = Object.keys(data.data).length;
          console.log(data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  };
  </script>
  
  <style>
  .form {
    background-color: #f8f8f8;
    padding: 35px;
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
    font-size: 16px;
    margin-bottom: 20px;
  }
  
  .choice-container {
    margin-bottom: 20px;
  }
  
  .choice-select,
  .choice-input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #dddddd;
    border-radius: 5px;
  }
  
  .submit-button {
    background-color: #333333;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }
  
  .submit-button:hover {
    background-color: #555555;
  }
  </style>
  