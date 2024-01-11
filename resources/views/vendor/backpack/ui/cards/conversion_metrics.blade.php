<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Conversion Matrix</div>
        <canvas id="conversionMetricsChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for conversion metrics chart (replace with actual data)
    const conversionMetricsData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [{
        label: 'New Community Memberships',
        data: [10, 15, 20, 18, 22, 25, 30],
        borderColor: '#7c69ef',
        borderWidth: 2,
        fill: false
      }, {
        label: 'Increased Participation in Charitable Activities',
        data: [5, 8, 10, 12, 15, 18, 20],
        borderColor: '#a396f4',
        borderWidth: 2,
        fill: false
      }, {
        label: 'Other Positive Outcomes',
        data: [8, 12, 15, 10, 18, 20, 25],
        borderColor: '#cbc3f9',
        borderWidth: 2,
        fill: false
      }]
    };
  
    // Chart configuration for conversion metrics
    const conversionMetricsConfig = {
      type: 'line',
      data: conversionMetricsData,
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
  
    // Get the conversion metrics chart canvas element
    const conversionMetricsChartCanvas = document.getElementById('conversionMetricsChart').getContext('2d');
  
    // Create the conversion metrics chart
    new Chart(conversionMetricsChartCanvas, conversionMetricsConfig);
  </script>  
@endpush