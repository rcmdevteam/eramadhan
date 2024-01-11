<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Social Media Impact</div>
        <canvas id="socialMediaChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for social media impact chart (replace with actual data)
    const socialMediaData = {
      labels: ['Facebook', 'Twitter', 'Instagram'],
      datasets: [{
        label: 'Shares',
        data: [1500, 800, 1200],
        backgroundColor: ['#7c69ef', '#7c69ef', '#7c69ef'],
        borderColor: ['rgba(59, 89, 152, 1)', 'rgba(29, 161, 242, 1)', 'rgba(193, 53, 132, 1)'],
        borderWidth: 0
      }, {
        label: 'Likes',
        data: [2000, 1200, 1800],
        backgroundColor: ['#cbc3f9', '#cbc3f9', '#cbc3f9'],
        borderColor: ['rgba(87, 127, 175, 1)', 'rgba(132, 206, 235, 1)', 'rgba(233, 30, 99, 1)'],
        borderWidth: 0
      }, {
        label: 'Comments',
        data: [500, 300, 450],
        backgroundColor: ['#e5e1fc', '#e5e1fc', '#e5e1fc'],
        borderColor: ['rgba(144, 164, 174, 1)', 'rgba(255, 204, 188, 1)', 'rgba(255, 224, 178, 1)'],
        borderWidth: 0
      }]
    };
  
    // Chart configuration for social media impact
    const socialMediaConfig = {
      type: 'bar',
      data: socialMediaData,
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
  
    // Get the social media impact chart canvas element
    const socialMediaChartCanvas = document.getElementById('socialMediaChart').getContext('2d');
  
    // Create the social media impact chart
    new Chart(socialMediaChartCanvas, socialMediaConfig);
  </script>
@endpush