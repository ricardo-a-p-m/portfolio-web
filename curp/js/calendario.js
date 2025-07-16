var Calendar = {
  setup: function (params) {
    const input = document.getElementById(params.inputField);
    const button = document.getElementById(params.button);

    function showCalendar() {
      if (document.getElementById('calendarDiv')) return;

      const calendarDiv = document.createElement('div');
      calendarDiv.id = 'calendarDiv';
      calendarDiv.style.position = 'absolute';
      calendarDiv.style.background = '#e6f2e6';
      calendarDiv.style.border = '1px solid #4caf50';
      calendarDiv.style.borderRadius = '8px';
      calendarDiv.style.padding = '8px';
      calendarDiv.style.zIndex = 1000;

      const rect = button.getBoundingClientRect();
      calendarDiv.style.top = `${rect.bottom + window.scrollY + 5}px`;
      calendarDiv.style.left = `${rect.left + window.scrollX}px`;

      const dateInput = document.createElement('input');
      dateInput.type = 'date';
      dateInput.style.fontSize = '14px';
      dateInput.style.padding = '4px';
      dateInput.style.borderRadius = '5px';
      dateInput.style.border = '1px solid #4caf50';

      if (params.range?.length === 2) {
        const [fromYear, toYear] = params.range;
        dateInput.min = `${fromYear}-01-01`;
        dateInput.max = `${toYear}-12-31`;
      }

      if (input.value) {
        const parts = input.value.split('/');
        if (parts.length === 3) {
          dateInput.value = `${parts[2]}-${parts[1].padStart(2, '0')}-${parts[0].padStart(2, '0')}`;
        }
      }

      dateInput.onchange = function () {
        const parts = this.value.split('-');
        if (parts.length === 3) {
          const formatted = `${parts[2]}/${parts[1]}/${parts[0]}`;
          input.value = formatted;
          if (params.inputField === 'FechaNacimiento') {
            document.getElementById('ConfirmarFecha').value = formatted;
          }
        }
        document.body.removeChild(calendarDiv);
      };

      calendarDiv.appendChild(dateInput);
      document.body.appendChild(calendarDiv);

      setTimeout(() => {
        document.addEventListener('click', function closeCalendar(e) {
          if (!calendarDiv.contains(e.target) && e.target !== button && e.target !== input) {
            if (document.body.contains(calendarDiv)) document.body.removeChild(calendarDiv);
            document.removeEventListener('click', closeCalendar);
          }
        });
      }, 0);
    }

    button.addEventListener('click', showCalendar);
  }
};

const currentYear = new Date().getFullYear();
Calendar.setup({
  inputField: 'FechaNacimiento',
  range: [currentYear - 120, currentYear],
  button: 'btFechaNacimiento',
});
Calendar.setup({
  inputField: 'ConfirmarFecha',
  range: [currentYear - 120, currentYear],
  button: 'btConfirmarFecha',
});
