<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Income Sources Diversity</div>
        <canvas id="incomeSourcesDiversityChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for income sources diversity chart (replace with actual data)
    const incomeSourcesData = {
      labels: ['Individual Donations', 'Organizational Sponsorships', 'Partnerships'],
      datasets: [{
        data: [60, 25, 15],
        backgroundColor: [
            '#7c69ef',
          '#cbc3f9',
          '#e5e1fc'
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 205, 86, 1)'
        ],
        borderWidth: 0
      }]
    };
  
    // Chart configuration for income sources diversity
    const incomeSourcesConfig = {
      type: 'doughnut',
      data: incomeSourcesData,
      options: {}
    };
  
    // Get the income sources diversity chart canvas element
    const incomeSourcesDiversityChartCanvas = document.getElementById('incomeSourcesDiversityChart').getContext('2d');
  
    // Create the income sources diversity chart
    new Chart(incomeSourcesDiversityChartCanvas, incomeSourcesConfig);
  </script>
@endpush