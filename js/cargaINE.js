const uploadZone = document.getElementById("uploadZone");
const fileInput = document.getElementById("fileInput");
const formSection = document.getElementById("formSection");
const loaderINE = document.getElementById("loader-ine");
const btnReloadINE = document.getElementById("btn-reload-ine");
const btnSend = document.getElementById("btn-send");

// Manejador para el arrastre de archivos
uploadZone.addEventListener("dragover", (e) => {
  e.preventDefault();
  uploadZone.classList.add("drag-over");
});

uploadZone.addEventListener("dragleave", () => {
  uploadZone.classList.remove("drag-over");
});

uploadZone.addEventListener("drop", (e) => {
  e.preventDefault();
  e.stopPropagation();
  uploadZone.classList.remove("drag-over");
  // Simular carga de archivo
  const file = e.dataTransfer.files[0];
  if (file) {
    mostrarFormulario(file);
  }
});

// Manejador para seleccionar un archivo
uploadZone.addEventListener("click", () => {
  fileInput.click();
});

fileInput.addEventListener("change", () => {
  if (fileInput.files.length > 0) {
    mostrarFormulario(fileInput.files[0]);
  }
});

// Función para mostrar el formulario y ocultar la zona de carga
async function mostrarFormulario(file) {
  try {
    loaderINE.classList.remove("hidden");
    const formData = new FormData();
    formData.append("image", file);
    let response = await fetch("./_controller/ajaxDatosINE.php", {
      method: "POST",
      body: formData,
    });
    let json = await response.json();
    loaderINE.classList.add("hidden");
    if (json.status === "error") {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: json.error,
      });
      return;
    }

    document.getElementById(
      "nombre"
    ).value = `${json.name.paternal_surname} ${json.name.maternal_surname} ${json.name.names}`;
    uploadZone.classList.add("hidden");
    formSection.classList.remove("hidden");
  } catch (err) {
    console.error(err);
    loaderINE.classList.add("hidden");
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "No se pudo cargar el archivo, intenta seleccionarlo",
    });
  }
}

if (btnReloadINE) {
  btnReloadINE.addEventListener("click", () => {
    uploadZone.classList.remove("hidden");
    formSection.classList.add("hidden");
  });
}
