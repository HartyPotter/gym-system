// Simulated data
const sessions = [
    { date: "2024-12-20", time: "10:00 AM", type: "Yoga", performance: "Good" },
    { date: "2024-12-21", time: "2:00 PM", type: "HIIT", performance: "Excellent" },
    { date: "2024-12-22", time: "5:00 PM", type: "Strength Training", performance: "Average" },
    { date: "2024-12-23", time: "6:00 PM", type: "Cycling", performance: "Excellent" }
  ];
  
  // Populate booked sessions
  const sessionList = document.getElementById("session-list");
  sessions.forEach(session => {
    const li = document.createElement("li");
    li.className = "list-group-item";
    li.textContent = `${session.date} - ${session.time} (${session.type})`;
    sessionList.appendChild(li);
  });
  
  // Performance tracking line chart
  const ctx = document.getElementById("performance-chart").getContext("2d");
  const performanceChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
      datasets: [{
        label: "Workout Hours",
        data: [5, 7, 8, 10],
        borderColor: "#007bff",
        borderWidth: 2,
        fill: false
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  
  // Body composition pie chart
  const bodyCompositionCtx = document.getElementById("body-composition-chart").getContext("2d");
  const xValues = ["Fats", "Muscles", "Water", "Bones", "Other"];
  const yValues = [25, 40, 55, 15, 5]; // Example percentages
  const barColors = [
    "#b91d47", // Red for Fats
    "#00aba9", // Teal for Muscles
    "#2b5797", // Blue for Water
    "#e8c3b9", // Light Brown for Bones
    "#1e7145"  // Green for Other
  ];
  
  new Chart(bodyCompositionCtx, {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: "Body Composition Percentages"
        },
        legend: {
          display: true,
          position: 'right'
        }
      }
    }
  });
  
  // Populate last 3 sessions as cards
  const lastSessions = document.getElementById("last-sessions");
  sessions.slice(-3).reverse().forEach(session => {
    const col = document.createElement("div");
    col.className = "col-md-4";
  
    col.innerHTML = `
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">${session.type}</h5>
          <p class="card-text"><strong>Date:</strong> ${session.date}</p>
          <p class="card-text"><strong>Time:</strong> ${session.time}</p>
          <p class="card-text"><strong>Performance:</strong> ${session.performance}</p>
        </div>
      </div>
    `;
    lastSessions.appendChild(col);
  });
