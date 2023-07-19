<template>
    <div>
        <DashboardAdmin/>
        <div class="first-content">
        <h1 class="firstTitle">Graphique de type pie</h1>
        <div class="graph-container">
            <canvas id="chart1"></canvas>
            <canvas id="chart2"></canvas>
            <canvas id="chart3"></canvas>
          </div>
          <div class="second-content">
            <h1 class="firstTitle">Graphique de type radar</h1>
            <div class="second-grah">
                <canvas id="radarChart"></canvas>
            </div>
        </div>
        </div>
    </div>
  
</template> 
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
       console.log(data.data.id);
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


      
  const ctx1 = document.getElementById('chart1').getContext('2d');
  new Chart(ctx1, {
    type: 'pie',
    data: {
      labels: ['Oculus Quest', 'Oculus Quest', 'HTC Vive','windows Mixed Reality','Valve index'],
      datasets: [{
        data: [30, 20, 15,10,15,15],
        backgroundColor: ['red', 'blue', 'yellow','green','purple','orange'],
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

  const ctx2 = document.getElementById('chart2').getContext('2d');
  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: ['SteamVR', 'Occulus store', 'Viveport','Windows store'],
      datasets: [{
        data: [15, 12, 20,10,10],
        backgroundColor: ['pink', 'teal', 'gray','green','blue'],
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

  const ctx3 = document.getElementById('chart3').getContext('2d');
  new Chart(ctx3, {
    type: 'pie',
    data: {
      labels: ['regarder la TV en direct', 'regarder des films', 'travailler','jouer en solo','jouer en équipe'],
      datasets: [{
        data: [10,25,18,10,21],
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
  const ctx = document.getElementById('radarChart').getContext('2d');
    new Chart(ctx, {
      type: 'radar',
      data: {
        labels: ["Qualité de l'image", "Confort d'utilisation", 'Connexion réseau', 'Qualité des graphimes 3D', 'Qualité audio'],
        datasets: [{
          label: 'Qualité',
          data: [1,2,3,4,5],
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
            max: 5
          }
        }
      }
    });
}



}
</script>

<style>
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
  
  .second-grah{
    display: flex;
    justify-content: center;
    margin: 10px;
    
  }
  
  .second-graph canvas {
    max-width: 200px;
    max-height: 200px;
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
  }
  .second-content{
    margin: 40px;
  }
  </style>

  
  
  
  
  
  