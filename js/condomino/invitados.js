function cargarOcDesoc() {
  const $btnDesocultar = document.querySelectorAll("#btn-desocultar");
  const $btnOcultar = document.querySelectorAll("#btn-ocultar");

  $btnDesocultar.forEach(($btn) => {
    $btn.addEventListener("click", function () {
      const formData = new FormData();
      formData.append("id_invitado", this.dataset.id_invitado);
      formData.append("id_condomino", this.dataset.id_condomino);
      formData.append("operacion", "desocultar");
      asyncConfirmProcess(
        formData,
        `${this.dataset.url}_controller/condomino/invitados/AsyncOcDesoc.php`,
        "Advertencia",
        "¿Está seguro de desocultar a este invitado?",
        "¡Hecho! El invitado ha sido desocultado",
        () => {
          $btn.outerHTML = `<button class="btn btn-danger" id="btn-ocultar" data-url="${$btn.dataset.url}" data-id_invitado="${$btn.dataset.id_invitado}" data-id_condomino=${$btn.dataset.id_condomino}">
                <i class='fa-solid fa-eye-slash'></i>
                Ocultar
              </button>`;
          const $registro = document.getElementById(
            `registro${this.dataset.id_invitado}`
          );
          const $btnQr = document.getElementById(
            `btn-qr${this.dataset.id_invitado}`
          );
          $registro.classList.remove("ocultar");
          $btnQr.disabled = false;
          cargarOcDesoc();
        }
      );
    });
  });

  $btnOcultar.forEach(($btn) => {
    $btn.addEventListener("click", function () {
      const formData = new FormData();
      formData.append("id_invitado", this.dataset.id_invitado);
      formData.append("id_condomino", this.dataset.id_condomino);
      formData.append("operacion", "ocultar");
      asyncConfirmProcess(
        formData,
        `${this.dataset.url}_controller/condomino/invitados/AsyncOcDesoc.php`,
        "Advertencia",
        "¿Está seguro de ocultar a este invitado?",
        "¡Hecho! El invitado ha sido ocultado",
        () => {
          $btn.outerHTML = `<button class="btn btn-success" id="btn-desocultar" data-url="${$btn.dataset.url}" data-id_invitado="${$btn.dataset.id_invitado}" data-id_condomino=${$btn.dataset.id_condomino}">
                <i class='fa-solid fa-eye'></i>
                Desocultar
              </button>`;
          const $registro = document.getElementById(
            `registro${this.dataset.id_invitado}`
          );
          const $btnQr = document.getElementById(
            `btn-qr${this.dataset.id_invitado}`
          );
          $registro.classList.add("ocultar");
          $btnQr.disabled = true;
          cargarOcDesoc();
        }
      );
    });
  });
}

cargarOcDesoc();
