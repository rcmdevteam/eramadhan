<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Budget Compliance</div>
        <canvas id="budgetComplianceChart" width="400" height="400"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for Budget Compliance chart (replace with actual data)
    const budgetComplianceData = {
      labels: ['Actual Income', 'Actual Expenses', 'Budget'],
      datasets: [{
        label: 'Amount (in $)',
        data: [15000, 12000, 18000],
        backgroundColor: ['#7c69ef', '#cbc3f9', '#e5e1fc'],
        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 205, 86, 1)'],
        borderWidth: 0
      }]
    };
  
    // Chart configuration for Budget Compliance
    const budgetComplianceConfig = {
      type: 'bar',
      data: budgetComplianceData,
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
  
    // Get the Budget Compliance chart canvas element
    const budgetComplianceChartCanvas = document.getElementById('budgetComplianceChart').getContext('2d');
  
    // Create the Budget Compliance chart
    new Chart(budgetComplianceChartCanvas, budgetComplianceConfig);
  </script>
@endpush