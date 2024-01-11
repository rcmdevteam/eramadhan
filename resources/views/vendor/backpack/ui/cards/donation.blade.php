<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
    <div>Donations and Contributions</div>
    <canvas id="donationsChart" width="400" height="200"></canvas>
    </div>
</div>


@push('after_scripts')
<script>
    // Dummy data for donations and contributions chart (replace with actual data)
    const donationsData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [{
        label: 'Amount Received',
        data: [5000, 7000, 6000, 8000, 9000, 7500, 10000],
        borderColor: '#7c69ef',
        borderWidth: 2,
        fill: false
      }]
    };
  
    // Chart configuration for donations and contributions
    const donationsConfig = {
      type: 'line',
      data: donationsData,
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
  
    // Get the donations chart canvas element
    const donationsChartCanvas = document.getElementById('donationsChart').getContext('2d');
  
    // Create the donations chart
    new Chart(donationsChartCanvas, donationsConfig);
  </script>
@endpush