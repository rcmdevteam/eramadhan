<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Feedback and Comments</div>
        <form>
            <div class="form-group">
              <label for="feedback">Feedback:</label>
              <textarea class="form-control" id="feedback" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="comments">Comments:</label>
              <textarea class="form-control" id="comments" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
          </form>
    </div>
</div>

@push('after_styles')

@endpush

@push('after_scripts')
<script>
    // Dummy data for feedback and comments (submitting the form would handle actual data)
    document.querySelector('form').addEventListener('submit', function(event) {
      event.preventDefault();
      const feedback = document.getElementById('feedback').value;
      const comments = document.getElementById('comments').value;
  
      // You can send the feedback and comments to a server or perform any other action here
      console.log('Feedback:', feedback);
      console.log('Comments:', comments);
  
      // Clear the form fields after submission
      document.getElementById('feedback').value = '';
      document.getElementById('comments').value = '';
    });
  </script>
@endpush