function cargarDesHab() {
  const $btnDeshabilitar = document.querySelectorAll("#btn-deshabilitar");
  const $btnHabilitar = document.querySelectorAll("#btn-habilitar");

  $btnDeshabilitar.forEach(($btn) => {
    $btn.addEventListener("click", function () {
      const formData = new FormData();
      formData.append("id", this.dataset.id);
      formData.append("usuario", this.dataset.usuario);
      formData.append("operacion", "deshabilitar");
      asyncConfirmProcess(
        formData,
        `${this.dataset.url}_controller/admin/AsyncDesHabUsuarios.php`,
        "Advertencia",
        "¿Está seguro de deshabilitar este empleado?",
        "¡Hecho! El usuario ha sido deshabilitado",
        () => {
          $btn.outerHTML = `<button class="btn btn-success" id="btn-habilitar" data-url="${$btn.dataset.url}" data-usuario="${$btn.dataset.usuario}" data-id="${$btn.dataset.id}">
                <i class="fa-solid fa-check"></i>
                  Habilitar
                </button>`;
          cargarDesHab();
        }
      );
    });
  });

  $btnHabilitar.forEach(($btn) => {
    $btn.addEventListener("click", function () {
      const formData = new FormData();
      formData.append("id", this.dataset.id);
      formData.append("usuario", this.dataset.usuario);
      formData.append("operacion", "habilitar");
      asyncConfirmProcess(
        formData,
        `${this.dataset.url}_controller/admin/AsyncDesHabUsuarios.php`,
        "Advertencia",
        "¿Está seguro de habilitar este empleado?",
        "¡Hecho! El usuario ha sido habilitado",
        () => {
          $btn.outerHTML = `<button class="btn btn-danger" id="btn-deshabilitar" data-url="${$btn.dataset.url}" data-usuario="${$btn.dataset.usuario}" data-id="${$btn.dataset.id}">
                  <i class="fa-solid fa-ban"></i>
                  Deshabilitar
                </button>`;
          cargarDesHab();
        }
      );
    });
  });
}

cargarDesHab();
