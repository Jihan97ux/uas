<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Fetch event data from the API route
    fetch('/event/get-json', {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        console.log('Received response:', response);  // Debugging
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        // Clone response stream untuk bisa membaca body dua kali
        return response.clone().text().then(text => {
            console.log('Raw response text:', text);  // Lihat response mentah
            const textFormatedToBeReturn = text.split('[')[2]
            return '[' + textFormatedToBeReturn;
        });
    })
    .then(data => {
        console.log('Received data:', data);  // Debugging
        
        // Parse the JSON data
        data = JSON.parse(data);

        if (Array.isArray(data)) {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: data
            });
            
            calendar.render();
        } else {
            console.error("Invalid data format:", data);
            alert('Error: Invalid data format received.');
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        console.error('Error details:', error.message);
        alert('Error fetching event data. Please check the console for details.');
    });
});
</script>