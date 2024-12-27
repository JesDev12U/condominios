function cargarDesHabEmpleados() {
  const $btnDeshabilitarEmpleado = document.querySelectorAll(
    "#btn-deshabilitar-empleado"
  );
  const $btnHabilitarEmpleado = document.querySelectorAll(
    "#btn-habilitar-empleado"
  );

  $btnDeshabilitarEmpleado.forEach(($btn) => {
    $btn.addEventListener("click", function () {
      const formData = new FormData();
      formData.append("id_empleado", this.dataset.id_empleado);
      formData.append("operacion", "deshabilitar");
      asyncConfirmProcess(
        formData,
        "<?php echo SITE_URL; ?>_controller/admin/gestor_empleados/AsyncDesHabEmpleado.php",
        "Advertencia",
        "¿Está seguro de deshabilitar este empleado?",
        "¡Hecho! El empleado ha sido deshabilitado",
        () => {
          $btn.outerHTML = `<button class="btn btn-success" id="btn-habilitar-empleado" data-id_empleado="${$btn.dataset.id_empleado}">
                <i class="fa-solid fa-check"></i>
                  Habilitar
                </button>`;
          cargarDesHabEmpleados();
        }
      );
    });
  });

  $btnHabilitarEmpleado.forEach(($btn) => {
    $btn.addEventListener("click", function () {
      const formData = new FormData();
      formData.append("id_empleado", this.dataset.id_empleado);
      formData.append("operacion", "habilitar");
      asyncConfirmProcess(
        formData,
        "<?php echo SITE_URL; ?>_controller/admin/gestor_empleados/AsyncDesHabEmpleado.php",
        "Advertencia",
        "¿Está seguro de habilitar este empleado?",
        "¡Hecho! El empleado ha sido habilitado",
        () => {
          $btn.outerHTML = `<button class="btn btn-danger" id="btn-deshabilitar-empleado" data-id_empleado="${$btn.dataset.id_empleado}">
                  <i class="fa-solid fa-ban"></i>
                  Deshabilitar
                </button>`;
          cargarDesHabEmpleados();
        }
      );
    });
  });
}

cargarDesHabEmpleados();
