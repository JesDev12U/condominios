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
  {
    id: "password",
    type: "password-modify",
    spanError: "error-password",
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
    "¡Datos modificados correctamente!",
    () => setTimeout(() => (location.href = this.dataset.url), 2000)
  );
});
