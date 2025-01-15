<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-dialog-centered" role="document">
    	<form class="modal-content" method="POST" action="{{ route('event.submit') }}">
			@csrf
      		<div class="modal-header">
        		<h5 class="modal-title" id="addModalLabel">Tambah Jadwal</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
	      	<div class="modal-body">
				<div class="tambah-jadwal-box">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" placeholder="Enter event name" required>
					</div>
					<div class="form-group">
						<label for="start">Start</label>
						<input type="date" id="start" name="start" placeholder="dd/mm/yyyy" required>
					</div>
					<div class="form-group">
						<label for="end">End</label>
						<input type="date" id="end" name="end" placeholder="dd/mm/yyyy" required>
					</div>
				</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="submit" class="btn btn-primary"> Submit </button>
	      	</div>
    	</form>
  	</div>
</div>

{{-- <script>
	document.getElementById('start').addEventListener('change', function() {
		var startDate = document.getElementById('start').value;
		var endDate = document.getElementById('end').value;

		if (endDate && endDate < startDate) {
			alert("End date cannot be before the start date.");
			document.getElementById('end').value = '';
		}
	});
</script> --}}