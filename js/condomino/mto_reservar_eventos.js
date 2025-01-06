const $fecha = document.getElementById("fecha");

// Calcula la fecha de mañana
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

flatpickr($fecha, {
  minDate: tomorrow,
});
