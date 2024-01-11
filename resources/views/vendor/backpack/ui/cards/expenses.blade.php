<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Expenses Tracking</div>
        <canvas id="expenseTrackingChart" width="400" height="200"></canvas>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for expense tracking chart (replace with actual data)
    const expenseTrackingData = {
      labels: ['Travel Costs', 'Event Expenses', 'Other Costs'],
      datasets: [{
        data: [30, 40, 30],
        backgroundColor: [
          '#7c69ef',
          '#cbc3f9',
          '#e5e1fc'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 205, 86, 1)'
        ],
        borderWidth: 0
      }]
    };
  
    // Chart configuration for expense tracking
    const expenseTrackingConfig = {
      type: 'doughnut',
      data: expenseTrackingData,
      options: {}
    };
  
    // Get the expense tracking chart canvas element
    const expenseTrackingChartCanvas = document.getElementById('expenseTrackingChart').getContext('2d');
  
    // Create the expense tracking chart
    new Chart(expenseTrackingChartCanvas, expenseTrackingConfig);
  </script>
@endpush