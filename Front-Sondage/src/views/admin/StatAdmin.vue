<template>
  <div>
      <DashboardAdmin/>
      <div class="azerty">
        <div class="first-content">
          <h1 class="firstTitle">Graphique Question 6</h1>
          <div class="graph-container">
              <canvas id="chart1"></canvas>
          </div>
      </div>
      <div class="first-content">
          <h1 class="firstTitle">Graphique Question 7</h1>
          <div class="graph-container">
              <canvas id="chart2"></canvas>
          </div>
      </div>
      </div>
     <div class="azerty">
      <div class="first-content">
        <h1 class="firstTitle">Graphique Question 10</h1>
        <div class="graph-container">
            <canvas id="chart3"></canvas>
        </div>
    </div>
    <div class="first-content">
        <h1 class="firstTitle">Graphique Question 11 à 15</h1>
        <div class="graph-container">
            <canvas id="radarChart"></canvas>
        </div>
    </div>
     </div>
  
  </div>
</template>

<style>
.azerty{
  display: flex;
  justify-content: space-around;
  
 
}
.Title3{
  color: black;
}

.graph-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
  
  }
  
  .graph-container canvas {
    flex: 1;
  max-width: 400px;
  max-height: 400px;
    margin: 10px;
    border-radius: 20px;
    padding-top: 10px;
  }

 
  .firstTitle{
    text-align:center ;
    margin: 20px;
    color:var(--color-background) ;
  }
  .first-content{
    background-color: white;
    border-radius: 20px;
    padding: 20px;
    margin: 30px 0px;
  }
  .second-content{
    margin: 0px;
  }
 </style>

<script>


import DashboardAdmin from '../../components/DashboardAdmin.vue';
export default{
    components: {DashboardAdmin},
    mounted() {
 // Retrieve token from local storage
 const token = localStorage.getItem("token");
  
  if (token) {
    fetch("http://127.0.0.1:8000/api/answer/all", {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`, // Add the token to the Authorization header
      },
      method: "GET",
    })
      .then((response) => response.json())
      .then((data) => {
       console.log(data.data);
// Assuming data.data is the array containing the answer objects
const answersQuest6 = ['Oculus Quest', 'Oculus Rift/s', 'HTC Vive', 'Windows Mixed Reality', 'Valve index'];
const filteredAnswersCounts6 = answersQuest6.map(answer => data.data.filter(item => item.question_id === 6 && item.answer.toLowerCase() === answer.toLowerCase()).length);
const ctx1 = document.getElementById('chart1').getContext('2d');
new Chart(ctx1, {
  type: 'pie',
  data: {
    labels: answersQuest6,
    datasets: [{
      data: filteredAnswersCounts6,
      backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple'],
      borderWidth: 1
    }]
  },
  options: {
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  }
});
const answersQuest7 = ['SteamVR', 'Oculus store', 'Viveport','Windows store'];
const filteredAnswersCounts7 = answersQuest7.map(answer => data.data.filter(item => item.question_id === 7 && item.answer.toLowerCase() === answer.toLowerCase()).length);
const ctx2 = document.getElementById('chart2').getContext('2d');
  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels:answersQuest7,
      datasets: [{
        data: filteredAnswersCounts7,
        backgroundColor: ['pink','red','gray','green'],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
const answersQuest10 = ['regarder la TV en direct', 'regarder des films', 'travailler','jouer en solo','jouer en équipe'];
const filteredAnswersCounts10 = answersQuest10.map(answer => data.data.filter(item => item.question_id === 10 && item.answer.toLowerCase() === answer.toLowerCase()).length);
const ctx3 = document.getElementById('chart3').getContext('2d');
  new Chart(ctx3, {
    type: 'pie',
    data: {
      labels: answersQuest10,
      datasets: [{
        data: filteredAnswersCounts10,
        backgroundColor: ['orange', 'green', 'purple','blue','red'],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
        const question11Responses = data.data.filter((answer) => answer.question_id === 11);
        const sumOfAnswers11 = question11Responses.reduce((acc, answer) => acc + answer.answer, 0);

        // Filtering the responses for question_id === 12
        const question12Responses = data.data.filter((answer) => answer.question_id === 12);
        const sumOfAnswers12 = question12Responses.reduce((acc, answer) => acc + answer.answer, 0);
       
        // Filtering the responses for question_id === 13
        const question13Responses = data.data.filter((answer) => answer.question_id === 13);
        const sumOfAnswers13 = question13Responses.reduce((acc, answer) => acc + answer.answer, 0);
      

        // Filtering the responses for question_id === 14
        const question14Responses = data.data.filter((answer) => answer.question_id === 14);
        const sumOfAnswers14 = question14Responses.reduce((acc, answer) => acc + answer.answer, 0);
  
        // Filtering the responses for question_id === 15
        const question15Responses = data.data.filter((answer) => answer.question_id === 15);
        const sumOfAnswers15 = question15Responses.reduce((acc, answer) => acc + answer.answer, 0);
        const ctx = document.getElementById('radarChart').getContext('2d');
    new Chart(ctx, {
      type: 'radar',
      data: {
        labels: ["Qualité de l'image", "Confort d'utilisation", 'Connexion réseau', 'Qualité des graphimes 3D', 'Qualité audio'],
        datasets: [{
          label: 'Qualité',
          data: [sumOfAnswers11,sumOfAnswers12,sumOfAnswers13,sumOfAnswers14,sumOfAnswers15],
          backgroundColor: 'rgba(75, 192, 192, 0.6)',
          borderColor: 'rgba(75, 192, 192, 1)',
          pointBackgroundColor: 'rgba(75, 192, 192, 1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(75, 192, 192, 1)'
        }]
      },
      options: {
        scales: {
          r: {
            beginAtZero: true,
            max: 20
          }
        }
      }
    });
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


}



}
</script>


  
  
  
  
  
  