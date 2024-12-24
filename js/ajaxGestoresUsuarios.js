const $fotoUser = document.getElementById("foto-user");
const formDataFoto = new FormData();
const $btnSend = document.getElementById("btn-send");

document.getElementById("foto-file").addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    const urlTemporal = URL.createObjectURL(file);
    $fotoUser.src = urlTemporal;
    // Limpieza de la URL temporal cuando ya no se necesite
    //vistaPrevia.onload = () => URL.revokeObjectURL(urlTemporal);

    formDataFoto.append("foto-user", file, file.name);
  }
});

$btnSend.addEventListener("click", (e) => {
  e.preventDefault();
  const formDataDatos = new FormData(document.getElementById("form-datos"));
  for (let [key, value] of formDataFoto.entries()) {
    formDataDatos.append(key, value);
  }

  if (formDataDatos.getAll("foto-user").length !== 0) {
    Swal.fire({
      icon: "success",
      title: "TODO",
      text: "Completar el AJAX del registro",
    });
  } else {
    Swal.fire({
      icon: "error",
      title: "¡Error!",
      text: "Tienes que subir una foto para seguir con el registro",
    });
  }
});
