<script type="text/javascript">
	
	// Trigger untuk membuka modal dan mengisi data event untuk diupdate
	$('.edit-btn').on('click', function () {
    var eventId = $(this).data('id');

    // Ambil data event melalui AJAX
    $.ajax({
        url: '/get-event/' + eventId,
        method: 'GET',
        success: function (data) {
            $('#editId').val(data.id);
            $('#editTitle').val(data.name);
            $('#editDate').val(data.start);
            $('#editDescription').val(data.end);
        }
    });
});

// Triger tombol delete dengan AJAX
$('form[action^="/event/delete"]').submit(function (e) {
    e.preventDefault();

    if (confirm('Are you sure you want to delete this event?')) {
        $(this).unbind('submit').submit();
    }
});



	// Tuliskan trigger saat menekan tombol edit
	// Di dalam trigger tersebut, tambahkan API untuk meload data 1 jadwal

</script>