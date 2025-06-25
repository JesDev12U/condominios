function cargarCancReag() {
  const $btnCancelar = document.querySelectorAll("#btn-cancelar");
  const $btnReagendar = document.querySelectorAll("#btn-reagendar");

  $btnCancelar.forEach(($btn) => {
    $btn.addEventListener("click", function (e) {
      const formData = new FormData();
      formData.append("id_evento", this.dataset.id_evento);
      formData.append("id_condomino", this.dataset.id_condomino);
      formData.append("operacion", "cancelar");
      asyncConfirmProcess(
        formData,
        `${this.dataset.url}_controller/condomino/eventos/AsyncCancReagEventos.php`,
        "Advertencia",
        "¿Está seguro de cancelar este evento?",
        "¡Hecho! El evento ha sido cancelado",
        () => {
          let $td = document.getElementById(`status${$btn.dataset.id_evento}`);
          if ($td) {
            tblReservaciones
              .cell($btn.dataset.id_evento - 1, 9)
              .data("Cancelado")
              .draw();
          }
          $btn.outerHTML = `<button class="btn btn-success" id="btn-reagendar" data-url="${$btn.dataset.url}" data-id_evento="${$btn.dataset.id_evento}" data-id_condomino="${$btn.dataset.id_condomino}">
                <i class="fa-solid fa-calendar"></i>
                Reagendar
              </button>`;
          cargarCancReag();
        }
      );
    });
  });

  $btnReagendar.forEach(($btn) => {
    $btn.addEventListener("click", function (e) {
      const formData = new FormData();
      formData.append("id_evento", this.dataset.id_evento);
      formData.append("id_condomino", this.dataset.id_condomino);
      formData.append("operacion", "reagendar");
      asyncConfirmProcess(
        formData,
        `${this.dataset.url}_controller/condomino/eventos/AsyncCancReagEventos.php`,
        "Advertencia",
        "¿Está seguro de reagendar este evento?",
        "¡Hecho! El evento ha sido reagendado",
        () => {
          let $td = document.getElementById(`status${$btn.dataset.id_evento}`);
          if ($td) {
            tblReservaciones
              .cell($btn.dataset.id_evento - 1, 9)
              .data("Activo")
              .draw();
          }
          $btn.outerHTML = `<button class="btn btn-danger" id="btn-cancelar" data-url="${$btn.dataset.url}" data-id_evento="${$btn.dataset.id_evento}" data-id_condomino="${$btn.dataset.id_condomino}">
                <i class="fa-solid fa-ban"></i>
                Cancelar
              </button>`;
          cargarCancReag();
        }
      );
    });
  });
}

cargarCancReag();
