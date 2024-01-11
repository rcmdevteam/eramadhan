<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Fundraising Campaign Performance</div>
        <canvas id="fundraisingCampaignChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for fundraising campaign performance chart (replace with actual data)
    const fundraisingCampaignData = {
      labels: ['Campaign 1', 'Campaign 2', 'Campaign 3', 'Campaign 4', 'Campaign 5'],
      datasets: [{
        label: 'Amount Raised',
        data: [15000, 20000, 18000, 25000, 30000],
        backgroundColor: '#7c69ef',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 0
      }]
    };
  
    // Chart configuration for fundraising campaign performance
    const fundraisingCampaignConfig = {
      type: 'bar',
      data: fundraisingCampaignData,
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
  
    // Get the fundraising campaign performance chart canvas element
    const fundraisingCampaignChartCanvas = document.getElementById('fundraisingCampaignChart').getContext('2d');
  
    // Create the fundraising campaign performance chart
    new Chart(fundraisingCampaignChartCanvas, fundraisingCampaignConfig);
  </script>
@endpush