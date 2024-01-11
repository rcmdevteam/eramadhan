<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Return on Investment (ROI)</div>
        <canvas id="roiChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for Return on Investment (ROI) chart (replace with actual data)
    const roiData = {
      labels: ['Activity 1', 'Activity 2', 'Activity 3', 'Activity 4', 'Activity 5'],
      datasets: [{
        label: 'ROI',
        data: [3.5, 2.8, 4.2, 3.0, 5.1],
        backgroundColor: '#7c69ef',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 0
      }]
    };
  
    // Chart configuration for Return on Investment (ROI)
    const roiConfig = {
      type: 'bar',
      data: roiData,
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
  
    // Get the Return on Investment (ROI) chart canvas element
    const roiChartCanvas = document.getElementById('roiChart').getContext('2d');
  
    // Create the Return on Investment (ROI) chart
    new Chart(roiChartCanvas, roiConfig);
  </script>
@endpush