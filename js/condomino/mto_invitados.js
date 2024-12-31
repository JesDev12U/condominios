const $horarioInicio = document.getElementById("horario_inicio");
const $horarioFinal = document.getElementById("horario_final");

// Configura Flatpickr para el campo de inicio
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

// Configura Flatpickr para el campo de final
const horarioFinalPicker = flatpickr($horarioFinal, {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i",
  time_24hr: true,
  minTime: $horarioInicio.value || null, // Establece minTime inicial si $horarioInicio tiene valor
  onChange: (selectedDates, dateStr) => {
    // Actualiza el límite máximo de horario inicio
    horarioInicioPicker.set("maxTime", dateStr);
  },
});
