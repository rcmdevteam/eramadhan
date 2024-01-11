<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Trend Analysis</div>
        <canvas id="trendAnalysisChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for trend analysis chart (replace with actual data)
    const trendAnalysisData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [{
        label: 'Audience Growth',
        data: [100, 150, 200, 180, 220, 250, 300],
        borderColor: '#7c69ef',
        borderWidth: 2,
        fill: false
      }, {
        label: 'Popular Topics',
        data: [30, 50, 40, 60, 70, 80, 90],
        borderColor: '#a396f4',
        borderWidth: 2,
        fill: false
      }, {
        label: 'Overall Impact',
        data: [60, 80, 70, 90, 100, 110, 120],
        borderColor: '#cbc3f9',
        borderWidth: 2,
        fill: false
      }]
    };
  
    // Chart configuration for trend analysis
    const trendAnalysisConfig = {
      type: 'line',
      data: trendAnalysisData,
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
  
    // Get the trend analysis chart canvas element
    const trendAnalysisChartCanvas = document.getElementById('trendAnalysisChart').getContext('2d');
  
    // Create the trend analysis chart
    new Chart(trendAnalysisChartCanvas, trendAnalysisConfig);
  </script>
@endpush