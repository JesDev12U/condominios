let objInputs = [
  {
    id: "cantidad_personas",
    type: "cantidad_personas",
    spanError: "error-cantidad-personas",
  },
  {
    id: "fecha",
    type: "fecha",
    spanError: "error-fecha",
  },
  {
    id: "detalles_evento",
    type: "detalles_evento",
    spanError: "error-detalles-evento",
  },
  {
    id: "tipo_evento",
    type: "tipo_evento",
    spanError: "error-tipo-evento",
  },
];

validaciones(objInputs, "btn-send");

const $fecha = document.getElementById("fecha");

// Calcula la fecha de mañana
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

flatpickr($fecha, {
  minDate: tomorrow,
});

const $fotoEvento = document.getElementById("foto-evento");
const $formDatos = document.getElementById("form-datos");
const $fotoFile = document.getElementById("foto-file");

$fotoFile.addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    const urlTemporal = URL.createObjectURL(file);
    $fotoEvento.src = urlTemporal;

    //Limpieza de la URL temporal cuando ya no se necesite
    $fotoFile.onload = () => URL.revokeObjectURL(urlTemporal);
  }
});

$formDatos.addEventListener("submit", function (e) {
  e.preventDefault();
  if ($fotoEvento.src === `${this.dataset.url}uploads/placeholderimage.jpg`) {
    Swal.fire({
      icon: "error",
      title: "¡Error!",
      text: "Tienes que subir una foto para el evento",
    });
    return;
  }
  const formData = new FormData(this);

  asyncConfirmProcess(
    formData,
    `${this.dataset.url}_controller/condomino/eventos/AsyncMtoReservarEventos.php`,
    "Confirmación",
    `${
      this.dataset.modificacion
        ? "¿Está seguro de modificar los datos de este evento?"
        : "¿Está seguro de agendar el evento?"
    }`,
    `${
      this.dataset.modificacion
        ? "¡Evento modificado correctamente!"
        : "¡Evento agendado correctamente!"
    }`,
    () =>
      setTimeout(
        () =>
          (location.href = `${this.dataset.url}${this.dataset.url_user}reservar-eventos`),
        2000
      )
  );
});
