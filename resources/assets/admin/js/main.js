import Chart, { elements } from "chart.js/auto";
import DnD from "./drop";
import './bootstrap';

window.DnD = DnD;

document.addEventListener('DOMContentLoaded', () => {
  chartInit();
  DnDForm();
  setCover();
  initPasswordToggle();
});

function chartInit() {
  const chartLine = document.getElementById("lineChart");
  const chartBar = document.getElementById("barChart");
  const chartBar2 = document.getElementById("barChart2");
  const pieChart = document.getElementById("pieChart");
  
  const chartLineOptions = {
    type: 'line',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUB', 'JUL'],
      datasets: [
        {
          label: 'My First Dataset',
          data: [14, 47, 50, 15, 49, 76, 66],
          borderColor: "#4318FF",
        },
        {
          label: 'My Second Dataset',
          data: [10, 24, 37, 42, 32, 23, 34],
          borderColor: "#6AD2FF",
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      fill: false,
      tension: 0.4,
      backgroundColor: 'transparent',
      pointBorderWidth: 1,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4,
      scales: {
        x: {
          display: true,
          grid: {
            display: false,
          },
        },
        y: {
          display: false,
          max: 100
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    },
  }

  const chartBarOptions = {
    type: 'bar',
    data: {
      labels: ['17', '16', '18', '19', '20', '21', '22', '23'],
      datasets: [
        {
          data: [81, 121, 40, 52, 164, 113, 26, 68],
          backgroundColor: "#775FFC",
        },
        {
          data: [135, 182, 76, 112, 199, 168, 49, 120],
          backgroundColor: "#84D9FD"
        },
        {
          data: [135, 182, 76, 112, 199, 168, 49, 120],
          backgroundColor: "#E6EDF9"
        }
      ],
    },
    options: {
      responsive: true,
      barPercentage: 0.3,
      scales: {
        x: {
          stacked: true,
          grid: {
            display: false,
          }
        },
        y: {
          stacked: true,
          display: false,
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    },
  }

  const chartBarOptions2 = {
    type: 'bar',
    data: {
      labels: ['17', '16', '18', '19', '20', '21', '22'],
      datasets: [
        {
          data: [81, 121, 40, 52, 164, 113, 26],
          backgroundColor: "#775FFC",
        }
      ],
    },
    options: {
      responsive: true,
      barPercentage: 0.5,
      scales: {
        x: {
          stacked: true,
          grid: {
            display: false,
          }
        },
        y: {
          stacked: true,
          display: false,
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    },
  }

  const chartPieOptions = {
    type: 'pie',
    data: {
      labels: [
        'First',
        'Second',
        'Third'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
          "#4318FF",
          '#6AD2FF',
          '#EFF4FB'
        ],
        hoverOffset: 4,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 8,
            boxHeight: 8,
            usePointStyle: true,
          }
        }
      }
    },
  }

  if (chartLine) {
    new Chart(chartLine, chartLineOptions);
  }

  if (chartBar) {
    new Chart(chartBar, chartBarOptions);
  }

  if (chartBar2) {
    new Chart(chartBar2, chartBarOptions2);
  }

  if (pieChart) {
    new Chart(pieChart, chartPieOptions);
  }
}


function DnDForm() {
  const form = document.querySelector('.dropForm');
  const allowedTypes = [
    // images
    "image/jpeg",
    "image/png",
    "image/webp",
    "image/gif",
    "image/svg+xml",
    "image/avif",

    // documents
    "application/pdf",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/vnd.ms-excel",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "application/vnd.ms-powerpoint",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    "text/plain",

    // archives
    "application/zip",
    "application/x-zip-compressed",
    "application/x-rar-compressed",
    "application/vnd.rar",
    "application/x-7z-compressed",

    // media
    "video/mp4",
    "video/webm",
    "audio/mpeg"
  ];

  const Drop = new DnD(form, {
    csrf: true,
    allowedTypes: allowedTypes,
  });
}

function setCover() {
  document.addEventListener('click', async (e) => {
    if (!e.target.classList.contains('set-cover-btn')) return;

    const mediaId = e.target.dataset.mediaId;
    const projectId = e.target.closest('[data-project-id]').dataset.projectId;

    try {
      const response = await fetch(`/admin/projects/${projectId}/set-cover/${mediaId}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').textContent
        }
      });
      return await response.json();
    } catch (e) {
        console.error('Error setting cover:', e);
    }
  });
}

function initPasswordToggle() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('toggle-password');

    if (!passwordInput || !toggleButton) {
        return;
    }

    toggleButton.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        const icon = this.querySelector('i');
        if (icon) {
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        }

        this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
        this.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
    });
}