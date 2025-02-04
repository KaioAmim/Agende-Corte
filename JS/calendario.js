document.addEventListener('DOMContentLoaded', function() {
    const calendarDays = document.querySelector('.calendar-days');
    const monthPicker = document.getElementById('month-picker');
    const yearSpan = document.getElementById('year');
    const selectedDateInput = document.getElementById('selectedDate');
    const hiddenSelectedDateInput = document.getElementById('hiddenSelectedDate');
    const currentDate = new Date();

    const months = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function populateCalendar(month, year) {
        calendarDays.innerHTML = "";
        monthPicker.innerText = months[month];
        yearSpan.innerText = year;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-day', 'empty');
            calendarDays.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('calendar-day');
            dayCell.innerText = day;

            if (day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
                dayCell.classList.add('current-day');
            }

            dayCell.addEventListener('click', function() {
                const formattedDay = day.toString().padStart(2, '0');
                const formattedMonth = (month + 1).toString().padStart(2, '0');
                const formattedDate = `${formattedDay}/${formattedMonth}/${year}`;
                selectedDateInput.value = formattedDate;
                hiddenSelectedDateInput.value = formattedDate;
            });

            calendarDays.appendChild(dayCell);
        }
    }

    document.getElementById('prev-month').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        populateCalendar(currentMonth, currentYear);
    });

    document.getElementById('next-month').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        populateCalendar(currentMonth, currentYear);
    });

    populateCalendar(currentMonth, currentYear);

    document.getElementById('scheduleForm').addEventListener('submit', function(e) {
        if (!selectedDateInput.value || !document.querySelector('input[name="selectedTime"]:checked')) {
            e.preventDefault();
            alert("Por favor, selecione uma data e um horário.");
        }
    });
});