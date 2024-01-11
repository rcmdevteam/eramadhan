<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
    <div>Engagement Metrics</div>
    <canvas id="engagementChart" width="400" height="200"></canvas>
    </div>
</div>


@push('after_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dummy data for chart (replace with actual data)
    const engagementData = {
      labels: ['Event 1', 'Event 2', 'Event 3', 'Event 4', 'Event 5'],
      datasets: [{
        label: 'Number of Attendees',
        data: [50, 75, 60, 80, 90],
        backgroundColor: '#7c69ef',
        // borderColor: '#7c69ef',
        borderWidth: 0
      }, {
        label: 'Duration of Talks (minutes)',
        data: [30, 45, 60, 40, 55],
        backgroundColor: '#cbc3f9',
        // borderColor: '#cbc3f9',
        borderWidth: 0
      }, {
        label: 'Participation in Discussions',
        data: [20, 30, 25, 35, 40],
        backgroundColor: '#e5e1fc',
        // borderColor: '#e5e1fc',
        borderWidth: 0
      }]
    };
  
    // Chart configuration
    const engagementConfig = {
      type: 'bar',
      data: engagementData,
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
  
    // Get the chart canvas element
    const engagementChartCanvas = document.getElementById('engagementChart').getContext('2d');
  
    // Create the chart
    new Chart(engagementChartCanvas, engagementConfig);
  </script>
@endpush