document.addEventListener('DOMContentLoaded', function () {
    const calendarElement = document.getElementById('calendar');
    const dateInput = document.getElementById('myDatePicker');
    const form = document.getElementById('formulario');
    const formStatus = document.getElementById('formStatus');

    const datePicker = flatpickr(dateInput, {
        locale: 'es',
        dateFormat: 'd-m-Y',
        defaultDate: 'today',
        allowInput: true,
    });

    const calendar = new FullCalendar.Calendar(calendarElement, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prevYear,prev,next,nextYear today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek',
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
        },
        dateClick: function (info) {
            datePicker.setDate(info.date, true);
        },
    });

    calendar.render();

    const popoverTriggers = document.querySelectorAll('[data-bs-toggle="popover"]');
    [...popoverTriggers].forEach(function (element) {
        new bootstrap.Popover(element);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        form.classList.add('was-validated');

        if (!form.checkValidity()) {
            formStatus.className = 'alert alert-danger mt-3 mb-0';
            formStatus.textContent = 'Completa los campos obligatorios y acepta los términos.';
            return;
        }

        formStatus.className = 'alert alert-success mt-3 mb-0';
        formStatus.textContent = 'Formulario de práctica validado correctamente.';
    });
});
