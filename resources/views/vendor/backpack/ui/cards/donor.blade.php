<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Donor Demographics</div>
        <canvas id="donorDemographicsChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for donor demographics chart (replace with actual data)
    const donorDemographicsData = {
      labels: ['18-24', '25-34', '35-44', '45-54', '55+'],
      datasets: [{
        label: 'Age Group',
        data: [10, 25, 30, 20, 15],
        backgroundColor: [
          '#e5e1fc',
          '#cbc3f9',
          '#b0a5f5',
          '#9687f2',
          '#7c69ef'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 205, 86, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(153, 102, 255, 1)'
        ],
        borderWidth: 0
      }]
    };
  
    // Chart configuration for donor demographics
    const donorDemographicsConfig = {
      type: 'bar',
      data: donorDemographicsData,
      options: {
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    };
  
    // Get the donor demographics chart canvas element
    const donorDemographicsChartCanvas = document.getElementById('donorDemographicsChart').getContext('2d');
  
    // Create the donor demographics chart
    new Chart(donorDemographicsChartCanvas, donorDemographicsConfig);
  </script>
  
@endpush