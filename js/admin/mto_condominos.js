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
    type: $inputPassword.dataset.valor === "1" ? "password" : "",
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
  {
    id: "torre",
    type: "torre",
    spanError: "error-torre",
  },
  {
    id: "departamento",
    type: "text",
    spanError: "error-departamento",
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
      `${this.dataset.url}_controller/admin/gestor_condominos/AsyncMtoCondominos.php`,
      "Confirmación",
      this.dataset.usuario === "condomino"
        ? "¿Está seguro de modificar sus datos?"
        : "¿Está seguro de que desea hacer el registro de este condomino?",
      this.dataset.usuario === "condomino"
        ? "¡Datos modificados correctamente!"
        : "¡Condomino registrado correctamente!",
      (json) => {
        if (json.usuario === "condomino") {
          const $fotoUserHeader = document.getElementById("foto-user-header");
          if ($fotoUserHeader && json.nuevos_datos.foto_path !== "")
            $fotoUserHeader.src = json.nuevos_datos.foto_path;
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
