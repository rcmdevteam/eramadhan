<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Demographic Information</div>
        <canvas id="demographicsChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('after_scripts')
<script>
    // Dummy data for demographics chart (replace with actual data)
    const demographicsData = {
      labels: ['18-24', '25-34', '35-44', '45-54', '55+'],
      datasets: [{
        label: 'Age Distribution',
        data: [15, 30, 25, 20, 10],
        backgroundColor: '#7c69ef',
        // borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 0
      }, {
        label: 'Gender Distribution',
        data: [40, 60],
        // backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)'],
        backgroundColor: ['#cbc3f9'],
        // borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 205, 86, 1)'],
        borderWidth: 0
      }]
    };
  
    // Chart configuration for demographics
    const demographicsConfig = {
      type: 'bar',
      data: demographicsData,
      options: {
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        }
      }
    };
  
    // Get the demographics chart canvas element
    const demographicsChartCanvas = document.getElementById('demographicsChart').getContext('2d');
  
    // Create the demographics chart
    new Chart(demographicsChartCanvas, demographicsConfig);
  </script>
@endpush