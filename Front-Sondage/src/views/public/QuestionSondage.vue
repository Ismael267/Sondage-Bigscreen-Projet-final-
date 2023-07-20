<template>
  <div>
    <p class="title">
      Merci de répondre à toutes les questions et de valider le formulaire en
      bas de page.
    </p>
  
    <div class="form">
      <form @submit.prevent="addAnswer">
        <div v-if="emailError" class="error-message">
          {{ emailError }}
        </div>
        <div
          class="card"
          v-for="(question, index) in questions"
          :key="question.id"
        >
          <h1 class="question-title">Question {{ index + 1 }}/{{ count }}</h1>
          <div class="card-body">
            <p class="question-body">{{ question.body }}</p>
            <div v-if="question.type === 'A'" class="choice-container">
              <select v-model="answers[index]" class="choice-select" required>
                <option
                  v-for="choice in getChoices(question.choices)"
                  :value="choice"
                  :key="choice"
                >
                  {{ choice }}
                </option>
              </select>
            </div>
            <div v-else-if="question.type === 'B'" class="choice-container">
              <input
                type="text"
                :id="question.id"
                maxlength="255"
                v-model="answers[index]"
                class="choice-input"
                required
              />
            </div>
            <div v-else-if="question.type === 'C'" class="choice-container">
              <input
                type="number"
                min="1"
                max="5"
                v-model="answers[index]"
                class="choice-input"
                required
              />
            </div>
          </div>
        </div>
        <div v-if="showPopup" class="popup">
          <div class="popup-content">
            <p>Toute l’équipe de Bigscreen vous remercie pour votre engagement. Grâce à
              votre investissement, nous vous préparons une application toujours plus facile
              à utiliser, seul ou en famille.
              Si vous désirez consulter vos réponses ultérieurement, vous pouvez consultez
              cette adresse: http://localhost:5173/answerSondage/{{token}}</p>
            <button @click="closePopup">Fermer</button>
          </div>
        </div>
        <div class="button-container">
          <button type="submit" class="submit-button">Finaliser</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      questions: [],
      count: 0,
      answers: [],
      emailError: "", 
      showPopup: false,
    token:[]
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
    closePopup() {
      // Close the popup when the "Close" button is clicked
      this.showPopup = false;
    },
    async addAnswer() {
        // Check if the answer for the first question is a valid email using regex
        const firstAnswer = this.answers[0];
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(firstAnswer)) {
        this.emailError = "Please provide a valid email address.";
        window.scrollTo(0, 0);
        return; // Prevent form submission if the email is invalid
      }

      // Reset the email error message if the email is valid
      this.emailError = "";
      const answers = this.questions.map((question, index) => {
        return {
          questionId: question.id,
          answer: this.answers[index],
        };
      });

      try {
        const response = await fetch("http://127.0.0.1:8000/api/answer/add", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ answers }),
        });

        if (response.ok) {
          const responseData = await response.json();
          console.log(responseData.token);
          this.token = responseData.token;
          this.$router.push({
           
            params: { answerToken: this.token },
          });
          this.showPopup = true;

          console.log("Réponses ajoutées avec succès");
        } else {
          throw new Error("Error adding answers.");
        }
      } catch (error) {
        console.log(error);
        // Handle validation errors here
        // Display error messages to the user
      }
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
        this.count = data.data.length;
        this.answers = new Array(this.count).fill("");
        console.log(data.data);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

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
.error-message{
  color: red;
  font-size: 15px;
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
  font-family: poppins;
  background-color: #efeeee;
}
.popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  text-align: center;
}

.popup button {
  background-color: #333333;
  color: #ffffff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  margin-top: 10px;
}

.popup button:hover {
  background-color: #555555;
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
