let objInputs = [
  {
    id: "nombre",
    type: "nombre",
    spanError: "error-nombre",
  },
  {
    id: "email",
    type: "email",
    spanError: "error-email",
  },
];

validaciones(objInputs, "btn-send");

const $btnSend = document.getElementById("btn-send");
const $formDatos = document.getElementById("form-datos");
$btnSend.addEventListener("click", function (e) {
  e.preventDefault();
  const formDataDatos = new FormData($formDatos);
  asyncConfirmProcess(
    formDataDatos,
    `${this.dataset.url}_controller/admin/AsyncMtoAdministrador.php`,
    "Confirmación",
    "¿Está seguro de modificar sus datos?",
    "¡Datos modificados correctamente!"
  );
});
