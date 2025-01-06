const $horarioInicio = document.getElementById("horario_inicio");
const $horarioFinal = document.getElementById("horario_final");

const horarioInicioPicker = flatpickr($horarioInicio, {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i",
  time_24hr: true,
  maxTime: $horarioFinal.value || null,
  onChange: (selectedDates, dateStr) => {
    horarioFinalPicker.set("minTime", dateStr);
  },
});

const horarioFinalPicker = flatpickr($horarioFinal, {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i",
  time_24hr: true,
  minTime: $horarioInicio.value || null,
  onChange: (selectedDates, dateStr) => {
    horarioInicioPicker.set("maxTime", dateStr);
  },
});
