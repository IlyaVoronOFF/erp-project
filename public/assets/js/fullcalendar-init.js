"use strict"

function fullCalender() {

    /* initialize the external events
    	-----------------------------------------------------------------*/

    var containerEl = document.getElementById('external-events');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText.trim(),
            }
        }

    });
    /* initialize the calendar
    -----------------------------------------------------------------*/

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: '', //'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialDate: new Date(),
        timeZone: 'Russia/Moscow',
        eventTimeFormat: { // like '14:30:00'
            hour: '2-digit',
            minute: '2-digit',
            hour12: false,
        },
        firstDay: 1,
        weekNumbers: true,
        navLinks: false, // can click day/week names to navigate views
        editable: true,
        nowIndicator: true,
        selectable: true,
        selectOverlap: false,
        selectConstraint: {
            start: '00:00',
            end: '24:00',
        },
        select: function(arg) {
            var d = arg.start.getDate(2);
            var m = arg.start.getMonth(2) + 1;
            var y = arg.start.getFullYear();
            var h = new Date().getHours();
            var mi = new Date().getMinutes();
            var se = new Date().getSeconds();
            $('#exampleModalCenter').modal('toggle');
            $('#displayDate').text('на ' + d + '.' + m + '.' + y);
            $('#date').val(y + '-' + m + '-' + d + ' ' + h + ':' + mi + ':' + se);

            calendar.unselect()
        },
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar
        drop: function(arg) {
            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
                // if so, remove the element from the "Draggable Events" list
                arg.draggedEl.parentNode.removeChild(arg.draggedEl);
            }
        },
        events: events,
        eventMouseEnter: function(arg) {
            $('.fc-event-title').attr('data-bs-original-title', 'Примечание')
            $('.fc-event-title').attr('data-bs-content', arg.event._def.extendedProps.description)
            $('.fc-event-title').attr('data-bs-placement', 'bottom')
            $('.fc-event-title').popover();

            $('.fa-times').click(function() {
                $('#exampleModalCenterDel').modal('toggle');
                //console.log(arg.event.id)
                $('.delete-check').click(function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        url: '/part-user/' + arg.event.id,
                        complete: function() {
                            $("#successMsg").delay(5000).slideUp(300);
                            $("#errorMsg").delay(5000).slideUp(300);
                            $('#exampleModalCenterDel').modal('hide');
                            location.reload();
                        }
                    })
                })
            })
        },
    });
    calendar.render();

}



jQuery(window).on('load', function() {
    setTimeout(function() {
        fullCalender();
    }, 10);


});