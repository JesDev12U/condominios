const $inputPassword = document.getElementById("password");

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
    type: $inputPassword.dataset.valor === "1" ? "password" : "password-modify",
    spanError: "error-password",
  },
  {
    id: "telefono",
    type: "phone",
    spanError: "error-telefono",
  },
  {
    id: "telefono_emergencia",
    type: "phone",
    spanError: "error-telefono-emergencia",
  },
];

validaciones(objInputs, "btn-send");

const $fotoUser = document.getElementById("foto-user");
const formDataFoto = new FormData();
const $btnSend = document.getElementById("btn-send");
const $fotoFile = document.getElementById("foto-file");

$fotoFile.addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    const urlTemporal = URL.createObjectURL(file);
    $fotoUser.src = urlTemporal;

    // Limpieza de la URL temporal cuando ya no se necesite
    $fotoFile.onload = () => URL.revokeObjectURL(urlTemporal);
    formDataFoto.append("foto_path", file, file.name);
  }
});

$btnSend.addEventListener("click", function (e) {
  e.preventDefault();
  const formDataDatos = new FormData(document.getElementById("form-datos"));
  for (let [key, value] of formDataFoto.entries()) {
    formDataDatos.append(key, value);
  }

  if (
    formDataDatos.getAll("foto_path").length !== 0 ||
    this.dataset.peticion === "UPDATE"
  ) {
    asyncConfirmProcess(
      formDataDatos,
      `${this.dataset.url}_controller/admin/gestor_empleados/AsyncMtoEmpleados.php`,
      "Confirmación",
      this.dataset.usuario === "empleado"
        ? "¿Está seguro de modificar sus datos?"
        : this.dataset.peticion === "UPDATE"
        ? "¿Está reguro de modificar los datos de este empleado?"
        : "¿Está seguro de que desea hacer el registro de este empleado?",
      this.dataset.usuario === "empleado" || this.dataset.peticion === "UPDATE"
        ? "¡Datos modificados correctamente!"
        : "¡Empleado registrado correctamente!",
      (json) => {
        if (json.usuario === "empleado") {
          const $fotoUserHeader = document.getElementById("foto-user-header");
          if ($fotoUserHeader && json.nuevos_datos.foto_path !== "")
            $fotoUserHeader.src = json.nuevos_datos.foto_path;
          setTimeout(() => (location.href = this.dataset.url), 2000);
        } else {
          setTimeout(
            () =>
              (location.href = `${this.dataset.url}${this.dataset.url_admin}gestor-empleados`),
            2000
          );
        }
      }
    );
  } else {
    Swal.fire({
      icon: "error",
      title: "¡Error!",
      text: "Tienes que subir una foto para seguir con el registro",
    });
  }
});
