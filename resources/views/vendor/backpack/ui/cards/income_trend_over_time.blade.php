<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Income Trend Analysis</div>
        <canvas id="incomeTrendAnalysisChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for income trend analysis chart (replace with actual data)
    const incomeTrendAnalysisData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Income',
        data: [5000, 7000, 6000, 8000, 9000, 12000, 10000, 11000, 9000, 10000, 8500, 9500],
        backgroundColor: '#7c69ef',
        borderColor: '#7c69ef',
        borderWidth: 1
      }]
    };
  
    // Chart configuration for income trend analysis
    const incomeTrendAnalysisConfig = {
      type: 'line',
      data: incomeTrendAnalysisData,
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
  
    // Get the income trend analysis chart canvas element
    const incomeTrendAnalysisChartCanvas = document.getElementById('incomeTrendAnalysisChart').getContext('2d');
  
    // Create the income trend analysis chart
    new Chart(incomeTrendAnalysisChartCanvas, incomeTrendAnalysisConfig);
  </script>
@endpush