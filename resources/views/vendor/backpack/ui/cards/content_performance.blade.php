<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Content Performance</div>
        <canvas id="contentPerformanceChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for content performance chart (replace with actual data)
    const contentPerformanceData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [{
        label: 'Specific Topics',
        data: [80, 90, 85, 88, 92, 95, 100],
        borderColor: '#7c69ef',
        borderWidth: 2,
        fill: false
      }, {
        label: 'Formats (Videos, Articles, etc.)',
        data: [60, 75, 70, 80, 85, 90, 95],
        borderColor: '#a396f4',
        borderWidth: 2,
        fill: false
      }, {
        label: 'Delivery Methods',
        data: [50, 60, 55, 65, 70, 75, 80],
        borderColor: '#cbc3f9',
        borderWidth: 2,
        fill: false
      }]
    };
  
    // Chart configuration for content performance
    const contentPerformanceConfig = {
      type: 'line',
      data: contentPerformanceData,
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
  
    // Get the content performance chart canvas element
    const contentPerformanceChartCanvas = document.getElementById('contentPerformanceChart').getContext('2d');
  
    // Create the content performance chart
    new Chart(contentPerformanceChartCanvas, contentPerformanceConfig);
  </script>
@endpush