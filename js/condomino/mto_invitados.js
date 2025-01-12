let objInputs = [
  {
    id: "nombre",
    type: "nombre",
    spanError: "error-nombre",
  },
  {
    id: "curp",
    type: "curp",
    spanError: "error-curp",
  },
  {
    id: "integrantes",
    type: "cantidad_personas",
    spanError: "error-integrantes",
  },
];

validaciones(objInputs, "btn-send");

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

const $btnSend = document.getElementById("btn-send");

$btnSend.addEventListener("click", function (e) {
  e.preventDefault();
  const formDataDatos = new FormData(document.getElementById("form-datos"));

  asyncConfirmProcess(
    formDataDatos,
    `${this.dataset.url}_controller/condomino/invitados/AsyncMtoInvitados.php`,
    "Confirmación",
    `${
      this.dataset.modificacion
        ? "¿Está seguro de modificar los datos del invitado?"
        : "¿Está seguro de registrar a este invitado?"
    }`,
    `${
      this.dataset.modificacion
        ? "¡Datos modificados correctamente!"
        : "¡Invitado registrado correctamente!"
    }`,
    () =>
      setTimeout(
        () =>
          (location.href = `${this.dataset.url}${this.dataset.url_user}invitados`),
        2000
      )
  );
});
